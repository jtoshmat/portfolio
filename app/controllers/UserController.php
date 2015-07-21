<?php

class UserController
  extends Controller
{

 
public function __construct(){
 \Session::flash('mymessage','');
 

}


protected function isNotAuthorized(){
    if (\Session::get('privileges')==0){
        return 'user/403';
     }

}

protected function isAdmin(){
    return \Session::get('pusertype');
}


  public function login()
  {
    if ($this->isPostRequest()) {
      $validator = $this->getLoginValidator();

      if ($validator->passes()) {
        $credentials = $this->getLoginCredentials();

        if (Auth::attempt($credentials)) {
          /*
          To represent rwx triplet use 4+2+1=7 | can do everything
          To represent rw- triplet use 4+2+0=6 | read and write
          To represent r-- triplet use 4+0+0=4 | read only
          To represent --- triplet use 0 |  nothing
          */
          $uid = Auth::user()->id;
           $role = Role::where('uid', '=', $uid)->firstOrFail();
           \Session::put('privileges', $role->privileges);
           \Session::put('pusertype', $role->pusertype);
           \Session::flash('mymessage','You are logged in');
          return Redirect::route("user/profile");
        }

        return Redirect::back()->withErrors([
          "password" => ["Credentials invalid."]
        ]);
      } else {
        return Redirect::back()
          ->withInput()
          ->withErrors($validator);
      }
    }

    return View::make("user/login");
  }

  protected function isPostRequest()
  {
    return Input::server("REQUEST_METHOD") == "POST";
  }

  protected function getLoginValidator()
  {
    return Validator::make(Input::all(), [
      "username" => "required",
      "password" => "required"
    ]);
  }

  protected function getLoginCredentials()
  {
    return [
      "username" => Input::get("username"),
      "password" => Input::get("password")
    ];
  }

  public function profile()
  {
     
    $action = Request::query('action');
    if ($action){
      \Session::flash('mymessage','The record has been '.$action)->get();
    }

      if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }

    $id = Auth::user()->id;
 

    switch ($this->isAdmin()){
      case 1: //Super Admin
        $bars = DB::select(DB::raw('select * from bars as b left join bevents as ev on b.id=ev.barid group by b.id'));
      break;
      
      case 2: //Bar Admin
        $bars = DB::select(DB::raw('select * from bars as b left join bevents as ev on b.id=ev.barid where b.userid = '.$id.' group by b.id'));
      break; 
       
      default: //Anybody else
        $bars = NULL;
      break; 
    }


     if ($bars){
      return View::make('bars/bars')->with('bars', $bars);
     }
     return View::make('bars/addnewbar');

  }

  public function users()
  {

   if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }

    switch ($this->isAdmin()){
      case 1: //Super Admin
        $users = User::all();
      break;
      
      case 2: //Bar Admin
        $users = User::where('parentid', '=', Auth::user()->id)->get();
      break; 
       
      default: //Anybody else
        $users = User::where('id', '=', Auth::user()->id)->get();
      break; 
    }

     return View::make('user/users')->with('users', $users);

  }



  public function deleteBevent()
  {
    if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }     
     $id = Request::query('id');
     $Bevent = Bevent::find($id);
     $Bevent->delete();
      \Session::flash('mymessage','The event has been deleted');
     return 'The event has been deleted';

  }

  public function viewBar()
  {
    if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }   
    $id = Request::query('id');  
     
    switch ($this->isAdmin()){
      case 1: //Super Admin
        $bars = Bar::where('id', '=', $id)->firstOrFail();
      break;
      
      case 2: //Bar Admin
        $bars = Bar::where('id', '=', $id)->where('userid', '=', Auth::user()->id)->firstOrFail();
      break; 
       
      default: //Anybody else
        $bars = NULL;
      break; 
    }
}
  public function addNewBar()
  {
  
   
      return View::make('bars/addnewbar');
 

  }

  public function editBar()
  {
    if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }     
     $id = Request::query('id');

     switch ($this->isAdmin()){
      case 1: //Super Admin
        $bars = Bar::where('id', '=', $id)->firstOrFail();
      break;
      
      case 2: //Bar Admin
        $bars = Bar::where('id', '=', $id)->where('userid', '=', Auth::user()->id)->firstOrFail();
      break; 
       
      default: //Anybody else
        $bars = NULL;
      break; 
    }

 

    if ($bars){
      return View::make('bars/editbar')->with('bars', $bars);
     }
     return View::make('user/403');
     

  }

  public function bevents()
  {
    if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }
     $id = Request::query('id');

     switch ($this->isAdmin()){
      case 1: //Super Admin
        $bevents = Bevent::where('barid', '=', $id)->get();
      break;
      
      case 2: //Bar Admin
        $bevents = Bevent::where('barid', '=', $id)->where('userid','=', Auth::user()->id)->get();
      break; 
       
      default: //Anybody else
        $bars = NULL;
      break; 
    }

    if ($bevents){
      return View::make('bars/bevents')->with('bevents', $bevents);
     }
     return View::make('user/403');

 

  }

  public function bevent()
  {
  if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }
     $id = Request::query('id');

     switch ($this->isAdmin()){
      case 1: //Super Admin
        $bevents = Bevent::where('barid', '=', $id)->get();
      break;
      
      case 2: //Bar Admin
        $bevents = Bevent::where('barid', '=', $id)->where('userid','=', Auth::user()->id)->get();
      break; 
       
      default: //Anybody else
        $bars = NULL;
      break; 
    }

    if ($bevents){
      return View::make('bars/bevents')->with('bevents', $bevents);
     }
     return View::make('user/403');
 

  }

  public function editBevent()
  {
    if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }       
     $id = Request::query('id');
     $bevent = Bevent::where('id', '=', $id)->firstOrFail();
     return View::make('bars/editBevent')->with('bevent', $bevent);

  }

  public function updateBevent()
  {
    if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }  
    $id = Request::get('id');
    $Bevent = Bevent::find($id);
    $Bevent->title = Input::get('title');
    $Bevent->save();
    \Session::flash('mymessage','The bar has been updated');
    return View::make('bars/editbevent')->with('bevent', $Bevent);
     

  }

  public function deleteBar()
  {
    if ($this->isNotAuthorized()){
      return 'Unauthorized Access';
    }       
     $id = Request::query('id');
     $Bar = Bar::find($id);
     $Bar->delete();
      \Session::flash('mymessage','The bar has been deleted');
     return 'The bar has been deleted';

  }

  public function updateBar()
  {
    if ($this->isNotAuthorized()){
      return View::make($this->isNotAuthorized());
    }  
    $id = Request::get('id');
    $Bar = Bar::find($id);
    $Bar->promo = Input::get('promo');
    $Bar->address = Input::get('address');
    $Bar->city = Input::get('city');
    $Bar->zipCode = Input::get('zipcode');
    $Bar->save();
    \Session::flash('mymessage','The bar has been updated');
    return View::make('bars/editbar')->with('bars', $Bar);
     

  }

  public function request()
  {
    if ($this->isPostRequest()) {
      $response = $this->getPasswordRemindResponse();

      if ($this->isInvalidUser($response)) {
        return Redirect::back()
          ->withInput()
          ->with("error", Lang::get($response));
      }

      return Redirect::back()
        ->with("status", Lang::get($response));
    }

    return View::make("user/request");
  }

  protected function getPasswordRemindResponse()
  {
    return Password::remind(Input::only("email"));
  }

  protected function isInvalidUser($response)
  {
    return $response === Password::INVALID_USER;
  }

  public function reset($token)
  {
    if ($this->isPostRequest()) {
      $credentials = Input::only(
        "email",
        "password",
        "password_confirmation"
      ) + compact("token");

      $response = $this->resetPassword($credentials);

      if ($response === Password::PASSWORD_RESET) {
        return Redirect::route("user/profile");
      }

      return Redirect::back()
        ->withInput()
        ->with("error", Lang::get($response));
    }

    return View::make("user/reset", compact("token"));
  }

  public function register()
  {
      $method = Request::method();
      if (Request::isMethod('post'))
      {
        $username = Input::get('username');
        $password = Input::get('password');
        $password2 = Input::get('password2');
        $matched = strcasecmp($password,$password2);

        if($matched!==0){
          echo "Not matched";
        }

        $validator = Validator::make(Input::all(), User::$rules);
 
        if ($validator->passes()) {
            $user = new User;
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
         
            return Redirect::to('users/login')->with('message', 'Thanks for registering!');
        } else {
            return Redirect::to('register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }


      }
      return View::make("user/register");
  }

  protected function resetPassword($credentials)
  {
    return Password::reset($credentials, function($user, $pass) {
      $user->password = Hash::make($pass);
      $user->save();
    });
  }

  public function logout()
  {
    \Session::forget('pusertype'); 
    \Session::forget('privileges'); 
    \Session::put('pusertype',0);
    \Session::put('privileges',0);

    Auth::logout();

    return Redirect::route("user/login");
  }

  public function error()
  {
    return View::make('errors/error');

  }

}
