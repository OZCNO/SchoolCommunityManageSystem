<?php
	header('content-type:text/html;charset=utf-8');
	//登录控制器
	class backstageLoginController{
		function login(){
			//登录
			$loginModel = M('backstageLogin');
			$temp=$loginModel->logincheck();
			echo $temp;
		}
		
		
		
		function login_view(){
			VIEW::display('admin/backstageLogin.html');
		}
	}
?>