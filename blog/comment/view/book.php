<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>个人博客模板（寻梦）</title>
<meta name="keywords" content="个人博客模板,博客模板" />
<meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
<link href="view/css/base.css" rel="stylesheet">
<link href="view/css/index.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="js/modernizr.js"></script>
<![endif]-->
</head>
<body>
<header>
  <div id="logo"><a href="/"></a></div>
  <nav class="topnav" id="topnav"><a href="index.html"><span>首页</span><span class="en">Protal</span></a><a href="about.html"><span>关于我</span><span class="en">About</span></a><a href="newlist.html"><span>慢生活</span><span class="en">Life</span></a><a href="admin/moodlist.php"><span>碎言碎语</span><span class="en">Doing</span></a><a href="share.html"><span>模板分享</span><span class="en">Share</span></a><a href="knowledge.html"><span>学无止境</span><span class="en">Learn</span></a><a href="admin/view/book.php"><span>留言版</span><span class="en">Gustbook</span></a></nav>
  </nav>
</header>
<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="#"><span>杨青</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>个人博客</span>模板 Templates</p>
    </h3>
  </div>
</div>
<form action="" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
    <!--文章内容-->
    <div class="col-lg-8">
        <div class="containertitle">
            <b>写文章</b><span id="msg_2"></span>
        </div>
        <div id="msg"></div>
        <div id="post" class="form-group">
            <div>
            <h4>文章标题</h4>
                <input type="text" name="title" id="title" value="" class="form-control" placeholder="文章标题" />
            <!-- </div>
            <div id="post_bar">
                <div class="show_advset">
                    <span onclick="displayToggle('FrameUpload', 0);autosave(1);">上传插入<i class="fa fa-caret-right fa-fw"></i></span>
                                        <span id="asmsg"></span>
                    <input type="hidden" name="as_logid" id="as_logid" value="-1">
                </div>
                <div id="FrameUpload" style="display: none;">
                    <iframe width="100%" height="330" frameborder="0" src="attachment.php-action=selectFile.htm"></iframe>
                </div>
            </div>
            <div> -->
            <h4>文章内容</h4>
                <textarea id="content" name="content" style="width:100%; height:460px;"></textarea>
            </div>
            <div id="advset">
                <div>文章摘要：</div>
                <div><textarea id="excerpt" name="excerpt" style="width:100%; height:260px;"></textarea></div>
            </div>
        </div>
        <div class=line></div>
    </div>

    <!--文章侧边栏-->
    <div class="col-lg-4 container-side">
        <div class="panel panel-default">


                    <div class="form-group">
                        <label>发布时间：</label>
                        <input maxlength="200" name="postdate" id="postdate" value="<?php echo date('Y-m-d H:i:s', time()) ?>" class="form-control" />
            </div>

            <div id="post_button">
                <input name="token" id="token" value="ac94bc4fcfa2345512df6888adc83e8f" type="hidden" />
                <input type="hidden" name="ishide" id="ishide" value="" />
                <input type="hidden" name="gid" value=-1 />
                <input type="hidden" name="author" id="author" value=1 />
                   <a href="http://localhost/zl/blog/admin/moodlist.php">发布留言</a>
                                    <input type="submit" value="发布留言" src="http://localhost/zl/blog" class="btn btn-primary" />
                    <input type="button" name="savedf" id="savedf" value="保存草稿" onclick="autosave(2);" class="btn btn-success" />

            </div>
        </div>
    </form>
    <script type="text/javascript">
        loadEditor('content');
        loadEditor('excerpt');
        $("#menu_wt").addClass('active');
        $("#advset").css('display', $.cookie('em_advset') ? $.cookie('em_advset') : '');
        $("#alias").keyup(function () {
            checkalias();
        });
        setTimeout("autosave(0)", 60000);
        $("#menu_wt").addClass('active');
    </script>
            <div id="footer"></div>
        </div>

 <!--  -->