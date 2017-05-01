<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/28 0028
 * Time: 下午 2:14
 */

namespace Admin\Controller;
use Think\Page;
use Think\Think;


class AreaActionController extends AdminController
{
    public function index(){
        $rows = D('Document')->where(['status>0','category_id'=>39])->page($_GET['p'],C('LIST_ROWS'))->select();
        int_to_string($rows,['status'=>['0'=>'删除','1'=>'待审核',2=>'已审核']]);
        //int_to_string($rows,array('status'=>array(-1=>'删除',0=>'待审核',1=>'已审核')));
        $count = D('Document')->where(['status>-1','category_id'=>39])->count();
        //实例分页,传入参数
        $page = new Page($count,C('LIST_ROWS'));
        $show = $page->show();
        // 分页显示输出
        $this->assign('page',$show);
        $this->assign('rows',$rows);
        $this->meta_title = '小区活动管理';
        $this->display();
    }
    //修改(审核)
    public function edit()
    {
        //获取id
        $id = I('id');
        //判断状态
        if(I('status')==2){
            if(D('Document')->where(['id'=>$id])->save(['status'=>1])){
                $this->success('取消成功');
            }else{
                $this->error('取消失败');
            }

        }else{
            //修改状态(审核)
            if(D('Document')->where(['id'=>$id])->save(['status'=>2])){
                $this->success('审核成功');
            }else{
                $this->error('审核失败');
            }
        }


    }
    //逻辑删除
    Public function del()
    {
        if (D('Document')->where(['id' => I('id')])->save(['status' => 0])) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
    public function row(){
        $rows = D('Areaaction')->where(['status>0'])->page($_GET['p'],C('LIST_ROWS'))->select();
        int_to_string($rows,['status'=>['0'=>'删除','1'=>'待审核',2=>'已审核']]);
        //int_to_string($rows,array('status'=>array(-1=>'删除',0=>'待审核',1=>'已审核')));
        foreach($rows as &$row){
            $rs = D('Member')->where(['uid'=>$row['member_id']])->find();
            $r = D('Document')->where(['id'=>$row['action_id']])->find();
            //赋值
            $row['title'] = $r['title'];
            $row['name'] = $rs['nickname'];
        }
        $count = D('Areaaction')->where(['status>-1'])->count();
        //实例分页,传入参数
        $page = new Page($count,C('LIST_ROWS'));
        $show = $page->show();
        // 分页显示输出
        $this->assign('page',$show);
        $this->assign('rows',$rows);
        $this->meta_title = '小区活动管理';
        $this->display();
    }
    //修改(审核)
    public function save()
    {
        //获取id
        $id = I('id');
        //判断状态
        if(I('status')==2){
            if(D('Areaaction')->where(['id'=>$id])->save(['status'=>1])){
                $this->success('取消成功');
            }else{
                $this->error('取消失败');
            }

        }else{
            //修改状态(审核)
            if(D('Areaaction')->where(['id'=>$id])->save(['status'=>2])){
                $this->success('审核成功');
            }else{
                $this->error('审核失败');
            }
        }


    }
    //删除
    Public function delete()
    {
        if (D('Areaaction')->where(['id' => I('id')])->delete()) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}