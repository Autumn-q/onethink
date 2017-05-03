<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27 0027
 * Time: 下午 4:02
 */

namespace Home\Controller;


class ServerController extends HomeController
{
    public function index()
    {
        $this->display();
    }
    //业主认证
    public function approve(){
        if(is_login()){
            if(IS_POST){

                //实例对象
                $model = D('Approve');
                $data = I('post.');
                $data['member_id'] = session('user_auth')['uid'];
                $data = $model->create($data);

                if($data){
                    $id = $model->add();
                    if($id){
                        $this->success('保存成功,请等待审核',U('index'));
                    }else{
                        $this->error('保存失败',U('approve'));
                    }
                }else{
                    $this->error($model->getError());
                }
            }else{
                $this->display();
            }

        }else{
            //设置返回的页面
            session('call_back','Server/approve');
            //跳转到登录界面
            $this->redirect('User/login');
        }
    }

}