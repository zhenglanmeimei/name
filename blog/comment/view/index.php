<?php include 'head.php';?>
<div class="template">
  <div class="box">
    <h3>
      <p><span>个人博客</span>模板 Templates</p>
    </h3>
  </div>
</div>
<?php if (!empty($rows)): ?><!-- 判断admin-log中查询结果是否为空 -->
 <?php foreach ($rows as $value): ?><!-- 对查询结果循环 -->
<article>
  <h2 class="title_tj">
   <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
  <td width="21"><input type="checkbox" name="blog[]" value="<?php echo $value['id']; ?>" class="ids" /></td><!-- 因为￥value为索引数组，则$value[0] -->
      <td width="490"><a href="index.php?id=<?php echo $value['id']; ?>"  target="_blank"><!-- 点击文章标题跳转到http://localhost/zl/blog/index.php?id=28.htm页面 -->
    <h3><?php echo $value['title']; ?></h3>
    <figure><img src="admin/view/images/001.png"></figure>
    <ul>
      <p>摘要：<?php echo !empty($value['des']) ? $value['des'] : extractHtmlData($value['title'], 250, true); ?></p>
      <br/>
      <P>文章内容：<?php echo $value['content']; ?></P>
      <a title="<?php echo $value['title']; ?>" href="http://localhost/zl/blog/admin/write_log.php?action=edit&id=<?php echo $value['id']; ?>.htm" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span><?php echo date('Y-m-d', $value['createtime']); ?></span><span>作者：郑兰美眉</span><span>个人博客：[<a href="localhost/zl/blog">程序人生</a>]</span></p>
  </div>
   <?php endforeach;?>
      <?php endif;?>
      <?php echo $show; ?>
  <aside class="right">
    </div>
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>

</article>
<footer>
  <p>Design by DanceSmile <a href="http://www.mycodes.net/" title="源码之家" target="_blank">源码之家</a> <a href="/">网站统计</a></p>
</footer>
<script src="js/silder.js"></script>
</body>
</html>