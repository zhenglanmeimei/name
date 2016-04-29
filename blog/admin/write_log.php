<?php
//此页将输入的数据放入数据库的表单中
// var_dump($_POST);//打印出输入数据，便于观察
include dirname(__FILE__) . '/globals.php'; //连接数据库并且引入函数
$list = new ArticleModel(); //实例化类
//编辑修改文章
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : ''; //判断地址栏或者表单是否存在action请求
if ('edit' == $action) {
//地址栏中$action=edit，执行以下代码
	$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : '';
	if (is_post()) {
//判断是否为post请求
		//判断地址栏是否存在id，若存在将字符型id转化为整形且赋值给变量$id,
		$title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; //给输入的标题赋值，若存在title，则将输入的title输出，不存在就不输出。htmlspecialchars是将特殊字符转化为html实体，鸳鸯输出
		if ($title != '') {
			//判断文章标题是否为空，若不是空执行以下代码，若为空，弹出一个警告框
			//	//判断输入内容
			$content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; //给输入的内容赋值
			//	//判断输入时间
			$postdata = isset($_POST['postdata']) && !empty($_POST['postdata']) ? htmlspecialchars((strtotime($_POST['postdata'])) ?: time()): time(); //判断是否存在一个不为空的时间，若存在将时间转化为离格林威治时间的时间戳，并转化为实体，若不存在就返回当前时间到格林威治时间的时间戳
			//判断输入摘要
			$excerpt = isset($_POST['excerpt']) && $_POST['excerpt'] != '' ? $_POST['excerpt'] : mb_substr(subString($content, 0, 255), 0, 255, 'UTF-8'); //html_replace是用于去除输入文本中的空格，换行，判断是否有摘要，如果没有，从内容中取出0-255字节的字作为摘要
			$status = $list->ArticleAdd($title, $excerpt, $content, $postdata);

			//根据索引id更新数据库中的数据，更新不用储存
			// $sql = 'UPDATE `blog_article` SET `title`=?,`content`=?,`des`=?,`createtime`=? WHERE `id`=? LIMIT 1';
			// //初始化stmt
			// if (!$stmt = $db->stmt_init()) {
			// 	zmMsg('添加失败：' . $db->error); //zmMsg是报错函数，添加失败指向报错代码
			// }
			// //预处理sql
			// if (!$stmt->prepare($sql)) {
			// 	zmMsg('添加失败：' . $stmt->error);
			// }
			// //绑定参数，‘si’字符和整形
			// if (!$stmt->bind_param('sssii', $title, $content, $excerpt, $postdata, $id)) {
			// 	//只有时间为int型，其余均为字符型，此处将post框传递过来的参数绑定到数据库的表单中，且与select中输入的字段顺序一一对应
			// 	zmMsg('添加失败：' . $db->error);
			// }
			// //执行sql
			// if (!$stmt->execute()) {
			// 	zmMsg('添加失败：' . $db->error);
			// }
			//判断是否输入数据，如果输入了数据则跳转到文章查询页面，显示添加成功（一段时间后自动消失）
			if ($status > 0) {
				go('admin_log.php?status=3'); //若更新成功跳转到，跳转到文章查询页面，显示更新成功
			} else {
				go('admin_log.php?status=-3'); //如果数据更新失败，跳转到文章查询页面，显示更新失败
			}
		} else {
			echo '标题不能为空';
		}
	} //文章编辑结束
	//查询文章
	if ($id != 0) {
//判断$id是否不为0，若id为0则不必查询
		$rows = $list->Articleshow($id);
		var_dump($rows); //此处$rows为关联数组，根据sql的查询字段及顺序命名键名
		// $sql = 'SELECT `id`,`title`,`content`,`des`,`createtime` FROM `blog_article` WHERE `id`=? LIMIT 1'; //以id为索引查询表中字段
		// $stmt = $db->stmt_init();
		// $stmt->prepare($sql);
		// $stmt->bind_param('i', $id);
		// $stmt->execute();
		// $stmt->store_result();
		// if ($stmt->num_rows > 0) {
		// 	$stmt->bind_result($id, $title, $content, $des, $createtime); //此处的变量与bind_param绑定的变量不一样
		// 	$stmt->fetch();
		// 	$rows = array('id' => $id, 'title' => $title, 'content' => $content, 'des' => $des, 'createtime' => $createtime); //创建一维数组储存信息，自定义键名
		// 	var_dump($rows);
		// } else {
		// 	zmMsg('编辑的文章不存在或者你没有权限');
		// }
	} else {
		zmMsg('编辑的文章不存在或者你没有权限');
	}
	include 'view/edit_log.php';

} else {

//查询文章
	if (is_post()) {
// //判断是否为post方式,非post方式在sublime里运行会出错
		$title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; //给输入的标题赋值，若存在title，则将输入的title输出，不存在就不输出。htmlspecialchars是将特殊字符转化为html实体，鸳鸯输出
		if ($title != '') {
			//判断文章标题是否为空，若不是空执行以下代码，若为空，弹出一个警告框
			//	//判断输入内容
			$content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; //给输入的内容赋值
			//	//判断输入时间
			$postdata = isset($_POST['postdata']) && !empty($_POST['postdata']) ? htmlspecialchars((strtotime($_POST['postdata'])) ?: time()): time(); //判断是否存在一个不为空的时间，若存在将时间转化为离格林威治时间的时间戳，并转化为实体，若不存在就返回当前时间到格林威治时间的时间戳
			//判断输入摘要
			$excerpt = isset($_POST['excerpt']) && $_POST['excerpt'] != '' ? $_POST['excerpt'] : mb_substr(subString($content, 0, 255), 0, 255, 'UTF-8'); //html_replace是用于去除输入文本中的空格，换行，判断是否有摘要，如果没有，从内容中取出0-255字节的字作为摘要
			$status = $list->ArticleAdd($title, $excerpt, $content, $postdata); //

			//用参数化查询stmt吧输入的标题，内容，摘要，时间添加到数据库
			// $sql = 'INSERT INTO `' . DB_PREFIX . 'article` (`title`,`content`,`des`,`createtime`) VALUES (?,?,?,?)';
			// $db->query($a); //查询数据库
			// var_dump($db->query($a)); //查看是否把记录录入数据库，如果成功返回true，错误返回false

			//用参数化查询将输入数据放入表中
			//初始化stmt
			// if (!$stmt = $db->stmt_init()) {
			// 	zmMsg('添加失败：' . $db->error); //zmMsg是报错函数，添加失败指向报错代码
			// }
			// //预处理sql
			// if (!$stmt->prepare($sql)) {
			// 	zmMsg('添加失败：' . $stmt->error);
			// }
			// //绑定参数，‘si’字符和整形
			// if (!$stmt->bind_param('sssi', $title, $content, $excerpt, $postdata)) {
			// 	//只有时间为int型，其余均为字符型，此处将post框传递过来的参数绑定到数据库的表单中，且与select中输入的字段顺序一一对应
			// 	zmMsg('添加失败：' . $db->error);
			// }
			// //执行sql
			// if (!$stmt->execute()) {
			// 	zmMsg('添加失败：' . $db->error);
			// }
			//判断是否输入数据，如果输入了数据则跳转到文章查询页面，显示添加成功（一段时间后自动消失）
			if ($status > 0) {
				go('admin_log.php?status=1');
			} else {
				go('admin_log.php?status=-1'); //如果数据输入失败，跳转到文章查询页面，显示添加失败
			}
		} else {
			echo '标题不能为空';
		}
	}
	include 'view/write_log.php'; //引入html文件，后缀改为php是为了防止别人下载html模板
}