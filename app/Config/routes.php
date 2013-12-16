<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	/*
	 * Modified the routes by adding each products 4/3/2013 by Jon Toshmatov
	 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'welcome'));
	Router::connect('/admin', array('controller'=>'users', 'action'=>'login'));
	Router::connect('/admin', array('controller' => 'pages', 'action' => 'display', 'admin'));
	Router::connect('/fields', array('controller' => 'pages', 'action' => 'ajaxLoad', 'fields'));
	Router::connect('/todo', array('controller' => 'pages', 'action' => 'ajaxLoad', 'todo'));

	Router::connect('/welcome', array('controller' => 'pages', 'action' => 'ajaxLoad', 'welcome'));
	Router::connect('/meetyouragent', array('controller' => 'pages', 'action' => 'ajaxLoad', 'meetyouragent'));
	Router::connect('/findyouragent', array('controller' => 'pages', 'action' => 'ajaxLoad', 'findyouragent'));
	Router::connect('/thankyou', array('controller' => 'pages', 'action' => 'ajaxLoad', 'thankyou'));
	Router::connect('/auto', array('controller' => 'pages', 'action' => 'ajaxLoad', 'auto'));
	Router::connect('/homeowners', array('controller' => 'pages', 'action' => 'ajaxLoad', 'homeowners'));
	Router::connect('/life', array('controller' => 'pages', 'action' => 'ajaxLoad', 'life'));
	Router::connect('/power', array('controller' => 'pages', 'action' => 'ajaxLoad', 'power'));
	Router::connect('/renters', array('controller' => 'pages', 'action' => 'ajaxLoad', 'renters'));
	Router::connect('/business', array('controller' => 'pages', 'action' => 'ajaxLoad', 'business'));
	Router::connect('/travel', array('controller' => 'pages', 'action' => 'ajaxLoad', 'travel'));
	Router::connect('/medical', array('controller' => 'pages', 'action' => 'ajaxLoad', 'medical'));
	Router::connect('/tell-us-about-yourself', array('controller' => 'pages', 'action' => 'ajaxLoad', 'tell-us-about-yourself'));
	Router::connect('/process', array('controller' => 'pages', 'action' => 'ajaxLoad', 'process'));
	Router::connect('/dev', array('controller' => 'pages', 'action' => 'ajaxLoad', 'dev'));
	Router::connect('/farm', array('controller' => 'pages', 'action' => 'ajaxLoad', 'farm'));
	Router::connect('/umbrella', array('controller' => 'pages', 'action' => 'ajaxLoad', 'umbrella'));
	Router::connect('/cron', array('controller' => 'pages', 'action' => 'ajaxLoad', 'cron'));

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	#Router::connect('/*', array('controller' => 'pages', 'action' => 'display'));
/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();
	Router::parseExtensions('json');
/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
