<?php
/**
 * 商城私有控制器，需要用户登录的时候继承，例如用户中心。
 * ============================================================================
 * 版权所有 (C) 
 * 网站地址:
 * ============================================================================
 * $Version: v1.0.0 Beta $
 * $Author: LWX <liwenxuan@pokpets.com> $
 * $Date: 2016/7/6 18:35 $
 * $Id: PrivateController.class.php 18:35 2016/7/6 $
**/
namespace B2b2c\Controller;
use Think\Controller;
class PrivateController extends Controller {
	public function __construct() {
		parent::__construct();
		if(get_user_token()) {
			$this->assign('user_info', get_user_info());
		} else {
			unset_user_token();
			unset_user_info();
			unset_user_menu();			
			$this->redirect('B2b2c/Index/login');
		}
	}
}