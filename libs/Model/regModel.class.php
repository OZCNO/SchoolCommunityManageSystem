<?php
	
	//注册模型
	class regModel{
		function usercheck(){
			$username=isset($_POST['username'])?$_POST['username']:"";//将post得到的username给$username
			
			$sql = "select `username` from `userinfo` where `username` = '$username'";			
			
			DB::query($sql);
			$arr=DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
			$arr=json_decode($arr);
			if(empty($arr)){
				return json_encode(array('success'=>true));
			}
			else{
				return json_encode(array('success'=>false));
			}
		}
		
		//从表单接收用户注册信息
		function getReg(){
			$table = 'userinfo';
			//启动session的初始化
			@session_start();
			/*	reg1
				用户名
				密码
				email
			*/

			//url解码
			$url_info = geturl($_SERVER['QUERY_STRING'],'SCU');
			$method = isset($url_info['method'])?$url_info['method']:null;
			if($method =='two'){
				if(!empty($_POST)){
					$username = $_POST['username'];
					$password = $_POST['pwd'];
					$email = $_POST['email'];
					//密码盐
					$salt = md5(uniqid(microtime()));
					//加密用户密码
					$password = md5($salt.md5($password));
					//数组存储 注册表1
					$_SESSION = array(
						'username'=>$username,
						'password'=>$password,
						'salt'=>$salt,
						'email'=>$email
					);			
				}
			}	
			/*	reg2
				姓名
				系别
				专业
				性别
				手机
				微信*/
			if($method =='three'){
				if(!empty($_POST)){
					$name = $_POST['realname'];
					$dept = $_POST['dept'];
					$major = $_POST['major'];
					$sex = $_POST['sex'];
					$tel = $_POST['tel'];
					$wechat = $_POST['chat'];
					//数组存放注册表2的信息
					$arr = array(
						'name'=>$name,
						'dept'=>$dept,
						'major'=>$major,
						'sex'=>$sex,
						'tel'=>$tel,
						'wechat'=>$wechat
					);		
					$reginfo = array_merge($_SESSION,$arr);
					if(isset($reginfo['checkedString'])){
						unset($reginfo['checkedString']);
					}
					if(isset($reginfo['contact_checkedString'])){
						unset($reginfo['contact_checkedString']);
					}
				}
				// insert 导入数据库
				if(isset($reginfo['username'])){
					DB::insert($table,$reginfo,"ssssssssss");
					$username_temp = $_SESSION['username'];
					$_SESSION =array();
					session_destroy();
					@session_start();
					$_SESSION['userinfo']['username']= $username_temp;
					return true;
				}	
				else
					return false;
			}
				
		}
	}

?>	