<?php
	class adminModel{
		//社团、社联 管理者中心模型
		

		/**
		  *logout 管理员登出
		  *
		  */
		function logout(){
			//启动session
			@session_start();
			if($_POST['exit']=="退出"){
				
				//清除session
				
				unset($_SESSION['societyinfo']);
				//unset($_SESSION);
				//销毁session数据
				if (empty($_SESSION['societyinfo'])) {
					return true;
				}
				
			}

		}
	}
?>