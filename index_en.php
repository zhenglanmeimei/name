<?php

if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

define('APP_PATH','./IvearsApp/');
define('RUNTIME_PATH','./Runtime/');

define('IvearsCMS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('HTML_PATH', IvearsCMS_PATH."Cache/");
if (!file_exists(dirname(__FILE__) . '/IvearsApp/Common/install.lock')) {
    header("location:/Install/");
    exit;
}

define('APP_ID','wx4c500e64250e026a');
define('TOKEN','txsh');
define('SECRET','db3777430c3652e8295d499b2ba64555');

define('URL', 'http://t3.uoing.cn/');
define('LANGUAGE','en');
define('APP_DEBUG',true);
if (get_magic_quotes_gpc()) {
	function stripslashes_deep($value){
        $value = is_array($value) ?array_map('stripslashes_deep', $value):stripslashes($value);
        return $value;
    }
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}
require './IvearsCMS/ThinkPHP.php';