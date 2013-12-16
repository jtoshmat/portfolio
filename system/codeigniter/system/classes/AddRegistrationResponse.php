<?php

class AddRegistrationResponse
{

  /**
   * 
   * @var RegistrationResponse $AddRegistrationResult
   * @access public
   */
  public $AddRegistrationResult;

  /**
   * 
   * @param RegistrationResponse $AddRegistrationResult
   * @access public
   */
  public function __construct($AddRegistrationResult)
  {
    $this->AddRegistrationResult = $AddRegistrationResult;
  }

}
