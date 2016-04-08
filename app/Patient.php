<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class Patient extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'users';
    protected $fillable = [
        'cid','fullname', 'email', 'password',
    ];

    protected $primaryKey = 'cid';

    public static $registerRules = array(
        'email' => 'required|Between:3,64|Email',
        'empid'=>'integer|required',
    );

    public static $getPatientRules = array(
        'cid' => 'required|integer|exists:users,cid,type,1',
        'orgid'=>'integer|required|exists:organizations,id',
        'short' => array('sometimes', 'regex:/^(yes|no)$/i'),
    );

    public static $createPatientRules = array(
        'orgid'=>'integer|required|exists:organizations,id',
        'empid' => 'unique:users,empid',
        'email' => 'required|email|unique:users,email'
    );

    public static $updatePatientRules = array(
        'cid' => 'required|integer|exists:users,cid,type,1',
        'orgid'=>'integer|required|exists:organizations,id',
        'email' => 'sometimes|email|unique:users,email'
    );

    public function organization(){
        return $this->belongsTo('app\Organization','org_id');
    }

    public function createPatient($data){
        $found = Patient::where('email','=', $data['email'])->OrWhere('empid', $data['empid'])->first();
        if(isset($found->id)){
            return [
                'error' => true,
                'status' => 500,
                'message' => 'The email address or patient id is already registered in the system'
            ];
        }
        $this->email = $data['email'];
        $this->org_id = $data['orgid'];
        if (isset($data['empid'])) {
            $this->empid = $data['empid'];
        }
        if (isset($data['userid'])) {
            $this->enteredby = $data['userid'];
        }
        $this->status = 'I';
        $this->activation_code = rand(10000000,99999999);

        if(!$this->save()){
            return [
                'error' => true,
                'status' =>500,
                'message' =>"{$this->email} is not registered"
            ];
        }
        $organization = Organization::find($this->org_id);
        return [
          'error' => false,
          'status' =>200,
          'cid' => $this->cid,
          'email' => $this->email,
          'message' =>"{$this->email} has been successfully registered",
          'from_email_address' => $organization->from_email_address,
          'from_email_orgname' => $organization->from_email_orgname,
        ];
    }

    public function updatePatient($data){
        $user = self::find($data['cid']);
        $user->org_id = $data['orgid'];

        if(isset($data['first_name'])){
            $user->first_name = $data['first_name'];
        }

        if(isset($data['last_name'])){
            $user->last_name = $data['last_name'];
        }

        if(isset($data['email'])){
            $user->email = $data['email'];
        }

        if(isset($data['password'])){
            $user->password = Hash::make($data['password']);
        }

        if(isset($data['mobile_number'])){
            $user->mobile_number = $data['mobile_number'];
        }

        if(isset($data['device_token'])){
            $user->device_token = $data['device_token'];
        }


        if(!$user->save()){
            return [
                'error' => true,
                'status' =>500,
                'message' =>"The user is not updated"
            ];
        }
        return [
            'error' => false,
            'status' =>200,
            'message' =>"The user has been successfully updated"
        ];
    }
}
