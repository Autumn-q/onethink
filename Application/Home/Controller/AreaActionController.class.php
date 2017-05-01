<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/1 0001
 * Time: 下午 2:02
 */

namespace Home\Controller;


class AreaActionController extends HomeController
{
    public function index()
    {
        echo 1;
    }
    public function add()
    {
        //判断是否登录
        if(is_login()){
            $action_id = I('id');
            $users = session('user_auth');
            $member_id = $users['uid'];
            //实例对象
            $areaAction = D('Areaaction');
            if(empty($action_id)){
                $this->error('请选择活动再报名');
            }
            //这里需要先判断用户是否已经报名过了
            if(D('Areaaction')->where(['member_id'=>$member_id])->find()){
                $this->error('您已经报名了,请不要重复报名');
            }
            $data['create_time'] = time();
            $data['member_id'] = $member_id;
            $data['action_id'] = $action_id;
            $data['status'] = 1;
            //dump($data);exit;
            //判断验证是否通过
            $id = $areaAction->add($data);
            if($id){
                $this->success('报名成功,请等待审核');
            }else{
                $this->error('报名失败');
            }

        }else{
            /*session('call_back','AreaAction/add');
            $this->redirect('User/login');*/
            $this->error('还未登陆');
        }

    }
}