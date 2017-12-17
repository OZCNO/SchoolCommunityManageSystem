<?php
	class yearRegModel{
		//显示年度注册审核页面
		public function getYearReg(){
			@session_start();
			$sql="select `sNO`,`sName`,`nhName`,`date_of_entry`,`review` from `society_reg` where `review`=0";
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
		
		//获取显示审核信息
		public function checkYearReg(){
			if(isset($_POST['id']))
				$id=$_POST['id'];
			$sql="select * from `society_reg` where `sNO`=$id";
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
		public function checkSubmit(){
			if(isset($_POST['id'])&&isset($_POST['review'])){
				$id=$_POST['id'];
				$review=(int)$_POST['review'];
				DB::query("update `society_reg` set `review`=$review where `sNO`=$id");
				return json_encode(array('success'=>true));
			}
		}
		
		//获取指定页
		public function yearRegGetpage($p){
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
	}






?>