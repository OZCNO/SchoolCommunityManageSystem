<?php
	class backstageLoginModel{
	//登录模型
		function fetch($username,$table){
			//查询并获取改用户的一行信息
			//sql语句
			$sql = "select `susername`,`spassword`,`ssalt` from ".$table." where `susername`='$username' ";
			//先执行查询
			DB::query($sql);
			//fetch得到结果集 $yn判断结果集是否为空 
			return DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
		}

		//记住密码
		function rember_login(){
			$table="societyinfo";
			$json=json_encode(array("success"=>false));
			//判断cookie是否保存信息
			if(isset($_COOKIE['admin_username'])&&isset($_COOKIE['admin_password'])){
				$username = $_COOKIE['admin_username'];
				$password = $_COOKIE['admin_password'];
				// $sql = "select `username`,`password`,`salt` from ".$table." where `username`=".$username;
				$user_row= $this->fetch($username,$table);
				if($user_row!="null"){
					//计算cookie密码
					$user_row =json_decode($user_row,true);
					$ua = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
					$password_cookie = md5($user_row['password']).md5($user_row['salt']);
					//验证cookie密码
					if($password == $password_cookie){
						//登录成功
						@session_start();
						$_SESSION['societyinfo']= array(
							'admin_username'=>$username
						);
						$json=json_encode(array("success"=>true));	
					}else
						$json=json_encode(array("success"=>false));	
				}else
					$json=json_encode(array("success"=>false));	
			}
			return $json;
		}
		
		function logincheck(){
			$table = 'societyinfo';
			if(!empty($_POST)){
				//获取post的用户名密码
				$username = isset($_POST['username_a']) ? trim($_POST['username_a']) : '';
				$password = isset($_POST['password_a']) ? $_POST['password_a'] : '';
				
				$user_row= $this->fetch($username,$table);
				$yn = ($user_row=="null");
				$user_row=json_decode($user_row,true);
				
				if(!$yn){
				//用户存在
					//判断密码是否正确
					$password = md5($user_row['ssalt'].md5($password));
					if($password == $user_row['spassword']){
						@session_start();
						$_SESSION['societyinfo']= array(
							'admin_username'=>$username
						);
						return json_encode(array("success"=>1));
						
						
					}
					else{
					
						return json_encode(array("success"=>0));
					}
				}
				else{
					
					return json_encode(array("success"=>-1));
				}
			
			}
			return json_encode(array("success"=>-1));	
			
		}
	}

?>	