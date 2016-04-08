<?php

namespace app\Http\Controllers;

use app\Services\UnityAdapter;
use app\User;
use Illuminate\Http\Request;

use app\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use app\Services\AdapterLog;

class UsersController extends ApiResponseController
{

    public $parms;

    public function loginForm(){
        return view('login');
    }

    public function loginPost(\Request $request){
        if ($request::isMethod('post')) {
            $validator = Validator::make(Input::all(), User::$loginRules);
            if ($validator->passes()) {
                $data=Input::get();
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
                {
                    return Redirect::to('/')->with('message', 'Successfull login')->with('flag', 'info');
                }
                return Redirect::to('/login')->with('message', 'The following errors occurred')->withErrors
                ($validator)->withInput()->with('flag', 'danger');
            }
            return Redirect::to('/login')->with('message', 'The following errors occurred')->withErrors
            ($validator)->withInput()->with('flag', 'danger');
        }
    }
    public function user(Request $request){
        $this->parms = json_decode($request->getContent(), true);
        $validation = $this->checkDataInput();
        if(isset($validation['code'])){
            return $this->errorWrongArgs($validation['message']);
        }
        $function = $this->parms[0]['action']."User";
        return $this->$function($request);
    }
    protected function checkDataInput(){
        $action = isset($this->parms[0]['action'])?$this->parms[0]['action']:null;
        $rule = $action."UserRules";
        $validator = Validator::make($this->parms[0], User::$$rule);

        if (!$validator->passes()) {
            $messages = $validator->errors()->getMessages();
            $msg = null;
            foreach ($messages as $m){
                $msg.=" ".$m[0];
            }
            $error = [
                'code' => 500,
                'message' =>"Input validation:".$msg
            ];
            AdapterLog::log($error['message'].' at '.__METHOD__.':'.__LINE__,'warning');
            return $error;
        }
    }

    protected function loginUser(){
        $data = $this->parms;
        if (Auth::attempt(['email' => $data[0]['email'], 'password' => $data[0]['password']]))
        {
            $user = Auth::user();
            $output = [
                'code' => 200,
                'message' => "Successfully logged in",
            ];

            $adapter = 'app\\Services\\'.\Config::get('myadapter.organizations.'.$data[0]['orgid'].".adapter")['primary'];
            $data['action'] = 'get';
            $data['cid'] = $user->cid;
            $data['function'] = 'patient';
            $allscript =  $adapter::processRequest($data);
            $realUser = json_decode($allscript, true);
            unset($user->empid);
            unset($user->created_at);
            unset($user->deleted_at);
            unset($user->updated_at);
            unset($user->activation_code);
            $user->first_name = $realUser[0]["getpatientinfo"][0]["Firstname"];
            $user->last_name = $realUser[0]["getpatientinfo"][0]["LastName"];
            return $this->successfullReponse($output['message'], ['user'=>$user]);
        }
        $output = [
            'code' => 500,
            'message' => "Wrong username/password"
        ];
        return $this->errorInternalError($output['message']);
    }

    protected function logoutUser(){
        echo csrf_token();
        return Auth::logout();
    }
}
