<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Bar extends Eloquent implements UserInterface, RemindableInterface {



	public static $rules = array(
		'barname'=>'required regex:[0-9]',
//		'address'=>'required|alpha|min:2',
//		'city'=>'required|alpha|min:2',
//		'zipcode'=>'required|alpha|min:2',
	);

	public static $addrules = array(
		'barname'=>'required|string',
		'address'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Za-z0-9 ]+$)+/'
		),
		'city'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Za-z0-9 ]+$)+/'
		),
		'state'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Z]{2}+$)+/'
		),
		'zipcode'=>array(
			'required',
			'min:5',
			'regex:/(^[0-9 ]{5,5}$)+/'
		),
		'website'=>'active_url|min:7',
		'timezone'=>'required',
	);

	public static $updatebarrules = array(
		'barname'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Za-z0-9 ]+$)+/'
		),
		'address'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Za-z0-9 ]+$)+/'
		),
		'city'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Za-z0-9 ]+$)+/'
		),
		'state'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Z]{2}+$)+/'
		),
		'zipcode'=>array(
			'required',
			'min:5',
			'regex:/(^[0-9 ]{5,5}$)+/'
		),
		'website'=>'active_url|min:7',
		'logo'=>'image',
	);

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bars';

	protected $rzd;

	public function __construct() {
		$this->rzd = new RefZipDetails;
	}

	public function upload() {
		return $this->hasOne('Upload', 'bid');
	}

	public function events() {
		return $this->hasMany('Bevent', 'barid');
	}

	protected function isAdmin(){
		return Auth::user()->admin;
	}

	public function getBars(){
		$id = Auth::user()->id;
		if ($this->isAdmin()) {
			return DB::select(DB::raw('
				SELECT *, (SELECT count(*) FROM bars LEFT JOIN games ON bars.id=games.bid WHERE games.bid=b.id) as
				totalGames,b.id as id, b.uid as uid
				FROM bars AS b
				LEFT JOIN games AS g
				ON b.id = g.bid
				LEFT JOIN uploads ON b.id = uploads.bid
				GROUP BY b.id
					 '));
		}
		else {
			return DB::select(DB::raw('
				SELECT *, (SELECT count(*) FROM bars LEFT JOIN games ON bars.id=games.bid WHERE games.bid=b.id) as
				totalGames,b.id as id, b.uid as uid
				FROM bars AS b
				LEFT JOIN games AS g
				ON b.id = g.bid
				LEFT JOIN uploads ON b.id = uploads.bid
				WHERE b.uid = '.$id.'
				GROUP BY b.id
					 '));
		}
		return false;
	}

	public function getBar(){
		$id = (int) Request::segment(2);
		if ($this->isAdmin()===1) {
			return Bar::where('id', '=', $id)->firstOrFail();
		}
		if ($this->isAdmin()===0) {
			return Bar::where('id', '=', $id)->where('uid', '=', Auth::user()->id)->firstOrFail();
		}
		return false;
	}

	public function approveBar(){
		$val = (int) Request::get('val');
		$bid = (int) Request::segment(4);
		$bar =Bar::find($bid);
		$bar->status = $val;
		$bar->save();
		return true;
	}

	public function addBar(){
		$insertData = array(
			'uid' => Auth::user()->id,
			'barname' => Input::get('barname'),
			'slug' => (\Illuminate\Support\Str::slug(Input::get('barname'))),
			'address' => Input::get('address'),
			'city' => Input::get('city'),
			'state' => Input::get('state'),
			'zipcode' => Input::get('zipcode'),
            'country' => Input::get('country'),
            'timezone' => Input::get('timezone'),
			'phone' => Input::get('phone'),
			'website' => Input::get('website'),
			'description' => Input::get('description'),
		);

		$geoData = $this->geocodeBar($insertData['zipcode']);
		if($geoData) {
			$insertData['latitude'] = $geoData['latitude'];
			$insertData['longitude'] = $geoData['longitude'];
		}

		$lastId = DB::table('bars')->insertGetId($insertData);

		return $lastId;

	}

	public function updateBar($bid, $uid){
 	
		$fillable = array(
		'uid' => $uid,
		'barname' => Input::get('barname'),
		'address' => Input::get('address'),
		'city' => Input::get('city'),
		'state' => Input::get('state'),
		'country' => Input::get('country'),
		'timezone' => Input::get('timezone'),
		'zipcode' => Input::get('zipcode'),
		'phone' => Input::get('phone'),
		'website' => Input::get('website'),
		'owner_email' => Input::get('owner_email'),
		'description' => Input::get('description'),
			
		);

		$geoData = $this->geocodeBar($fillable['zipcode']);
		if($geoData) {
			$fillable['latitude'] = $geoData['latitude'];
			$fillable['longitude'] = $geoData['longitude'];
		}

		$output = Bar::where('id','=', $bid)->update($fillable);
		return $output;

	}

	public function deleteBar(){
		$id = (int) Request::query('id');
		return Bar::find($id)->delete();
	}

	public function geocodeBar($zipcode) {
		$geoData = $this->rzd->getGeoDataByZip($zipcode);
		return !empty($geoData) ? $geoData->toArray() : false;
	}

	public function findByName($name) {
		return $this->where('barname', '=', $name)->with('events')->where('status', '=', 1)->first();
	}

	public function findByZip($zipcode) {
		return $this->where('zipcode', '=', $zipcode)->with('events')->where('status', '=', 1)->get();
	}

}
