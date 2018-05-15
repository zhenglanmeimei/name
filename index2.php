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

define('APP_ID','wxcc226c93fea4a1ba');
define('TOKEN','txsh');
define('SECRET','b8516f4de894af1eb9c47b0401ac2a7d');

define('URL', 'http://t3.uoing.cn/');
//define('URL', 'http://www.tiexinshouhu.com/');
define('LANGUAGE','zh');
define('MIGOU','migou');
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