<?php
	class regSubmitModel{
		//社团年度注册表提交模型
		
		/**
		  *submit()  社团年度注册表提交
		  *return :true or false 
		  */
		function submit(){
			if(!empty($_POST)){
				$table = 'society_reg';
                $fd=DB::insert($table,$_POST,"sssssssssssssss");
				if($fd){
					return true;
				}

				// die('提交成功 请等待审核');
				else{
					return false;
				}
			}
			else{
				return false;
				// die('提交失败');
			}
		}



		/**
		  *getsName()  获取社团名称
		  *return : $sName 用于界面左上角的当前社团显示
		  */
		function getsName(){
			$sName =json_decode($this->fetch(),true)['sName'] ;
			return $sName;
		}
		function fetch(){
			@session_start();
			if(isset($_SESSION['societyinfo'])){
				//用户已经登录
				$socManager = $_SESSION['societyinfo'];
				$value =$socManager['admin_username'];
				$table = 'societyinfo';
				$sql = "select `sName` from ".$table." where `sUsername`='$value'";
				DB::query($sql);
				return DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
			}
		}
		
	}
?>
