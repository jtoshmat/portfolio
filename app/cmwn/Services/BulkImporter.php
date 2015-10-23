<?php

namespace app\cmwn\Services;

use Illuminate\Foundation\Bus\DispatchesJobs;

use app\cmwn\Services\Notifier;
use app\District;
use app\Organization;
use app\User;

use Illuminate\Support\Facades\Auth;

class BulkImporter
{
	use DispatchesJobs;

	public static function migratecsv(){

		$file = base_path( 'storage/app/yourcsv.csv' );

		$csv = self::csv_to_array($file);

		self::updateDB($csv);
	}

	public static function csv_to_array($filename='', $delimiter=',')
	{
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;

		$header = NULL;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== FALSE)
		{
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
			{
				if(!$header)
					$header = $row;
				else
					$data[] = array_combine($header, $row);
			}
			fclose($handle);
		}
		return $data;
	}

    protected static function updateDB($data)
    {
	    foreach($data as $title){
		    if ($title['STUDENT ID']!='') {

			    //creating or updating districts
			    $DDBNNN = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$title['DDBNNN']);
			    $district = District::firstOrCreate(['code' => $DDBNNN[0], 'system_id' => 1]);
				$district->code = $DDBNNN[0];
				$district->system_id= 1;
				$district->title = 'District '. $DDBNNN[0];
			    $district->save();

			    //@TODO find a way where from $organization
			    $organization = Organization::firstOrCreate(['code' => $DDBNNN[1]]);
			    $organization->title = $DDBNNN[1];
			    $organization->save();

			    if (!$organization->districts->contains($district->id)) {
				    $organization->districts()->attach($district->id);
			    }

			    $user = User::firstOrCreate(['student_id' => $title['STUDENT ID']]);
			    
			    $user->student_id = $title['STUDENT ID'];
			    $user->first_name = $title['FIRST NAME'];
			    $user->last_name  = $title['LAST NAME'];
			    $user->sex        = $title['SEX'];
			    $user->dob        = $title['BIRTH DT'];
			    $user->save();

		    }
	    }

	    $notifier = new Notifier();
	    $notifier->to = Auth::user()->email;
	    $notifier->subject = "Your import is completed at ". date('m-d-Y h:i:s A');
	    $notifier->template = "emails.import";
	    $notifier->attachData(['user'=>Auth::user()]);
	    $notifier->send();
    }
}

	/*
	 * "DDBNNN" => "14K120"
    "LAST NAME" => "Smith"
    "FIRST NAME" => "Jim"
    "STUDENT ID" => "236199170"
    "SEX" => "M"
    "BIRTH DT" => "20100612"
    "OFF CLS" => "013"
    "GRD CD" => "310"
    "GRD LVL" => "0K"
    "STREET NUM" => "574"
    "STREET" => "Q STREET"
    "APT" => "1"
    "CITY" => "BROOKLYN"
    "ST" => "NY"
    "ZIP" => "11221"
    "HOME PHONE" => "(555)555-1378"
    "ADULT LAST 1" => "Smith"
    "ADULT FIRST 1" => "Mommy"
    "ADULT PHONE 1" => "(555)555-3398"
    "ADULT LAST 2" => ""
    "ADULT FIRST 2" => ""
    "ADULT PHONE 2" => ""
    "ADULT LAST 3" => ""
    "ADULT FIRST 3" => ""
    "ADULT PHONE 3" => ""
    "STUDENT PHONE" => ""
    "MEAL CDE" => "1"
    "YTD ATTD PCT" => "100"
    "EMAIL" => ""
	 */