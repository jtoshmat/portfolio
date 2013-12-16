<?php

class AddRegistration
{

  /**
   * 
   * @var RegistrationRequest $request
   * @access public
   */
  public $request;

  /**
   * 
   * @param RegistrationRequest $request
   * @access public
   */
  public function __construct($request)
  {
    $this->request = $request;
  }

}
