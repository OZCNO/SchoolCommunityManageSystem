<?php
	class scuaccountModel{
		public function index(){
			@session_start();
			$sql="select `ID`,`username`,`realname`,`phone`,`department`,`work` from `scu_manager`";
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
			$sql="select `username`,`realname`,`work`,`phone`,`department`,`major` from scu_manager where `ID`={$id}";
			DB::query($sql);
			return json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC));
		}

        public function update(){
            @session_start();
            $type="sssssss";
            $ID=$_POST['ID'];
            unset($_POST['ID']);
            //判断是否修改密码
            if($_POST['password']==""){
                unset($_POST['password']);
                $type="sssss";
            }else{
                $_POST['salt']=md5(uniqid(microtime()));
                $_POST['password']=md5($_POST['salt'].md5($_POST['password']));
            }
            //判断是否修改当前账户的信息
            $sql="select `username` from `scu_manager` where `ID`={$ID}";
            DB::query($sql);
			$arr=json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC));
            unset($_POST['username']);
            $flag=DB::update("scu_manager",$_POST,$type,"`ID`={$ID}");
            if($flag>0){
                if($arr->username==$_SESSION['admin']['username']){
                    unset($_SESSION['admin']);
                    return array("flag"=>3);
                }
                return array("flag"=>1);
            }
            else
                return array("flag"=>0);
        }


        public function del(){
            @session_start();
            $id=$_POST['id'];
            $sql="select `username` from `scu_manager` where `ID`={$id}";
            DB::query($sql);
			$arr=json_decode(DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC));
            if($id==1){
                return array('flag'=>2);
            }
            if(!empty($arr)){
                if($arr->username==$_SESSION['admin']['username']){
                    $flag=DB::del("scu_manager","`ID`={$id}");
                    if($flag>0){
                        unset($_SESSION['admin']);
                        return array("flag"=>3);
                    }
                }else{
                    $flag=DB::del("scu_manager","`ID`={$id}");
                }

                if($flag>0)
                    return array("flag"=>1);
                else
                    return array("flag"=>0);
            }else{
                return array('flag'=>0);
            }
        }

        public function add(){
            $_POST['salt']=md5(uniqid(microtime()));
            $_POST['password']=md5($_POST['salt'].md5($_POST['password']));
            $flag=DB::insert("scu_manager",$_POST,"ssssssss");
            if($flag>0)
                return array("flag"=>1);
            else
                return array("flag"=>0);
        }

        public function exist(){
            $user=$_POST['username'];
            $sql="select `username` from `scu_manager`";
            DB::query($sql);
			$arr=json_decode(DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC));
            foreach($arr as $v){
                if($user==$v->username){
                    return array("flag"=>0);
                }
            }
            return array("flag"=>1);

        }
	}
?>

