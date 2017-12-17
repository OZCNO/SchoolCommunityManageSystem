<?php
	class joinSocietyModel{
		//加入社团 模型

		private $sNO;
		private $username;
		function isJoin(){
			
				$this->sNO =intval(3);
				//DB查询 是否存在 即该用户是否已加入社团
				@session_start();
				//从session获取username
				if(isset($_SESSION['userinfo']['username']))
					$this->username = $_SESSION['userinfo']['username'];
				if($is_exist = $this->fetch($this->username,$this->sNO)){
					if(!empty($result = json_decode($is_exist,true))){
						if($result['review']==1){
							return 1;
						}
						else if($result['review']==0)
							return 0;
						else
							return -1;
					}else
						return -1;
				}
				else
					return -1;
		}


		function join(){

			//点击加入社团button 传入 社团名
			if($_POST['sNO']){
				if($this->isJoin()==1||$this->isJoin()==0){
					return json_encode(array("success"=>2));
				}
				else{
					$arr_insert = array(
						'Username'=>$this->username,
						'sNO'=>$this->sNO);
						if(empty(json_decode($this->fetch($arr_insert['Username'],$arr_insert['sNO'])))){
							DB::insert('user_sno',$arr_insert);
							return json_encode(array("success"=>true)) ;
						}
						return json_encode(array("success"=>false)) ;
				}
		
			}
		}


		function fetch($user,$society){
			$sql = "select * from `userinfo` as a ,`user_sno` as b, `societyinfo` as c where a.username  = b.Username and b.sNO = c.sNO and c.sNo = '$society' and a.username = '$user' group by b.username,b.sNO ";
			if(DB::query($sql)){
				return DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
			}
		}	
	}
?>