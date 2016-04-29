<?php
/**
 *
 */
class CommentModel {
	private $stmt;
	function __construct() {
		$this->stmt = new Mysqlim();
	}
	public function commentAdd($pid, $id, $nickname, $email, $address, $description, $createtime, $ip) {
		if (!$this->stmt->bind_query('INSERT INTO `blog_comment`(`pid`,`id`,`nickname`,`email`,`address`,`description`,`createtime`,`ip`) VALUES (%d,%d,%s,%s,%s,%s,%d,%s)', array($pid, $id, $nickname, $email, $address, $description, $createtime, $ip))) {
			zmMsg($this->stmt->get_stmt_error());
		}
		$affected_rows = ($this->stmt->get_stmt_affected_rows());
		$this->stmt->close_stmt();
		return $affected_rows;
	}
	public function commentlist($id) {
		if (!$this->stmt->bind_query('SELECT * FROM `blog_comment` WHERE `id`=%d ORDER BY `id` DESC', array($id))) {
			zmMsg($this->stmt->get_stmt_error());
		}
		if (($rows = $this->stmt->fetch_array()) === false) {
			zmMsg($this->stmt->get_stmt_error());
		}
		$this->stmt->close_stmt();
		return $rows;
	}

	// public function CommentListall($id) {
	// 	if($id)
	// 	if (!$this->stmt->bind_query('SELECT * FROM `blog_comment` WHERE `id`=%d ORDER BY `id` DESC', array($artid))) {
	// 		zmMsg($this->stmt->get_stmt_error());
	// 	}
	// 	//取出数据
	// 	if (($rows = $this->stmt->fetch_array()) === false) {
	// 		zmMsg($this->stmt->get_stmt_error());
	// 	}
	// 	//关闭线程
	// 	$this->stmt->close_stmt();
	// 	return $rows;
	// }
}