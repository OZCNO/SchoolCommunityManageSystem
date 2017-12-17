<?php
	class getUserInfoModel{
	//获取会员信息模型
		private $username;
		//获取会员信息
		function getInfo(){
			@session_start();
			//若已登录
			if(isset($_SESSION['userinfo']['username'])){
				//获取username
				$this->username = $_SESSION['userinfo']['username'];
				//DB查询user信息
				if($result = $this->fetch($this->username)){
					$userinfo = json_decode($result,true)[0];
					return $userinfo;
				}
				else
					return false;

			}
			else
				return false;

		}
		//获取加入的社团
		function  getSociety(){
			if(isset($this->username)){
				if($result  = $this->fetch($this->username,1)){
					$joined_club = json_decode($result,true);
					return $joined_club;
				}
				return false;

			}
		}
		//获取关注的社团
		function getConcern(){
			if(isset($this->username)){
				if($result  = $this->fetch($this->username,2)){
					$concerned_club = json_decode($result,true);
					return $concerned_club;
				}
				return false;

			}
		}


		/**
		  *$flag :  1:获取加入社团 2:获取关注社团
		  *$value : 传入用户名
		  */
		function fetch($value,$flag=null){
			$sql = "select * from `userinfo` where `username` = '$value' ";
			if($flag ===1)
				$sql = "select * from `userinfo` as a ,`user_sno` as b, `societyinfo` as c where a.username  = b.Username and b.sNO = c.sNO and a.username = '$value' and b.review = '1'";
			else if($flag ===2)
				$sql = "select * from `concern` as c, `societyinfo` as s where c.username = '$value' and c.sNO = s.sNO";
			$rst = DB::query($sql);
			if($rst){
				$result = DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
			}
			if($result)
				return $result;
			else
				return false;

		}
	}
?>