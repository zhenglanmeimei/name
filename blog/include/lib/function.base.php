<?php
// [autoload 自定义加载类的函数] 

function autoload($class){
	if(file_exists(dirname(__FILE__).'/lib/'.$class.'.class.php')){
		include_once dirname(__FILE__).'/lib/'.$class.'.class.php'));
	}else{
		zmMsg('类'.$class.'引入失败');
	}
}
//绑定函数为自定义加载
spl_autoload_register('autoload');
/**
 * [is_post 判断是否post请求]
 * @Author   ZiShang520
 * @DateTime 2016-04-06T15:30:56+0800
 * @return   boolean                  [description]
 */
function is_post() {
	return (isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']);
}
/**
 * [arrayToString 多维数组转为字符串]
 * @Author   ZiShang520
 * @DateTime 2016-04-07T17:26:56+0800
 * @param    [type]                   $arr [description]
 * @return   [type]                        [description]
 */
function arrayToString($arr) {
	if (is_array($arr)) {
		return implode('', array_map('arrayToString', $arr));
	}
	return $arr;
}

/**
 * [zmMsg 显示消息的function]
 * @Author   ZiShang520
 * @DateTime 2016-02-24T17:05:59+0800
 * @param    [type]                   $msg      [description]
 * @param    string                   $url      [description]
 * @param    boolean                  $isAutoGo [description]
 * @return   [type]                             [description]
 */
function zmMsg($msg, $url = 'javascript:history.back(-1);', $isAutoGo = false) {
	if ('404' == $msg) {
		header("HTTP/1.1 404 Not Found");
		$msg = '抱歉，你所请求的页面不存在！';
	}
	echo <<<EOT
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

EOT;
	if ($isAutoGo) {
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$url\" />";
	}
	echo <<<EOT
    <title>提示信息</title>
    <style type="text/css">
        body { background-color:#F7F7F7; font-family: Arial; font-size: 12px; line-height:150%; } .main { background-color:#FFFFFF; font-size: 12px; color: #666666; width:650px; margin:60px auto 0px; border-radius: 10px; padding:30px 10px; list-style:none; border:#DFDFDF 1px solid; } .main p { line-height: 18px; margin: 5px 20px; }
    </style>
</head>

<body>
    <div class="main">
        <p>$msg</p>

EOT;
	if ('none' != $url) {
		echo '        <p><a href="' . $url . '">&laquo;点击返回</a></p>';
	}
	echo <<<EOT

    </div>
</body>

</html>
EOT;
	exit;
}

function is_post() {
	return (isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']);
}
function is_login() {
	global $db;
	//判断cookie
	if (isset($_COOKIE['info']) && !empty($_COOKIE['info'])) {
		//截取cookie中字符串
		$info = explode('|', $_COOKIE['info']);
		//用户名
		$username = isset($info[0]) ? $info[0] : '';
		//授权信息
		$auth = isset($info[1]) ? $info[1] : '';
		//判断session是否存在
		if (isset($_SESSION['info'])) {
			//判读cookie中信息与session信息是否匹配
			return (md5($_SESSION['info']) === $auth);
		} else {
			$sql = 'SELECT * FROM `user` WHERE `username`=? LIMIT 1';
			if (!$stmt = $db->stmt_init()) {
				var_dump($db->error);
			}
			//预处理sql
			if (!$stmt->prepare($sql)) {
				var_dump($stmt->error);
			}
			//绑定参数
			if (!$stmt->bind_param('s', $username)) {
				var_dump($stmt->error);
			}
			if (!$stmt->execute()) {
				var_dump($stmt->error);
			}
			//取出数据到内存
			if (!$stmt->store_result()) {
				var_dump($stmt->error);
				// .....
			}
			//判断数据是否存在
			if ($stmt->num_rows > 0) {
				//绑定字段到对应变量
				if (!$stmt->bind_result($user, $pass)) {
					var_dump($stmt->error);
					// .....
				}
				//取出结果放到对应变量
				$stmt->fetch();
				$info = serialize(array($user, $pass));
				//判断数据库取出的数据是否和cookie匹配
				if (md5($info) === $auth) {
					$_SESSION['info'] = $info;
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}
}
