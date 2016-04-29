<?php
include dirname(__FILE__) . '/globals.php';
$list = new ArticleModel(); //实例化文章列表的类
//获取action，删除页面地址栏跳到action=operate_log
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if ('operate_log' == $action) {
	//文章的一些操作
	$operate = isset($_POST['operate']) ? $_POST['operate'] : '';
	// var_dump($_POST);
	switch ($operate) {
	//删除操作
	case 'del':
		//判断传递的值是否合法
		$blog = (isset($_POST['blog']) && is_array($_POST['blog'])) ? array_unique(array_map('strtoint', $_POST['blog'])) : array(); //将复选框的id变为数组
		//以逗号拼接//移除数组中重复的值//回掉函数array_map将传入的id经过回掉函数转化为整形，为数组，用array_unique去掉数组中的重复值，$blog 为数组
		$ids = implode(',', $blog); //将id数组拼接成字符串
		$status = $list->ArticleDel($blog); //将传递的id数组传入ArticleDel，并将删除处理的影响行赋值给$status
		//创建sql语句
		// $sql = 'DELETE FROM `blog_article` WHERE `id` IN (' . $ids . ')';
		//执行一个无返回值的查询
		// $db->multi_query($sql); //multi_query一次添加多个数据
		if ($status > 0) {
//删除一条数据以上
			go('admin_log.php?status=2');
		} else {
//删除不成功
			go('admin_log.php?status=-2');
		}
		break;
	}
} //文章删除结束
else {
	//用自定义的类查询文章

	$data = $list->ArticleList(5, 5); //指向类中的一个属性并赋值给变量$data，此时$data为一个二维数组
	$rows = $data['info']; //$rows为二维数组
	// var_dump($rows);
	$show = $data['show'];

	//查询列表
	// 	if (!$result = $db->query('SELECT count(`id`) FROM `blog_article` WHERE 1')) {
	// 		zmMsg($stmt->error);
	// 	}
	// 	$row = $result->fetch_row();
	// 	var_dump($row[0]);
	// 	$page = new Page($row[0], 2, 5);
	// echo $page->get_query_string() ;
	// 	$page->unset_query('status');
	// 	$show = $page->show();
	// 	$sql = 'SELECT `id`,`title`,`createtime` FROM `blog_article` WHERE 1 LIMIT ?,?';
	// 	$stmt = $db->stmt_init();
	// 	if (!$stmt->prepare($sql)) {
	// 		zmMsg($stmt->error);
	// 	}
	// 	$stmt->bind_param('ii', $page->first_num, $page->page_num_rows);
	// 	$stmt->execute();
	// 	$stmt->store_result();
	// 	$stmt->bind_result($id, $title, $createtime);
	// 	$rows = array();
	// 	while ($stmt->fetch()) {
	// 		$rows[] = array('id' => $id, 'title' => $title, 'createtime' => $createtime);
	// 	}
	include 'view/admin_log.php';
}

//此处为引进自己创建的数据库连接的类
// include dirname(dirname(__FILE__)).'/include/lib/Mysqlim.class.php';
// $a=new mysqlim();
// $s=array('ok','ok');
// if($a->bind_query('SELECT * FROM `blog_u` WHERE `username`=%s AND `passname`=%s',$s)){
// 	var_dump($a->fetch_array(true));
// 	}else{
// 	echo $a->get_stmt_error();
// 	}