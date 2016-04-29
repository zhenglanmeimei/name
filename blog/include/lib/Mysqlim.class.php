<?php
/**
 * 自定义数据库链接泪
 */
class Mysqlim {
	/**
	 * [$link 数据库连接]
	 * @var [type]
	 */
	private $link;
	/**
	 * [$stmt d定义为私有的静态属性，防止调试时出错]
	 * @var [type]
	 */
	private static $stmt;
	/**
	 * [__construct 构建函数]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T16:39:48+0800
	 * @copyright (c)                      ZiShang520  All           Rights Reserved
	 * @param     [type]                   $db_host    [主机名]
	 * @param     [type]                   $db_user    [用户名]
	 * @param     [type]                   $db_pass    [密码]
	 * @param     [type]                   $db_name    [数据库名]
	 * @param     [type]                   $db_port    [端口]
	 * @param     [type]                   $db_charset [编码]
	 */
	public function __construct($db_host = DB_HOST, $db_user = DB_USER, $db_pass = DB_PASS, $db_name = DB_NAME, $db_port = DB_PORT, $db_charset = DB_CHARSET) {
		class_exists('mysqli', false) || zmMsg('PHP空间不支持mysqli类操作数据库');
		$this->link = @new Mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
		if ($this->link->connect_errno) {
			//输出错误信息
			$this->error($this->link->connect_errno);
		}
		//设置编码
		$this->link->set_charset($db_charset);
	}
	/**
	 * [stmt_check 检测stmt]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T16:48:22+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	private function stmt_check() {
		method_exists($this->link, 'stmt_init') || zmMsg('mysqli类不支持stmt方法');
		self::$stmt = $this->link->stmt_init();
	}
	/**
	 * [bind_query 绑定执行sql]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T17:14:44+0800
	 * @copyright (c)                      ZiShang520    All           Rights Reserved
	 * @param     [type]                   $query_string [预处理绑定的sql]
	 * @param     array                    $bind_params  [需要绑定的参数]
	 * @return    [type]                                 [返回执行状态]
	 */
	public function bind_query($query_string, $bind_params = array()) {
		$args = func_get_args(); //获取传入的值，保存到数组
		unset($args[0]); //卸载$query_string
		if (func_num_args() == 2) {
//若只传入两个参数
			if (is_array($bind_params)) {
//判断传入的第二个参数是数组
				$bind_params = $bind_params;
			} else {
				$bind_params = $args; //若第二个参数不为数组将数组$args赋值给$bind_params，因为$bind_params必须为一个数组
			}
		} else if (func_num_args() > 2) {
//若传入的参数在三个及以上
			$bind_params = $args; //将数组赋值给$bind_params
		}
		$this->stmt_check();
		$map = array(
			'%d' => 'i', //integer
			'%f' => 'd', //float
			'%s' => 's', //string
			'%b' => 'b', //blob
		);
		//处理正则表达式
		$expr = '/(' . implode('|', array_keys($map)) . ')/';
		//正则匹配
		if (preg_match_all($expr, $query_string, $matches)) {
			if (count($matches[0]) !== count($bind_params)) {
				zmMsg('参数与预绑定参数个数不匹配');
			}
			//取出匹配的type属性
			$types = strtr(implode('', $matches[0]), $map);
			//替换sql中的预绑定参数
			$query = preg_replace($expr, '?', $query_string);
			//预处理sql
			if (self::$stmt->prepare($query)) {
				//添加type属性到参数数组中
				array_unshift($bind_params, $types);
				$params = array();
				//为了兼容绑定的引用传参
				foreach ($bind_params as $key => $val) {
					$params[$key] = &$bind_params[$key];
				}
				//调用回调函数动态传参进行绑定
				if (call_user_func_array(array(self::$stmt, 'bind_param'), $params)) {
					//执行sql语句
					return self::$stmt->execute();
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			if (self::$stmt->prepare($query_string)) {
				return self::$stmt->execute();
			} else {
				return false;
			}
		}
	}

	public function fetch_array($status = false) {
		method_exists(self::$stmt, 'store_result') || zmMsg('不存在store_result方法'); //method_exists检查类的方法是否存在
		if (self::$stmt->store_result()) {
//如果存储数据
			if (self::$stmt->num_rows > 0) {
				//存储数据成功
				$result = array(); //初始化空数组
				$fd = self::$stmt->result_metadata(); //调用元数据
				$params = array(); //初始化空数组
				//循环绑定取出的变量
				while ($field = $fd->fetch_field()) {
					//fetch_field从结果集中取得列信息,name列名
					$params[] = &$result[$field->name]; //将
				}
				//调用回调函数绑定取出
				if (call_user_func_array(array(self::$stmt, 'bind_result'), $params)) {
//将$params数组用回调函数绑定参数
					//判断是否只输出一条数据
					if ($status) {
//取出一条数据
						self::$stmt->fetch();
						return $result;
					} else {
						while (self::$stmt->fetch()) {
//取出多条数据
							//解决引用带来的问题
							$re = array();
							foreach ($result as $key => $val) {
								$re[$key] = $val;
							}
							$rows[] = $re;
						}
						return $rows;
					}
				} else {
					return false;
				}
			} else {
				return null;
			}
		} else {
			return false;
		}

	}
	/**
	 * [get_stmt 获取stmt]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T17:19:24+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	public function get_stmt() {
		return self::$stmt;
	}
	/**
	 * [get_stmt_num_rows 获取当前数据总的行数]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T17:21:50+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	public function get_stmt_num_rows() {
		return self::$stmt->num_rows;
	}
	/**
	 * [get_stmt_affected_rows 获取响应行数]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T17:21:01+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	public function get_stmt_affected_rows() {
		return self::$stmt->affected_rows;
	}
	/**
	 * [get_stmt_error 获取错误信息]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T17:18:25+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	public function get_stmt_error() {
		return self::$stmt->error;
	}
	/**
	 * [get_stmt_errno 获取错误信息编号]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T17:18:25+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	public function get_stmt_errno() {
		return self::$stmt->errno;
	}
	/**
	 * [close_stmt 关闭stmt线程]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T17:23:11+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	public function close_stmt() {
		return self::$stmt->close();
	}
	/**
	 * [close_db 关闭数据库连接]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T17:23:21+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	public function close_db() {
		return $this->link->close();
	}
	/**
	 * [error 数据库连接失败提示]
	 * @Author   ZiShang520
	 * @DateTime 2016-04-07T14:14:32+0800
	 */
	private function error($connect_errno) {
		switch ($connect_errno) {
		case 1044:
		case 1045:
			zmMsg("连接数据库失败，数据库用户名或密码错误");
			break;

		case 1049:
			zmMsg("连接数据库失败，未找到您填写的数据库");
			break;

		case 2003:
			zmMsg("连接数据库失败，数据库端口错误");
			break;

		case 2005:
			zmMsg("连接数据库失败，数据库地址错误或者数据库服务器不可用");
			break;

		case 2006:
			zmMsg("连接数据库失败，数据库服务器不可用");
			break;

		default:
			zmMsg("连接数据库失败，请检查数据库信息。错误编号：" . $connect_errno);
			break;
		}
	}
}
