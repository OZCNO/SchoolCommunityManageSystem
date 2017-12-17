<?php
	class scuLoginModel{
		public function login(){
			if(!empty($_POST)){
				$usr=$_POST['admin_usr'];
				$pwd=$_POST['admin_pwd'];
				$sql="select `username`,`salt`,`password` from `scu_manager` where `username`=?";
				DB::query($sql,array('s',&$usr));
				$arr=json_decode(DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC));
				if(count($arr)==1){
					foreach($arr as $v){
						$pwd=md5($v->salt."".md5($pwd));
						if($pwd==$v->password){
							@session_start();
							$_SESSION['admin']['username']=$usr;
							return json_encode(array("success"=>1));
						}else{
							return json_encode(array("success"=>0));
						}
					}
				}else{
					return json_encode(array("success"=>-1));
				}
				
			}else
				return json_encode(array("success"=>-2));
		}
		
		
	}
?>
