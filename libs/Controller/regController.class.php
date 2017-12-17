<?php
	header('content-type:text/html;charset=utf-8');
	require_once('/../../framework/function/url_encode.php');
	//注册控制器
	class regController{
		
		function check_user_exist(){
			$regModel = M('reg');
			echo $regModel->usercheck();
		}
		
		function one(){
			VIEW::_assign("reg2","index.html?".encrypt_url("controller=reg&method=two",'SCU'));
			VIEW::_assign("url_aboutUs","index.html?".encrypt_url("controller=index&method=showAboutUs",'SCU'));
			VIEW::_assign("url_information","index.html?".encrypt_url("controller=index&method=information",'SCU'));
			VIEW::_assign("url_contactUs","index.html?".encrypt_url("controller=index&method=contactUs",'SCU'));
			VIEW::_assign("url_reg","index.html?".encrypt_url("controller=reg&method=one",'SCU'));
			VIEW::_assign("url_showPI2","index.html?".encrypt_url("controller=login&method=showPI2",'SCU'));
			VIEW::_assign("url_logout","index.html?".encrypt_url("controller=login&method=logout",'SCU'));
			VIEW::display('./main/reg1.html');

		}
		
		function two(){
			if($_POST){
				VIEW::_assign("reg3","index.html?".encrypt_url("controller=reg&method=three",'SCU'));
				VIEW::_assign("url_aboutUs","index.html?".encrypt_url("controller=index&method=showAboutUs",'SCU'));
				VIEW::_assign("url_information","index.html?".encrypt_url("controller=index&method=information",'SCU'));
				VIEW::_assign("url_contactUs","index.html?".encrypt_url("controller=index&method=contactUs",'SCU'));
				VIEW::_assign("url_reg","index.html?".encrypt_url("controller=reg&method=one",'SCU'));
				VIEW::_assign("url_showPI2","index.html?".encrypt_url("controller=login&method=showPI2",'SCU'));
				VIEW::_assign("url_logout","index.html?".encrypt_url("controller=login&method=logout",'SCU'));
				VIEW::display('./main/reg2.html');
				//注册处理模型
				$regModel = M('reg') ;
				$regModel->getReg();
			}
			else{
				// header("Location:main.php?controller=reg&method=one");
				$location_url = "Location:index.html?".encrypt_url("controller=reg&method=one",'SCU');
				header($location_url);
			}
		}
		
		function three(){
			if($_POST){
				VIEW::_assign("url_aboutUs","index.html?".encrypt_url("controller=index&method=showAboutUs",'SCU'));
				VIEW::_assign("url_information","index.html?".encrypt_url("controller=index&method=information",'SCU'));
				VIEW::_assign("url_contactUs","index.html?".encrypt_url("controller=index&method=contactUs",'SCU'));
				VIEW::_assign("url_reg","index.html?".encrypt_url("controller=reg&method=one",'SCU'));
				VIEW::_assign("url_showPI2","index.html?".encrypt_url("controller=login&method=showPI2",'SCU'));
				VIEW::_assign("url_logout","index.html?".encrypt_url("controller=login&method=logout",'SCU'));
				VIEW::display('./main/reg3.html');

				//注册处理模型
				$regModel = M('reg') ;
				$result = $regModel->getReg();
				if($result){
					header("refresh:1.2;url=./index.html");
					// die();
				}
				else
					alertGo('注册失败，未知错误','index.html');

			}
			else{
				// header("Location:main.php?controller=reg&method=one");
				$location_url = "Location:index.html?".encrypt_url("controller=reg&method=one",'SCU');
				header($location_url);
			}
		}
		
		//显示移动端注册页面
		function appShow(){
			VIEW::display('./main/reg.html');
		}
}
?>