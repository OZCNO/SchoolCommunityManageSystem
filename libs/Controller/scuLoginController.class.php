<?php
	class scuLoginController{
		//登录
		public function login(){
			$model=M('scuLogin');
			$arr=$model->login();
			echo $arr;
		}
		
		//插入管理员
		public function aaa(){
			$salt= md5(uniqid(microtime()));
			$password = md5($salt.md5('41253100'));
			echo DB::insert('scu_manager',array('username'=>'wangziyu','password'=>$password,'salt'=>$salt),"sss");
		}
		
		//退出
		public function logout(){
			@session_start();
			unset($_SESSION['admin']['username']);
			alertGO("您已成功退出","admin.php");
		}
	}
?>
