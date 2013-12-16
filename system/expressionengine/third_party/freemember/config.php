<?php

if ( ! defined('FREEMEMBER_NAME')) {
    define('FREEMEMBER_NAME', 'FreeMember');
    define('FREEMEMBER_CLASS', 'Freemember');
    define('FREEMEMBER_VERSION', '2.2.2');
    define('FREEMEMBER_DOCS', 'http://exp-resso.com/freemember');
}

$config['name'] = FREEMEMBER_NAME;
$config['version'] = FREEMEMBER_VERSION;
$config['nsm_addon_updater']['versions_xml'] = 'http://exp-resso.com/rss/freemember/versions.rss';
$config['encryption_key'] = "518F1E80209257910ED78450D2486CEB099623551921D74C464C5D2A9C857FDE";
