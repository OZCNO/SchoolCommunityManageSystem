<?php
	//登录模型
	class loginModel{
		//查询并获取用户的一行信息
		function fetch($username,$table){
			//sql语句
			$sql = "select `username`,`password`,`salt` from ".$table." where `username`=".$username;
			//先执行查询
			DB::query($sql);
			//fetch得到结果集 $yn判断结果集是否为空 
			return DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
		}
		
		//记住密码
		function rember_login(){
			$table="userinfo";
			$json=json_encode(array("success"=>false));
			//判断cookie是否保存信息
			if(isset($_COOKIE['username'])&&isset($_COOKIE['password'])){
				$username = $_COOKIE['username'];
				$password = $_COOKIE['password'];
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
						$_SESSION['userinfo']= array(
							'username'=>$username
						);
						$json=json_encode(array("success"=>true));	
					}else
						$json=json_encode(array("success"=>false));	
				}else
					$json=json_encode(array("success"=>false));	
			}
			return $json;
		}
		
		//登录验证
		function logincheck(){
			$table = 'userinfo'; 
			$json=null;
			if(!empty($_POST)){
				//获取登录表单post过来的用户名，密码
				$username = isset($_POST['username']) ? trim($_POST['username']) : '';
				$password = isset($_POST['password']) ? $_POST['password'] : '';
				
				$user_row= $this->fetch($username,$table);
				
				$yn = ($user_row=="null");
				$user_row=json_decode($user_row,true);
				
				//用户存在
				if(!$yn){
					//判断密码是否正确
					$password = md5($user_row['salt'].md5($password));
					if($password == $user_row['password']){
						//判断是否勾选了记住密码
						
						if(isset($_POST['auto_login'])&&$_POST['auto_login']=='true'){
							//$ua  user agent信息 用于加密密码
							$ua = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
							//加密后的cookie密码
							$password_cookie = md5($user_row['password']).md5($user_row['salt']);
							//保存期限 此处为一个月
							$cookie_expire = time()+ 2592000;
							//保存用户名
							setcookie('username',$username,$cookie_expire);
							//保存密码
							setcookie('password',$password_cookie,$cookie_expire);
							unset($_POST['auto_login']);
						}
						//登录成功 页面跳转
						@session_start();
						$_SESSION['userinfo']= array(
							'username'=>$username
						);
						$json=json_encode(array("success"=>1));
					}else{
						$json=json_encode(array("success"=>0));
					}
				}
				else{
					$json=json_encode(array("success"=>-1));	
				}
			
			}
			return $json;	
			
		}
		
		//判断用户提交的验证码是否正确
		function check_text(){
			@session_start();
			if(isset($_SESSION['checkedString'])&&isset($_POST['data'])){
				if($_SESSION['checkedString']==md5(strtolower($_POST['data']))){
					$json=json_encode(array("success"=>true));
				}
				else{
					$json=json_encode(array("success"=>false));
				}
			}else{
				$json=json_encode(array("success"=>false));
			}
			unset($_SESSION['checkedString']);
			return $json;
		}
		
	}
	
	

?>	