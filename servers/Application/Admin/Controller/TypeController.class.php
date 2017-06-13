<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/6/12
 * Time: 20:04
 */

namespace Admin\Controller;
use Think\Controller;

class TypeController extends PrivateController
{
    /**
     * 分类管理，type_add添加的展示，type_add_post添加，type_edit编辑展示，type_edit_do编辑，type_delete删除，type_list展示
     */
    /**
     * 添加分类的展示
     */
    public function type_add()
    {
        $res=M('goods_type');
        $re=$res->field(array('*','CONCAT(type_path,\'-\',goods_type_id)'=>'path_c'))->order("path_c")->select();
        $this->assign('type_list',$re);
        $this->display();
    }
    /**
     * 添加分类
     */
    public function type_add_post()
    {
        $type_name=I('post.type_name');
        $type_pid=I('post.type_pid');
        $type_sort=I('post.type_sort');
        $is_nav=I('post.is_nav');
        $data=array('type_name'=>$type_name,'type_pid'=>$type_pid,'type_sort'=>$type_sort,'is_nav'=>$is_nav,'type_path'=>'');
        $res=M('goods_type');
        //判断添加的分类是否为顶级分类
        if($type_pid!=0)
        {
            $re=$res->where("goods_type_id='$type_pid'")->find();
            if($re['type_pid']!=0)
            {
               $type_path=$re['type_path'].'-'.$type_pid;
            }else{
                $type_path='0-'.$type_pid;
            }
        }else
        {
            $type_path='0';
        }
        $data['type_path']=$type_path;
        $re1=$res->add($data);
        if($re1)
        {
            $this->success('添加成功',U('Type/type_list'));
        }else
        {
            $this->error('添加失败',U('Type/type_add'));
        }
    }
    /**
     * 分类展示
     */
    public function type_list()
    {
        $model=M('goods_type');
        $data=$model->select();
        $this->assign('list',$data);
        $data=$model->select();
        // print_r($path);die;
        $this->display();
    }
    /**
     * 分类修改的展示
     */
    public function type_edit()
    {
        $goods_type_id=I('get.id');
        $res=M('goods_type');
        $data = $res->where("goods_type_id=".$goods_type_id)->find();
        $re=$res->field(array('*','CONCAT(type_path,\'-\',goods_type_id)'=>'path_c'))->order("path_c")->select();
        $this->assign('type_list',$re);
        // print_r($data);die;
        $this->assign("data",$data);
        $this->display("type_upload");

    }
    /**
     * 分类修改
     */
    public function type_edit_do()
    {
        $goods_type_id=I('get.id');
        $res=M('goods_type');
        $data=I("post.");
        $res = $res->where("goods_type_id='$goods_type_id'")->data($data)->save();
        if($res){
            $this->success('修改成功','type_list');
        }else{
            $this->error('修改失败','type_edit');
        }
    }
    /**
     * 删除分类
     */
    public function type_delete()
    {
        $res=M('goods_type');
        $id=I('get.id');
        $re=$res->where("type_pid='$id'")->select();
        $len=count($re);
        //判断该分类下是否有子分类
        if($len>0)
        {
            $this->error('删除失败，该分类下存在子分类',U('Type/type_list'));
        }else{
            $res1=M('goods');
            $re1=$res1->where("goods_type_id='$id'")->select();
            $len1=count($re1);
            //判断该分类下是否有商品
            if($len1>0)
            {
                $this->error('删除失败，该分类下存在商品',U('Type/type_list'));
            }else{
                $re2=$res->where("goods_type_id='$id'")->delete();
                if($re2)
                {
                    $this->success('删除成功',U('Type/type_list'));
                }else
                {
                    $this->success('删除失败',U('Type/type_list'));
                }
            }
        }
    }
}