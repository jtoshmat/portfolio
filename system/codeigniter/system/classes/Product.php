<?php

class Product
{

  /**
   * 
   * @var string $Category
   * @access public
   */
  public $Category;

  /**
   * 
   * @var string $EventDescription
   * @access public
   */
  public $EventDescription;

  /**
   * 
   * @var dateTime $EventEndTime
   * @access public
   */
  public $EventEndTime;

  /**
   * 
   * @var int $EventId
   * @access public
   */
  public $EventId;

  /**
   * 
   * @var dateTime $EventStartTime
   * @access public
   */
  public $EventStartTime;

  /**
   * 
   * @var EventStatus $EventState
   * @access public
   */
  public $EventState;

  /**
   * 
   * @var string $ProductDescription
   * @access public
   */
  public $ProductDescription;

  /**
   * 
   * @var string $ProductId
   * @access public
   */
  public $ProductId;

  /**
   * 
   * @var ProductType $Type
   * @access public
   */
  public $Type;

  /**
   * 
   * @param string $Category
   * @param string $EventDescription
   * @param dateTime $EventEndTime
   * @param int $EventId
   * @param dateTime $EventStartTime
   * @param EventStatus $EventState
   * @param string $ProductDescription
   * @param string $ProductId
   * @param ProductType $Type
   * @access public
   */
  public function __construct($Category, $EventDescription, $EventEndTime, $EventId, $EventStartTime, $EventState, $ProductDescription, $ProductId, $Type)
  {
    $this->Category = $Category;
    $this->EventDescription = $EventDescription;
    $this->EventEndTime = $EventEndTime;
    $this->EventId = $EventId;
    $this->EventStartTime = $EventStartTime;
    $this->EventState = $EventState;
    $this->ProductDescription = $ProductDescription;
    $this->ProductId = $ProductId;
    $this->Type = $Type;
  }

}
