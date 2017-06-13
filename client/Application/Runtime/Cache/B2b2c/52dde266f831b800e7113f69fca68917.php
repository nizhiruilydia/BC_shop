<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0"/>
        <title>博宠商城</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta content="telephone=no" name="format-detection"/>
        <script type="text/javascript">var GV = {DIMAUB: "/client/", MODULE_URL: "/client/index.php/B2b2c/"};</script>
    <link rel="stylesheet" type="text/css" href="/client/Application/B2b2c/Public/plug/swiper/css/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="/client/Application/B2b2c/Public/plug/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/client/Application/B2b2c/Public/plug/upload/style.css" />
    <link rel="stylesheet" type="text/css" href="/client/Application/B2b2c/Public/plug/artDialog/css/ui-dialog.css" />
    <link rel="stylesheet" type="text/css" href="/client/Application/B2b2c/Public/css/b2b2c.css" />
    <script type="text/javascript" src="/client/Application/B2b2c/Public/js/jquery.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/plug/swiper/js/swiper.min.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/plug/artDialog/dist/dialog.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/plug/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/js/b2b2cc.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/js/b2b2cf.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/js/b2b2cj.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/js/b2b2c.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/plug/effect/js/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/plug/effect/js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="/client/Application/B2b2c/Public/plug/effect/js/jquery.fileupload.js"></script>

    <script type="text/javascript" src="/client/Application/B2b2c/Public/plug/bootstrap/js/bootstrap-datetimepicker.js"></script>
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


<div class="swiper-container swiper-container-horizontal">
    <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
        <?php if(is_array($banner)): foreach($banner as $key=>$vo): ?><div class="swiper-slide <?php echo ($vo["active"]); ?>" style="width:100%;">
                <a href="javascript:void(0);">
                    <img class="b2b2c_public_banner_slider_img" data-src="" alt="" src="<?php echo ($vo["image"]["0"]); ?>" data-holder-rendered="true" onclick="window.open('<?php echo ($vo["url"]); ?>')"/>
                </a>
            </div><?php endforeach; endif; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>

<div class="b2b2c_layout">
    <!--头部搜索start-->
    <header class="b2b2c_header">
        <div class="b2b2c_header_box">
            <a href="#" class="b2b2c_logo"></a>
            <form action="#">
				<span class="b2b2c_icon_search" onclick="b2b2cf.index_type_list_select(this);"></span>
				<input type="search" onclick="b2b2cf.index_type_list_select(this);" name="keyword" placeholder="搜索"/>
            </form>
        </div>
    </header>
    <!--头部搜索end-->

    <!--导航栏start-->
    <nav class="b2b2c_nav">
        <!--一级导航-->
        <div class="b2b2c_nav_title">
            <ul>
            	<?php if(is_array($goods_type_list)): foreach($goods_type_list as $key=>$vo): ?><li class="b2b2c_nav_level_1 <?php echo ($vo["active"]); ?>" data-id="<?php echo ($vo["id"]); ?>" onclick="b2b2cf.index_switch_goods_type(<?php echo ($vo["id"]); ?>)">
						<img src="<?php echo ($vo["image"]["0"]); ?>" alt="">
						<?php echo ($vo["name"]); ?>
					</li><?php endforeach; endif; ?>
            </ul>
        </div>
        <!--二级导航-->
        <?php if(is_array($goods_type_list)): foreach($goods_type_list as $key=>$vo): ?><section class="b2b2c_two_nav" style="display:<?php if($vo['active']=='active'){echo 'block';}else{echo 'none';}?>;" data-parentid="<?php echo ($vo["id"]); ?>">
	            <ul class="clearfix">
	            	<?php if(is_array($vo["child"])): foreach($vo["child"] as $key=>$vo2): ?><li data-id="<?php echo ($vo2["id"]); ?>" onclick="b2b2cf.index_type_level_2_select(this);">
		                    <a href="javascript:void(0);">
		                        <img src="<?php echo ($vo2["image"]["0"]); ?>" alt=""/>
		                        <p><?php echo ($vo2["name"]); ?></p>
		                    </a>
		                </li><?php endforeach; endif; ?>
	            </ul>
	        </section><?php endforeach; endif; ?>
    </nav>
    <!--导航栏end-->
    <!--主内容区域start-->
    <main class="b2b2c_index_main" id="b2b2c_index_main">
    	<?php if(is_array($recommend_list)): foreach($recommend_list as $key=>$vot): ?><section class="b2b2c_product">
    			<header style="background-color: <?php if(!empty($vot['color'])){echo $vot['color'];}else{echo '#ea7047';}?>">
					<img src="<?php echo ($vot["image"]["0"]); ?>" alt=""/>
					<?php echo ($vot["name"]); ?>
				</header>
	    		<section class="b2b2c_product_box">
	    			<ul class=clearfix>
    					<?php if(is_array($vot["list"])): foreach($vot["list"] as $key=>$vog): ?><li>
		                        <a href="<?php echo U('Index/goodspointinfo', array('goods_id'=>$vog['b2b2c_goods_id']));?>">
		                            <div class="b2b2c_product_imgbox">
		                                <img src="<?php echo ($vog["b2b2c_goods_images"]["0"]); ?>" alt="">
		                            </div>
		                            <p class="b2b2c_product_describe toe"><?php echo ($vog["b2b2c_goods_name"]); ?></p>
		                            <div class="b2b2c_price_box">
		                                <span class="b2b2c_price fl"><i>&yen</i><?php echo ($vog["b2b2c_product_price"]); ?></span>
		                                <span class="b2b2c_old_price fr"><i>&yen</i><?php echo ($vog["b2b2c_product_mktprice"]); ?></span>
		                            </div>
		                            <div class="b2b2c_product_btm clearfix">
		                                <div class="b2b2c_product_logo fl">
		                                    <img src="<?php echo ($vog["b2b2c_brand_logo"]["0"]); ?>" alt="">
		                                </div>
		                                <div class="b2b2c_product_numbox fr">
		                                    <div>
		                                        <span>已售</span>
		                                        <span><?php echo ($vog["b2b2c_goods_sold_count"]); ?></span>
		                                    </div>
		                                    <div>
		                                        <span>评价</span>
		                                        <span><?php echo ($vog["b2b2c_comments_count"]); ?></span>
		                                    </div>
		                                </div>
		                            </div>
		                        </a>    						
	    					</li><?php endforeach; endif; ?>
    				</ul>
    			</section>
    		</section><?php endforeach; endif; ?>
    </main>
    <!--主内容区域end-->
    <!--悬浮底部start-->
    <footer class="b2b2c_index_footer">
        <div class="b2b2c_index_footer_box">
            <ul>
                <li>
                    <!--谁是当前页给谁的a加上active这个类名，即可变换图标和文字的颜色-->
                    <a href="#" class="active">
                        <div class="b2b2c_index_icon"></div>
                        <p>首页</p>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('User/get_cart_list');?>">
                        <div class="b2b2c_cart_icon"></div>
                        <p>购物车</p>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('User/home');?>">
                        <div class="b2b2c_user_icon"></div>
                        <p>我的博宠</p>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
    <!--悬浮底部end-->
    <a href="#" class="b2b2c_return_top" id="b2b2c_return_top"></a>
</div>
<script>
	var swiper = new Swiper('.swiper-container',{
		pagination: '.swiper-pagination'
	});
</script>
</body>
</html>