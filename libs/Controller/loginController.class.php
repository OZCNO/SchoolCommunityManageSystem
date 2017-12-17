<?php
	header('content-type:text/html;charset=utf-8');
	// require_once('/../ORG/checkedImage.php');
	require_once(getcwd().'/../libs/ORG/checkedImage.php');
	//登录控制器
	class loginController{
		function login(){
			$loginModel = M('login');
			$a=$loginModel->logincheck();
			echo $a;
		}
		
		function getCheckedImage(){
			createCheckedImage(90,30);
		}
		
		function check_text(){
			$loginModel=M('login');
			echo $loginModel->check_text();
		}
		
		function auto_login(){
			$loginModel=M('login');
			echo "".$loginModel->rember_login();
		}
		
		public function showPI(){
			if(isset($_SESSION['userinfo'])){
				VIEW::_assign("login","<a href='index.html?".encrypt_url("controller=login&method=showPI",'SCU')."'><span class='lr' >消息<sup  id='new'>1</sup></span></a>");
				VIEW::_assign("reg","<a href='index.html?".encrypt_url("controller=login&method=showPI2",'SCU')."'><span class='lr'  id='hvr'>{$_SESSION['userinfo']['username']}</span></a><span>|</span><a href='main.php?controller=login&method=logout'><span class='lr'>退出</span></a>");
			}
			if(isset($_COOKIE['username'])){
				VIEW::_assign("login","<a href='index.html?".encrypt_url("controller=login&method=showPI",'SCU')."'><span class='lr' >消息<sup  id='new'>1</sup></span></a>");
				VIEW::_assign("reg","<a href='index.html?".encrypt_url("controller=login&method=showPI2",'SCU')."'><span class='lr' id='hvr'>{$_COOKIE['username']}</span></a><span>|</span><a href='main.php?controller=login&method=logout'><span class='lr'>退出</span></a>");
			}
			VIEW::_assign("url_aboutUs","index.html?".encrypt_url("controller=index&method=showAboutUs",'SCU'));
			VIEW::_assign("url_information","index.html?".encrypt_url("controller=index&method=information",'SCU'));
			VIEW::_assign("url_contactUs","index.html?".encrypt_url("controller=index&method=contactUs",'SCU'));
			VIEW::_assign("url_reg","index.html?".encrypt_url("controller=reg&method=one",'SCU'));
			VIEW::_assign("url_showPI2","index.html?".encrypt_url("controller=login&method=showPI2",'SCU'));
			VIEW::_assign("url_logout","index.html?".encrypt_url("controller=login&method=logout",'SCU'));
			VIEW::display('./main/individualInterface.html');
		}
		
		public function showPI2(){
			$userinfo = M('getUserinfo');
			if($arr_info = $userinfo->getInfo()){
				VIEW::_assign("userinfo",$arr_info);
			}
			if($arr_club = $userinfo->getSociety() ){
				VIEW::_assign("society",$arr_club);
				//加入一个随机参 让浏览器知道图片已刷新
				VIEW::_assign("rand",rand());
			}
			if($arr_concern = $userinfo->getConcern()){
				VIEW::_assign("concern",$arr_concern);
			}
			if(isset($_SESSION['userinfo'])){
				VIEW::_assign("login","<a href='index.html?".encrypt_url("controller=login&method=showPI",'SCU')."'><span class='lr' >消息<sup  id='new'>1</sup></span></a>");
				VIEW::_assign("reg","<a href='index.html?".encrypt_url("controller=login&method=showPI2",'SCU')."'><span class='lr'  id='hvr'>{$_SESSION['userinfo']['username']}</span></a><span>|</span><a href='main.php?controller=login&method=logout'><span class='lr'>退出</span></a>");
			}
			if(isset($_COOKIE['username'])){
				VIEW::_assign("login","<a href='index.html?".encrypt_url("controller=login&method=showPI",'SCU')."'><span class='lr' >消息<sup  id='new'>1</sup></span></a>");
				VIEW::_assign("reg","<a href='index.html?".encrypt_url("controller=login&method=showPI2",'SCU')."'><span class='lr' id='hvr'>{$_COOKIE['username']}</span></a><span>|</span><a href='main.php?controller=login&method=logout'><span class='lr'>退出</span></a>");
			}
			VIEW::_assign("url_aboutUs","index.html?".encrypt_url("controller=index&method=showAboutUs",'SCU'));
			VIEW::_assign("url_information","index.html?".encrypt_url("controller=index&method=information",'SCU'));
			VIEW::_assign("url_contactUs","index.html?".encrypt_url("controller=index&method=contactUs",'SCU'));
			VIEW::_assign("url_reg","index.html?".encrypt_url("controller=reg&method=one",'SCU'));
			VIEW::_assign("url_showPI2","index.html?".encrypt_url("controller=login&method=showPI2",'SCU'));
			VIEW::_assign("url_logout","index.html?".encrypt_url("controller=login&method=logout",'SCU'));
			VIEW::display('./main/individualInterface2.html');
		}
		
		function logout(){
			$logout = M('logout');
			if($logout->logout())
				alertGO("退出成功","main.php");

		}

		//发表评论
		function addComment(){
			@session_start();
			if(isset($_SESSION['userinfo'])){
				$addCommMod = M('comment');
				$add_result = $addCommMod ->addComment();
				if($add_result)
					// alertBack('评论成功');
					alertGo('评论成功','index.html?AT9VPlVpVCRdLwBlAzpXaQpgUnZTbgs5Vm4BZAUxUysLcANqADdXJ1szCm8JOAdoCXUFO1M8W3cGY1dwCykATgETVWxVNA%3D%3D');
				else
					alertBack('服务器错误,请稍后再试');
			}
			else
				alertBack('请先登录');
		}
	}
?>