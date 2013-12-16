<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'expressionengine';
$active_record = TRUE;

$db['expressionengine']['hostname'] = '172.20.0.51';
$db['expressionengine']['username'] = 'ldb_dba';
$db['expressionengine']['password'] = 'hypochondriac';
$db['expressionengine']['database'] = 'bap_three_zero';
$db['expressionengine']['dbdriver'] = 'mysql';
$db['expressionengine']['pconnect'] = FALSE;
$db['expressionengine']['dbprefix'] = 'exp_';
$db['expressionengine']['swap_pre'] = 'exp_';
$db['expressionengine']['db_debug'] = TRUE;
$db['expressionengine']['cache_on'] = FALSE;
$db['expressionengine']['autoinit'] = FALSE;
$db['expressionengine']['char_set'] = 'utf8';
$db['expressionengine']['dbcollat'] = 'utf8_general_ci';
$db['expressionengine']['cachedir'] = '/var/www/html/dev.amfambusinessaccelerator.com/system/expressionengine/cache/db_cache/';

/* End of file database.php */
/* Location: ./system/expressionengine/config/database.php */
