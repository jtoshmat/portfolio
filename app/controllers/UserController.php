<?php

class UserController
  extends Controller
{

public function __construct(){
  \Session::flash('mymessage','');
}


  public function login()
  {
    if ($this->isPostRequest()) {
      $validator = $this->getLoginValidator();

      if ($validator->passes()) {
        $credentials = $this->getLoginCredentials();

        if (Auth::attempt($credentials)) {
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
      \Session::flash('mymessage','The record has been '.$action);
    }
 
      
     $bars = Bar::all();
     return View::make('bars/bars')->with('bars', $bars);

  }

  public function users()
  {
     $users = User::all();
     return View::make('user/users')->with('users', $users);

  }

  public function bevents()
  {
     $id = Request::query('id');
     $bevents = Bevent::where('barid', '=', $id)->get();
     return View::make('bars/bevents')->with('bevents', $bevents);

  }

  public function bevent()
  {
     $id = Request::query('id');
     $bevent = Bevent::where('id', '=', $id)->firstOrFail();
     return View::make('bars/bevent')->with('bevent', $bevent);

  }

  public function deleteBevent()
  {
     $id = Request::query('id');
     $Bevent = Bevent::find($id);
     $Bevent->delete();
      \Session::flash('mymessage','The event has been deleted');
     return 'The event has been deleted';

  }

  public function viewBar()
  {
     $id = Request::query('id');
 
     $bars = Bar::where('id', '=', $id)->firstOrFail();
     return View::make('bars/bar')->with('bars', $bars);

  }

  public function editBar()
  {
     $id = Request::query('id');
 
     $bars = Bar::where('id', '=', $id)->firstOrFail();
     return View::make('bars/editbar')->with('bars', $bars);

  }

  public function editBevent()
  {
     $id = Request::query('id');
 
     $bevent = Bevent::where('id', '=', $id)->firstOrFail();
     return View::make('bars/editBevent')->with('bevent', $bevent);

  }

  public function updateBevent()
  {

    $id = Request::get('id');
    $Bevent = Bevent::find($id);
    $Bevent->title = Input::get('title');
    $Bevent->save();
    \Session::flash('mymessage','The bar has been updated');
    return View::make('bars/editbevent')->with('bevent', $Bevent);
     

  }

  public function deleteBar()
  {
     $id = Request::query('id');
     $Bar = Bar::find($id);
     $Bar->delete();
      \Session::flash('mymessage','The bar has been deleted');
     return 'The bar has been deleted';

  }

  public function updateBar()
  {

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

  protected function resetPassword($credentials)
  {
    return Password::reset($credentials, function($user, $pass) {
      $user->password = Hash::make($pass);
      $user->save();
    });
  }

  public function logout()
  {
    Auth::logout();

    return Redirect::route("user/login");
  }
}
