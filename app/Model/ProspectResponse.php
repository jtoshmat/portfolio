<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility');
/**
 * ProspectResponse Model
 *
 * @property Prospect $Prospect
 * @property Question $Question
 */
class ProspectResponse extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	//public $primaryKey = 'prospect_response_id'; //had to comment it because prospect_response was not updating

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
/*		'response_value' => array(
			'notempty' => array(
				 'rule' => array('notempty'),
				//'message' => 'Response is empty',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'prospect_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'question_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
  public function validateresponse($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
        if ($value==''){return false;}
        return preg_match('|^[0-9a-zA-Z_-\s.,()\i]*$|', $value);
    }

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public function beforeSave($options = array()) {
       $this->data = Sanitize::clean($this->data, array('encode' => false));
       $this->data = Sanitize::stripTags($this->data); 
       return true;
    }
	
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Prospect' => array(
			'className' => 'Prospect',
			'foreignKey' => 'prospect_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProspectResponse' => array(
			'className' => 'ProspectResponse',
			'foreignKey' => 'prospect_id',
			'associationForeignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => true
		)

	);
}
