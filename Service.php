<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 **服务管理接口
 */
 class Service extends Api
{
	protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];
	
	//服务创建
	public function service_add(){
		if($this->request->isPost()){
			$data = input('post.');
			$data['creat_time']=date('Y-m-d H:i:s',time());
			$res = db('service')->insert($data);
			if($res){
				$this->success('添加成功!');
			}else{
				$this->error('添加失败！');
			}
		}
	}
	
	//服务分配列表
	public function service_list(){
		$where['status']=array('ELT',2);
		if($this->request->isPost()){
			 $data = input('post.');
			 if(!empty($data['kehu']) && array_key_exists('kehu',$data)){
				$where['kehu']= $data['kehu'];
			}
			if(!empty($data['gaiyao']) && array_key_exists('gaiyao',$data)){
				$where['gaiyao'] = ['like', '%'.$data['gaiyao'].'%'];
			}
			if(!empty($data['fuwu_type'])){
				$where['fuwu_type'] = $data['fuwu_type'];
			}
			if(!empty($data['status'])){
				$where['status']= $data['status']; 
			}
			if(!empty($data['start_time']) && !empty($data['end_time'])){
				$where['creat_time'] = array('between',$data['start_time'].','.$data['end_time']);
			}
		}
		$data=db('service')->where($where)->order('id desc')->select();
		foreach($data as $k=>$v){
			$data[$k]['fenpei_data']=db('admin')->field('id,username')->order('id asc')->select();
			if($v['fuwu_type']==1){
				$data[$k]['fuwu_type']='咨询';
			}elseif($v['fuwu_type']==2){
				$data[$k]['fuwu_type']='建议';
			}elseif($v['fuwu_type']==3){
				$data[$k]['fuwu_type']='投诉';
			}
			$data[$k]['creat_time']=date('Y/m/d H:i',strtotime($v['creat_time']));
			$data[$k]['creat_name']=db('admin')->where('id',$v['creat_id'])->value('username');
			if($v['status']==1){
				$data[$k]['status']='新创建';
			}elseif($v['status']==2){
				$data[$k]['status']='已分配';
			}
			if($v['assigned_id']!=0){
				$data[$k]['fenpei_name']=db('admin')->where('id',$v['assigned_id'])->value('username');
			}
		}
		if($data){
			$this->success('请求成功！',$data);
		}else{
			$this->error('暂无数据！');
		}
	
	}
	//服务分配--执行
	public function service_assigned(){
		if($this->request->isPost()){
			$data=input('post.');
			$id=$data['id'];
			$arr=[
				'assigned_id'=>$data['assigned_id'],
				'assigned_time'=>time(),
				'status'=>2,
			];
			$res=db('service')->where('id',$id)->update($arr);
			if($res){
				$this->success('分配成功！',$res);
			}else{
				$this->error('分配失败！');
			}
		}
	}
	//服务编辑
	public function service_edit(){
		if($this->request->isPost()){
			$data=input('post.');
			if(!empty($data['pleased']) && !empty($data['handle_result'])){
				if($data['pleased']<3){
					$data['pleased']='';
					$data['handle_result']='';
					$data['handle_name']='';
					$data['handle_method']='';
					$data['handle_time']='';
					$data['status']=2;
				}else{
					$data['status']=4;
				}
			}
			$res = db('service')->where('id',$data['id'])->update($data);
			if($res){
				$this->success('更新成功！',$res);
			}else{
				$this->error('无数据更新！');
			}
		}else{
			$id=input('id');
			if(empty($id)){
				$this->error('无效的请求！');
			}
			$data=db('service')->where('id',$id)->find();
			if($data){
				if($data['fuwu_type']==1){
					$data['fuwu_type']='咨询';
				}elseif($data['fuwu_type']==2){
					$data['fuwu_type']='建议';
				}elseif($data['fuwu_type']==3){
					$data['fuwu_type']='投诉';
				}
				$data['creat_name']=db('admin')->where('id',$data['creat_id'])->value('username');
				if($data['assigned_id']){
					$data['assigned_name']=db('admin')->where('id',$data['assigned_id'])->value('username');
					$data['assigned_time']=date('Y-m-d H:i',$data['assigned_time']);
				}
				$this->success('请求成功',$data);
			}else{
				$this->error('请求失败');
			}
		}
	}
	//服务删除
	public function service_del(){
		if($this->request->isPost()){
			$id=input('post.id');
			$res=db('service')->where('id',$id)->delete();
			if($res){
				$this->success('删除成功！',$res);
			}else{
				$this->error('删除失败');
			}
		}
	}
	//服务处理
	public function service_handle(){
		$where['status']=array(array('egt',2),array('elt',3));
		if($this->request->isPost()){
			 $data = input('post.');
			 if(!empty($data['kehu']) && array_key_exists('kehu',$data)){
				$where['kehu']= $data['kehu'];
			}
			if(!empty($data['gaiyao']) && array_key_exists('gaiyao',$data)){
				$where['gaiyao'] = ['like', '%'.$data['gaiyao'].'%'];
			}
			if(!empty($data['fuwu_type'])){
				$where['fuwu_type'] = $data['fuwu_type'];
			}
			if(!empty($data['status'])){
				$where['status']= $data['status']; 
			}
			if(!empty($data['start_time']) && !empty($data['end_time'])){
				$where['creat_time'] = array('between',$data['start_time'].','.$data['end_time']);
			}
		}
		$data=db('service')->where($where)->order('id desc')->select();
		foreach($data as $k=>$v){
			$data[$k]['fenpei_data']=db('admin')->field('id,username')->order('id asc')->select();
			if($v['fuwu_type']==1){
				$data[$k]['fuwu_type']='咨询';
			}elseif($v['fuwu_type']==2){
				$data[$k]['fuwu_type']='建议';
			}elseif($v['fuwu_type']==3){
				$data[$k]['fuwu_type']='投诉';
			}
			$data[$k]['creat_time']=date('Y/m/d H:i',strtotime($v['creat_time']));
			$data[$k]['creat_name']=db('admin')->where('id',$v['creat_id'])->value('username');
			if($v['status']==2){
				$data[$k]['status']='未处理';
			}else{
				$data[$k]['status']='已处理';
			}
			if($v['assigned_id']!=0){
				$data[$k]['fenpei_name']=db('admin')->where('id',$v['assigned_id'])->value('username');
			}
		}
		if($data){
			$this->success('请求成功！',$data);
		}else{
			$this->error('暂无数据！');
		}
	}
	
	//服务反馈
	public function service_feedback(){
		$where['status']=array(array('egt',3),array('lt',4));
		if($this->request->isPost()){
			 $data = input('post.');
			 if(!empty($data['kehu']) && array_key_exists('kehu',$data)){
				$where['kehu']= $data['kehu'];
			}
			if(!empty($data['gaiyao']) && array_key_exists('gaiyao',$data)){
				$where['gaiyao'] = ['like', '%'.$data['gaiyao'].'%'];
			}
			if(!empty($data['fuwu_type'])){
				$where['fuwu_type'] = $data['fuwu_type'];
			}
			if(!empty($data['start_time']) && !empty($data['end_time'])){
				$where['creat_time'] = array('between',$data['start_time'].','.$data['end_time']);
			}
		}
		$data=db('service')->where($where)->order('id desc')->select();
		foreach($data as $k=>$v){
			$data[$k]['fenpei_data']=db('admin')->field('id,username')->order('id asc')->select();
			if($v['fuwu_type']==1){
				$data[$k]['fuwu_type']='咨询';
			}elseif($v['fuwu_type']==2){
				$data[$k]['fuwu_type']='建议';
			}elseif($v['fuwu_type']==3){
				$data[$k]['fuwu_type']='投诉';
			}
			$data[$k]['creat_time']=date('Y/m/d H:i',strtotime($v['creat_time']));
			$data[$k]['creat_name']=db('admin')->where('id',$v['creat_id'])->value('username');
			if($v['status']==3){
				$data[$k]['status']='未反馈';
			}
			if($v['assigned_id']!=0){
				$data[$k]['fenpei_name']=db('admin')->where('id',$v['assigned_id'])->value('username');
			}
		}
		if($data){
			$this->success('请求成功！',$data);
		}else{
			$this->error('暂无数据！');
		}
	}
	
	//服务归档
	public function service_file(){
		$where['status']=4;
		if($this->request->isPost()){
			 $data = input('post.');
			 if(!empty($data['kehu']) && array_key_exists('kehu',$data)){
				$where['kehu']= $data['kehu'];
			}
			if(!empty($data['gaiyao']) && array_key_exists('gaiyao',$data)){
				$where['gaiyao'] = ['like', '%'.$data['gaiyao'].'%'];
			}
			if(!empty($data['fuwu_type'])){
				$where['fuwu_type'] = $data['fuwu_type'];
			}
			if(!empty($data['start_time']) && !empty($data['end_time'])){
				$where['creat_time'] = array('between',$data['start_time'].','.$data['end_time']);
			}
		}
		$data=db('service')->where($where)->order('id desc')->select();
		foreach($data as $k=>$v){
			$data[$k]['fenpei_data']=db('admin')->field('id,username')->order('id asc')->select();
			if($v['fuwu_type']==1){
				$data[$k]['fuwu_type']='咨询';
			}elseif($v['fuwu_type']==2){
				$data[$k]['fuwu_type']='建议';
			}elseif($v['fuwu_type']==3){
				$data[$k]['fuwu_type']='投诉';
			}
			
			$data[$k]['creat_time']=date('Y/m/d H:i',strtotime($v['creat_time']));
			$data[$k]['creat_name']=db('admin')->where('id',$v['creat_id'])->value('username');
			$data[$k]['status']='已归档';
			$data[$k]['fenpei_name']=db('admin')->where('id',$v['assigned_id'])->value('username');
			
		}
		if($data){
			$this->success('请求成功！',$data);
		}else{
			$this->error('暂无数据！');
		}
	}
	
	
	
	
	
	
}