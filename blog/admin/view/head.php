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
        <link type="text/css" type="text/css" href="view/css/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link type="text/css" href="view/css/css-main.css" rel="stylesheet">
        <script type="text/javascript" src="../include/lib/js/jquery/jquery-2.1.4.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="../include/lib/js/jquery/plugin-cookie.js"charset="utf-8"></script>
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
                    <a class="navbar-brand" href="../index." target="_blank" title="在新窗口浏站点">
                        点滴记忆                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li><a href="index"><i class="fa fa-home fa-fw"></i>管理首页</a></li>
                    <li><a href="configure.php"><i class="fa fa-wrench fa-fw"></i> 设置</a></li>
                    <li><a href="../index"><i class="fa fa-power-off fa-fw"></i>退出</a></li>
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