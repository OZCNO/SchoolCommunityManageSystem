<?php
	class concernSocietyModel{
		//关注社团模型
		private $sNO;
		private $username;
		//获取关注状态
		function isConcern(){
			if(isset($_POST['sNO']))
				$this->sNO =  intval($_POST['sNO']);
				//DB查询 是否存在 即该用户是否已加入社团
			else{
				require_once('/../../framework/function/url_encode.php');
				$url_info = geturl($_SERVER['QUERY_STRING'],'SCU');//接收所有参数
				$this->sNO = $url_info['sNO'];
			}
				
			@session_start();
			//从session获取username
			if(isset($_SESSION['userinfo']['username'])){
				$this->username = $_SESSION['userinfo']['username'];
				$isConcern = $this->fetch($this->sNO,$this->username);
				if($isConcern){
					//已经关注 返回true
					// return true;
					return true;
				}
				else
					//未关注 返回false
					return false;
			}
			else
				//调用登录框
				return false;
			
		
		}

		//关注
		function concern(){
			//若已关注 执行就删除该记录
			if($this->isConcern()){
				$where = '`username` = '.$this->username;
				if(DB::del('concern',$where))
					// return true;
					$json=json_encode(array("success"=>true,"isConcern&del"=>true));
				else
					// return false;

					$json=json_encode(array("success"=>false,"isConcern"=>true));
				return $json;
			}
			//若未关注 执行就插入该记录
			else{
				$arr = array(
					'Username'=>$this->username,
					'sNO'=>$this->sNO);
				if(DB::insert('concern',$arr,"ss"))
					$json=json_encode(array("success"=>true,"notConcern&insert"=>true));
					// return true;
				else
					// return false;
					$json=json_encode(array("success"=>false,"notConcern"=>true));
				return $json;
			}

		}


		function fetch($sNO,$username){
			$sql = "select * from `concern` as c where c.sNo = '$sNO' and c.Username = '$username' group by c.username,c.sNO ";
			// echo $sql;
			DB::query($sql);
			$arr=DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
			$arr=json_decode($arr);
			//若结果集为空 则返回false 否则返回true
			if(empty($arr)){
				return false;
			}
			else
				return true;
		}
	}
?>