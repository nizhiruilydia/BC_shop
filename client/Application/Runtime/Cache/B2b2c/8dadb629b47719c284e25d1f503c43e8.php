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



<div class="b2b2c_layout">
    <!--点击编辑弹出框start-->
    <div class="b2b2c_cart_pop">
        <section class="bgcf b2b2c_cart_edit_box">
            <div class="b2b2c_cart_edit_inner b2b2c_p16">
                <div class="b2b2c_cart_edit_inner_t clearfix">
                    <div class="img_box fl"><img src="<?php echo ($b2b2c_goods_product_one['images'][0]); ?>" alt=""></div>
                    <div class="div_txt fl">
                        <div class="div_txt_btm">
                        <span class="">
                            <i>&yen;</i>
                            <i><?php echo ($b2b2c_goods_product_one['price']); ?></i>
                        </span>
                        <span>
                            <i>库存</i>&nbsp;<i><?php echo ($b2b2c_goods_product_one['store']); ?></i>件
                        </span>
                         <span>
                            <i>已选:</i>&nbsp;<i><?php echo ($b2b2c_goods_product_one['name']); ?></i>
                        </span>
                        </div>
                    </div>
                    <div class="b2b2c_cart_delbtn" onclick="javascript:history.go(-1);"></div>
                </div>
                <div class="b2b2c_cart_edit_inner_c">
                    <ul class="clearfix">
                        <li>数量</li>
                        <li>一次最多购买99件</li>
                        <li>
                            <a href="#" class="plus fr" onclick="b2b2cf.product_number(parseInt($('#b2b2c_product_number').val())+1);"></a>
                            <input type="text" value="1" class="fr" id="b2b2c_product_number" autocomplete="off" onBlur="b2b2cf.product_number(parseInt($('#b2b2c_product_number').val()));">
                            <a href="#" class="minus fr" onclick="b2b2cf.product_number(parseInt($('#b2b2c_product_number').val())-1);"></a>
                        </li>
                    </ul>
                </div>
                <div class="b2b2c_cart_edit_inner_b clearfix">
                    <p class="fl">规格</p>
                    <ul class="fl">
						<?php if(is_array($b2b2c_goods_product)): $i = 0; $__LIST__ = $b2b2c_goods_product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['store'] < 1) { echo '<li class="dashed">'; } else if($vo['id'] == $product_id) { echo '<li class="active">'; } else { echo '<li>'; } ?>
								<!--<a href="<?php echo U('Index/product', array('goods_id'=>$vo['goods_id'], 'product_id'=>$vo['id'], 'product_url'=>$product_url));?>"><?php echo ($vo["name"]); ?></a>-->
								<a href="javascript:" onclick="b2b2cc.refresh('Index/product', 'goods_id:<?php echo ($vo['goods_id']); ?>,product_id:<?php echo ($vo['id']); ?>,rfs:<?php echo ($rfs); ?>');"><?php echo ($vo["name"]); ?></a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <footer>
                <input type="button" readonly value="加入购物车" onclick="<?php echo ($rfs); ?>">
            </footer>
        </section>
    </div>
    <!--点击编辑弹出框end-->
</div>

<input type="hidden" id="b2b2c_goods_id" value="<?php echo ($goods_id); ?>">
<input type="hidden" id="b2b2c_product_id" value="<?php echo ($product_id); ?>">
<input type="hidden" id="b2b2c_rfs" value="<?php echo ($rfs); ?>">

</body>
</html>