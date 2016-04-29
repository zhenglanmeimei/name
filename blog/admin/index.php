<?php
include dirname(__FILE__) . '/globals.php'; //连接数据库并且引入函数
if (!$a->is_login()) { //判断是否登录
	$a->Login(); //若没有登录则登录
} else {
	include 'view/index.php';
}