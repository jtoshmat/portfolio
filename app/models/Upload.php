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
		$checkLogoDuplicate = Upload::where('filename','=', $filename)->where('bid','=', $bid)->count();
		if($checkLogoDuplicate){
			return false;
		}
		$output = DB::table('uploads')->insert(
			[
				'filename' => $filename,
				'uid'      => Auth::user()->id,
				'bid'      => $bid,
			]
		);
	}
	

}
