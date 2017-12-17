<?php
	class indexModel{
		function getScrollImage(){
			DB::query("select `aNO`,`aName`,`aImg`,`date_of_entry` from `scu_activity` where `location`='轮播图'");
			$arr=DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
            $arr=json_decode($arr);
            foreach($arr as $line){
                $str=explode(',',$line->aImg);
                $line->aImg=$str[0];
            }
            $jsarr=json_encode($arr);
			return json_decode($jsarr);
			
		}
		function getAImage(){
			DB::query("select `aNO`,`aName`,`aImg`,`date_of_entry` from `scu_activity` where `location`='公告' and `category`='热门活动' order by `date_of_entry` desc");
			$arr=DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
            $arr=json_decode($arr);
            foreach($arr as $line){
                $str=explode(',',$line->aImg);
                $line->aImg=$str[0];
            }
            $jsarr=json_encode($arr);
			return json_decode($jsarr);
		}
        
		function getAImage1(){
			DB::query("select `aNO`,`aName`,`aImg`,`date_of_entry` from `scu_activity` where `location`='公告' and `category`='火热进行' order by `date_of_entry` desc");
			$arr=DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
            $arr=json_decode($arr);
            foreach($arr as $line){
                $str=explode(',',$line->aImg);
                $line->aImg=$str[0];
            }
            $jsarr=json_encode($arr);
			return json_decode($jsarr);
		}

		function getAImage2(){
			DB::query("select `aNO`,`aName`,`aImg`,`date_of_entry` from `scu_activity` where `location`='公告' and `category`='往期回顾' order by `date_of_entry` desc");
			$arr=DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
            $arr=json_decode($arr);
            foreach($arr as $line){
                $str=explode(',',$line->aImg);
                $line->aImg=$str[0];
            }
            $jsarr=json_encode($arr);
			return json_decode($jsarr);
		}

        //获取活动具体信息
        function getActivityData(){
            //url解码
            $url_info = geturl($_SERVER['QUERY_STRING'],'SCU');
            $aNO = isset($url_info['aNO'])?$url_info['aNO']:null;
            DB::query("select `aName`,`date_of_entry`,`aContent` from `scu_activity` where `aNO`=$aNO");
            $jsarr=DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
            return json_decode($jsarr);
        }
	}
?>
