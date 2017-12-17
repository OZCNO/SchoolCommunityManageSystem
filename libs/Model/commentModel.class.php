<?php 
	//社团评论模型类
	class commentModel{
		/**
		*	addComment(): 发表留言
		*	  
		*/
		function addComment(){
			if(!empty($_POST)){
				$table = 'society_evaluate';
				$arr_comm = array(
					'content' => $_POST['content']
					);
				if(DB::insert($table,$arr_comm,'s')){
					$topic_id = DB::insertId();
					$arr_user_comment = array(
						'username' => $_SESSION['userinfo']['username'],
						'topic_id' => $topic_id
 					 );
 					$arr_sno_comment = array(
 						'sNO' => $_POST['sNO'], 
 						'topic_id' => $topic_id
 					);
					$flag = DB::insert('user_comment',$arr_user_comment,'ss');
					if($flag){
						$flag = DB::insert('sno_comment',$arr_sno_comment,'ss');
						if($flag){
							return true;
						}
						else
							return false;
					}
					else
						return false;

				}
				else
					return false;
			}
		}

		function getAll($sNO){
			if(!empty($sNO)){
				// $sNO = $_GET['sNO'];
				$sql = "select se.*,ui.`name`,ui.`portrait` from `society_evaluate` as se , `user_comment` as uc , `sno_comment` as sc ,`userinfo` as ui ,`societyinfo` as si where sc.`sNO`='3' and sc.`topic_id` = se.`topic_id` and se.`topic_id` = uc.`topic_id` and uc.`username` = ui.`username` group by se.`topic_id` order by se.`date_of_entry` desc";
				$rst = DB::query($sql);
				if($rst){
					$result = DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
				}
				if($result){
					$comment_all = json_decode($result,true);
					return $comment_all;
				}
				else
					return false;
			}
		}

		
	}
 ?>