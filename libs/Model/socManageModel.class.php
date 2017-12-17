<?php
	class socManageModel{
		//社团管理模型类 包含了社团成员的删除和审核方法

		private $table;
		private $sum;
		private $success;
		private $fail;

		/**
		  *init()
		  *初始化属性值
		  */

		function init(){
			$this->table ='user_sno';
			$this->sum=0;
			$this->success =0;
			$this->fail	=0;
		}
		/*
		 *del()
		 *$smNO 要删除的社团成员id
		 *return: true or false or "null" 
		 **/
		function del(){
			//获取要删除的社团成员id => smNO
			if($_POST){
				$smNO =isset($_POST['smNO'])?$_POST['smNO']:"";
				$this->init();
				foreach ($smNO as $key => $arr_value) {
					$this->sum = $key+1;
					$value = $arr_value;
					if($this->fetch($value,$this->table,1)!="null"){
						$where = "`username` = ".$arr_value;
						//执行删除并存储结果
						$del_result = DB::del($this->table,$where);
						if($del_result){
							$this->success+=1;
						}
						else{
							$this->fail+=1;
						}
					}
					else{
						$this->fail+=1;
					}
				}
				$result = array(
					'提交:'=>$this->sum,
					'成功:'=>$this->success,
					'失败:'=>$this->fail); 
				return $result;
			}
			else{
				$result = 'null';
				return $result;
			}
			
		}
		
		/*
		 *review()
		 *$smNO 要删除的社团成员id
		 *return: true or false or "null" 
		 **/
		 //审核提交
		function review(){
			//获取要审核的社团成员id => smNO
			if($_POST){
				$smNO =isset($_POST['smNO'])?$_POST['smNO']:"";
				$this->init();
				foreach ($smNO as $key => $arr_value) {
					$this->sum = $key+1;
					$value = $arr_value;
					if($this->fetch($value,$this->table,0)!="null"){
						$where = "`username` = ".$arr_value;
						$arr = array('review'	=>'1');
						//执行update并储存结果
						$review_result = DB::update($this->table,$arr,"s",$where);
						if($review_result){
							$this->success+=1;
						}
						else{
							$this->fail+=1;
						}
					}
					else{
						$this->fail+=1;
					}
				}
				$result = array(
					'提交:'=>$this->sum,
					'成功:'=>$this->success,
					'失败:'=>$this->fail); 
				return $result;
				
			}
			else{
				$result = 'null';
				return $result;
			}
		}
		
		
		
		function fetch($value,$table,$flag){
			//sql 语句
			$sql = "select * from ".$table." where `username`= ".$value;
			if($flag==1){
				$sql.=" and `review` = '1' " ;
			}else{
				$sql.=" and `review` = '0' " ;	
			}
			//查询
			DB::query($sql);
			return DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
		}
		
		
		/*   ======暂不需要=======
		function add(){
			if(!empty($_POST)){
				$table = 'society_member';
				DB::insert($table,$_POST);
				//提交后跳转回上一页
				// 
				//结束脚本
				die();
			}
		}
		function update(){
			if(!empty($_POST)){
				//获取要编辑的社团成员id => smNO
				$smNO = isset($_GET['smNO']) ? intval($_GET['smNO']) : 0;
				//数据库表处理
				$table = 'society_member';
				//数据库条件
				$where = "`smNO` = ".$smNO;
				DB::update($table,$_POST,$where);
				//提交后跳转回上一页
				// header(); 
				//结束脚本
				die();
			}
		}
			
		 ==========================================*/
		 
	}
?>
