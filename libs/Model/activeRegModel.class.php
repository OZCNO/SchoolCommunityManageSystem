<?php
	class activeRegModel{
		public function getActiveReg(){
			@session_start();
			$sql="select `aNO`,`aName`,`applicantName`,`date_of_entry`,`review` from `activity_apply` where `review`=0";
			DB::query($sql);
			if(($arr['page']=DB::makePage(10))>0){
				$_SESSION['sql']=$sql;
				$arr['date']=DB::getPage(1);
				$arr['date']=json_decode($arr['date']);
				for($i=0;$i<count($arr['date']);$i++){
					if($arr['date'][$i]->review==0){
						$arr['date'][$i]->review='未审核';
					}
				}
				$arr['date']=json_encode($arr['date']);
			}	
			else{
				unset($_SESSION['sql']);
				$arr['page']=1;
			}
			return $arr;
		}
		
		//获取指定页
		public function activeRegGetpage($p){
			@session_start();
			if(isset($_SESSION['sql'])){
				DB::query($_SESSION['sql']);
				if(($arr['page']=DB::makePage(10))>0){
					$arr['date']=DB::getPage($p);
					$arr['date']=json_decode($arr['date']);
					for($i=0;$i<count($arr['date']);$i++){
						if($arr['date'][$i]->review==0){
							$arr['date'][$i]->review='未审核';
						}
					}
					$arr['date']=json_encode($arr['date']);
				}	
				
				
			}else{
				$arr['page']=1;
			}
				
			return $arr;
		}
		
		//获取显示审核信息
		public function checkActiveReg(){
			if(isset($_POST['id']))
				$id=$_POST['id'];
			$sql="select * from `activity_apply` where `aNO`=$id";
			DB::query($sql);
			$arr=json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC));
			if($arr->review==0){
				$arr->review="未审核";
			}else{
				$arr->review="已审核";
			}
			return $arr;
		}
		
		//审核
		public function activeSubmit(){
			if(isset($_POST['id'])&&isset($_POST['review'])){
				$id=$_POST['id'];
				$review=(int)$_POST['review'];
				DB::update("activity_apply",array("review"=>$review),"s" ,"`aNO`=$id");
				return json_encode(array('success'=>true));
			}
		}
	}

?>
