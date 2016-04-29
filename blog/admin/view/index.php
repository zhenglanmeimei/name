
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理中心 - 点滴记忆</title>
    <link type="text/css" href="view/css/cssreset-min.css" rel="stylesheet">
    <link type="text/css" href="view/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="view/css/select2.min.css" rel="stylesheet">
    <link type="text/css" href="view/css/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="view/css/css-main.css" rel="stylesheet">
    <script type="text/javascript" src="include/lib/js/jquery/jquery-2.1.4.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="include/lib/js/jquery/plugin-cookie.js" charset="utf-8"></script>
    <script type="text/javascript" src="view/js/bootstrap.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="view/js/select2.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="view/js/common.js" charset="utf-8"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index" target="_blank" title="在新窗口浏站点">
                        点滴记忆                    </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li><a href="index"><i class="fa fa-home fa-fw"></i>管理首页</a></li>
                <li><a href="configure.php"><i class="fa fa-wrench fa-fw"></i> 设置</a></li>
                <li><a href="http://localhost/zl/blog/houtai"><i class="fa fa-power-off fa-fw"></i>退出</a></li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-avatar">
                            <div style="text-align: center;">
                                <a href="blogger.php">
                                    <img class="img-circle" src="view/images/avatar.jpg" />
                                </a>
                            </div>
                        </li>
                        <li><a href="write_log.php" id="menu_wt"><i class="fa fa-edit fa-fw"></i> 写文章</a></li>
                        <li><a href="admin_log.php" id="menu_log"><i class="fa fa-list-alt fa-fw"></i> 文章</a></li>
                        <li><a href="tag.php" id="menu_tag"><i class="fa fa-tags fa-fw"></i> 标签</a></li>
                        <li><a href="sort.php" id="menu_sort"><i class="fa fa-flag fa-fw"></i> 分类</a></li>
                        <li><a href="comment.php" id="menu_cm"><i class="fa fa-comments fa-fw"></i> 评论
                                                                        </a></li>
                        <li><a href="page.php" id="menu_page"><i class="fa fa-file-o fa-fw"></i> 页面</a></li>
                        <li><a href="link.php" id="menu_link"><i class="fa fa-link fa-fw"></i> 友链</a></li>
                        <li id="menu_category_view" class="">
                            <a href="#"><i class="fa fa-eye fa-fw"></i> 外观<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" id="menu_view">
                                <li><a href="widgets.php" id="menu_widget"><i class="fa fa-columns fa-fw"></i> 侧边栏</a></li>
                                <li><a href="navbar.php" id="menu_navi"><i class="fa fa-bars fa-fw"></i> 导航</a></li>
                                <li><a href="template.php" id="menu_tpl"><i class="fa fa-eye fa-fw"></i> 模板</a></li>
                            </ul>
                        </li>
                        <li id="menu_category_sys" class="">
                            <a href="#"><i class="fa fa-cog fa-fw"></i> 系统<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" id="menu_sys">
                                <li><a href="configure.php" id="menu_setting"><i class="fa fa-wrench fa-fw"></i> 设置</a></li>
                                <li><a href="user.php" id="menu_user"><i class="fa fa-user fa-fw"></i> 用户</a></li>
                                <li><a href="data.php" id="menu_data"><i class="fa fa-database fa-fw"></i> 数据</a></li>
                                <li><a href="plugin.php" id="menu_plug"><i class="fa fa-plug fa-fw"></i> 插件</a></li>
                                <li><a href="store.php" id="menu_store"><i class="fa fa-shopping-cart fa-fw"></i> 应用</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
            <script type="text/javascript">
            setTimeout(hideActived, 2600);
            </script>
            <div class="containertitle"><b>管理首页</b></div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-laptop fa-fw"></i> 站点信息
                        </div>
                        <div class="panel-body" id="admindex_servinfo">
                            <ul>
                                <li>有<b>2</b>篇文章，<b>0</b>条评论</li>
                                <li>数据库表前缀：emlog_</li>
                                <li>PHP版本：5.5.12</li>
                                <li>MySQL版本：5.6.17</li>
                                <li>服务器环境：Apache/2.4.9 (Win32) PHP/5.5.12</li>
                                <li>GD图形处理库：bundled (2.1.0 compatible)</li>
                                <li>服务器空间允许上传最大文件：64M</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-volume-down fa-fw"></i> 官方消息
                        </div>
                        <div class="panel-body" id="admindex_msg">
                            <ul></ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="admindex">
                        <div id="about" class="alert alert-warning">
                            欢迎使用 © <a href="../../../www.emlog.net/index" target="_blank">emlog</a> v6.0.0-Beta  <span><a id="ckup" href="javascript:void(0);">检查更新</a></span>
                            <br />
                            <span id="upmsg"></span>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
            $(document).ready(function() {
                $("#admindex_msg ul")l("<span class=\"ajax_remind_1\">正在读取...</span>");
                $.getJSON("http://www.emlog.net/services/messenger.php?v=6.0.0-Beta&callback=?" ,
                    function(data) {
                        $("#admindex_msg ul")l("");
                        $.each(data.items, function(i, item) {
                            var image = '';
                            if (item.image != '') {
                                image = "<a href=\"" + item.url + "\" target=\"_blank\" title=\"" + item.title + "\"><img src=\"" + item.image + "\"></a><br />";
                            }
                            $("#admindex_msg ul").append("<li class=\"msg_type_" + item.type + "\">" + image + "<span>" + item.date + "</span><a href=\"" + item.url + "\" target=\"_blank\">" + item.title + "</a></li>");
                        });
                    });
            });
            $("#about #ckup").click(function() {
                $("#about #upmsg")l("正在检查，请稍后").addClass("ajaxload");
                $.getJSON("http://www.emlog.net/services/check_update.php?ver=6.0.0-Beta&callback=?",
                    function(data) {
                        if (data.result.match("no")) {
                            $("#about #upmsg")l("目前还没有适合您当前版本的更新！").removeClass();
                        } else if (data.result.match("yes"))  {
                            $("#about #upmsg")l("有可用的emlog更新版本 " + data.ver + "，更新之前请您做好数据备份工作，<a id=\"doup\" href=\"javascript:doup('" + data.file + "','" + data.sql + "');\">现在更新</a>").removeClass();
                        } else {
                            $("#about #upmsg")l("检查失败，可能是网络问题").removeClass();
                        }
                    });
            });

            function doup(source, upsql) {
                $("#about #upmsg")l("系统正在更新中，请耐心等待").addClass("ajaxload");
                $.get('./index.php?action=update&source=' + source + "&upsql=" + upsql,
                    function(data) {
                        $("#about #upmsg").removeClass();
                        if (data.match("succ")) {
                            $("#about #upmsg")l('恭喜您！更新成功了，请<a href="index"/*tpa=http://127.0.0.1/emlog6/admin/*/>刷新页面</a>开始体验新版emlog');
                        } else if (data.match("error_down")) {
                            $("#about #upmsg")l('下载更新失败，可能是服务器网络问题');
                        } else if (data.match("error_zip")) {
                            $("#about #upmsg")l('解压更新失败，可能是你的服务器空间不支持zip模块');
                        } else if (data.match("error_dir")) {
                            $("#about #upmsg")l('更新失败，目录不可写');
                        } else {
                            $("#about #upmsg")l('更新失败');
                        }
                    });
            }
            </script>
            <div id="footer"></div>
        </div>
    </div>
    <script type="text/javascript">
    $('select').select2();
    </script>
</body>

</html>
