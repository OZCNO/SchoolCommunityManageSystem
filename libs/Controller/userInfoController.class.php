<?php
	class userInfoController{
		//展示页会员设置个人信息控制器
		

		/**
		  * function setInfo() : 会员设置个人信息页
		  * $result  : json
		  *
		  */
		public function setInfo(){
			
			@session_start();
			if(isset($_SESSION['userinfo']['username'])){
				$setInfoModel = M('setUserInfo');
				$result = $setInfoModel->setUserInfo();
				echo $result;
			}
			else
				alertGo('请先登录','main.php');
			
		}

		/**
		  * function concern() : 会员设置个人信息页
		  * $result  : json
		  *
		  */

		public function concern(){
			@session_start();
			if(isset($_SESSION['userinfo']['username'])){
				$concernModel = M('concernSociety');
				$result = $concernModel->concern();
				echo $result;
			}
			else
				alertGo('请先登录','main.php');
			
		}

	}
?>