<?php
include 'conf.php'; //引入常量
header('content-type:text/html;charset=utf-8');
include 'include/functions.php'; //引入函数
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT); //连接数据库
$db->set_charset(DB_CHARSET); //设置编码方式
date_default_timezone_set('PRC'); //设置时区