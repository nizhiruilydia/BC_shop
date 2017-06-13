<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0"/>
        <title>博宠商城</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta content="telephone=no" name="format-detection"/>
        <script type="text/javascript">var GV = {DIMAUB: "/xiangmu/client/", MODULE_URL: "/xiangmu/client/index.php/B2b2c/"};</script>
    <link rel="stylesheet" type="text/css" href="/xiangmu/client/Application/B2b2c/Public/plug/swiper/css/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="/xiangmu/client/Application/B2b2c/Public/plug/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/xiangmu/client/Application/B2b2c/Public/plug/upload/style.css" />
    <link rel="stylesheet" type="text/css" href="/xiangmu/client/Application/B2b2c/Public/plug/artDialog/css/ui-dialog.css" />
    <link rel="stylesheet" type="text/css" href="/xiangmu/client/Application/B2b2c/Public/css/b2b2c.css" />
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/js/jquery.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/plug/swiper/js/swiper.min.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/plug/artDialog/dist/dialog.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/plug/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/js/b2b2cc.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/js/b2b2cf.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/js/b2b2cj.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/js/b2b2c.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/plug/effect/js/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/plug/effect/js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/plug/effect/js/jquery.fileupload.js"></script>

    <script type="text/javascript" src="/xiangmu/client/Application/B2b2c/Public/plug/bootstrap/js/bootstrap-datetimepicker.js"></script>
    <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?23f8c2c17dd7a662f57060d862356c09";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<!-- 百度站长自动推送工具代码 -->
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>

</head>
<body>



<div class="b2b2c_layout">
    <!--头部start-->
    <header class="b2b2c_login_header">登录博宠商城
        <a href="javascript:history.back(-1);" class="b2b2c_public_back"></a>
    </header>
    <!--头部end-->
    <!--表单区域start-->
    <section class="b2b2c_login_box b2b2c_register_box">
        <form action="#">
            <div class="b2b2c_login_mobile b2b2c_login_mib">
                <label for="mobile">
                    <i class="b2b2c_login_username" title="用户名"></i>
                </label>
                <input type="text" name="" id="b2b2c_telno" class="" value="" maxlength="" tabindex="1" aria-label=""placeholder="请输入用户名">
            </div>
            <div class="b2b2c_login_mobile b2b2c_login_mib">
                <label for="password">
                    <i class="b2b2c_login_userpassword" title="密码"></i>
                </label>
                <input type="password" name="" id="b2b2c_password" class="" value="" maxlength="" tabindex="2" aria-label=""placeholder="请您输入密码">
            </div>
            <div id="b2b2c_login_button_div"></div>
            <div class="b2b2c_login_confirm">
                <input type="button" value="登 录" onclick="b2b2cf.b2b2c_login($('#b2b2c_telno').val(), $('#b2b2c_password').val());">
            </div>
            <div class="b2b2c_register_btm">
                <a href="<?php echo U('Index/register');?>" class="b2b2c_register_btm_l tr">立即注册</a>
                <i></i>
                <a href="<?php echo U('Index/forgetpassword');?>" class=" b2b2c_register_btm_r">忘记密码</a>
            </div>
        </form>
    </section>
    <!--表单区域end-->
</div>
</body>
</html>