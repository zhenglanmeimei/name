<?php
include 'init.php';
$new = new CommentModel();
$Article = new ArticleModel();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : ''; //判断地址栏或者表单是否存在action请求
// $id = isset($_POST['id']) ? $_POST['id'] : '';
if ('addcom' == $action) {
	// var_dump($_POST);
	// exit();
	$pid = isset($_POST['pid']) ? $_POST['pid'] : 0;
	$id = isset($_POST['blog_id']) ? $_POST['blog_id'] : 0; //文章id
	$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$address = isset($_POST['address']) ? $_POST['address'] : '';
	$description = isset($_POST['description']) ? $_POST['description'] : '';
	$createtime = date('Y-m-d H:i:s', time());
	$ip = getIp();
	if (($new->commentAdd($pid, $id, $nickname, $email, $address, $description, $createtime, $ip)) == 0) {
		//id为文章id，必须给方法传入参数
		zmMsg('评论失败');
	}
	echo '评论成功';
} else {
//判断是否有改文章
	if (isset($_GET['id'])) {
		$id = !empty($_GET['id']) ? $_GET['id'] : 0;
		if (0 == $id) {
			zmMsg('文章不存在或者你没有权限');
		}
		if (!$rows = $Article->ArticleShow($id)) {
			zmMsg('文章不存在或者你没有权限');
		}
		$comment_list = $new->commentlist($id); //显示评论列表
		$comment_list = generateTree(foreachkey($comment_list)); //将评论列表数据中的id键赋值给数组索引，pid=comment_id,pid为回复的那条评论，comment_id是回复文章的评论，为自增的索引数组，id为文章id
		print_r($comment_list);
		include 'comment/view/write_log.php'; //文章详情页面
	} else {
		$info = $Article->ArticleList(); //显示文章列表
		$show = $info['show'];
		$rows = $info['info'];
		include 'comment/view/index.php'; //若id不存在，返回登录界面
	}
}