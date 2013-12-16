<?php
// App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 * @property AnswerType $AnswerType
 * @property DeviceType $DeviceType
 * @property Language $Language
 * @property LoginEntry $LoginEntry
 * @property OriginType $OriginType
 * @property Product $Product
 * @property Question $Question
 * @property Response $Response
 * @property State $State
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public function beforeSave($options=array()){
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}

	public function bindNode($user){
		return array('model'=>'Group', 'foreign_key' => $user['User']['group_id']);
	}
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => '/^[a-zA-Z0-9\!\-\.\@\#\$\%\&\*\(\)\?]{8,}$/',
				'message' => 'Username is a required field which contains at least 8 characters including numbers, letters and !@#$%&*()?',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notempty' => array(
				'rule' => '/^[a-zA-Z\ \.]{2,}$/',
				'message' => 'First name is a required field',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => '/^[a-zA-Z\ \.]{2,}$/',
				'message' => 'Last name is a required field',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_address' => array(
			'notempty' => array(
				'rule' => '/^([a-zA-Z0-9\-\.\_]{1,})@([a-zA-Z0-9\-\.]{1,}).([a-zA-Z]{2,})$/',
				'message' => 'Email address is a required field',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => '/^[a-zA-Z0-9\!\-\.\@\#\$\%\&\*\(\)\?]{8,}$/',
				'message' => 'Please enter a valid password which contains at least 8 characters including numbers, letters and !@#$%&*()?',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please assign a role',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	// public $belongTo = array('Group');
	public $actsAs = array('Acl'=> array('type'=>'requester'));
	public function parentNode(){
		if(!$this->id && empty($this->data)){
			return null;
		}
		if(isset($this->data['User']['group_id'])){
			$groupId = $this->data['User']['group_id'];
		} else {
			$groupId = $this->field('group_id');
		}
		if(!$groupId){
			return null;
		} else {
			return array('Group' => array('id'=> $groupId));
		}
	}
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AnswerType' => array(
			'className' => 'AnswerType',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'DeviceType' => array(
			'className' => 'DeviceType',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'LoginEntry' => array(
			'className' => 'LoginEntry',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'OriginType' => array(
			'className' => 'OriginType',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Response' => array(
			'className' => 'Response',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
