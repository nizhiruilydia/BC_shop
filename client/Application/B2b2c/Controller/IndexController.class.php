<?php
/**
 * 商城首页相关控制器
 * ============================================================================
 * 版权所有 (C) 
 * 网站地址:
 * ============================================================================
 * $Version: v1.0.0 Beta $
 * $Author: LWX <liwenxuan@pokpets.com> $
 * $Date: 2016/7/6 18:35 $
 * $Id: IndexController.class.php 18:35 2016/7/6 $
**/
namespace B2b2c\Controller;
use Think\Controller;
class IndexController extends PublicController {

    public function __construct() {
		parent::__construct();
    }

	/**
	 *+--------------------------------------------------------------------------------------------------------------------
	 * 商城首页
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @Author wangdi  Date:2016/8/5
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @access public
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @type GET
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @parame
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @return HTML
	 *+--------------------------------------------------------------------------------------------------------------------
	**/
	public function index() {


		$params = array();

		$data = curls(C('APIURL') . 'B2b2cPublic/Demo', 'get', $params, true);


		echo '<pre>';print_r($data);

		exit;





		//获取banner
		$params = array(
				'type'	=> 2,
			);
		$banner = curls(C('APIURL') . 'B2b2cPublic/IndexBanner', 'get', $params, true);
		$banner = $banner['data'];
		$banner[0]['active'] = 'swiper-slide-active';
		
		//获取商品分类
		$goods_type_list = curls(C('APIURL') . 'B2b2cPublic/GetGoodsTypeList', 'get', array() , true);
		$goods_type_list = $goods_type_list['data'];
		$goods_type_list[0]['active'] = 'active';

		//获取推荐商品
		$recommend_list = curls(C('APIURL').'B2b2cPublic/GetGoodsByRecommendMobile','get', array('goods_type_id'=>$goods_type_list[0]['id']) ,true);
		$recommend_list = $recommend_list['data'];

		//手机端只显示有推荐商品的分类
		foreach ($goods_type_list[0]['child'] as $key => $value) {
			$found = false;
			foreach ($recommend_list as $rec_key => $rec_value) {
				if($rec_value['id'] == $value['id']){
					$found = true;
					break;
				}
			}
			if(!$found){
				//该分类下没有推荐商品，不显示该分类
				unset($goods_type_list[0]['child'][$key]);
			}
		}

		// error_log(print_r($recommend_list,1));
		$this->assign('goods_type_list', $goods_type_list);
		$this->assign('recommend_list', $recommend_list);
		$this->assign('banner', $banner);
		$this->display();
    }

	/**
	 *+--------------------------------------------------------------------------------------------------------------------
	 * 登录页
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @Author zhangnan  Date:2016/12/8
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @access public
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @type GET
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @parame 
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @return HTML
	 *+--------------------------------------------------------------------------------------------------------------------
	**/
	public function login() {
		if(IS_POST) {
			
			$data = array();
			$data['telno'] = I('post.telno', '', 'trim');
			$data['password'] = I('post.password', '', 'trim');
			$data['login_type'] = "wc";
			$info = curls(C('APIURL').'User/Login', 'post', $data, true);
                        
			if($info['status']) {
				$user_token = $info['data']['user_token'];
				set_user_token($user_token);
				
				$user_info = array();
				$user_info_data = curls(C('APIURL').'User/GetUserInfo','get',array('user_token'=>$user_token),true);
				$user_info_data = $user_info_data['data'];
				
				$user_info['telno'] = $user_info_data['telno'];
				$user_info['nickname'] = $user_info_data['nickname'];
				$user_info['user_id'] = $user_info_data['user_id'];
				$user_info['user_type'] = $user_info_data['user_type'];
				set_user_info($user_info);
				
				$info['data'] = array();
				echo json_encode($info);	
			} else {
				echo json_encode($info);	
			}
		} else {
			$this->display();
		}
	}

	/**
	 *+--------------------------------------------------------------------------------------------------------------------
	 * 用户注册页
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @Author zhangnan  Date:2016/12/8
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @access public
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @type GET
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @parame 
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @return HTML
	 *+--------------------------------------------------------------------------------------------------------------------
	**/
	public function register() {
		$this->display();
	}    

	/**
	 *+--------------------------------------------------------------------------------------------------------------------
	 * 用户退出操作
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @Author	zhangnan  Date:2016/12/8
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @access	public
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @type	GET
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @return JSON
	 *+--------------------------------------------------------------------------------------------------------------------
	**/
	public function logout() {
		curls(C('APIURL').'User/Logout', 'post', array('user_token'=>get_user_token()));
		unset_user_token();
		unset_user_info();
		unset_user_menu();
		$this->redirect('Index/index');
	}	

	/**
	 *+--------------------------------------------------------------------------------------------------------------------
	 * 密码找回
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @Author zhangnan  Date:2016/12/8
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @access public
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @type GET
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @parame 
	 *+--------------------------------------------------------------------------------------------------------------------
	 * @return HTML
	 *+--------------------------------------------------------------------------------------------------------------------
	**/
	public function forgetpasd() {
		$this->display();
	}	

	/**
	 * +--------------------------------------------------------------------------------------------------------------------
	 * 商品列表
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @Author zhangnan  Date:2016/12/9
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @access public
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @type GET
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 非必 $type 商品类型(不指定商品类型时，筛选条件不可用)
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame String 非必 $keyword 关键词
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 非必 $brand_id 筛选条件的品牌ID
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 非必 $is_import 筛选条件的产地
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 非必 $price_from 筛选条件的起始价格区间
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 非必 $price_to 筛选条件的结束价格区间
	 * +--------------------------------------------------------------------------------------------------------------------
     * @parame Int 非必 $sort 排序规则(1销量降序,2人气降序,3价格降序,4价格升序,5发布时间降序,6评论降序,默认综合排序)
     * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 非必 $last_goods_index 上一页最后一个商品在检索结果中的序号，不是商品ID
	 * +--------------------------------------------------------------------------------------------------------------------
     * @parame Int 非必 $page_goods 每页商品的数量，默认值8
     * +--------------------------------------------------------------------------------------------------------------------
	 * @return HTML
	 * +--------------------------------------------------------------------------------------------------------------------
	**/
	public function goods_list() {
		// error_log(print_r($_GET,1));
		$type = I('get.type', 0 , 'intval');
		$type_level_2 = I('get.type_level_2', 0 , 'intval');
		$type_level_3 = I('get.type_level_3', 0 , 'intval');
		$sort = I('get.sort', '', 'intval');

		//获取第一级商品分类
		$goods_type_level_1 = curls(C('APIURL') . 'B2b2cPublic/GetGoodsTypeChildren', 'get', array(), true);
		$goods_type_level_1 = $goods_type_level_1['data'];

        //获取二级页的筛选条件
        $_GET['terminal_type'] = 2;
		$filter = curls(C('APIURL') . 'B2b2cPublic/GetGoodsFilter', 'get', $_GET, true);
		$filter = $filter['data'];

		$this->assign('brand_filter', $filter['brand_filter']);
		$this->assign('import_filter', $filter['import_filter']);
		$this->assign('price_filter', $filter['price_filter']);

		$this->assign('type', $type);
		$this->assign('type_level_2', empty($type_level_2)?0:$type_level_2);
		$this->assign('type_level_3', empty($type_level_3)?0:$type_level_3);

		$this->assign('brand_id', $_GET['brand_id']);
		$this->assign('is_import', $_GET['is_import']);
		$this->assign('price_from', $_GET['price_from']);
		$this->assign('price_to', $_GET['price_to']);

		foreach ($goods_type_level_1 as $key => $value) {
			if($value['id'] == $type){
				$this->assign('type_image', $value['image'][0]);
				$this->assign('type_name', $value['name']);
				break;
			}
		}	

        //获取检索的商品列表
        $params = $_GET;
        $params['terminal_type'] = 2;

        if(!empty($type_level_3) && !empty($type_level_2)){
        	$params['type'] = $type_level_3;
        }else if(!empty($type_level_2)){
        	$params['type'] = $type_level_2;
        }

		$goods_list = curls(C('APIURL') . 'B2b2cPublic/GetGoodsBySearch', 'get',  $params, true);

		$this->assign('goods_type_level_1', $goods_type_level_1);
		$this->assign('goods_list',$goods_list['data']['list']);

		// error_log(print_r($goods_list,1));

		$this->assign('goods_keyword', $_GET['goods_keyword']);
		$this->assign('sort', $sort);
		$this->display();
	}
	
	/**
	 * +--------------------------------------------------------------------------------------------------------------------
	 * 商品详情页
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @Author zhangnan  Date:2016/12/25
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @access public
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @type GET
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 必填$goods_id 商品ID
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @return HTML
	 * +--------------------------------------------------------------------------------------------------------------------
	**/
	public function goodspointinfo() {

		$goods_id =I('get.goods_id',0,'intval');

		$b2b2c_goods_info = array();//商品详情
		$b2b2c_goods_info = curls(C('APIURL').'B2b2cPublic/GetGoodsInfo','get',array('goods_id'=>$goods_id) , true);
		if($b2b2c_goods_info['status']){
			$b2b2c_goods_info = $b2b2c_goods_info['data'];
		}else{
			$this->error($b2b2c_goods_info['info'], U('Index/index'), 3);
		}

		//获取面包屑导航的商品类型信息
		$goods_types = curls(C('APIURL').'B2b2cPublic/GetGoodsTypeNavi','get',array('goods_type_id'=>$b2b2c_goods_info['goods_type_id']) , true);
		$goods_types = $goods_types['data'];

		$b2b2c_goods_product = array();//商品规格
		if($b2b2c_goods_info) {
			$b2b2c_goods_product = curls(C('APIURL').'B2b2cPublic/GetGoodsProduct','get',array('goods_id'=>$goods_id) , true);
			$b2b2c_goods_product = $b2b2c_goods_product['data'];
		}
		if(!empty($b2b2c_goods_product[0])){
			$b2b2c_goods_product[0]['active'] = 'active';
		}

		$b2b2c_shop_info = array();//店铺信息
		if($b2b2c_goods_info) {
			$b2b2c_shop_product = curls(C('APIURL').'B2b2cPublic/GetShopInfo','get',array('shop_id'=>$b2b2c_goods_info['shop_id']) , true);
			$b2b2c_shop_info = $b2b2c_shop_product['data'];
		}
		$b2b2c_goods_point = array();//商品评分信息
		if($b2b2c_goods_info) {
			$b2b2c_goods_point = curls(C('APIURL').'B2b2cPublic/GetGoodsPointInfo','get',array('goods_id'=>$goods_id) , true);
			$b2b2c_goods_point = $b2b2c_goods_point['data'];
		}

		$comments = array();//商品评价列表
		if($b2b2c_goods_info) {
			$comments = curls(C('APIURL') . 'B2b2cPublic/GetGoodsComments', 'get', array('goods_id' => $goods_id), true);
		}

		//商品是否已收藏
		$is_favorite = curls(C('APIURL') . 'B2b2cPrivate/IsFavorite', 'get', array('goods_id' => $goods_id), true);
		if($is_favorite['status']){
			$is_favorite = $is_favorite['data']['count'];
		}else{
			$is_favorite = 0;
		}

		//商品人气加1
		curls(C('APIURL').'B2b2cPublic/AddGoodsPopularityCount','get',array('goods_id'=>$goods_id),true);

		// error_log('b2b2c_shop_info='.print_r($b2b2c_shop_info, 1));
		$this->assign('goods_types', $goods_types);
		$this->assign('goods_id', $goods_id);
		$this->assign('b2b2c_goods_info', $b2b2c_goods_info);
		$this->assign('b2b2c_goods_product', $b2b2c_goods_product);
		$this->assign('b2b2c_shop_info', $b2b2c_shop_info);
		$this->assign('b2b2c_goods_point', $b2b2c_goods_point);
		$this->assign('list', $comments['data']['list']);
		$this->assign('page', $comments['data']['page']);
		$this->assign('is_favorite', $is_favorite);

		$this->display();
	}
	
	/**
	 * +--------------------------------------------------------------------------------------------------------------------
	 * 商品规格详情页
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @Author liwenxuan Date:2016/12/29
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @access public
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @type GET
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 必填 $goods_id 商品ID
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame Int 非必 $product_id 商品规格ID
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @parame String 必填 $rfs 确定出发的js
	 * +--------------------------------------------------------------------------------------------------------------------
	 * @return HTML
	 * +--------------------------------------------------------------------------------------------------------------------
	**/
	public function product() {
		
		$goods_id = I('get.goods_id', 0, 'intval');
		$product_id = I('get.product_id', 0, 'intval');
		$rfs = I('get.rfs', '', 'trim');
			
		$b2b2c_goods_product = curls(C('APIURL').'B2b2cPublic/GetGoodsProduct','get',array('goods_id'=>$goods_id) , true);
		$b2b2c_goods_product = $b2b2c_goods_product['data'];
		
		$b2b2c_goods_product_one = $b2b2c_goods_product[0];
		if($product_id) {
			for($one=0; $one<count($b2b2c_goods_product); $one++) {
				if($product_id == $b2b2c_goods_product[$one]['id']) {
					$b2b2c_goods_product_one = $b2b2c_goods_product[$one];
					break;
				}
			}
		}
		
		$this->assign('b2b2c_goods_product', $b2b2c_goods_product);
		$this->assign('b2b2c_goods_product_one', $b2b2c_goods_product_one);
		$this->assign('goods_id', $goods_id);
		$this->assign('product_id', $product_id);
		$this->assign('rfs', $rfs);
		$this->display();
	}



	//测试
	public function test()
	{

	}

}