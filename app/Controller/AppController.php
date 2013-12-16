<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {



    public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session'
    );
    public $helpers = array('Html', 'Form', 'Js'=>array("Jquery"),"Session");
    public function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'display');
        $this->set('current_user',$this->Auth->user());
        $this->set('is_user_loggedin',$this->Auth->loggedIn());
        $current_id = $this->Auth->user();
        $this->Auth->deny();//set deny to all by default
        $this->Auth->allow(array('pages'));
        $this->Auth->allow('display');
        $this->Auth->allow('logout','login');//everybody has right to login and logout
        $this->Auth->allow(array('users'=>'profile'));//everybody can view their owb profile

		if ($this->Auth->loggedIn()){
			$this->Auth->allow(array('settings'=>'index'));
			$settings = $this->requestAction("settings/get_settings");
			$msg = ($settings)?$settings[0]['Setting']['message']:'';
	        if ($msg!=''){$this->Session->setFlash(__($msg));}
		}

		App::uses('CakeTime', 'Utility');
		CakeTime::convert(time(), new DateTimeZone('America/Chicago'));
		$this->Auth->allow();

    }

    public function get_user(){
    	return $this->Auth->user();
    }

}
