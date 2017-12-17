<?php
	//审核社团注册表
	class smrModel{
		function get(){
			$sql="select * from `society_reg` where `review`=0";
			DB::query($sql);
			//return DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
		}
		
		function getNext(){
			return DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
		}
		
	}

?>