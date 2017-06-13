$(function () {
    //返回顶部
    var totop = $("#b2b2c_return_top");
    $(window).scroll(function(){
        if($(window).scrollTop() > 300){
            totop.fadeIn(200);
        }
        else{
            totop.fadeOut(200);
        }
    })
    totop.click(function(){
        $('body,html').animate({
            scrollTop:'0px'
        },200);
    });
    // 商品详情点击页面内查看评价跳转后的页面直接跳转到顶部
    $("#b2b2c_info_score_content").click(function(){
        var h = $(".b2b2c_public_header_two").height();
        $("html, body").scrollTop(h+"rem");
    })
    $('.ui-popup-backdrop').bind("touchmove",function(e){
        e.preventDefault();
    });
    // 订单提交页内容高度不够时底部始终显示在最底部
    var h_doc = $(document).height();
    var h_lay = $('.b2b2c_layout').height();
    var h_foo =$('.b2b2c_order_submit_footer').height();
    var h_footer = h_doc - h_foo;
    if(h_doc > h_lay){
        $('.b2b2c_order_submit_footer').offset({top: h_footer, left: 0});
    }

    //订单提交页点击开发票弹出软键盘后让底部去除固定定位
    var wHeight =$(window).height();   //获取初始可视窗口高度
    $(window).resize(function() {         //监测窗口大小的变化事件
        var hh = $(window).height();     //当前可视窗口高度
        var viewTop = $(window).scrollTop();   //可视窗口高度顶部距离网页顶部的距离
        if(wHeight < hh){
            //虚拟键盘弹出事件
            $(".b2b2c_order_submit_f").css({position:"static"});
        }
    });

})