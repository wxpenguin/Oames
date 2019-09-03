<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 * 营销管理接口
 */
class Yingxiao extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

	//销售机会管理
    public function xiaoshou_index()
    {
		$where=[];
		if($this->request->isPost()){
			$data = input('post.');
			 if(!empty($data['kehu_name']) && array_key_exists('kehu_name',$data)){
				$where['b.username']= $data['kehu_name'];
			}
			if(!empty($data['gaiyao']) && array_key_exists('gaiyao',$data)){
				$where['a.abstract'] = ['like', '%'.$data['gaiyao'].'%'];
			}
			if(!empty($data['lianxi_name']) && array_key_exists('lianxi_name',$data)){
				$where['b.lianxi_name']= $data['lianxi_name'];
			}
			if(!empty($data['status'])){
				$where['a.status']= $data['status']-1;
			}
		}
		$data1 = db('salesieads as a')
		->field('a.*,b.usernum,b.username as kehu_name,b.lianxi_name,b.lianxi_tel,c.username as creat_name')
		->join('fa_linkman b','a.link_id=b.lid')
		->join('fa_user c','a.creat_id=c.id')
		->where($where)->order('a.sid desc')->select();
		foreach($data1 as $k=>$v){
			if($v['status']==0){
				$data1[$k]['status'] = '未指派';
			}else{
				$data1[$k]['status'] = '已指派';
			}
		}
		if(!empty($data1)){
			$this->success('请求成功！',$data1);
		}else{
			$this->error('暂无数据！');
		}
    }
	
	//销售机会添加
	public function xiaoshou_add(){
		if($this->request->isPost()){
			$data = input('post.');
			$res = db('linkman')->where('usernum',$data['usernum'])->find();
			if(!$res){
				$arr =[
					'usernum'=>$data['usernum'],
					'username'=>$data['kehu_name'],
					'lianxi_name'=>$data['lianxi_name'],
					'lianxi_tel'=>$data['lianxi_tel']
				];
				$row = db('linkman')->insert($arr);
				$lid = Db::name('linkman')->getLastInsID();
				$array = [
					'link_id'=>$lid,
					'jihui_from'=>$data['jihui_from'],
					'success_jilv'=>$data['success_jilv'],
					'abstract'=>$data['abstract'],
					'jihui_desc'=>$data['jihui_desc'],
					'creatTime'=>date('Y-m-d H:i:s',time()),
					'creat_id'=>'1',
					'zhipai_name'=>$data['zhipai_name'],
					'zhipai_time'=>$data['zhipai_time']
				];
				$ree = db('salesieads')->insert($array);
				$sid = Db::name('salesieads')->getLastInsID();
				if($data['zhipai_name'] && $data['zhipai_time']){
					db('salesieads')->where('sid',$sid)->setField('status',1);
				}
				if($row && $ree){
					$this->success('添加成功!');
				}else{
					$this->error('添加失败！');
				}
			}else{
				$this->error('该用户编号已存在');
			}
			
		}else{
			$where=[];
			$data = db('user')->where($where)->field('id,username')->select();
			$this->success('请求成功！',$data);
		}		
	}
	
	//销售机会编辑
	public function xiaoshou_edit(){
		if($this->request->isPost()){
			$data=input('post.');
			$sid=$data['sid'];
			$link_id=$data['link_id'];
			if((empty($data['zhipai_name']) && !empty($data['zhipai_time'])) || (!empty($data['zhipai_name']) && empty($data['zhipai_time']))){
				$this->error('请完整填写指派人和指派时间！');
			}else{
				 $kh_arr =[
					'username'=>$data['kehu_name'],
					'lianxi_name'=>$data['lianxi_name'],
					'lianxi_tel'=>$data['lianxi_tel']
				];
				$res = db('linkman')->where('lid',$link_id)->update($kh_arr);
				$ss_arr=[
					'jihui_from'=>$data['jihui_from'],
					'success_jilv'=>$data['success_jilv'],
					'abstract'=>$data['abstract'],
					'jihui_desc'=>$data['jihui_desc'],
					'zhipai_name'=>$data['zhipai_name'],
					'zhipai_time'=>$data['zhipai_time']
				];
				$ree = db('salesieads')->where('sid',$sid)->update($ss_arr);
				if($data['zhipai_name'] && $data['zhipai_time']){
					db('salesieads')->where('sid',$sid)->setField('status',1);
				}
				
				$this->success('提交成功!',$ree);
				
			}
		}else{
			$sid =input('sid');
			$where=['a.sid'=>$sid];
			$data = db('salesieads as a')
			->field('a.*,b.usernum,b.username as kehu_name,b.lianxi_name,b.lianxi_tel,c.username as creat_name')
			->join('fa_linkman b','a.link_id=b.lid')
			->join('fa_user c','a.creat_id=c.id')
			->where($where)
			->find();
			if($data){
				$data['zhipai'] = db('user')->field('id,username')->select();
				$this->success('请求成功！',$data);
			}else{
				$this->error('请求失败！');
			}
			
		}
	}
	
	//销售机会删除
	public function xiaoshou_del(){
		$id = input('post.id');
		$lid = input('post.lid');
		
		if($this->request->isPost()){
			$res = db('salesieads')->where('sid',$id)->delete();
			$res1 = db('linkman')->where('lid',$lid)->delete();
			if($res && $res1){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！');
			}
		}
	}
	
	

	//客户开发计划
	public function plan_index(){
		$where['a.status']=1;
		if($this->request->isPost()){
			$data = input('post.');
			 if(!empty($data['kehu_name']) && array_key_exists('kehu_name',$data)){
				$where['b.username']= $data['kehu_name'];
			}
			if(!empty($data['gaiyao']) && array_key_exists('gaiyao',$data)){
				$where['a.abstract'] = ['like', '%'.$data['gaiyao'].'%'];
			}
			if(!empty($data['lianxi_name']) && array_key_exists('lianxi_name',$data)){
				$where['b.lianxi_name']= $data['lianxi_name'];
			}
			if(!empty($data['kaifa_status'])){
				$where['a.kaifa_status']= $data['kaifa_status']-1;
			}
			
		}
		$data = db('salesieads as a')
		->field('a.sid,a.abstract,a.creatTime,a.kaifa_status,b.usernum,b.username as kehu_name,b.lianxi_name,b.lianxi_tel,c.username as zhipai_name')
		->join('fa_linkman b','a.link_id=b.lid')
		->join('fa_user c','a.zhipai_name=c.id')
		->where($where)->order('a.sid desc')->select();
		foreach($data as $k=>$v){
			$data[$k]['creatTime']=date('Y-m-d',strtotime($v['creatTime']));
			if($v['kaifa_status']==1){
				$data[$k]['kaifa_status'] = '开发成功';
			}elseif($v['kaifa_status']==2){
				$data[$k]['kaifa_status'] = '终止开发';
			}else{
				$data[$k]['kaifa_status']='发开中';
			}
		}
		if(!empty($data)){
			$this->success('请求成功！',$data);
		}else{
			$this->error('暂无数据！');
		}
	}
	
	//客户开发计划---制定
	public function plan_formulate(){
		if($this->request->isPost()){
			$data=input('post.');
			$res=db('plan')->insert($data);
			if($res){
				$datall = db('plan')->where('fid',$data['fid'])->order('id asc')->select();
				$this->success('添加成功',$datall);
			}else{
				$this->error('添加失败');
			}
		}else{
			$sid =input('id');
			$where=['a.sid'=>$sid];
			$data = db('salesieads as a')
			->field('a.*,b.usernum,b.username as kehu_name,b.lianxi_name,b.lianxi_tel,c.username as creat_name')
			->join('fa_linkman b','a.link_id=b.lid')
			->join('fa_user c','a.creat_id=c.id')
			->where($where)
			->find();
			if($data){
				$data['zhipai_name']=db('user')->where('id',$data['zhipai_name'])->value('username');
				$data['jihua_list'] = db('plan')->where('fid',$data['sid'])->order('id asc')->select();
				$this->success('请求成功！',$data);
			}else{
				$this->error('请求失败！');
			}
			
		}
	}
	
	//客户开发计划====制定更新
	public function plan_edit(){
		if($this->request->isPost()){
			$data=input('post.');
			$res=db('plan')->where('id',$data['id'])->setField('jihua',$data['jihua']);
			if($res){
				$datall = db('plan')->where('fid',$data['fid'])->order('id asc')->select();
				$this->success('修改成功',$datall);
			}else{
				$this->error('修改失败');
			}
		}
	}
	
	//客户开发计划---制定删除
	public function plan_del(){
		if($this->request->isPost()){
			$data=input('post.');
			$res=db('plan')->where('id',$data['id'])->delete();
			if($res){
				$datall = db('plan')->where('fid',$data['fid'])->order('id asc')->select();
				$this->success('删除成功',$datall);
			}else{
				$this->error('删除失败');
			}
		}
	}
	
	//客户开发计划---执行
	public function plan_execute(){
		if($this->request->isPost()){
			$data=input('post.');
			$res=db('plan')->where('id',$data['id'])->setField('xiaoguo',$data['xiaoguo']);
			if($res){
				$datall = db('plan')->where('fid',$data['fid'])->order('id asc')->select();
				$this->success('保存成功',$datall);
			}else{
				$this->error('保存失败');
			}
		}else{
			$sid =input('id');
			$where=['a.sid'=>$sid];
			$data = db('salesieads as a')
			->field('a.*,b.usernum,b.username as kehu_name,b.lianxi_name,b.lianxi_tel,c.username as creat_name')
			->join('fa_linkman b','a.link_id=b.lid')
			->join('fa_user c','a.creat_id=c.id')
			->where($where)
			->find();
			if($data){
				$data['zhipai_name']=db('user')->where('id',$data['zhipai_name'])->value('username');
				$data['jihua_list'] = db('plan')->where('fid',$data['sid'])->order('id asc')->select();
				$this->success('请求成功！',$data);
			}else{
				$this->error('请求失败！');
			}
			
		}
	}
	
	//客户开发计划--开发成功
	public function plan_success(){
		if($this->request->isGet()){
			$sid=input('sid');
			$res=db('salesieads')->where('sid',$sid)->setField('kaifa_status',1);
			if($res){
				$this->success('保存成功',1);
			}else{
				$this->error('保存失败');
			}
		}
	}
	
	//客户开发计划--终止开发
	public function plan_over(){
		if($this->request->isGet()){
			$sid=input('sid');
			$res=db('salesieads')->where('sid',$sid)->setField('kaifa_status',2);
			if($res){
				$this->success('保存成功',2);
			}else{
				$this->error('保存失败');
			}
		}
	}
	
	
	
	
	
	
	
}