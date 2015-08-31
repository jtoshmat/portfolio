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
		'city'=>'required | string',
		/*
		'state'=>array(
			'required',
			'min:2
			'regex:/(^[A-Z]{2}+$)+/'
		),*/
		'zipcode'=>array(
			'required',
			'min:5',
			'regex:/([A-Z0-9 ]{5,10}$)+/'
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
		/*
		'state'=>array(
			'required',
			'min:2',
			'regex:/(^[A-Z]{2}+$)+/'
		),*/
		'zipcode'=>array(
			'required',
			'min:5',
			'regex:/([A-Z0-9 ]{5,10}$)+/'
		),
		'website'=>'active_url|min:7',
		'logo'=>'image',
	);

	public static $addbarrulesapi = array(
		'barname'=>'required|string',
		'zipcode'=>array(
			'required',
			'min:5',
			'regex:/(^[0-9 ]{5,5}$)+/'
		),
		'email'=>'required|email',
		'address'=>'required',

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
		if ($this->isAdmin()==1) {
			return Bar::where('id', '=', $id)->firstOrFail();
		}
		if ($this->isAdmin()==0) {
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
		try {
			$bar = $this->where('barname', '=', $name)
				->orWhere('slug', '=', $name)
				->with('events')
				->with('upload')
				->where('status', '=', 1)->firstOrFail();

			if ($bar->events->count() > 0) {
				$bar->events->each(function ($event) {
					$event->game = \Game::where('gid', '=', $event->gid)->first();
					$event->apiTransform();
				});
			}
			$bar->apiTransform();
			return $bar;
		}
		catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return false;
		}
	}

	public function findAllByZip($zipcode) {
		$bars = $this->where('zipcode', '=', $zipcode)
			->with('events')
			->with('upload')
			->where('status', '=', 1)->get();
		if($bars) {
			foreach($bars as $bar) {
				if ($bar->events && $bar->events->count() > 0) {
					$bar->events->each(function ($event) {
						$event->game = \Game::where('gid', '=', $event->gid)->first();
						$event->apiTransform();
					});
				}
				$bar->apiTransform();
			}
			return $bars;
		}
		else {
			return false;
		}
	}

	public function findByGeo($ll, $ln, $radius){
		$bars = $this->selectRaw(" *,
            (6371 * acos( cos( radians(".$ll.") ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians(".$ln.") ) + sin( radians(".$ll.") ) * sin( radians( `latitude` ) ) ) ) AS distance")
			->having('distance', '<=', $radius)
			->orderBy('distance', 'asc')
			->with('upload')
			->get();

		if($bars) {
			foreach($bars as $bar) {
				$bar->apiTransform();
			}
		}
		return $bars;
	}

	public function findByZip($zipcode) {
		return $this->where('zipcode', '=', $zipcode)->with('events')->where('status', '=', 1)->first();
	}

	public function apiTransform() {
		unset($this->id, $this->uid, $this->status);
		$this->key_name = $this->slug; unset($this->slug);
		$this->telephone = $this->phone; unset($this->phone);
		$this->county = null;
		$this->logo = $this->upload ? $this->upload->logo : null;
		unset($this->upload);
		$this->timeAdded = (string) $this->created_at; unset($this->created_at);
		$this->email = $this->owner_email;
		$this->name = $this->barname;
		unset($this->owner_email, $this->updated_at, $this->barname);
		$this->contactFirstName = null;
		$this->contactLastName = null;
		$this->favorites = 0;
		$this->hash = "";
		$this->latlng = array(
			'lat' => (float) $this->latitude,
			'lon' => (float) $this->longitude
		);
		unset($this->longitude, $this->latitude);
	}

	public function createBarApi($uid){
		$bar = new \Bar;
		$bar->uid = $uid;
		$bar->barname = \Input::get('barname');
		$bar->address = \Input::get('address');
		$bar->city = \Input::get('city');
		$bar->zipcode = \Input::get('zipcode');
		$bar->owner_email = \Input::get('email');
		$bar->phone = \Input::get('phone');
		$bar->save();
		$insertedId = $bar->id;
		return $insertedId;
	}

}
