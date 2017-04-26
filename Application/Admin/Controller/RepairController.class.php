<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26 0026
 * Time: 上午 11:56
 */

namespace Admin\Controller;


class RepairController extends AdminController
{
    //报修列表
    public function index()
    {
        //查出输入
        $rows = M('Repair')->where('id>-1')->select();
        $this->meta_title = '报修管理';
        //分配到页面上
        $this->assign('rows',$rows);
        //展示页面
        $this->display();
    }
    //新增保修单
    public function add()
    {
        //判断提交方式
        if(IS_POST){
            //实例对象
            $repair = D('Repair');

            $data = $repair->create();

            if($data){

                $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                //打断随机字符串
                $char = str_shuffle($char);
                $data['sn']='IT'.rand(1000,9999).substr($char,0,3).date('Ym').substr($char,0,5);

                $id = $repair->add();
                if($id){
                    $this->success('添加成功',U('index'));
                }else{
                    $this->error('新增失败');
                }
            }else{
                $this->error($repair->getError());
            }
        }else{

            $this->mate_title = '新增保修单';
            $this->display('edit');
        }
    }
    public function edit($id = 0)
    {
        //判断提交方式
        if(IS_POST){
            //实例对象
            $repair = D('Repair');
            $data = $repair->create();
            if($data){
                $id = $repair->save();
                if($id){
                    $this->success('修改成功',U('index'));
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error($repair->getError());
            }
        }else{
            //查出数据
            $row = M('Repair')->find($id);
            $this->mate_title = '修改保修单';
            //分配数据
            $this->assign('row',$row);
            $this->display('edit');
        }
    }
    public function del(){
        $id = array_unique((array)I('id',0));
        if(empty($id)){
            $this->error('请选择要操作的数据');
        }
        $map = ['id'=>['in',$id]];
        //$map = array('id' => array('in', $id) );

        if(M('Repair')->where($map)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}