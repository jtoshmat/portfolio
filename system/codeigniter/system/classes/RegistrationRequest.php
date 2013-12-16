<?php

class RegistrationRequest
{

  /**
   * 
   * @var int $EventId
   * @access public
   */
  public $EventId;

  /**
   * 
   * @var string $ExternalOrderId
   * @access public
   */
  public $ExternalOrderId;

  /**
   * 
   * @var array $Products
   * @access public
   */
  public $Products;

  /**
   * 
   * @var Person $Profile
   * @access public
   */
  public $Profile;

  /**
   * 
   * @param int $EventId
   * @param string $ExternalOrderId
   * @param array $Products
   * @param Person $Profile
   * @access public
   */
  public function __construct($EventId, $ExternalOrderId, $Products, $Profile)
  {
    $this->EventId = $EventId;
    $this->ExternalOrderId = $ExternalOrderId;
    $this->Products = $Products;
    $this->Profile = $Profile;
  }

}
