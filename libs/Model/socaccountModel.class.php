<?php
	class socaccountModel{
		public function index(){
			@session_start();
			$sql="select `sNo`,`sUsername`,`sName` from   `societyinfo`";
			DB::query($sql);
			if(($arr['page']=DB::makePage(10))>0){
				$_SESSION['sql']=$sql;
				$arr['date']=DB::getPage(1);
			}	
			else{
				unset($_SESSION['sql']);
				$arr['page']=1;
			}
			return $arr;
		}
		
		public function getPage($p){
			@session_start();
			if(isset($_SESSION['sql'])){
				DB::query($_SESSION['sql']);
				if(($arr['page']=DB::makePage(10))>0){
					$arr['date']=DB::getPage($p);
				}	
			}else{
				$arr['page']=1;
			}
				
			return $arr;
		}
		
		public function getDataById(){
			$id=$_POST['id'];
			$sql="select `sUsername`,`sName` from `societyinfo` where `sNo`={$id}";
			DB::query($sql);
			return json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC));
		}

        public function update(){
            @session_start();
            $type="ss";
            $ID=$_POST['ID'];
            unset($_POST['ID']);
            $_POST['sSalt']=md5(uniqid(microtime()));
            $_POST['sPassword']=md5($_POST['sSalt'].md5($_POST['sPassword']));
            $flag=DB::update("societyinfo",$_POST,$type,"`sNo`={$ID}");
            if($flag>0)
                return array("flag"=>true);
            else
                return array("flag"=>false);
        }
	}
?>

