<?php
	class adminController{
		//社团、社联 管理者中心 相关功能控制器

		
		function logout(){
			//管理员登出
			$logout = M('admin');
			if ($logout->logout()) 
				//退出登录 跳转到登录界面
				alertGO("您已成功退出！","admin.php");
			
		}
	}

?>