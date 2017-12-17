
<?php
class nowModel{
	public function nowFind($r,$d){
		@session_start();
		if($d=='0'){
			if(empty($r)){
				$sql="select `sNO`,`sName`,`sType`,`hName`,`date_of_found`,`tName`,`vNum` from `societyinfo`";
			}
			else{
				$sql="select `sNO`,`sName`,`sType`,`hName`,`date_of_found`,`tName`,`vNum` from `societyinfo` where `sName`='$r'";
			}
		}
		else{
				$department="";
				switch($d){
					case '1':$department="学术科技类";break;
					case '2':$department="体育健身类";break;
					case '3':$department="文娱文化类";break;
					case '4':$department="综合实践类";break;
					default :$department="";
				}
				if(empty($r)){
					if(!empty($department)){
						$sql="select `sNO`,`sName`,`sType`,`hName`,`date_of_found`,`tName`,`vNum` from `societyinfo` where `sType`='$department'";
					}
				}
				else{
					$sql="select `sNO`,`sName`,`sType`,`hName`,`date_of_found`,`tName`,`vNum` from `societyinfo` where `sType`='$department' and `sName`='$r'";
				}
			}
			
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
	
	
	public function now(){
		@session_start();
		$sql="select `sNO`,`sName`,`sType`,`hName`,`date_of_found`,`tName`,`vNum` from `societyinfo`";
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
	
	public function delMember($arr){
		if(!empty($arr)){
			$arr=json_decode($arr);
			foreach($arr as $value){
				DB::del('societyinfo',"`sNo`={$value}");
			}
			return  json_encode(array('success'=>true));
		}
		return  json_encode(array('success'=>false));
	}
	
	
	public function getNow(){
		if(isset($_POST['id']))
			$id=$_POST['id'];
		$sql="select * from `societyinfo` where `sNO`=$id";
		DB::query($sql);
		$arr=json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC));
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
}

?>