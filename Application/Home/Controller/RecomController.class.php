<?php
namespace Home\Controller;
use Think\Controller;
class RecomController extends Controller {
    public function rlist(){
    	//http://localhost/qiumiba/home/recom/recom
    	//http://localhost/qiumiba/index.php?m=home&c=recomc&a=recom_list
       $recom = M("recom");
       $recom_list = $recom->where("is_show=1")->order("recom_id desc")->select();
       $seo_title = '';
       $seo_keyword = '';
       $seo_desc = '';
       $this->assign('seo_title',$seo_title);
       $this->assign('seo_keyword',$seo_keyword);
       $this->assign('seo_desc',$seo_desc);
       $this->assign('recom_list',$recom_list);
       $this->display('recom_list');
    }

     public function rinfo(){
       $rid = intval($_GET['rid']);
       if($rid>0){
	       $recom = M("recom");
	       $recom_list = $recom->where("is_show=1 and recom_id=$rid")->find();
	       $seo_title = $recom_list['title'];
	       $seo_keyword = $recom_list['title'];
	       $seo_desc = $recom_list['title'];
	       $this->assign('seo_title',$seo_title);
	       $this->assign('seo_keyword',$seo_keyword);
	       $this->assign('seo_desc',$seo_desc);
	       $this->assign('recom_list',$recom_list);
	       $this->display('recom_info');
	   }

    }

     public function radd(){
     	$_POST['title'] = 'twerewrwe';
     	$_POST['content'] = '432weffafasdas';
     	$user_info['uid'] = 1;
     	$user_info['user_name'] = '532423';
       $title = htmlspecialchars($_POST['title']);
       $content = htmlspecialchars($_POST['content']);
       if($title&&$content&&$user_info['uid']>0){
       		$data['uid'] = $user_info['uid'];
       		$data['user_name'] = $user_info['user_name'];
       		$data['title'] = $title;
       		$data['content'] = $content;
       		$data['type'] = 'recom';
       		$data['is_recommend'] = 1;
       		$data['is_show'] = 1;
       		$data['on_time'] = time();
       		$recom = M('recom');
       		$result = $recom->data($data)->add();
       		if($result){
       			//$this->success('插入成功');
       		}
       		else{
       			//$this->error('插入失败');
       		}
       }
       else{
       		//$this->error('表单数据有误，请重新提交');
       }
    }

    public function rreply(){
    	$rid = intval($_POST['rid']);
    	if($rid>0){
    		$data['content'] = htmlspecialchars($_POST['content']);
    		if($data['content']){
    			$data['uid'] = $user_info['uid'];
	       		$data['user_name'] = $user_info['user_name'];
	       		$data['recom_id'] = $rid;
	       		$data['time'] = time();
	       		intval($_POST['com_pid']) and $data['com_pid'] = $_POST['com_pid'];
	       		$recom = M('recom');
	       		$result = $recom->data($data)->add();
	       		if($result){
	       			//$this->success('插入成功');
	       		}
	       		else{
	       			//$this->error('插入失败');
	       		}
    		}
    		else{
    			$this->error('表单数据有误，请重新提交');
    		}

    	}
    }
}