<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/2 0002
 * Time: 下午 6:11
 */

namespace Admin\Controller;


use Think\Page;

class ApproveController extends AdminController
{
    public function index(){
        $rows = D('Approve')->where(['status>0'])->page($_GET['p'],C('LIST_ROWS'))->select();
        int_to_string($rows,['status'=>['0'=>'删除','1'=>'待审核',2=>'已审核']]);
        int_to_string($rows,['relation'=>['0'=>'删除','1'=>'本人','2'=>'亲属','3'=>'租户']]);
        //int_to_string($rows,array('status'=>array(-1=>'删除',0=>'待审核',1=>'已审核')));
        foreach($rows as &$row){
            //根据member_id查出数据
            $rs = D('Member')->where(['uid'=>$row['member_id']])->find();
            $row['nickname'] = $rs['nickname'];
        }
        $count = D('Document')->where(['status>-1','category_id'=>39])->count();
        //实例分页,传入参数
        $page = new Page($count,C('LIST_ROWS'));
        $show = $page->show();
        // 分页显示输出
        $this->assign('page',$show);
        $this->assign('rows',$rows);
        $this->meta_title = '业主认证';
        $this->display();
    }
    //修改(审核)
    public function edit()
    {
        //获取id
        $id = I('id');
        //判断状态
        if(I('status')==2){
            if(D('Approve')->where(['id'=>$id])->save(['status'=>1])){
                $this->success('取消成功');
            }else{
                $this->error('取消失败');
            }

        }else{
            //修改状态(审核)
            if(D('Approve')->where(['id'=>$id])->save(['status'=>2])){
                $this->success('审核成功');
            }else{
                $this->error('审核失败');
            }
        }


    }
    //逻辑删除
    Public function del()
    {
        if (D('Approve')->where(['id' => I('id')])->save(['status' => 0])) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}