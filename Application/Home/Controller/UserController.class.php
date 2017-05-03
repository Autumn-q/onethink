<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use EasyWeChat\Foundation\Application;
use User\Api\UserApi;
require 'vendor/autoload.php';

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends HomeController {


	/* 用户中心首页 */
	public function index(){
		if(is_login()){
			//查出数据
			$user = session('user_auth');
			$row = D('Member')->where(['uid'=>$user['uid']])->find();
			$this->assign('row',$row);
			$this->display();
		}else{
			session('call_back','User/index');
			$this->redirect('User/login');
		}

	}
	//签到
	public function sign($uid=1){

		//拼接名字
		$key = ACTION_NAME.MODULE_NAME.CONTROLLER_NAME.$uid;
		//配置参数
		S(array(
				'type'=>'memcache',
				'host'=>'127.0.0.1',
				'port'=>'11211',
				'prefix'=>'think',
				'expire'=>3600*24)
		);
		//查看当前是否有这个缓存
		$sign = S($key);
		if(!$sign){
			//生成随机积分
			$rand = rand(10,20);

			D('Member')->where(['uid'=>$uid])->setInc('score',$rand);
			$row = D('Member')->where(['uid'=>$uid])->select();
			S($key,$row);
			$this->success('签到成功');
		}else{
			$this->error('今天已经签到过了');
		}

	}

	/* 注册页面 */
	public function register($username = '', $password = '', $repassword = '', $email = '', $verify = ''){
        if(!C('USER_ALLOW_REGISTER')){
            $this->error('注册已关闭');
        }
		if(IS_POST){ //注册用户
			/* 检测验证码 */
			if(!check_verify($verify)){
				$this->error('验证码输入错误！');
			}

			/* 检测密码 */
			if($password != $repassword){
				$this->error('密码和重复密码不一致！');
			}			

			/* 调用注册接口注册用户 */
            $User = new UserApi;
			$uid = $User->register($username, $password, $email);
			if(0 < $uid){ //注册成功
				//TODO: 发送验证邮件
				$this->success('注册成功！',U('login'));
			} else { //注册失败，显示错误信息
				$this->error($this->showRegError($uid));
			}

		} else { //显示注册表单
			$this->display();
		}
	}

	/* 登录页面 */
	public function login($username = '', $password = '', $verify = ''){
		//如果有openid那就就去数据库查是否有该用户
		if(session('openId')){
			$Member = D('Member');
			$rows = D('Member')->where(['openId'=>session('openId')])->find();
			if( $rows!= null){
				$Member->login($rows['uid']);
				$this->redirect(session('call_back'));
			//如果没有数据
			}else{
				//判断是否有数据
				if(IS_POST){ //登录验证
					/* 检测验证码 */
					if(!check_verify($verify)){
						$this->error('验证码输入错误！');
					}

					/* 调用UC登录接口登录 */
					$user = new UserApi;
					$uid = $user->login($username, $password);
					if(0 < $uid){ //UC登录成功
						/* 登录用户 */

						//登录成功后将openId保存到数据库
						$Member->where(['uid'=>$uid])->setField('openId',session('openId'));

						if($Member->login($uid)){ //登录用户
							//TODO:跳转到登录前页面
							//var_dump(session('call_back'));exit;
							if(session('call_back')){
								$this->success('登录成功',U(session('call_back')));
							}else{
								$this->success('登录成功！',U('Index/index'));
							}
						} else {
							$this->error($Member->getError());
						}

					} else { //登录失败
						switch($uid) {
							case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
							case -2: $error = '密码错误！'; break;
							default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
						}
						$this->error($error);
					}

				} else { //显示登录表单
					$this->display();
				}
			}

		//如果没有openid就授权
		}else{
			//设置回调界面
			session('back','User/login');
			$this->redirect('Wechat/server');
		}

	}

	/* 退出登录 */
	public function logout(){
		if(is_login()){
			D('Member')->logout();
			$this->success('退出成功！', U('User/login'));
		} else {
			$this->redirect('User/login');
		}
	}

	/* 验证码，用于登录和注册 */
	public function verify(){
		$verify = new \Think\Verify();
		$verify->entry(1);
	}

	/**
	 * 获取用户注册错误信息
	 * @param  integer $code 错误编码
	 * @return string        错误信息
	 */
	private function showRegError($code = 0){
		switch ($code) {
			case -1:  $error = '用户名长度必须在16个字符以内！'; break;
			case -2:  $error = '用户名被禁止注册！'; break;
			case -3:  $error = '用户名被占用！'; break;
			case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
			case -5:  $error = '邮箱格式不正确！'; break;
			case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
			case -7:  $error = '邮箱被禁止注册！'; break;
			case -8:  $error = '邮箱被占用！'; break;
			case -9:  $error = '手机格式不正确！'; break;
			case -10: $error = '手机被禁止注册！'; break;
			case -11: $error = '手机号被占用！'; break;
			default:  $error = '未知错误';
		}
		return $error;
	}


    /**
     * 修改密码提交
     * @author huajie <banhuajie@163.com>
     */
    public function profile(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
        if ( IS_POST ) {
            //获取参数
            $uid        =   is_login();
            $password   =   I('post.old');
            $repassword = I('post.repassword');
            $data['password'] = I('post.password');
            empty($password) && $this->error('请输入原密码');
            empty($data['password']) && $this->error('请输入新密码');
            empty($repassword) && $this->error('请输入确认密码');

            if($data['password'] !== $repassword){
                $this->error('您输入的新密码与确认密码不一致');
            }

            $Api = new UserApi();
            $res = $Api->updateInfo($uid, $password, $data);
            if($res['status']){
                $this->success('修改密码成功！');
            }else{
                $this->error($res['info']);
            }
        }else{
            $this->display();
        }
    }
	//我的报修单
	public function repair(){
		$name = I('name');
		//查出所有数据
		$rows = D('Repair')->where(['name'=>$name,'status>-1'])->select();

		int_to_string($rows,array('status'=>array(0=>'待接收处理',1=>'正在处理',2=>'已处理')));
		$this->assign('rows',$rows);
		$this->display();
	}
	//我参加的活动
	public function action(){
		//接收传值
		$uid = I('id');
		//根据用户id查出数据
		$rows = D('Areaaction')->where(['member_id'=>$uid,'status>0'])->select();
		int_to_string($rows,['status'=>['0'=>'删除','1'=>'待审核',2=>'已审核']]);
		//int_to_string($rows,array('status'=>array(-1=>'删除',0=>'待审核',1=>'已审核')));
		//循环赋值
		foreach($rows as &$row){
			$rs = D('Member')->where(['uid'=>$row['member_id']])->find();
			$r = D('Document')->where(['id'=>$row['action_id']])->find();
			//赋值
			$row['title'] = $r['title'];
			$row['name'] = $rs['nickname'];
		}
		// 分页显示输出
		$this->assign('rows',$rows);
		$this->display();
	}

}
