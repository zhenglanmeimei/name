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

// 公众号配置
define('APP_ID','wx1f25d7312aabd014');
define('TOKEN','txsh');
define('SECRET','88d0c732d014395128168f76f0552f09');

define('URL', 'http://t4.uoing.cn/');
//define('URL', 'http://www.tiexinshouhu.com/');
define('LANGUAGE','zh');
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