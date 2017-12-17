<?php
	class joinSocietyController{
		//会员 加入社团 控制器
		function join(){
			$join = M('joinSociety');
			echo $join->join();
		}

		 function isJoin(){
		 	$isJoin = M('joinSociety');
			$isJoin->isJoin();
		 }
	}
?>