<?php
	class logoutModel{
		//展示页退出登陆
		function logout(){
			//启动session
			@session_start();
				if(isset($_COOKIE['username'])&&isset($_COOKIE['password'])){
				//清除cookie
				setcookie('username',time()-1);
				setcookie('password',time()-1);
				}
				//清除session
				$_SESSION = array();
				unset($_SESSION['userinfo']);
				// unset($_SESSION);
				//销毁session数据
				if (empty($_SESSION)) {
					session_destroy();
					return true;
				}
				
			
		}
	}
?>