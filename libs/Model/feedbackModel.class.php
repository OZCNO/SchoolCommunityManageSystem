<?php
	class feedbackModel{
		public function index(){
			@session_start();
			$sql="select `msg_id`,`msg_title`,`msg_date`,`msg_who` from `msg_feedback` where `msg_flag`=1";
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
			$sql="select `msg_title`,`msg_content` from `msg_feedback` where `msg_id`={$id}";
			DB::query($sql);
			return json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC));
		}

        public function insertInto(){
            $flag=DB::insert("msg_feedback",$_POST,"sssi");
            if($flag>0)
                return array("flag"=>true);
            else
                return array("flag"=>false);
        }

        public function del(){
            $id=$_POST['id'];
            $flag=DB::del("msg_feedback","msg_id={$id}");
            if($flag>0)
                return array("flag"=>true);
            else
                return array("flag"=>false);
        }
	}
?>
