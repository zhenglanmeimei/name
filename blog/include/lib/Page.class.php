<?php
/**
 * 分页类
 */
class Page {
	/**
	 * [$num_rows 内部属性 数组总行数]
	 * @var [type]
	 */
	private $num_rows;
	/**
	 * [$page_num_rows 内部属性 每页显示行数]
	 * @var [type]
	 */
	public $page_num_rows;
	/**
	 * [$page_button_num 内部属性 分页按钮显示数量]
	 * @var [type]
	 */
	private $page_button_num;
	/**
	 * [$first_num 公开属性 起始数据]
	 * @var [type]
	 */
	public $first_num;
	/**
	 * [$all_page_num 内部属性 所有页数]
	 * @var [type]
	 */
	private $all_page_num;
	/**
	 * [$page_name 内部属性 page默认键名]
	 * @var string
	 */
	private $page_name;
	/**
	 * [$this_page 内部属性 当前处于第几页]
	 * @var [type]
	 */
	private $this_page;
	/**
	 * [$unset_query_array 需要卸载的query_string]
	 * @var array
	 */
	private $unset_query_array = array();
	/**
	 * [__construct 构建函数]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-14T16:39:26+0800
	 * @copyright (c)                      ZiShang520       All           Rights Reserved
	 * @param     [type]                   $num_rows        [数组总行数]
	 * @param     [type]                   $page_num_rows   [每页显示行数]
	 * @param     [type]                   $page_button_num [分页按钮显示数量]
	 */
	public function __construct($num_rows, $page_num_rows = 10, $page_button_num = 5, $page_name = 'page') {
		$this->num_rows = $num_rows;
		//判断每页数据是否大于了总数据
		$this->page_num_rows = $page_num_rows > $this->num_rows ? $this->num_rows : $page_num_rows;
		$this->page_name = $page_name;
		//判断数据是否存在
		$this->all_page_num = $this->num_rows > 0 ? intval(ceil(($this->num_rows) / ($this->page_num_rows))) : 0;
		//判断按钮数量是否大于了总页数
		$this->page_button_num = $page_button_num > $this->all_page_num ? $this->all_page_num : $page_button_num;
		$page = $this->get_page();
		//当前页数
		$this->this_page = ($page > $this->all_page_num) ? $this->all_page_num : $page;
		// $this->page(); //获取当前页数
		$this->first_num = ($this->this_page - 1) * $this->page_num_rows;
	}
	/**
	 * [get_page 获取当前页数]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-14T16:46:48+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [当前页数]
	 */
	private function get_page() {
		$page = isset($_REQUEST[$this->page_name]) ? abs(intval($_REQUEST[$this->page_name])) : 1;
		$page = $page ? $page : 1;
		return $page;
	}
	/**
	 * [get_query_string 获取地址栏的的query_string信息]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T14:06:16+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [description]
	 */
	private function get_query_string() {
		$query_string = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
		parse_str($query_string, $query_array);
		foreach ($this->unset_query_array as $value) {
			unset($query_array[$value]); //卸载传入的键名及值
		}
		unset($query_array[$this->page_name]); //卸载键名page及值
		$new_query_string = http_build_query($query_array);
		$new_query_string = !empty($new_query_string) ? '?' . $new_query_string . '&' : '?';
		return $new_query_string;
	}
	/**
	 * [unset_query 需要删除的键]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-15T14:12:57+0800
	 * @copyright (c)                      ZiShang520 All           Rights Reserved
	 * @param     [type]                   $key       [description]
	 * @return    [type]                              [description]
	 */
	public function unset_query() {
		$keys = func_get_args(); //返回一个包含函数参数列表的数组 $keys为数组
		if (func_num_args() == 1) {
//获取传入的参数个数
			$this->unset_query_array = is_array($keys[0]) ? $keys[0] : $keys; //此处要将$keys变为数组，好在foreach中遍历
		} else {
			$this->unset_query_array = $keys;
		}
	}
	/**
	 * [show 显示分页按钮]
	 * @Author    ZiShang520@gmail.com
	 * @DateTime  2016-04-14T17:13:37+0800
	 * @copyright (c)                      ZiShang520    All Rights Reserved
	 * @return    [type]                   [html格式的按钮代码]
	 */
	public function show() {
		//获取地址栏处理后的信息
		$query_string = $this->get_query_string();
		$html = '<nav><ul class="pagination">';

		/**
		 * 上一页开始
		 */
		if ($this->this_page > 1) {
			$html .= '<li><a href="' . $query_string . $this->page_name . '=1" aria-label="Previous">首页</a></li>';
			$html .= '<li><a href="' . $query_string . $this->page_name . '=' . ($this->this_page - 1) . '" aria-label="Previous">上页</a></li>';
		} else {
			$html .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Previous">首页</a></li>';
			$html .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Previous">上页</a></li>';
		}
		/**
		 * 上一页结束
		 */
		/**
		 * [$i 中间按钮开始]
		 * @var integer
		 */
		//开始5个
		//修复bug，$this->this_page <= ($this->all_page_num - $this->page_button_num) + 1
		//当前页数<页面按钮数&当前页数《=（所有页数-当前按钮数）+1
		if ($this->this_page < $this->page_button_num && $this->this_page <= (($this->all_page_num - $this->page_button_num) + 1)) {
			//每页显示行数=所有页数《每页按钮数？所有页数：每页按钮数
			$a = $this->all_page_num < $this->page_button_num ? $this->all_page_num : $this->page_button_num;
			for ($i = 1; $i <= $a; $i++) {
				if ($i == $this->this_page) {
					$html .= '<li class="am-active"><a href="javascript:void(0);">' . $i . ' <span class="sr-only"></span></a></li>';
				} else {
					$html .= '<li class="am-disabled"><a href="' . $query_string . $this->page_name . '=' . $i . '">' . $i . '</a></li>';
				}
			}
		}
		/**
		 *中间按钮逻辑
		 */
		if ($this->page_button_num <= $this->this_page && $this->this_page <= ($this->all_page_num - $this->page_button_num + 1)) {
			$page_button_num = intval($this->page_button_num / 2);
			for ($i = ($this->this_page - $page_button_num); $i <= $this->this_page + $page_button_num; $i++) {
				if ($i == $this->this_page) {
					$html .= '<li class="active"><a href="javascript:void(0);">' . $i . ' <span class="sr-only"></span></a></li>';
				} else {
					$html .= '<li><a href="' . $query_string . $this->page_name . '=' . $i . '">' . $i . '</a></li>';
				}
			}
		}
		// //结束的五个
		if (($this->all_page_num - $this->this_page) < ($this->page_button_num - 1) && $this->all_page_num >= $this->page_button_num) {
			for ($i = ($this->all_page_num - $this->page_button_num + 1); $i <= $this->all_page_num; $i++) {
				if ($i == $this->this_page) {
					$html .= '<li class="active"><a href="javascript:void(0);">' . $i . ' <span class="sr-only"></span></a></li>';
				} else {
					$html .= '<li><a href="' . $query_string . $this->page_name . '=' . $i . '">' . $i . '</a></li>';
				}
			}
		}
		/**
		 * 中间按钮结束
		 */
		/**
		 * 下一页开始
		 */
		if ($this->this_page < $this->all_page_num) {
			$html .= '<li><a href="' . $query_string . $this->page_name . '=' . ($this->this_page + 1) . '" aria-label="Next"><span aria-hidden="true">下页</span></a></li>';
			$html .= '<li><a href="' . $query_string . $this->page_name . '=' . $this->all_page_num . '" aria-label="Next"><span aria-hidden="true">尾页</span></a></li>';
		} else {
			$html .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">下页</span></a></li>';
			$html .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">尾页</span></a></li>';
		}
		/**
		 * 下一页结束
		 */
		$html .= '<li><form action="' . $query_string . '" method="get" accept-charset="utf-8" class="form-inline" style="display: inline-block;"><input type="text" name="' . $this->page_name . '" class="form-control" value="" placeholder="跳转" style="width: 50px;"><input class="btn btn-default" type="submit" value="Go"></form></li>';
		$html .= '</ul></nav>';
		return $html;
	}
}
