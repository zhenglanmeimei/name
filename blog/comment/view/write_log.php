<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>杨青个人博客网站—一个站在web前段设计之路的女技术员个人博客网站</title>
<meta name="keywords" content="个人博客,杨青个人博客,个人博客模板,杨青" />
<meta name="description" content="杨青个人博客，是一个站在web前端设计之路的女程序员个人网站，提供个人博客模板免费资源下载的个人原创网站。" />
<link href="comment/view/css/base.css" rel="stylesheet">
<link href="comment/view/css/new.css" rel="stylesheet">
<link href="admin/view/css/index.css" rel="stylesheet">
<script type="text/javascript" src="include/lib/js/jquery/jquery-2.2.3.min.js" charset="utf-8"> </script>
<script type="text/javascript">
  $(document).ready(function(){//文档就绪函数
    $('form').submit(function(){//form表单的提交事件
      var data=$(this).serialize();//序列化表单数据
      var url=$(this).attr('action');//返回被选元素的属性值
      $.ajax({//不用刷新页面就可以显示
        cache:false,//不缓存
        url:url,//需要请求的地址
        type:'POST',//请求类型
        data:data,//post请求时才有
        success:function(data){
          console.log(data);//控制台打印服务器提交的东西
        },
        error:function(a){
          console.log(a);
          console.log('请求失败');//错误打印错误信息
        }
      });//ajax为对象数组
      return false;//如果ajax错误返回false
    });
  });
</script>
</head>
<body>
<article class="blogs">
  <h1 class="t_nav"><span>您当前的位置：<a href="/index.html">首页</a>&nbsp;&gt;&nbsp;<a href="/news/s/">慢生活</a>&nbsp;&gt;&nbsp;<a href="/news/s/">日记</a></span><a href="http://localhost/zl/blog/" class="n1">网站首页</a><a href="/" class="n2">日记</a></h1>
  <div class="index_about">
    <h2 class="c_titile">爱情不容有错，即使错了那就重来</h2>
    <p class="box_c"><span class="d_time">发布时间：2013-09-08</span><span>编辑：杨青</span><span>互动QQ群：<a href="http://wp.qq.com/wpa/qunwpa?idkey=d4d4a26952d46d564ee5bf7782743a70d5a8c405f4f9a33a60b0eec380743c64">280998807</a></span></p>
    <ul class="infos">
      <p><?php echo $rows['content']; ?></p>
    </ul>
    <div class="keybq">
    <p><span>关键字词</span>：爱情,犯错,原谅,分手</p>
      <div id="replay" >
       <legend><h3 class="fabu">发布评论</h3><a href="#replay" id="noreplay" style="display:none;cursor:pointer;">取消回复</a></legend><br/>
     <form action="index.php?action=addcom" method="post" name="link" id="link" class="form-inline">
<div id="link_new" class="form-group">
<form class="am-form" role="form" method="post" action="index.php?action=addcom" >
     <input type="hidden" name="blog_id" value="<?php echo $rows['id']; ?>"/>
     <input type="hidden" name="pid" id="pid" value="0"/>
     <label>用户昵称<span class="required"></span></label>
        <input maxlength="200" style="width:170px;height:40px" class="form-control" name="nickname"required="required" />
    </li>
    <label>邮箱地址</label>
        <input  type="email" maxlength="170" style="width:170px;height:40px" class="form-control" name="email"  required="required"/>
    <label>友情链接<span class="required"></span></label>
        <input type="url" maxlength="170" style="width:170px;height:40px" class="form-control" name="address"required="required"/>
    <p>描述内容</p>
    <textarea name="description" type="text" class="form-control" style="width:85%;height:200px;overflow:auto;" required="required"></textarea>
    <p><input type="submit" class="btn btn-primary" name="submit" value="提交评论"/></p>
</form>
</div>
    </div>
<?php if (!empty($comment_list)) {
	?>
<?php foreach ($comment_list as $value) {
		?>
<article class="am-comment">
  <a href="#link-to-user-home">
    <img src="comment/view/images/aboutphoto.jpg" alt="" class="am-comment-avatar" width="88" height="88"/>
  </a>
  <div class="am-comment-main  content">
    <header class="am-comment-hd">
      <h3 class="am-comment-title">评论标题</h3>
      <div class="am-comment-meta">
        <h3>昵称:</h3><a href="#" class="am-comment-author"><?php echo $value['nickname']; ?></a>
      </div>
    </header>
    <div class="am-comment-bd">
     <h3>评论内容:</h3><?php echo $value['description']; ?>
    <p>
    评论于 <time  ><?php echo date('Y-m-d H:i:s', time()); ?></time>
    </p>
    <p><?php echo $value['email']; ?></p>
   <a href="#replay" class="replay" data-id="<?php echo $value['comment_id']; ?>" style="cursor: pointer;color:black;">回复</a>
    </div>
    <?php if (isset($value['data']) && is_array($value['data'])) {echo comment($value['data']);}?>
  </div>
  </article>
<?php }?>
<?php }?>

    <div class="nextinfo">
      <p>上一篇：<a href="/news/s/2013-09-04/606.html">程序员应该如何高效的工作学习</a></p>
      <p>下一篇：<a href="/news/s/2013-10-21/616.html">柴米油盐的生活才是真实</a></p>
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        <li><a href="/news/s/2013-07-25/524.html" title="现在，我相信爱情！">现在，我相信爱情！</a></li>
        <li><a href="/newstalk/mood/2013-07-24/518.html" title="我希望我的爱情是这样的">我希望我的爱情是这样的</a></li>
        <li><a href="/newstalk/mood/2013-07-02/335.html" title="有种情谊，不是爱情，也算不得友情">有种情谊，不是爱情，也算不得友情</a></li>
        <li><a href="/newstalk/mood/2013-07-01/329.html" title="世上最美好的爱情">世上最美好的爱情</a></li>
        <li><a href="/news/read/2013-06-11/213.html" title="爱情没有永远，地老天荒也走不完">爱情没有永远，地老天荒也走不完</a></li>
        <li><a href="/news/s/2013-06-06/24.html" title="爱情的背叛者">爱情的背叛者</a></li>
      </ul>
    </div>
  </div>
</article>
     <script type="text/javascript">
      $(function() {
       // 给所有的回复按钮绑定点击事件
        $('.replay').click(function() {
            //修改from表单中pid的值
            $('form input[name=pid]').val($(this).attr('data-id'));
            //把from表单移动到对应的评论下边
            // console.log($(this).attr('data-id'));
           $(this).parents('article').first().append($('#replay'));
            // // 显示取消回复按钮
            $('#noreplay').show();
        });
        $('#noreplay').click(function() {
            //修改from表单中pid为0
            $('form input[name=pid]').val(0);
            //移动from表单到原始位置
            $('#olddom').append($('#replay'));
            //隐藏取消回复
            $('#noreplay').hide();
        });
    });
    // </script>
<?php include 'foot.php';?>