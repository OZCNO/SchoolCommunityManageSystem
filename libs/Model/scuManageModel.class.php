<?php
	class scuManageModel{
		//显示所有成员，即页面一开始加载调用
		public function showMember(){
			@session_start();
			$sql="select * from `scu_member`";
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
		
		
		//查找成员
		public function getMember($r,$d){
			@session_start();
			if($d=='0'){
				if(empty($r)){
					$sql="select * from `scu_member`";
				}
				else{
					$sql="select * from `scu_member` where `realname`='$r'";
				}
			}
			else{
				$department="";
				switch($d){
					case '1':$department="办公室";break;
					case '2':$department="人力资源部";break;
					case '3':$department="财务监控部";break;
					case '4':$department="外联部";break;
					case '5':$department="文娱部";break;
					case '6':$department="网络信息部";break;
					case '7':$department="会员服务部";break;
					case '8':$department="宣传策划部";break;
					default :$department="";
				}
				if(empty($r)){
					if(!empty($department)){
						$sql="select * from `scu_member` where `department`='$department'";
					}
				}
				else{
					$sql="select * from `scu_member` where `department`='$department' and `realname`='$r'";
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
		
		//获取指定页页
		public function getPage($p){
			@session_start();
			if(isset($_SESSION['sql'])){
				DB::query($_SESSION['sql']);
				if(($arr['page']=DB::makePage(10))>0){
					$arr['date']=DB::getPage(1);
				}	
				$arr['date']=DB::getPage($p);
				
			}else{
				$arr['page']=1;
			}
				
			return $arr;
		}
		
		
		//添加成员
		public function addMember(){
			switch($_POST['department']){
					case '1':$department="办公室";break;
					case '2':$department="人力资源部";break;
					case '3':$department="财务监控部";break;
					case '4':$department="外联部";break;
					case '5':$department="文娱部";break;
					case '6':$department="网络信息部";break;
					case '7':$department="会员服务部";break;
					case '8':$department="宣传策划部";break;
					default :$department="";
			}
			switch($_POST['job']){
					case '1':$job="主席团";break;
					case '2':$job="部长";break;
					case '3':$job="副部长";break;
					case '4':$job="干事";break;
					default :$job="";
			}
		//	if(empty($_POST['phone']))
			//	unset($_POST['phone']);
			$_POST['department']=$department;
			$_POST['job']=$job;
			if($_POST['yes']=="true"){
				
			}else{
				
			}
			unset($_POST['yes']);
			unset($_POST['admin_usr']);
            unset($_POST['admin_pwd']);
			return DB::insert('scu_member',$_POST,"ssssssssss");
		}
		
		
		//删除成员
		public function delMember($arr){
			if(!empty($arr)){
				$arr=json_decode($arr);
				foreach($arr as $value){
					DB::del('scu_member',"`ID`={$value}");
				}
				return  json_encode(array('success'=>true));
			}
			return  json_encode(array('success'=>false));
		}
		
		//更新成员
        public function updateMember(){
            $type="ssssssssss";
			if(!empty($_POST)){
				switch($_POST['department']){
					case '1':$department="办公室";break;
					case '2':$department="人力资源部";break;
					case '3':$department="财务监控部";break;
					case '4':$department="外联部";break;
					case '5':$department="文娱部";break;
					case '6':$department="网络信息部";break;
					case '7':$department="会员服务部";break;
					case '8':$department="宣传策划部";break;
					default :$department="";
				}
				switch($_POST['job']){
						case '1':$job="主席团";break;
						case '2':$job="部长";break;
						case '3':$job="副部长";break;
						case '4':$job="干事";break;
						default :$job="";
				}
                if(empty($_POST['phone'])){
                    $type=substr($type,1);
                    unset($_POST['phone']);
                }
				$_POST['department']=$department;
				$_POST['job']=$job;
				$id=$_POST['ID'];
				unset($_POST['ID']);
				$_POST['class']=$_POST['dclass'];
				unset($_POST['dclass']);
                unset($_POST['yesOrNo']);
				return DB::update('scu_member',$_POST,$type,"ID={$id}");
			
			}else
				return 0;
		}
		
		//获取成员信息
		public function getUpdateMember($arr){
			if(!empty($arr)){
				$arr=json_decode($arr);
				foreach($arr as $value){
					DB::query("select * from `scu_member` where `ID`={$value}");
				}
				$arr=json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC));
				if(is_object($arr))
					$arr=get_object_vars($arr);
				switch($arr['department']){
					case "办公室":$arr['department']=1;break;
					case "人力资源部":$arr['department']=2;break;
					case "财务监控部":$arr['department']=3;break;
					case "外联部":$arr['department']=4;break;
					case "文娱部":$arr['department']=5;break;
					case "网络信息部":$arr['department']=6;break;
					case "会员服务部":$arr['department']=7;break;
					case "宣传策划部":$arr['department']=8;break;
					default:$arr['department']=0;
				}
				switch($arr['job']){
					case "主席团":$arr['job']=1;break;
					case "部长":$arr['job']=2;break;
					case "副部长":$arr['job']=3;break;
					case "干事":$arr['job']=4;break;
					default:$arr['job']=0;
				}
				return  json_encode($arr);
			}
		}
	}
?>
