<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26 0026
 * Time: 上午 11:56
 */

namespace Home\Controller;


class RepairController extends HomeController
{
    //报修列表
    public function index()
    {
        $user_auth = session('user_auth');
        $name = $user_auth['username'];
        $rows = M('Repair')->where(["status>=0","name"=>$name])->select();
        int_to_string($rows,array('status'=>array(-1=>'删除',0=>'待接收处理',1=>'正在处理',2=>'已处理')));
        $this->assign('rows',$rows);
        $this->display();
    }
    //新增保修单
    public function add()
    {
        if(session('user_auth')){
            //判断提交方式
            if(IS_POST){
                //实例对象
                $repair = D('Admin/Repair');
                //dump($repair);exit;
                $data = $repair->create();

                if($data){

                    /*$char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    //打断随机字符串
                    $char = str_shuffle($char);
                    $data['sn']='IT'.rand(1000,9999).substr($char,0,3).date('Ym').substr($char,0,5);*/

                    $id = $repair->add();
                    if($id){
                        $this->success('报修成功',U('index'));
                    }else{
                        $this->error('报修失败');
                    }
                }else{
                    $this->error($repair->getError());
                }
            }else{

                $this->display('edit');
            }
        }else{
            session('call_back','Repair/add');
            $this->redirect('User/login');
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
        /*$id = array_unique((array)I('id',0));
        if(empty($id)){
            $this->error('请选择要操作的数据');
        }
        $map = ['id'=>['in',$id]];
        //$map = array('id' => array('in', $id) );*/
        $id = I('id');
        $model = M('Repair');
        $repair = $model->find($id);
        $repair['status'] = -1;

        if($model->save($repair)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}