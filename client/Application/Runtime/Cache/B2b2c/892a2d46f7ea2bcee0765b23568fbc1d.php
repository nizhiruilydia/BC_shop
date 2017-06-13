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



<div id="b2b2c_image_full_div" style="display:none;background-color:#999;position:absolute;top:0;z-index:1000;" onclick="b2b2cf.goods_info_image_normal()">
    <img src="" />
</div>

<div class="b2b2c_layout">
    <!--头部start-->
    <div style="position:fixed;top:0;left:0;z-index:10;width:100%;">
    <header class="b2b2c_public_header_two b2b2c_spinfo_head">
        <a href="<?php echo U('Index/index');?>" class="b2b2c_public_back"></a>
        <div class="b2b2c_spinfo_nav">
            <a class="active" data-div="b2b2c_goods_info_default_div" href="javascript:void(0);" onclick="b2b2cf.goods_info_switch(this)">商品</a>
            <a data-div="b2b2c_goods_info_detail_div" href="javascript:void(0);" onclick="b2b2cf.goods_info_switch(this)">详情</a>
            <a id="b2b2c_goods_info_comment_div" data-div="b2b2c_goods_info_comment_div" href="javascript:void(0);" onclick="b2b2cf.goods_info_switch(this)">评价</a>
        </div>
        <?php if(!empty(get_user_token())){ ?>
            <?php if(empty($is_favorite)): ?><div class="b2b2c_collect_btn" id="b2b2c_public_goods_addcollect" onclick="b2b2cf.goodstypelist_addfavorite(<?php echo ($b2b2c_goods_info['id']); ?>);"></div>
            <?php else: ?>
                    <div class="b2b2c_collect_btn already_f"></div><?php endif; ?>
        <?php } ?>
    </header>
    </div>
    <!--头部end-->
    <!-- banner轮播图start-->
    <div id="b2b2c_goods_info_outer">
        <div id="b2b2c_goods_info_default_div">
            <div class="swiper-container swiper-container-horizontal b2b2c_spinfo_banner">
                <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0, 0px, 0px);">
                    <?php if(is_array($b2b2c_goods_info["images"])): foreach($b2b2c_goods_info["images"] as $key=>$vo): ?><div class="swiper-slide" style="width:100%;">
                            <a href="#">
                                <img src="<?php echo ($vo); ?>">
                            </a>
                        </div><?php endforeach; endif; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- banner轮播图end-->
            <!--主内容区域start-->
            <main class="b2b2c_spinfo_content">
                <section class="bgcf b2b2c_p16 b2b2c_sp_info">
                    <div class="b2b2c_t b2b2c_ov2">
                        <?php echo ($b2b2c_goods_info["name"]); ?>
                    </div>
                    <div class="b2b2c_c clearfix">
                        <span class="fl"><i>&yen;</i><i><?php echo ($b2b2c_goods_product[0]["price"]); ?></i></span>
                        <span class="fr"><i>原价:</i><i>&yen;</i><i><?php echo ($b2b2c_goods_product[0]["mktprice"]); ?></i></span>
                    </div>
                    <div class="b2b2c_b clearfix">
                        <img class="fl" src="<?php echo ($b2b2c_goods_info["b2b2c_brand_logo"]["0"]); ?>" alt="">
                        <p class="fr">
                            <span><i>已售</i><i><?php echo ($b2b2c_goods_info["sold_count"]); ?></i></span>
                            <span><i>评价</i><i><?php echo ($b2b2c_goods_info["comments_count"]); ?></i></span>
                        </p>
                    </div>
                </section>
                <section class="bgcf b2b2c_p16">
                    <div class="b2b2c_info_pro clearfix" onclick="b2b2cc.refresh('Index/product', 'goods_id:<?php echo ($b2b2c_goods_info['id']); ?>,product_id:<?php echo ($b2b2c_goods_product[0]['id']); ?>,rfs:b2b2cf.goods_info_select_product_callback();', true);">
                        <a class="fl" href="javascript:void(0);">查看商品规格</a>
                        <span class="fr"></span>
                    </div>
                </section>
                <section class="bgcf b2b2c_p16 b2b2c_info_site clearfix">
                    <p class="fl">配送至</p>
                    <input class="b2b2c_goods_info_area toe" type="button" id="area" readonly="readonly" value="点击选择配送地址"/>
                    <!-- <div class="fl b2b2c_site_choose">
                        北京 北京市
                    </div> -->
                    <div class="fr b2b2c_site_la" id="b2b2c_goods_info_distribute">
<!--                         <span>可配送</span>
                        <span>运费 <i>10元</i> </span> -->
                    </div>
                </section>
                <section class="bgcf b2b2c_p16 b2b2c_info_shop clearfix">
                    <div class="b2b2c_t clearfix">
                        <div class="b2b2c_shop_name fl clearfix">
                            <img src="<?php echo ($b2b2c_shop_info["logo"]["0"]); ?>" alt=""/>
                            <div class="b2b2c_box">
                                <span class="toe"><?php echo ($b2b2c_shop_info["shop_name"]); ?></span>
                                <span class="<?php echo ($b2b2c_shop_info["shop_grade_class_name"]); ?>"></span>
                            </div>
                        </div>
                        <div class="b2b2c_score fr">
                            <span>评分:</span>
                            <span><?php echo ($b2b2c_shop_info["shop_score"]); ?></span>
                        </div>
                    </div>
                    <div class="b2b2c_b clearfix">
                        <div class="fl b2b2c_telnum">
                            <span>联系电话:</span>
                            <span><?php echo ($b2b2c_shop_info["tel"]); ?></span>
                        </div>
                        <?php if(!empty($b2b2c_shop_info["phone"])): ?><div class="fr b2b2c_telnum">
                                <span>座机:</span>
                                <span><?php echo ($b2b2c_shop_info["phone"]); ?></span>
                            </div><?php endif; ?>
                    </div>
                </section>
                <section class="bgcf b2b2c_p16 b2b2c_public_info_score_inner">
                    <div class="b2b2c_info_pro clearfix" onclick="$('#b2b2c_goods_info_comment_div').click();">
                        <a href="javascript:void(0)" class="fl">宝贝评价</a>
                        <span class="fr"></span>
                    </div>
                    <!--评论内容循环的盒子start-->
                    <?php $index = 0;?>
                    <?php if(is_array($list)): foreach($list as $key=>$vo): $index++;?>
                        <?php if($index >= 3){break;}?>
                        <div class="b2b2c_info_score_box">
                            <div class="b2b2c_t clearfix">
                                <div class="b2b2c_l fl clearfix">
                                    <img class="fl"src="<?php echo ($vo["portrait"]["0"]); ?>" alt=""/>
                                    <span class="fl toe"><?php echo ($vo["nickname"]); ?></span>
                                </div>
                                <div class="b2b2c_r fr clearfix">
                                    <span class="fr"><?php echo ($vo["point"]); ?>分</span>
                                    <span class="<?php echo ($vo["star_class_name"]); ?> fr"></span>
                                    <span class="fr">评分:</span>
                                </div>
                            </div>
                            <div class="b2b2c_c"><?php echo ($vo["content"]); ?></div>
                            <div class="b2b2c_img_box clearfix">
                                <?php if(is_array($vo["images"])): foreach($vo["images"] as $key=>$ivo): ?><img src="<?php echo ($ivo); ?>" alt="" onclick="b2b2cf.goods_info_image_full(this)"><?php endforeach; endif; ?>
                            </div>
                            <div class="b2b2c_b"><?php echo ($vo["time_create_str"]); ?></div>
                            <!--有卖家回复的区域start-->
                            <?php if(is_array($vo["child"])): foreach($vo["child"] as $key=>$cvo): ?><div class="b2b2c_seller_reply">
                                    <i></i>
                                    <p>
                                        <span>掌柜回复:</span>
                                        <span><?php echo ($cvo["content"]); ?></span>
                                    </p>
                                    <p><?php echo ($cvo["time_create_str"]); ?></p>
                                </div><?php endforeach; endif; ?>
                            <!--有卖家回复的区域end-->
                        </div><?php endforeach; endif; ?>

                    <!--评论内容循环的盒子end-->
                </section>
            </main>
            <!--主内容区域end-->
        </div>
        <div id="b2b2c_goods_info_detail_div" style="display:none;">
            <!--主内容区域start-->
            <main class="b2b2c_spinfo_val">
                <section class="b2b2c_info_incont">
                    <?php if(!empty($b2b2c_goods_info['image_poster'])):?>
                    <?php foreach($b2b2c_goods_info['image_poster'] as $val):?>
                    <img src="<?php echo ($val); ?>" alt="">
                    <?php endforeach;?>
                    <?php endif;?>
                </section>
            </main>
            <!--主内容区域end-->
        </div>
        <div id="b2b2c_goods_info_comment_div" style="display:none;">
            <!--评价区域start-->
            <?php if(!empty($list)):?>
            <main class="b2b2c_spinfo_val">
                <section class="bgcf b2b2c_p16 b2b2c_public_info_score_inner b2b2c_info_score_index">
                    <!--评论内容循环的盒子一start-->
                    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="b2b2c_info_score_box">
                            <div class="b2b2c_t clearfix">
                                <div class="b2b2c_l fl clearfix">
                                    <img class="fl"src="<?php echo ($vo["portrait"]["0"]); ?>" alt=""/>
                                    <span class="fl toe"><?php echo ($vo["nickname"]); ?></span>
                                </div>
                                <div class="b2b2c_r fr clearfix">
                                    <span class="fr"><?php echo ($vo["point"]); ?>分</span>
                                    <span class="<?php echo ($vo["star_class_name"]); ?> fr"></span>
                                    <span class="fr">评分:</span>
                                </div>
                            </div>
                            <div class="b2b2c_c"><?php echo ($vo["content"]); ?></div>
                            <!--有晒图的区域start-->
                            <div class="b2b2c_img_box clearfix">
                                <?php if(is_array($vo["images"])): foreach($vo["images"] as $key=>$ivo): ?><img src="<?php echo ($ivo); ?>" alt="" onclick="b2b2cf.goods_info_image_full(this)"><?php endforeach; endif; ?>
                            </div>
                            <!--有晒图的区域end-->
                            <div class="b2b2c_b"><?php echo ($vo["time_create_str"]); ?></div>
                            <!--有卖家回复的区域start-->
                            <?php if(is_array($vo["child"])): foreach($vo["child"] as $key=>$cvo): ?><div class="b2b2c_seller_reply">
                                    <i></i>
                                    <p>
                                        <span>掌柜回复:</span>
                                        <span><?php echo ($cvo["content"]); ?></span>
                                    </p>
                                    <p><?php echo ($cvo["time_create_str"]); ?></p>
                                </div><?php endforeach; endif; ?>
                            <!--有卖家回复的区域end-->
                        </div>
                        <!--评论内容循环的盒子一end--><?php endforeach; endif; ?>
                </section>
            <!--评价区域end-->
            </main>
            <?php else:?>
            <img class="b2b2c_no_content" src="/client/Application/B2b2c/Public/images/backgrounds/no_c.jpg" alt="">
            <?php endif;?>
        </div>
    </div>

    <!--悬浮底部start-->
    <footer class="b2b2c_info_footer">
        <div class="b2b2c_info_footer_box">
            <input type="hidden" id="b2b2c_goods_info_product_id" value="<?php echo ($b2b2c_goods_product[0]['id']); ?>">
            <input type="hidden" id="b2b2c_goods_addafter_shownumber" name="" value="1"/>
            <ul>
                <li>
                    <a href="<?php echo U('User/get_cart_list');?>">
                        <span class="b2b2c_cart_icon">
                            <?php if(!empty(get_user_token())) { ?>
                            <i class="b2b2c_num_icon"><?php
 $result = curls(C('APIURL').'B2b2cPrivate/GetCartCount','get', array(), true); if($result['status']){ echo $result['data']; }else{ echo '0'; } ?></i>
                            <?php }else{ ?>
                            <?php } ?>
                        </span>
                        <p>购物车</p>
                    </a>
                </li>
                <li>
                    <input type="button" value="加入购物车" readonly="" unselectable="on" onclick="b2b2cc.refresh('Index/product', 'goods_id:<?php echo ($b2b2c_goods_info['id']); ?>,product_id:<?php echo ($b2b2c_goods_product[0]['id']); ?>,rfs:b2b2cf.goods_info_select_product_callback();', true);">
                </li>
                <li>
                    <input type="button" value="立即购买" onclick="b2b2cf.goods_info_buy()" readonly="" unselectable="on">
                </li>
            </ul>
        </div>
    </footer>
    <!--悬浮底部end-->
</div>
<div class="b2b2c_public_shade" style="display:none;"></div>
<script>
    var swiper = new Swiper('.swiper-container',{
        pagination: '.swiper-pagination'
    });
</script>
<script type="text/javascript" src="/client/Application/B2b2c/Public/plug/area/areas.js"></script>
<!--地区选择插件-->
<script type="text/javascript">
    $("#area").click(function (e) {
        b2b2cf.SelCity(this,e,function(area_id){
            //判断能否配送
            var product_id = $('#b2b2c_goods_info_product_id').val();
            var product_count = $('#b2b2c_goods_addafter_shownumber').val();

            var post_data = {};
            post_data.area_id = area_id;
            post_data.product_list = [];
            post_data.product_list.push({product_id: product_id, count: product_count});
            b2b2cc.curls('B2b2cPublic/CheckAreaIsDistribution',
                    post_data,
                    function(data) {
                        if (data.status) {
                            var free_post = data.data.free_post;
                            var sum_cost = data.data.sum_cost;
                            if (free_post == 0) {
                                //不能配送
                                $('#b2b2c_goods_info_distribute').text('不可配送');
                            } else {
                                //可以配送
                                var htmltext = '可配送';
                                b2b2cc.curls('B2b2cPublic/getCartAllCumCost', post_data, function(data) {
                                    if (data.status) {
                                        htmltext += ',运费' + data.data.sum_cost + '元';
                                        $('#b2b2c_goods_info_distribute').text(htmltext);
                                    }
                                }, 'get');
                            }
                        } else {
                            b2b2cc.popupdialog(data.info);
                        }
                    }, 'get');
        });
    });
</script>
</body>
</html>