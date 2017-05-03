<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/2 0002
 * Time: 下午 2:47
 */

namespace Home\Controller;
use EasyWeChat\Foundation\Application;

require './vendor/autoload.php';

class WechatController extends HomeController
{
    public function index(){

        //是对象并传入参数
        $app  = new Application(C('easyWechat'));
        //调用方法
        $response = $app->server->serve();
        //响应输出
        $response->send();

    }
   public function server()
   {

       //实例对象,并传入配置参数
       $app = new Application(C('easyWechat'));

       $response = $app->oauth->redirect();
       $response->send();
   }
    //授权回调方法
    public function callback()
    {

        //实例对象,并传入配置参数
        $app = new Application(C('easyWechat'));
        $user = $app->oauth->user();
        //将openId保存到session中
        session('openId',$user->getId());
        //返回上一页
        $this->redirect(session('back'));
    }
    //查询菜单
    public function getMenus()
    {
        //实例菜单对象
        $app = new Application(\Yii::$app->params['wechat']);
        //实例菜单对象模块
        $menu = $app->menu;
        //调用查看方法
        $menus = $menu->all();
        var_dump($menus);
    }

    //设置菜单
    public function setMenus()
    {
        //实例菜单对象
        $app = new Application(\Yii::$app->params['wechat']);
        //实例菜单对象模块
        $menu = $app->menu;
        //设置菜单
        $buttons = [
            [
                "type" => "click",
                "name" => "最新商品",
                "key" => "V1001_NEW_GOODS"
            ],
            [
                "type" => 'click',
                "name"=>"最热商品",
                "key"=>"V1001_HOT_GOODS"
            ],
            [
                "name" => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "我的信息",
                        "url" => Url::to(['wechat/user'], true),//这里需要绝对路径
                    ],
                    [
                        "type" => "view",
                        "name" => "我的订单",
                        "url" =>  Url::to(['wechat/order'], true),
                    ],
                    [
                        "type" => "view",
                        "name" => "绑定/解绑",
                        "url" =>  Url::to(['wechat/update'], true),
                    ],
                    /*[
                        "type" => "view",
                        "name" => "解除绑定",
                        "url" =>  Url::to(['wechat/unlink'], true),
                    ],*/
                ],
            ],
        ];
        //将菜单添加进去
        $r = $menu->add($buttons);
        var_dump($r);

    }
}