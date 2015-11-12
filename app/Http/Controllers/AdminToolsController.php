<?php

namespace app\Http\Controllers;
use app\District;
use app\Organization;
use Illuminate\Support\Facades\Request;
use app\AdminTool;
use app\Jobs\ImportCSV;
use app\User;
use Illuminate\Support\Facades\Hash;
use app\Http\Requests;
use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AdminToolsController extends Controller
{
    public function uploadCsv(Request $request)
    {
        if (Request::isMethod('post')) {
            $validator = Validator::make(Input::all(), AdminTool::$uploadCsvRules);

            if ($validator->passes()) {
                $file = \Request::file('yourcsv');
	            //the files are stored in storage/app/*files*
                $output = Storage::put('yourcsvfile.csv', file_get_contents($file));
                if($output){
                    $importType = \Request::get('importType');
                    $data = array(
                        'parms' => array()
                    );
                    $this->dispatch(new ImportCSV($data));
                    return Redirect::to('admin/uploadcsv')->with('message', 'The following errors occurred')->withErrors
                    ('Your file has been successfully uploaded. You will receive an email notification once the import is completed.');
                } else {
                    return Redirect::to('admin/uploadcsv')->with('message', 'The following errors occurred')->withErrors
                    ('Something went wrong with your upload. Please try again.');
                }
            }else{
                return Redirect::to('admin/uploadcsv')->with('message', 'The following errors occurred')->withErrors
                ($validator)->withInput();
            }

        }
        return view('admin/uploadcsv');
    }


    public function importfiles(Request $request){
        if (Request::isMethod('post')) {
            $validator = Validator::make(Input::all(), AdminTool::$uploadCsvRules);
            if ($validator->passes()) {
                $file = \Request::file('yourcsv');
                $organization_id = (int) \Request::get('organizations');

                if ($file==''){
                    return Redirect::to('admin/importfiles')->with('message', 'The following errors occurred')->withErrors
                    ('Please upload your csv file.');
                }

                //the files are stored in storage/app/*files*
                $user_id = Auth::user()->id;
                $file_name = $file->getFilename()."_userid".$user_id."_time".time();
                $extension = $file->getClientOriginalExtension();
                $full_file_name = $file_name.".".$extension;
                $output = Storage::disk('local')->put($file_name.'.'.$extension,  \File::get($file));

                if($output){
                    $data = array(
                        'file' =>$full_file_name,
                        'parms' => array('organization_id' => $organization_id)
                    );
                    $this->dispatch(new ImportCSV($data));
                    return Redirect::to('admin/importfiles')->with('message', 'The following errors occurred')->withErrors
                    ('Your file has been successfully uploaded. You will receive an email notification once the import is completed.');
                } else {
                    return Redirect::to('admin/importfiles')->with('message', 'The following errors occurred')->withErrors
                    ('Something went wrong with your upload. Please try again.');
                }
            }else{
                return Redirect::to('admin/importfiles')->with('message', 'The following errors occurred')->withErrors
                ($validator)->withInput();
            }

        }





        $district_id = (int) Request::query('district');
        $districts = District::All();
        $selected_district = 0;
        $organizations = array();
        if ($district_id) {
            $selected_district = District::where('id', '=', $district_id)->get(array('id'));
            $organizations = District::with('organizations')->where('id', '=', $district_id)->get();
        }
        return view('admin/importfiles',compact('districts','selected_district','organizations'));
    }
}
