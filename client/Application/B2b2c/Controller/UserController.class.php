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
class UserController extends PrivateController {
	
    public function __construct() {
        parent::__construct();
    }
	
    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 我的博宠
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author yangjing  Date:2016/8/16
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------
     * @parame  Int      必填      $user_id    用户id      
     * +-------------------------------------------------------------------------------------------------------------------- 
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function home() {
    	$user_token = get_user_token();
        $user_info = curls(C('APIURL') . 'B2b2cPrivate/GetUserInfo', 'get', array('user_token'=>get_user_token()), true); //获取个人信息列表
        $this->assign('user_info', $user_info['data']);
        $this->display();
    }    

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 个人资料
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author  zhangnan  Date:2016/12/9
     * +--------------------------------------------------------------------------------------------------------------------
     * @access  public
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function index() {
        //获取用户信息
        $user_info = curls(C('APIURL') . 'B2b2cPrivate/GetUserInfo', 'get', array('user_token' => get_user_token()), true);
        if (!$user_info['status']) {
            unset_user_token();
            unset_user_info();
            $this->error('登录失效，请重新登录', 'B2b2c/index/login');
        }
        $user_info = $user_info['data'];
        $this->assign('user_info', $user_info);
        $this->display();
    }    

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 个人资料--修改昵称
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author  zhangnan  Date:2016/12/9
     * +--------------------------------------------------------------------------------------------------------------------
     * @access  public
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function edit_nickname() {
        $user_info = I('get.', '', 'trim');
        if (!empty($user_info['nickname'])) {
            $user_info['user_token'] = get_user_token();
            $user_info = curls(C('APIURL') . 'MobileUser/EditUserInfo', 'post', $user_info, true);
            if ($user_info['status']) {
                $new_info = get_user_info();
                $new_info['nickname'] = $nickname;
                $new_info['user_id'] = $user_info['data']['user_id'];
                set_user_info($new_info);
                $this->redirect('User/index');
            } else {
                $this->error($user_info['info']);
            }
        } else {
            $this->display();
        }
    }    

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 个人资料--修改真实姓名
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author  zhangnan  Date:2016/12/9
     * +--------------------------------------------------------------------------------------------------------------------
     * @access  public
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function edit_realname() {
        $user_info = I('post.', '', 'trim');
        if (IS_POST) {
            if(!empty($user_info['realname'])){
                $user_info['user_token'] = get_user_token();
                $user_info = curls(C('APIURL') . 'MobileUser/EditUserInfo', 'post', $user_info, true);
                if ($user_info['status']) {
                    $new_info = get_user_info();
                    $new_info['user_id'] = $user_info['data']['user_id'];
                    set_user_info($new_info);
                    $this->redirect('User/index');
                } else {
                    $this->error($user_info['info']);
                }
            }
        } else {
            $this->display();
        }
    }    
	
    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 个人资料--修改性别
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author  zhangnan  Date:2016/12/9
     * +--------------------------------------------------------------------------------------------------------------------
     * @access  public
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function edit_gender() {
        if(IS_POST){
            $user_info = I('post.', '', 'trim');
            if (isset($user_info['gender'])) {
                $user_info['user_token'] = get_user_token();
                $user_info = curls(C('APIURL') . 'MobileUser/EditUserInfo', 'post', $user_info, true);
                if ($user_info['status']) {
                    $new_info = get_user_info();
                    $new_info['user_id'] = $user_info['data']['user_id'];
                    set_user_info($new_info);
                    echo json_encode($user_info);
                } else {
                    echo json_encode($user_info);
                }
            }
        }
    }    
	
    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 个人资料--修改头像
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author  zhangnan  Date:2016/12/9
     * +--------------------------------------------------------------------------------------------------------------------
     * @access  public
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function edit_portrait() {
        $img = I('post.image', '', 'trim');
        if (isset($_POST['image'])) {
            $data = upload_mobile_image($img, 'User', 'User', '1');
            $user_token = get_user_token();
            if ($data['status'] == true) {
                $data = (array) $data['data'];
                $user_head = curls(C('APIURL') . 'User/EditUserPortrait', 'get', array('portrait' => $data['key'], 'user_token' => $user_token));
                if ($user_head['status'] == true) {
                    $this->redirect('User/index');
                } else {
                    $this->error($user_head['info']);
                }
            } else {
                $this->error($data['info']);
            }
        } else {
            $this->display();
        }
    } 

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 收货地址管理
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author zhangnan  Date:2016/12/10
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function address() {
        $user_token = get_user_token();
        $user_address = curls(C('APIURL') . 'B2b2cPrivate/AddressBuyersList', 'get', array('user_token'=>get_user_token()), true);
        $this->assign('user_address', $user_address['data']);
        $this->display();
    }    

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 订单管理
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author zhangnan  Date:2016/12/22
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function order_manage() {
        $user_token = get_user_token();
        $list = curls(C('APIURL') . 'B2b2cPrivate/GetOrderList', 'get', array('user_token'=>get_user_token(), 'terminal_type'=>2), true);

        $this->assign('list', $list['data']['list']);
        $this->display();
    }    
	
    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 订单详情------评价(买家)
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author zhangnan  Date:2016/12/28
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------
     * @parame  Int      必填      $order_id    订单id
     * @parame  Int      必填      $product_id    规格id
     * @parame  Int      必填      $type        全部0，好评1，中评2，差评3，晒单4      
     * +-------------------------------------------------------------------------------------------------------------------- 
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function buyermakeorderrated() {
        $param['type'] = I('get.type', 0, 'intval');
        $param['order_id'] = I('get.order_id', 0, 'intval');
        $param['product_id'] = I('get.product_id', 0, 'intval');
        //订单详情
        $order_info = curls(C('APIURL') . 'B2b2cPrivate/GetOrderDetail', 'get', array('order_id' => $param['order_id']), true);
        if(empty($order_info['data'])){
            $this->error('查询不到相关信息');
        }
        if ($order_info['status'] && !empty($order_info['data'])) {
            $param['shop_id'] = $order_info['data']['shop_id'];
        }
        //商品规格信息
        $product_info = curls(C('APIURL') . 'B2b2cPublic/GetGoodsInfoByProductId', 'post', array('shop_id' => $param['shop_id'], 'product_id' => $param['product_id']), true);
        if (!$product_info['status'] || empty($product_info['data'])) {
            $this->error('查询不到相关信息');
        }
        //订单运费
        $order_free = curls(C('APIURL') . 'B2b2cPrivate/GetOrderShippingFee', 'get', array('shop_id' => $param['shop_id'], 'order_id' => $param['order_id']), true);
        //获取商品评分
        $good_score = curls(C('APIURL') . 'B2b2cPublic/GetGoodsPointInfo', 'get', array('goods_id' => $product_info['data']['goods_id']), TRUE);
        //是否已评论
        $mycomments = curls(C('APIURL') . 'B2b2cPrivate/CheckUserIsCommentOn', 'get', array('order_id' => $param['order_id'], 'product_id' => $param['product_id']), true);
        $param['goods_id'] = $product_info['data']['goods_id'];
        $user_info = curls(C('APIURL') . 'B2b2cPrivate/GetUserInfo', 'get', array(), true); //获取个人信息列表
        $is_buyer = ($order_info['data']['buyer_id'] == $user_info['data']['user_id']) ? 1 : 0;
        $this->assign('is_buyer', $is_buyer);
        $this->assign('order_shop_id', $param['shop_id']);
        $this->assign('type', $type);
        $this->assign('product_info', $product_info['data']);
        $this->assign('product_free', $order_free['data']);
        $this->assign('mycomments', $mycomments['data']);
        $this->assign('score', $good_score['data']);
        $this->assign('param', $param);
        $this->display();
    }

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 订单确认(商品详情页面过来的)
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author zhangnan  Date:2016/12/28
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------    
     * @parame  Int      非必      $product_id   规格id     
     * @parame  Int      非必      $product_num   购买数量     
     * @parame  Int      非必      logis_model_id   物流模板id     
     * +-------------------------------------------------------------------------------------------------------------------- 
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function order_confirm_goodsdetail() {
        $product_id = I('get.product_id', 0, 'intval');
        $logis_model_id = I('get.logis_model_id', '', 'trim');
        $product_count = I('get.product_count', 0, 'intval');
        if (empty($product_id)) {
            $this->error('没有找到');
        }
        if (empty($product_count)) {
            $this->error('请添加数量');
        }
        $goods_list = curls(C('APIURL') . 'B2b2cPrivate/GetGoodsByProductId', 'get', array('product_id' => $product_id), true);
        $shop_id = $goods_list['data']['shop_id'];
        $goods_list['data']['count'] = $product_count;

        $data = array();
        if (!empty($goods_list['data'])) {
            if ($goods_list['data']['product_store'] == 0) {
                $this->error('部分商品库存不足，请重新选择');
            }
        } else {
            $this->error('没有商品被选中,请重新选择');
        }
        //获取用户默认收费地址
        $user_area = curls(C('APIURL') . 'B2b2cPrivate/GetUserDefaultAddress', 'get', array('logis_model_id' => $logis_model_id), true);

        if (!empty($user_area['data'])) {
            $new_area = substr($user_area['data']['area'], 0, -2) . '00';
            $has_address = 1;
        }else{
            //用户没有默认收货地址
            $has_address = 0;
        }
        //
        $is_peisong = curls(C('APIURL') . 'B2b2cPublic/CheckAreaIsDistribution', 'get', array(
            'product_list' => array(array('product_id' => $product_id,),),
            'area_id' => $new_area,
                ), true);
        //检查运费
        $logis_info = curls(C('APIURL') . 'B2b2cPublic/getCartAllCumCost', 'get', array(
            'product_list' => array(
                array(
                    'product_id' => $product_id,
                    'count' => $product_count,
                ),
            ),
            'area_id' => $new_area,
                ), true);
        //判断店主所在店铺
        $is_invoices = curls(C('APIURL') . 'B2b2cPublic/CheckShopIssuingInvoice', 'get', array('shop_id' => $shop_id), TRUE);
        $goods_list['data']['logis_data'] = $logis_info['data'];
        $addres_list = curls(C('APIURL') . 'B2b2cPrivate/AddressBuyersList', 'get', array(), TRUE);
        $this->assign('product_count', $product_count);
        $this->assign('logis_model_id', $user_area['data']['id']);
        $this->assign('is_peisong', $is_peisong['data']);
        $this->assign('sum_cost',$logis_info['data']);
        
        $this->assign('add_list', $addres_list['data']);
        //默认地址
        foreach ($addres_list['data'] as $key => $value) {
            if($value['id'] == $user_area['data']['id']){
                $this->assign('selected_address', $value);
                break;
            }
        }

        $this->assign('info', $goods_list['data']);
        $this->assign('is_invoices', $is_invoices['data']);
        $this->assign('has_address', $has_address);
        $this->display();
    }

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 订单详情---订单确认(购物车过来的)
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author zhangnan  Date:2016/12/30
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------    
     * @parame  Int      非必      $product_id   规格id     
     * @parame  Int      非必      $product_num   购买数量     
     * @parame  Array   非必       b2b2c_cart_id     购物车ID
     * +-------------------------------------------------------------------------------------------------------------------- 
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function order_confirm() {
        $b2b2c_cart_id = I('get.b2b2c_cart_id', '', 'trim');
        $logis_model_id = I('get.logis_model_id', '', 'trim');
        $shop_id = b2b2c_user_selected_shop_id_get();
        if (empty($b2b2c_cart_id)) {
            $this->error('请选择商品');
        }
        $goods_list = curls(C('APIURL') . 'B2b2cPrivate/GetCartList', 'get', array('cart_id' => $b2b2c_cart_id), true);
        $data = array();
        $user_area = curls(C('APIURL') . 'B2b2cPrivate/GetUserDefaultAddress', 'get', array('logis_model_id' => $logis_model_id), true);
        if (!empty($user_area['data']['area'])) {
            $new_area = substr($user_area['data']['area'], 0, -2) . '00';
            $has_address = 1;
        }else{
            //用户没有默认收货地址
            $has_address = 0;
        }
        $logis_data = array();
        if (!empty($goods_list['data'])) {
            foreach ($goods_list['data'] as $val) {
                if ($val['product_store'] == 0) {
                    $this->error('部分商品库存不足，请重新选择');
                }
                $data[$val['shop_id']]['info'] = array(
                    'shop_id' => $val['shop_id'],
                    'shop_name' => $val['shop_name']
                );
                $data[$val['shop_id']]['list'][$val['goods_id']]['list'][] = $val;
            }
            //检查商品是否在配送区
            foreach ($data as $key => $val) {
                $invoice = curls(C('APIURL') . 'B2b2cPublic/CheckShopIssuingInvoice', 'get', array('shop_id' => $val['info']['shop_id']), TRUE);
                $data[$key]['info']['invoice'] = $invoice['data'];
                $all_product_list = array();
                foreach ($val['list'] as $goods_key => $goods_val) {
                    $count = 0;
                    $product_ids = '';
                    $product_list = array();
                    foreach ($goods_val['list'] as $prokey => $proval) {
                        $product_list[] = array('count' => $proval['count'], 'product_id' => $proval['product_id']);
                        $all_product_list[] = array('count' => $proval['count'], 'product_id' => $proval['product_id']);
                    }
                    $shipping = curls(C('APIURL') . 'B2b2cPublic/CheckAreaIsDistribution', 'get', array('product_list' => $product_list, 'area_id' => $new_area), true);
                    $data[$key]['list'][$goods_key]['logis_info'] = $shipping['data'];
                    //店铺发票信息
                    $data[$key]['info']['invoice_info'] = $invoice['data'];
                }
                //运费
                $all_logi_post = curls(C('APIURL') . 'B2b2cPublic/getCartAllCumCost', 'get', array('product_list' => $all_product_list, 'area_id' => $new_area), true);
                $data[$key]['info']['sum_cost'] = $all_logi_post['data']['sum_cost'];
            }
        } else {
            $this->error('没有商品被选中,请重新选择');
        }
        
        //判断店主所在店铺
        $addres_list = curls(C('APIURL') . 'B2b2cPrivate/AddressBuyersList', 'get', array(), TRUE);
        //默认地址
        foreach ($addres_list['data'] as $key => $value) {
            if($value['id'] == $user_area['data']['id']){
                $this->assign('selected_address', $value);
                break;
            }
        }
        
        $this->assign('user_area_id', $user_area['data']['id']);
        $this->assign('b2b2c_cart_id', $b2b2c_cart_id);
        $this->assign('logis_model_id', $logis_model_id);
        $this->assign('add_list', $addres_list['data']);
        $this->assign('list', $data);
        $this->assign('new_pro', $new_pro);
        $this->assign('has_address', $has_address);
        $this->display();
    }

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 提交订单，生成订单并跳转到支付页面
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author zhangnan  Date:2016/7/11
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type POST
     * +--------------------------------------------------------------------------------------------------------------------
     * @parame Int 必填 $user_address_id 买家收货地址ID
     * @parame Int 必填 b2b2c_cart_id 购物车id
     * +--------------------------------------------------------------------------------------------------------------------
     * @parame Array 必填 $shop_list 店铺维度的货品列表，格式为
     *                                'shop_list' => {
     *                                   $shop_id_1 => {
     *                                      'goods_list' => {
     *                                         $goods_id_1 => {
     *                                            $product_id_1 => $count_1,
     *                                            $product_id_2 => $count_2,
     *                                            ...
     *                                         },
     *                                         ...
     *                                      'invoice' => {
     *                                         'type' => $type,
     *                                         'no' => $no,
     *                                         'company' => $company,
     *                                         }
     *                                      }
     *                                   },
     *                                   ...
     *                                }
     * +--------------------------------------------------------------------------------------------------------------------
     * @return JSON
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function submit_order() {
        // error_log('POST='.print_r($_POST, 1));
        $b2b2c_cart_id = I('post.objids', '', 'trim');
        $user_address_id = I('post.user_address_id', '', 'intval');
        $post_invoice_info = I('post.invoice_info', '', 'trim');
        if (empty($user_address_id)) {
            $this->ajaxReturn(array('info' => '请选择收货地址', 'data' => array(), 'status' => 0));
        }
        if (isset($b2b2c_cart_id['cart_id'])) {
            if (empty($b2b2c_cart_id['cart_id'])) {
                $this->ajaxReturn(array('info' => '购物车内没有商品被选中', 'data' => array(), 'status' => 0));
            } else {
                $goods_list = curls(C('APIURL') . 'B2b2cPrivate/GetCartList', 'get', array('cart_id' => $b2b2c_cart_id['cart_id']), true);
            }
        } elseif (isset($b2b2c_cart_id['product_id'])) {
            if (empty($b2b2c_cart_id['product_id'])) {
                $this->ajaxReturn(array('info' => '没有商品被选中', 'data' => array(), 'status' => 0));
            } else {
                $goods_info = curls(C('APIURL') . 'B2b2cPrivate/GetGoodsByProductId', 'get', array('product_id' => $b2b2c_cart_id['product_id']), true);
                if (!empty($goods_info['data'])) {
                    if ($goods_info['data']['product_store'] == 0 || $b2b2c_cart_id['product_count'] > $goods_info['data']['product_store']) {
                        $this->ajaxReturn(array('info' => '商品库存不足', 'data' => array(), 'status' => 0));
                    }
                    $goods_info['data']['count'] = $b2b2c_cart_id['product_count'];
                }
                $goods_list['data'][] = $goods_info['data'];
            }
        }
        if (empty($goods_list['data'])) {
            $this->ajaxReturn(array('info' => '购物车内没有商品被选中', 'data' => array(), 'status' => 0));
        }

        $shop_list = array();
        $cart_product_id = array();
        foreach ($goods_list['data'] as $val) {
            $cart_product_id[] = $val['product_id'];
            $shop_list[$val['shop_id']]['shop_id'] = $val['shop_id'];
            //当前店铺是否可开发票
            $shop_invoice = curls(C('APIURL') . 'B2b2cPublic/CheckShopIssuingInvoice', 'get', array('shop_id' => $val['shop_id']), TRUE);
            $invoice_info = array(
                'type' => 0,
                'company' => '',
            );
            if ($shop_invoice['status'] && $shop_invoice['code'] == 0) {
                if ($shop_invoice['data'] == 1) {
                    $invoice_info['type'] = $post_invoice_info['type'];
                    $invoice_info['company'] = $post_invoice_info['company'];
                }
            }
            $shop_list[$val['shop_id']]['invoice_info'] = $invoice_info;
            $shop_list[$val['shop_id']]['product_list'][] = array(
                'goods_id' => $val['goods_id'],
                'product_id' => $val['product_id'],
                'count' => $val['count'],
            );
        }
        $params = array(
            'user_address_id' => $user_address_id,
            'shop_list' => $shop_list,
            'invoice' => '',
        );
        $result = curls(C('APIURL') . 'B2b2cPrivate/AddNewOrder', 'post', $params, true);
        //删除购物车内商品
        if ($result['status'] && !empty($cart_product_id)) {
            $rs = curls(C('APIURL') . 'B2b2cPrivate/CartProductDelete', 'get', array('product_array' => $cart_product_id), true);
        }
        $this->ajaxReturn($result);
    }

    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 我的收藏
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author  yangjing  Date:2016/12/10
     * +--------------------------------------------------------------------------------------------------------------------
     * @access  public
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function collect() {
        $user_token = get_user_token();
        $list = curls(C('APIURL') . 'B2b2cPrivate/GetFavoriteList', 'get',array('user_token'=>get_user_token()),true);
        $this->assign('list', $list['data']['list']);
        $this->display();
    }
	
    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 获取购物车货品列表
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author liwenxuan  Date:2016/12/23
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function get_cart_list() {
        $list = curls(C('APIURL') . 'B2b2cPrivate/GetCartList', 'get', array('type' => 'shop'), true);
        $count = curls(C('APIURL') . 'B2b2cPrivate/GetCartCount', 'get', array(), true);
		
        $this->assign('list', $list['data']);
        $this->assign('count', $count['data']);
        $this->display();
    }
	
	/**
     * +--------------------------------------------------------------------------------------------------------------------
     * 获取购物车货品编辑列表
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author liwenxuan  Date:2016/12/25
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function get_cart_list_edit() {
        $list = curls(C('APIURL') . 'B2b2cPrivate/GetCartList', 'get', array('type' => 'shop'), true);
        $count = curls(C('APIURL') . 'B2b2cPrivate/GetCartCount', 'get', array(), true);
		
        $this->assign('list', $list['data']);
        $this->assign('count', $count['data']);
        $this->display();
    }
	


    /**
     * +--------------------------------------------------------------------------------------------------------------------
     * 订单详情
     * +--------------------------------------------------------------------------------------------------------------------
     * @Author yangjing  Date:2016/12/25
     * +--------------------------------------------------------------------------------------------------------------------
     * @access public
     * +--------------------------------------------------------------------------------------------------------------------
     * @type GET
     * +--------------------------------------------------------------------------------------------------------------------
     * @parame  Int      必填      $order_id      
     * +--------------------------------------------------------------------------------------------------------------------      
     * @return HTML
     * +--------------------------------------------------------------------------------------------------------------------
    **/
    public function orderdetailbuyers() {
        $order_id = I('get.order_id', 0, 'intval');
        if (empty($order_id)) {
            $this->error('查询不到订单信息');
        }
        $info = curls(C('APIURL') . 'B2b2cPrivate/GetOrderDetail', 'get', array('order_id' => $order_id), TRUE);
        if (empty($info['data'])) {
            $this->error('查询不到订单信息');
        }
        $this->assign('data', $info['data']);
        $this->display();
    }
}