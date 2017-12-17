<?php
	//校社联管理模块之管理    model
	class smmModel{
		
		//管理人员登录
		public function login(){
			if(!empty($_POST)){
				$username=$_POST['username'];
				$password=$_POST['password'];
				DB::query("select * from `sManage_userinfo` where `username` = '$username'");
				$arr=json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC),true);
				if(md5($arr['pwd_salt'].md5($password))==$arr['password']){
					return true;
				}
				else
					return false;
			}
			else
				return false;
		}
		
		
		
		//添加新的管理员
		public function add(){
			$salt= md5(uniqid(microtime()));
			DB::insert('sManage_userinfo',array('username'=>'root1','password'=>md5($salt.md5('wangziyu')),'pwd_salt'=>$salt));
			return DB::insertId();
		}
		
		//删除管理员
		public function del($username){
			return DB::del('sManage_userinfo',"`username`='{$username}'");
		}
	}

?>