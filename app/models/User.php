<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User
  extends Eloquent
  implements UserInterface, RemindableInterface
{
  protected $table = "user";
  protected $hidden = ["password"];

  public static $rules = array(
    'username'=>'required|unique:user|alpha|min:2',
    'password'=>'required|alpha_num|between:6,12|confirmed',
    'password_confirmation'=>'required|alpha_num|between:6,12'
    );

  public static $rules2 = array(
      'email'=>'required|email|min:4',

  );

  public function getAuthIdentifier()
  {
    return $this->getKey();
  }

  public function getAuthPassword()
  {
    return $this->password;
  }

  public function getRememberToken()
  {
    return $this->remember_token;
  }

  public function setRememberToken($value)
  {
    $this->remember_token = $value;
  }

  public function getRememberTokenName()
  {
    return "remember_token";
  }

  public function getReminderEmail()
  {
    return $this->email;
  }
}
