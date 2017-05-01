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
        //获取session中的用户数据
        $user_auth = session('user_auth');
        $name = $user_auth['username'];
        //使用用户名去查报修单
        $rows = M('Repair')->where(["status>=0","name"=>$name])->select();
        int_to_string($rows,array('status'=>array(-1=>'删除',0=>'待接收处理',1=>'正在处理',2=>'已处理')));
        //分配数据
        $this->assign('rows',$rows);
        $this->display();
    }
    //新增保修单
    public function add()
    {

        if(is_login()){
            //判断提交方式
            if(IS_POST){
                //实例对象
                $repair = D('Admin/Repair');
                //dump($repair);exit;
                $data = $repair->create();

                if($data){
                    //保存
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
            //接收数据并验证
            $data = $repair->create();
            if($data){
                //保存
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
        //获取要逻辑删除的id
        $id = I('id');
        $model = M('Repair');
        $repair = $model->find($id);
        //状态该为-1
        $repair['status'] = -1;
        //保存并判断是否删除成功
        if($model->save($repair)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}