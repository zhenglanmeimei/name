<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>form</title>
  <script type="text/javascript" src="../../include/lib/js/jquery/jquery-2.1.4.min.js" charset="utf-8"></script>
   <script type="text/javascript">
   $(document).ready(function(){
    $('#pic').click(function(){
    // $(this).attr('src','yanzhengma.php?'+Math.random());//Math.random()产生0-1的随机数

    });
   });
    </script>
  </head>
  <body>
    <span></span><br/>
    <h1><center>用户注册</center></h1>
    <center>
      <form action="" method="post">
        用户名<input name="username" type="text" maxlength="10" size="20"/><br/>
        密码<input name="passname" type="text" value="" maxlength="10"  /><br/>
        验证码<input name="code" type="text" value="" maxlength="10" placeholer="请输入验证码"  /><br/>
        <img src="yanzhengma.php" id='pic'>点图片更换<br/>
        <input type="submit" name="submit" value"提交"/>
        <input type="checkbox" name="readme" value="记住登录"/>
        <br/>
      </form>
    </center>
  </head>
</body>
</html>

