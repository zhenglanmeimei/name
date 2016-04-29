<?php
session_start();
class LoginModel {
	private $stmt;
	public function __construct() {
		$this->stmt = new Mysqlim();
	}
	//判断登录的函数
	public function login() {
		if (is_post()) {
			// var_dump($_POST);
			//用户名
			$username = isset($_POST['username']) ? $_POST['username'] : ''; //判断是否存在用户名
			//密码
			$passname = isset($_POST['passname']) ? md5($_POST['passname']) : '';
			var_dump($_SESSION['code']); //打印服务器保存的密码
			var_dump($_POST['code']); //打印提交的密码
			if (isset($_POST['code']) && isset($_SESSION['code']) && strtoupper($_POST['code']) === $_SESSION['code']) {
//判断服务器是否存在密码和，用户是否输入密码，并且两者密码相同，将输入密码转化为大写，yanzhengma.php中也将验证码全部转为大写
				//判断不能为空
				if ('' != $username && '' != $passname) {
					//创建sql模板
					// $sql = 'SELECT * FROM `blog_user` WHERE `username`=%s AND `passname`=%s LIMIT 1'; //查询一条数据
					//初始化stmt
					if (!$this->stmt->bind_query('SELECT * FROM `blog_user` WHERE `username`=%s AND `passname`=%s LIMIT 1', array($username, $passname))) {
						zmMsg($this->stmt->get_stmt_error());
					}
					if (($rows = $this->stmt->fetch_array(ture)) === false) {
						zmMsg($this->stmt->get_stmt_error());
					}
					if (!empty($rows)) {
						$info = serialize($rows); //serialize序列化一组表单元素，将表单内容编码为用于提交的字符串
						$_SESSION['info'] = $info; //将序列化后的字符串保存到客户端$_SESSION['info']
						//输出结果
						$v = $rows['username'] . '|' . md5($info); //用户名和加密后的$info连接
						$time = isset($_POST['readme']) ? (time() + 3600 * 24 * 7) : null; //判断是否记住登录，如果是，保留7天
						// var_dump($v);
						setcookie('info', $v, $time, '/', '', false, true); //cookie加密了的
						go('index.php');
					} //判断用户名密码是否正确
					else {
						echo '用户名或密码错误';
					}unset($_SESSION['code']);
				} //判断用户名密码是否为空
				else {
					echo '用户名或密码不能为空';
				}
				unset($_SESSION['code']);
			} //判断验证码错误
			else {
				echo '验证码错误'; //验证码判断错误
				unset($_SESSION['code']);
			}
			//取消登录
			// if(isset($REQUEST['logout'])){
			//  $params=session_get_cookie_params();//session_get_cookie_params — 获取会话 cookie 参数
			//  setcookie(session_name(),'',-1,$params["path"],$params["domain",$params["secure"],$params["httponly"]);
			//      setcookie('info','',-1,'/','',false,true);
			//      session_destroy();
			// }
		} //判断不为post提交方式
		include 'view/login.php';
		// exit();
	} //函数结束

	//判断是否登录
	function is_login() {
		global $db;
		if (isset($_COOKIE['info']) && !empty($_COOKIE['info'])) {
//判断是否存在一个不为空的$_COOKIE['info']，在setcookie中定义了$_COOKIE['info']
			$info = explode('|', $_COOKIE['info']); //将$_COOKIE['info']中的字符串从|分割成两个部分，前面为user，后面为auth
			$user = isset($info[0]) ? $info[0] : '';
			$auth = isset($info[1]) ? $info[1] : '';
			if (isset($_SESSION['info'])) { //判断是否存在$_SESSION['info']
				return (md5($_SESSION['info']) === $auth); //客户端和服务器的信息一致返回
			} else {
				$sql = ('SELECT * FROM `blog_user` WHERE `username`=%s LIMIT 1');
				if (!$this->stmt->bind_query($sql, $user)) {
					zmMsg($this->stmt->get_stmt_error());
				}
				if (($rows = $this->stmt->fetch_array()) === false) {
					zmMsg($this->stmt->get_stmt_error());
				}
				$info = serialize($rows);
				if (md5($info) === $auth) {
					$_SESSION['info'] = $info;
					return true;
				} else {
					return false;
				}
			} //客户端和服务器的信息不一致的else的闭合}
		} //isset($_COOKIE['info']) && !empty($_COOKIE['info'])条件不满足
		else {
			return false;
		}
	} //函数结束
} //类结束