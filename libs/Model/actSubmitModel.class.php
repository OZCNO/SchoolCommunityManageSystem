<?php
	class actSubmitModel{
		//社团活动申请表提交模型
		
		
		function submit(){
			if(!empty($_POST)){
                $table = 'activity_apply';
				if(DB::insert($table,$_POST,"ssssssssss")){
					return true;
				}else{
					return false;
				}
				
			}
			else{
				return false;
			}
		}




		
	}
?>
