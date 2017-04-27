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
        $repair = M('Repair');

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $rows = $repair->where('status>=0')->order('add_time')->page($_GET['p'].',2')->select();
        int_to_string($rows,array('status'=>array(-1=>'删除',0=>'待接收处理',1=>'正在处理',2=>'已处理')));
        $this->assign('rows',$rows);
        // 赋值数据集
        $count    = $repair->count();
        // 查询满足要求的总记录数
        $Page  = new \Think\Page($count,2);
        // 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();
        // 分页显示输出
        $this->meta_title = '报修管理';
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板

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

                /*$char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                //打断随机字符串
                $char = str_shuffle($char);
                $data['sn']='IT'.rand(1000,9999).substr($char,0,3).date('Ym').substr($char,0,5);*/

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

            if(M('Repair')->where($map)->save(['status'=>-1])){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }

    }
}