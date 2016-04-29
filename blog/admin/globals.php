<?php
include dirname(dirname(__FILE__)) . '/init.php';
//退出登录
if (isset($_REQUEST['logout'])) {
	$param = session_get_cookie_params();
	setcookie(session_name(), '', -1, $param['path'], $param['domain'], $param['secure'], $param['httponly']);
	setcookie('info', '', -1, '/', '', false, true);
	session_destroy();
	go('index.php');
}
$a = new LoginModel();
