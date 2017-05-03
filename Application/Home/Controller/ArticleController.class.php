<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

/**
 * 文档模型控制器
 * 文档模型列表和详情
 */
class ArticleController extends HomeController {

    //小区通知
	public function index(){

		//查询小区通知文章
		$rows = D('Document')->where('category_id=40')->page(I('p',1),C('LIST_ROWS'))->select();
		//循环遍历赋值
		foreach($rows as &$row){
			$row['path'] = get_cover($row['cover_id'],'path');
			$row['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
			$row['url'] = U('Article/content',['id'=>$row['id']]);
		}
		//判断是否为ajax请求
		if(IS_AJAX){
			if(empty($rows)){
				$this->error('没有数据');
			}else{
				$this->success($rows);
			}
		}
		//分配数据
		$this->assign('rows',$rows);
		//展示页面
		$this->display();
	}
	//小区通知内容
	public function content(){
		//给字段自增1
		D('Document')->where(['id'=>I('id')])->setInc('view',1);
		$row = D('Document')->find(I('id'));


		$result = D('Document_article')->find(I('id'));
		//根据查出的数据中的uid查出发布信息的用户
		$rs = D('Member')->find($row['uid']);
		//赋值
		$row['content'] = $result['content'];
		$row['name']=$rs['nickname'];
		//分配数据
		$this->assign('row',$row);
		//展示页面
		$this->display('content');
	}
	//小区活动
	public function actionIndex(){
		//查询小区通知文章
		$rows = D('Document')->where(['category_id'=>39,'status'=>2])->page(I('p',1),C('LIST_ROWS'))->select();
		//循环遍历赋值
		foreach($rows as &$row){
			$row['path'] = get_cover($row['cover_id'],'path');
			$row['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
			$row['url'] = U('Article/actionContent',['id'=>$row['id']]);
		}
		//判断是否为ajax请求
		if(IS_AJAX){
			if(empty($rows)){
				$this->error('没有数据');
			}else{
				$this->success($rows);
			}
		}
		//分配数据
		$this->assign('rows',$rows);
		//展示页面
		$this->display();
	}
	//小区活动内容
	public function actionContent(){
		//给字段自增1
		D('Document')->where(['id'=>I('id')])->setInc('view',1);
		$row = D('Document')->find(I('id'));
		$result = D('Document_article')->find(I('id'));
		//根据查出的数据中的uid查出发布信息的用户
		$rs = D('Member')->find($row['uid']);
		//赋值
		$row['content'] = $result['content'];
		$row['name']=$rs['nickname'];
		//分配数据
		$this->assign('row',$row);
		//展示页面
		$this->display('actionContent');
	}

	//商家活动列表
	public function businessList()
	{
		//查询小区通知文章
		$rows = D('Document')->where(['category_id'=>42,'status'=>2])->page(I('p',1),C('LIST_ROWS'))->select();
		//循环遍历赋值
		foreach($rows as &$row){
			$row['path'] = get_cover($row['cover_id'],'path');
			$row['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
			$row['url'] = U('Article/businessContent',['id'=>$row['id']]);
		}
		//判断是否为ajax请求
		if(IS_AJAX){
			if(empty($rows)){
				$this->error('没有数据');
			}else{
				$this->success($rows);
			}
		}
		//分配数据
		$this->assign('rows',$rows);
		//展示页面
		$this->display();
	}
	//商家活动内容
	public function businessContent()
	{
		//给字段自增1
		D('Document')->where(['id'=>I('id')])->setInc('view',1);
		$row = D('Document')->find(I('id'));
		$result = D('Document_article')->find(I('id'));
		//根据查出的数据中的uid查出发布信息的用户
		$rs = D('Member')->find($row['uid']);
		//赋值
		$row['content'] = $result['content'];
		$row['name']=$rs['nickname'];
		//分配数据
		$this->assign('row',$row);
		//展示页面
		$this->display('businessContent');
	}
	//关于我们
	public function aboutList()
	{
		//查询小区通知文章
		$rows = D('Document')->where(['category_id'=>43])->page(I('p',1),C('LIST_ROWS'))->select();
		//循环遍历赋值
		foreach($rows as &$row){
			$row['path'] = get_cover($row['cover_id'],'path');
			$row['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
			$row['url'] = U('Article/aboutContent',['id'=>$row['id']]);
		}
		//判断是否为ajax请求
		if(IS_AJAX){
			if(empty($rows)){
				$this->error('没有数据');
			}else{
				$this->success($rows);
			}
		}
		//分配数据
		$this->assign('rows',$rows);
		//展示页面
		$this->display();
	}
	//关于我们内容
	public function aboutContent()
	{
		//给字段自增1
		D('Document')->where(['id'=>I('id')])->setInc('view',1);
		$row = D('Document')->find(I('id'));
		$result = D('Document_article')->find(I('id'));
		//根据查出的数据中的uid查出发布信息的用户
		$rs = D('Member')->find($row['uid']);
		//赋值
		$row['content'] = $result['content'];
		$row['name']=$rs['nickname'];
		//分配数据
		$this->assign('row',$row);
		//展示页面
		$this->display('aboutContent');
	}
	//生活贴士列表
	public function articleList(){
		//查询小区通知文章
		$rows = D('Document')->where('category_id>39')->page(I('p',1),5)->select();
		//循环遍历赋值
		foreach($rows as &$row){
			$row['path'] = get_cover($row['cover_id'],'path');
			$row['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
			$row['url'] = U('Article/articleContent',['id'=>$row['id']]);
		}
		//判断是否为ajax请求
		if(IS_AJAX){
			if(empty($rows)){
				$this->error('没有数据');
			}else{
				$this->success($rows);
			}
		}
		//分配数据
		$this->assign('rows',$rows);
		//展示页面
		$this->display();
	}
	//生活贴士内容
	public function articleContent()
	{
		//给字段自增1
		D('Document')->where(['id'=>I('id')])->setInc('view',1);
		$row = D('Document')->find(I('id'));
		$result = D('Document_article')->find(I('id'));
		//根据查出的数据中的uid查出发布信息的用户
		$rs = D('Member')->find($row['uid']);
		//赋值
		$row['content'] = $result['content'];
		$row['name']=$rs['nickname'];
		//分配数据
		$this->assign('row',$row);
		//展示页面
		$this->display('articleContent');
	}
	//租列表
	public function zushouList(){
		//查出租房信息
		$rows = D('Document')->where(['category_id'=>44,'level'=>1])->select();

		//循环遍历赋值
		foreach($rows as &$row){
			$row['path'] = get_cover($row['cover_id'],'path');
			$row['create_time'] = date('Y-m-d H:i:s',$row['create_time']);
			$row['url'] = U('Article/zushouContent',['id'=>$row['id']]);
		}

		//查出售房信息
		$rs = D('Document')->where(['category_id'=>44,'level'=>2])->select();
		//循环遍历赋值
		foreach($rs as &$r){
			$r['path'] = get_cover($r['cover_id'],'path');
			$r['create_time'] = date('Y-m-d H:i:s',$r['create_time']);
			$r['url'] = U('Article/zushouContent',['id'=>$r['id']]);
		}
		$this->assign('rows',$rows);
		$this->assign('rs',$rs);
		$this->display();
	}
	//租售详情
	public function zushouContent(){
		$row = D('Document')->find(I('id'));
		$result = D('Document_article')->find(I('id'));
		//根据查出的数据中的uid查出发布信息的用户
		$rs = D('Member')->find($row['uid']);
		//赋值
		$row['content'] = $result['content'];
		$row['name']=$rs['nickname'];
		//分配数据
		$this->assign('row',$row);
		//展示页面
		$this->display('articleContent');
	}
}
