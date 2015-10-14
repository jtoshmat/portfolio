<?php

namespace cmwn\Http\Controllers;


use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use cmwn\Http\Requests;
use cmwn\Http\Controllers\Controller;

class BatchController implements SelfHandling, ShouldQueue
{
	use InteractsWithQueue, SerializesModels;

    public static function run()
    {
        return self::migratecsv();
    }

	protected static function migratecsv(){
		$file = base_path( 'storage/app/yourcsv.csv' );
		$csv = self::csv_to_array($file);
		$output = self::updateDB($csv);
		if(!$output){
			return Redirect::to('admin/uploadcsv')->with('message', 'The following errors occurred')->withErrors
			('Something went wrong with your import. Please try again.');
		}
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
		    \DB::table('states')->insert(
			    [
				    'StateCode' => $title['StateCode'],
				    'StateName' => $title['StateName'],
				    'IsRealState' => $title['IsRealState'],
				    'StateDate' => $title['StateDate'],

			    ]

		    );
	    }
	    return true;


    }
}
