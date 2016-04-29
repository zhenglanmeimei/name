<?php

/**
 * 截取编码为utf8的字符串
 *
 * @param string $strings 预处理字符串
 * @param int $start 开始处 eg:0
 * @param int $length 截取长度
 */

/**
 * [foreachkey 转换数组的键]
 * @Author    ZiShang520@gmail.com
 * @DateTime  2016-04-27T14:13:05+0800
 * @copyright (c)                      ZiShang520 All           Rights Reserved
 * @param     [type]                   $array     [description]
 * @return    [type]                              [description]
 */
function foreachkey($data) {
	if (is_array($data)) {
		$arr = array();
		foreach ($data as $value) {
			$arr[$value['comment_id']] = $value;
		}
		return $arr;
	}
}
/**
 * [generateTree 生成树状数组]
 * @Author    ZiShang520@gmail.com
 * @DateTime  2016-04-27T14:08:36+0800
 * @copyright (c)                      ZiShang520 All           Rights Reserved
 * @param     [type]                   $items     [description]
 * @return    [type]                              [description]
 */
function generateTree($items) {
	if (is_array($items)) {
		//初始化一个空的数组
		$tree = array();
		//遍历
		foreach ($items as $value) {
			//判断是否存在对应得索引
			if (isset($items[$value['pid']])) {
				$items[$value['pid']]['data'][] = &$items[$value['comment_id']];
			} else {
				$tree[] = &$items[$value['comment_id']];
			}
		}
		return $tree;
	}
}

function comment($data) {
	$html = '';
	if (is_array($data)) {
		foreach ($data as $value) {
			$id = $value['id'];
			$nickname = $value['nickname'];
			$url = !empty($value['url']) ? $value['url'] : '';
			$date = date('Y-m-d H:i', $value['createtime']);
			$comment = $value['description'];
			$html .= <<<HTML

            <article class="am-comment">
  <a href="#link-to-user-home">
    <img src="comment/view/images/aboutphoto.jpg" alt="" class="am-comment-avatar" width="88" height="88"/>
  </a>
  <div class="am-comment-main  content">
    <header class="am-comment-hd">
      <h3 class="am-comment-title">评论标题</h3>
      <div class="am-comment-meta">
        <h3>昵称:</h3><a href="#" class="am-comment-author">{$value['nickname']}</a>
      </div>
    </header>
    <div class="am-comment-bd">
     <h3>评论内容:</h3>{$value['description']}
    <p>
    评论于 <time  >{date('Y-m-d H:i:s', time())}</time>
    </p>
    <p>{$value['email']}</p>
   <a href="#replay" class="replay" data-id="{$value['comment_id']}" style="cursor: pointer;color:black;">回复</a>
    </div>
  </div>
  </article>
HTML;
			if (isset($value['data']) && is_array($value['data'])) {$html .= comment($value['data']);}
		}
	}
	return $html;
}

//获取服务器ip
function getIp() {
	if (isset($_SERVER['REMOTE ADDR'])) {
		return $_SERVER['REMOTE ADDR'];
	}
}
function subString($strings, $start, $length) {
	if (function_exists('mb_substr') && function_exists('mb_strlen')) {
		$sub_str = mb_substr($strings, $start, $length, 'utf8');
		return mb_strlen($sub_str, 'utf8') < mb_strlen($strings, 'utf8') ? $sub_str . '...' : $sub_str;
	}
	$str = substr($strings, $start, $length);
	$char = 0;
	for ($i = 0; $i < strlen($str); $i++) {
		if (ord($str[$i]) >= 128) {
			$char++;
		}

	}
	$str2 = substr($strings, $start, $length + 1);
	$str3 = substr($strings, $start, $length + 2);
	if ($char % 3 == 1) {
		if ($length <= strlen($strings)) {
			$str3 = $str3 .= '...';
		}
		return $str3;
	}
	if ($char % 3 == 2) {
		if ($length <= strlen($strings)) {
			$str2 = $str2 .= '...';
		}
		return $str2;
	}
	if ($char % 3 == 0) {
		if ($length <= strlen($strings)) {
			$str = $str .= '...';
		}
		return $str;
	}
}

/**
 * 从可能包含html标记的内容中萃取纯文本摘要
 *
 * @param string $data
 * @param int $len
 */
function extractHtmlData($data, $len, $status = false) {
	$data = $status ? htmlspecialchars_decode($data) : $data;
	$data = subString(strip_tags($data), 0, $len + 30);
	$search = array("/([\r\n])[\s]+/", // 去掉空白字符
		"/&(quot|#34);/i", // 替换 HTML 实体
		"/&(amp|#38);/i",
		"/&(lt|#60);/i",
		"/&(gt|#62);/i",
		"/&(nbsp|#160);/i",
		"/&(iexcl|#161);/i",
		"/&(cent|#162);/i",
		"/&(pound|#163);/i",
		"/&(copy|#169);/i",
		"/\"/i",
	);
	$replace = array(" ", "\"", "&", " ", " ", "", chr(161), chr(162), chr(163), chr(169), "");
	$data = trim(subString(preg_replace($search, $replace, $data), 0, $len));
	return $data;
}

//go跳转函数
//is_login判断登录
// html_replace()去除空格
//is_post()判断是否为post方式
//将数组转化为字符串的函数
//check_status为判断添加，修改，删除信息
//html_replace去除空格
//arrayToString数组转化为字符串
//strtoint字符串转化为整形
function arrayToString($arr) {
	if (is_array($arr)) {
		return implode(',', array_map('arrayToString', $arr));
	}
	return $arr;
}
//跳转函数
function go($url = '') {
	if ($url != '') {
		header('location:' . $url);
		exit();
	}
}
//此处为跳转函数，判断添加，修改，删除信息。
function check_status($num) {
	switch ($num) {
	case '1':
		return '<span class="alert alert-success">添加成功</span>';
		break;
	case '-1':
		return '<span class="alert alert-danger">添加失败</span>';
		break;
	case '2':
		return '<span class="alert alert-success">删除成功</span>';
		break;
	case '-2':
		return '<span class="alert alert-danger">删除失败</span>';
		break;
	case '3':
		return '<span class="alert alert-success">修改成功</span>';
		break;
	case '-3':
		return '<span class="alert alert-danger">修改失败</span>';
		break;
	}
}

//判断是否是post方式
function is_post() {
	return (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST');
}

//将字符串转化为整形
function strtoint($str) {
	if (is_array($str)) {
		return 0;
	} else {
		return intval($str);
	}
}
// [autoload 自定义加载类的函数]

function autoload($class) {
	if (file_exists(dirname(__FILE__) . '/lib/' . $class . '.class.php')) {
		include_once dirname(__FILE__) . '/lib/' . $class . '.class.php';
	} else if (file_exists(dirname(__FILE__) . '/model/' . $class . '.class.php')) {
		include_once dirname(__FILE__) . '/model/' . $class . '.class.php';
	} else {
		zmMsg('类' . $class . '引入失败');
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

/**
 * [arrayToString 多维数组转为字符串]
 * @Author   ZiShang520
 * @DateTime 2016-04-07T17:26:56+0800
 * @param    [type]                   $arr [description]
 * @return   [type]                        [description]
 */
// function arrayToString($arr) {
// 	if (is_array($arr)) {
// 		return implode('',array_map('arrayToString', $arr));
// 	}
// 	return $arr;
// }

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
