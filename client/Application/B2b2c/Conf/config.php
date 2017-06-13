<?php
return array(
	
	'TMPL_PARSE_STRING'  =>array(   //'配置项'=>'配置值'  
		'__PUBLICS__' => __ROOT__.'/Application/'.MODULE_NAME.'/Public',	//用于模块模板资源获取的扩展定义
		'__UPLOAD__' => '/Uploads/',										//文件存储路径
	),

	'LOAD_EXT_CONFIG'=>array(
		'menu_user', //用户中心菜单配置
	),

);
