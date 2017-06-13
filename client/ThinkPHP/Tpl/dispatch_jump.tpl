<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection"content="telephone=no, email=no" />
	    <meta name="renderer" content="webkit">
	    <meta http-equiv="Cache-Control" content="no-siteapp" />
	    <meta name="HandheldFriendly" content="true">
	    <meta name="screen-orientation" content="portrait">
	    <meta name="x5-orientation" content="portrait">
	    <meta name="full-screen" content="yes">
	    <meta name="x5-fullscreen" content="true">
	    <meta name="browsermode" content="application">
	    <meta name="x5-page-mode" content="app">
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
html { font-family: "Helvetica Neue", Helvetica, STHeiTi, Arial, sans-serif;  Helvetica, STHeiTi, Arial, sans-serif; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; }
body { margin: 0; font-size: .75rem; line-height: 1.5; color: #333333;  height: 100%; overflow-x: hidden; -webkit-overflow-scrolling: touch; }
*{padding: 0; margin: 0;}




a { background: transparent; text-decoration: none; -webkit-tap-highlight-color: transparent; color: #333; }
a:active { outline: 0; }
a:active { color: #eee; }
b, strong { font-weight: bold; }
img { border: 0; vertical-align: middle; }
hr { -moz-box-sizing: content-box; box-sizing: content-box; height: 0; }
* { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
@media screen and (min-width: 640px) {
	html{font-size: 32px!important;}
}
.header , .wrap_page{
  position:absolute;
  left:0;
  right:0;
}
.header{
  top: 0;
  background-color: #e8720f;
  color:#fff;
  font-size:1.333rem;
  font-weight: bold;
  height:44px;
  text-align: center;
  z-index:900;
  line-height:44px;
}
.footer{
  bottom: 0;
}
.wrap_page{
  top: 44px;
  bottom: 0;
  overflow-y:auto;
  -webkit-overflow-scrolling:touch;
}
.page{
  padding: 10px;
}
.page p{
  margin-bottom: 10px;
}

.error_wrap{
	background-color:#fff; 
}
.error_box{
	height:10rem;
	position: fixed;
	top:25%;
	/*bottom:45%;*/
	left:0;
	right:0;
}
.error_left_img{
	width:40%;
	float: left;
	background:url(__ROOT__/ThinkPHP/Tpl/images/error.jpg) no-repeat right;
	background-size: 60% 60%; 
	height:100%;
	background-position:20% right;
}
.error_right_text{
	height:100%;
	width:60%;
	float: left;
	padding:0 1rem ;
}
.error_right_text p{
	font-size: 0.888rem;
	font-weight: bold;
	line-height: 1.6rem;
	margin-top:20%;
	display:block;
}
.error_right_text span{
	font-size: 0.666rem;
	line-height: 1.6rem;
	display:block;
}
.error_right_text a{
	height:1.6rem;
	width:3.333rem;
	display: block;
	line-height: 1.6rem;
	border-radius: 0.2rem;
	border:1px solid #e8720f;
	background-color:#e8720f;
	text-align: center;
	color:#fff;
	margin:0.5rem 0 0 0 ;
	font-size:0.666rem;
}
.success_left_img{
	background: url(__ROOT__/ThinkPHP/Tpl/images/success.jpg) no-repeat right;
	background-size:60% 60%; 
}
</style>
</head>
<script src="__ROOT__/ThinkPHP/Tpl/js/jquery.js"></script>
<script src="__ROOT__/ThinkPHP/Tpl/js/rem.js"></script>

<body>
		<header class="header ">操作提示</header>
		<div class="wrap_page error_wrap">
			<div class="error_box">
				<div class="error_left_img <?php if(isset($message)) { echo 'success_left_img';}?>">
					
				</div>
				<div class="error_right_text"> 
					<p>
						<?php if(isset($message)){ echo ($message);} else { echo ($error);} ?>
					</p>
					<span>如果您不做选择系统将自动跳转：<b id="wait"><?php echo($waitSecond); ?></b></span>
					<a id="href" href="<?php echo($jumpUrl); ?>">返回</a>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
