<?php

class Person
{

  /**
   * 
   * @var string $AccountCode
   * @access public
   */
  public $AccountCode;

  /**
   * 
   * @var string $Address1
   * @access public
   */
  public $Address1;

  /**
   * 
   * @var string $Address2
   * @access public
   */
  public $Address2;

  /**
   * 
   * @var string $City
   * @access public
   */
  public $City;

  /**
   * 
   * @var string $Company
   * @access public
   */
  public $Company;

  /**
   * 
   * @var string $Country
   * @access public
   */
  public $Country;

  /**
   * 
   * @var string $EmailAddress
   * @access public
   */
  public $EmailAddress;

  /**
   * 
   * @var string $ExternalAccountCode
   * @access public
   */
  public $ExternalAccountCode;

  /**
   * 
   * @var string $FirstName
   * @access public
   */
  public $FirstName;

  /**
   * 
   * @var string $LastName
   * @access public
   */
  public $LastName;

  /**
   * 
   * @var string $MiddleInitial
   * @access public
   */
  public $MiddleInitial;

  /**
   * 
   * @var string $Phone
   * @access public
   */
  public $Phone;

  /**
   * 
   * @var string $PostalCode
   * @access public
   */
  public $PostalCode;

  /**
   * 
   * @var string $State
   * @access public
   */
  public $State;

  /**
   * 
   * @var string $Suffix
   * @access public
   */
  public $Suffix;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @param string $AccountCode
   * @param string $Address1
   * @param string $Address2
   * @param string $City
   * @param string $Company
   * @param string $Country
   * @param string $EmailAddress
   * @param string $ExternalAccountCode
   * @param string $FirstName
   * @param string $LastName
   * @param string $MiddleInitial
   * @param string $Phone
   * @param string $PostalCode
   * @param string $State
   * @param string $Suffix
   * @param string $Title
   * @access public
   */
  public function __construct($AccountCode, $Address1, $Address2, $City, $Company, $Country, $EmailAddress, $ExternalAccountCode, $FirstName, $LastName, $MiddleInitial, $Phone, $PostalCode, $State, $Suffix, $Title)
  {
    $this->AccountCode = $AccountCode;
    $this->Address1 = $Address1;
    $this->Address2 = $Address2;
    $this->City = $City;
    $this->Company = $Company;
    $this->Country = $Country;
    $this->EmailAddress = $EmailAddress;
    $this->ExternalAccountCode = $ExternalAccountCode;
    $this->FirstName = $FirstName;
    $this->LastName = $LastName;
    $this->MiddleInitial = $MiddleInitial;
    $this->Phone = $Phone;
    $this->PostalCode = $PostalCode;
    $this->State = $State;
    $this->Suffix = $Suffix;
    $this->Title = $Title;
  }

}
