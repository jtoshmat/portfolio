<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Upload extends Eloquent implements UserInterface, RemindableInterface {

	public static $uploadrules = array(
		'logo'=>'image',
		'bid'=> 'required|numeric|min:1',

	);

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'uploads';

	public function bar() {
		return $this->belongsTo('Bar', 'bid');
	}

	public function user() {
		return $this->belongsTo('User', 'uid');
	}

	public function addUploadedImage($filename, $bid){

		$checkLogoDuplicate = Upload::where('bid','=', $bid)->get(array('uploadid'));
		$uploadid = false;
		foreach ($checkLogoDuplicate as $found) {
			if ($found){
				$uploadid = $found->uploadid;
			}
		}

		//update the existing image
		if ($uploadid){
		$output = DB::table('uploads')
            ->where('uploadid', $uploadid)
            ->update(array(
            	'filename' => $filename,
            	'uid' =>Auth::user()->id,
            	'bid' =>$bid
            	));
            return $output;
        }

		//insert a new image
		$output = DB::table('uploads')->insert(
			[
				'filename' => $filename,
				'uid'      => Auth::user()->id,
				'bid'      => $bid,
			]
		);
		return $output;
	}
	

}
