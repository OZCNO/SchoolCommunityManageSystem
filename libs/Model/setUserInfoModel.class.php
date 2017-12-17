<?php 
	class setUserInfoModel{
		//展示页会员设置个人信息模型类

		/**
		  *更改用户信息方法
		  *
		  */
		public function setUserInfo(){

			if(!empty($_POST)){
				if(isset($_POST['email']) &&
					isset($_POST['wechat']) &&
					isset($_POST['tel'])){
					//获取post值
					$usrn = $_POST['username'];
					$arr = array('email' => $_POST['email'], 
							'wechat' => $_POST['wechat'],
							'tel' => $_POST['tel']
						);
					//数据库执行update
					$result = DB::update("userinfo",$arr,'sss','`username`='.$usrn);
					//如果通过
					if($result)
						$json=json_encode(array("success"=>true));	
					else
						$json=json_encode(array("success"=>false));
				}
			}
			else
				$json=json_encode(array("success"=>false));
			return $json;

		}


		

	}
 ?>