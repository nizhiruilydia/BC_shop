/**
 * 商城页面使用脚本初始化监听区
 * ============================================================================
 * 版权所有 (C) 
 * 网站地址:
 * ============================================================================
 * $Version: v1.0.0 Beta $
 * $Author: liwenxuan <liwenxuan@pokpets.com> $
 * $constraint 变量前缀、方法前缀与文件名相同
 * $Date: 2016/7/15 $
 * $Id: b2b2cj.js 2016/7/11  $
 **/
var b2b2cj = {
    constructs: function() {
		
        var _this = this;
        
        //文件上传初始化
        $('.fileupload').fileupload();        
    },
}

/* 初始化调用区 */
$(function() {
    b2b2cj.constructs();
});

