<?php

//显示文章列表的类
class ArticleModel {
	private $stmt;
	public function __construct() {
		$this->stmt = new Mysqlim(); //实例化自定义的类，方便下面调用该类中的方法
	}
	//显示文章列表
	public function ArticleList($page_num_rows = 5, $page_button_num = 5) {
//这里也可以在admin的ArticleList()中传参
		if (!$this->stmt->bind_query('SELECT COUNT(`id`) as num FROM `blog_article` where 1')) {
//计算表中数据条数，错误指向error
			zmMsg($this->stmt->get_stmt_error);
		} //初始化方法
		if (($num_rows = $this->stmt->fetch_array(true)) === false) {
//取出一条查询数据，赋值给数组$num_rows
			//加true显示单挑，不加true显示多条数据
			zmMsg($this->stmt->get_stmt_error());
		}
		$this->stmt->close_stmt(); //关闭数据连接
		$page = new page($num_rows['num'], $page_num_rows, $page_button_num); //实例化page.class.php中的page类，传递参数分别为总条数，每页显示条数，分页按钮显示数量
		$page->unset_query('status'); //地址栏删除(卸载)键名为status的键
		$show = $page->show(); //显示分页信息，1，2，3
		if (!$this->stmt->bind_query('SELECT * FROM `blog_article` WHERE 1 LIMIT %d,%d ',
			array($page->first_num, $page->page_num_rows))) {
//初始化，绑定参数，一步完成
			zmMsg($this->stmt->get_stmt_error());
		}
		if (($rows = $this->stmt->fetch_array()) === false) {
//取出全部数据
			zmMsg($this->stmt->get_stmt_error);
		}
		// var_dump($rows);
		return array('info' => $rows, 'show' => $show); //返回取出的数据，分页
	}

	//文章删除函数
	public function ArticleDel($id) {
		$str = array();
		$sql = 'DELETE FROM `blog_article` WHERE `id` IN (' . implode(',', array_pad($str, count($id), '%d')) . ')'; //array_pad用%d填充count($id)的长度到空数组$str中保存，再用implode将数组拼接为字符串，结果显示为%d%d%d……
		if (!$this->stmt->bind_query($sql, $id)) { //绑定参数
			zmMsg($this->stmt->get_stmt_error()); //输出错误信息
		}
		$affected_rows = $this->stmt->get_stmt_affected_rows(); //取出删除的条数
		$this->stmt->close_stmt(); //关闭线程
		return $affected_rows;
	}
	//写入文章
	public function ArticleAdd($title, $excerpt, $content, $postdata) {
//传入写文章要传入的参数
		$sql = 'INSERT INTO `' . DB_PREFIX . 'article` (`title`,`content`,`des`,`createtime`) VALUES (%s,%s,%s,%s)'; //初始化
		if (!$this->stmt->bind_query($sql, $title, $excerpt, $content, $postdata)) {
//绑定参数
			zmMsg($this->stmt->get_stmt_error()); //指向错误
		}
		$affected_rows = $this->stmt->get_stmt_affected_rows(); //判断是否写入数据，若成功$affected_rows =1
		$this->stmt->close_stmt(); //关闭线程
		return $affected_rows;
	}
	//文章修改
	public function ArticleEdit($title, $excerpt, $content, $postdata) {
		$sql = 'UPDATE `blog_article` SET `title`=%s,`content`=%s,`des`=%s,`createtime`=%s WHERE `id`=%s LIMIT 1';
		if (!$this->stmt->bind_query($sql, $title, $excerpt, $content, $postdata)) {
			zmMsg($this->stmt->get_stmt_error()); //指向错误
		}
		$affected_rows = $this->stmt->get_stmt_affected_rows(); //取出修改的条数
		$this->stmt->close_stmt(); //关闭线程
		return $affected_rows;
	}
	//点击显示整篇文章
	public function Articleshow($id) {
		$sql = 'SELECT `id`,`title`,`content`,`des`,`createtime` FROM `blog_article` WHERE `id`=%d LIMIT 1';
		if (!$this->stmt->bind_query($sql, array($id))) {
			zmMsg($this->stmt->get_stmt_error()); //指向错误
		}
		if (($rows = $this->stmt->fetch_array(true)) === false) { //取出所有数据,mysqlim里面默认数据为空时返回null，且null不全等与false
			zmMsg($this->stmt->get_stmt_error()); //指向错误
		}
		$this->stmt->close_stmt(); //关闭线程
		return $rows;
	}
}