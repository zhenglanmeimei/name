<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>杨青个人博客网站—一个站在web前段设计之路的女技术员个人博客网站</title>
<meta name="keywords" content="个人博客,杨青个人博客,个人博客模板,杨青" />
<meta name="description" content="杨青个人博客，是一个站在web前端设计之路的女程序员个人网站，提供个人博客模板免费资源下载的个人原创网站。" />
<link href="view/css/base.css" rel="stylesheet">
<link href="view/css/mood.css" rel="stylesheet">
</head>
<body class="all">
<header>
  <div id="logo"><a href="/"></a></div>
  <nav class="topnav" id="topnav"><a href="localhost/zl/blog"><span>首页</span><span class="en">Protal</span></a><a href="about.html"><span>关于我</span><span class="en">About</span></a><a href="newlist.html"><span>慢生活</span><span class="en">Life</span></a><a href="http://localhost/zl/blog/admin/moodlist.php"><span>碎言碎语</span><span class="en">Doing</span></a><a href="share.html"><span>模板分享</span><span class="en">Share</span></a><a href="knowledge.html"><span>学无止境</span><span class="en">Learn</span></a><a href="http://localhost/zl/blog/admin/book.php"><span>留言版</span><span class="en">Gustbook</span></a></nav>
  </nav>
</header>
  <?php if (!empty($rows)): ?><!-- 判断admin-log中查询结果是否为空 -->
 <?php foreach ($rows as $value): ?><!-- 对查询结果循环 -->
         <div class="biankuang">
          <tr >
      <td width="21"><input type="checkbox" name="blog[]" value="<?php echo $value['id']; ?>" class="ids" /></td><!-- 因为￥value为索引数组，则$value[0] -->
      <td width="490"><a href="write_log.php?action=edit&id=<?php echo $value['id']; ?>.htm">
      <p><?php echo $value['title']; ?></p>
      <P><?php echo $value['content']; ?></P>
      <p><?php echo !empty($value['des']) ? $value['des'] : extractHtmlData($value['title'], 250, true); ?></p>
      <p><?php echo $value['createtime']; ?></p>
      </a> <!-- 将数据中的结果从这里输出 -->
      </div>
        <span style="display:none; margin-left:8px;">
</span>
      </td>
            <td class="tdcenter">
      </td>
      </td>
      <p>
          <?php endforeach;?>
<?php endif;?>
 <?php echo $show; ?>
            <td><a href="admin_log.php-uid=1.htm">紫殇</a></td>
      <td><a href="admin_log.php-sid=-1.htm">未分类</a></td>
      <td class="small"><?php echo date('Y-m-d H:i:s', $value['createtime']); ?></td>
      <td class="tdcenter"><a href="comment.php-gid=1.htm">0</a></td>
      <td class="tdcenter">0</p>
      </tr>

        </tbody>
    </table>
    <input name="token" id="token" value="bb1bb62fac972af39766d4071fd3133d" type="hidden" />
    <input name="operate" id="operate" value="" type="hidden" />
    <div class="list_footer form-inline">
    <a href="javascript:void(0);" id="select_all">全选</a> 选中项：
    <a href="javascript:logact('del');" class="care">删除</a> |
        <a href="javascript:logact('hide');">放入草稿箱</a> |

        <select name="top" id="top" onChange="changeTop(this);" style="width:120px;" class="form-control">
        <option value="" selected="selected">置顶操作...</option>
        <option value="top">首页置顶</option>
        <option value="sortop">分类置顶</option>
        <option value="notop">取消置顶</option>
    </select>

    <select name="sort" id="sort" onChange="changeSort(this);" style="width:120px;" class="form-control">
    <option value="" selected="selected">移动到分类...</option>

        <option value="-1">未分类</option>
    </select>
       </div>
</form>
<div class="page"> (有<?php echo $rows[0]['id']; ?>篇文章)
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#f_t_tag").click(function(){$("#f_tag").toggle();$("#f_sort").hide();$("#f_user").hide();});
    selectAllToggle();
});
setTimeout(hideActived,2600);
$("#menu_log").addClass('active');
</script>
            <div id="footer"></div>
        </div>
</body>
</html>
<?php include 'foot.php';?>