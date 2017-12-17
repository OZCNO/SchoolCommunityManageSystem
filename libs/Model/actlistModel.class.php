<?php
	class actlistModel{
		//获取活动审核表模型
		public $page_max;
		function getActReview($sName){
			$actReview = json_decode($this->fetch($sName),true);
			return $actReview;
		}


		function fetch($sname){
			$sql = "select `aNO`,`aName`,`applicantName`,`date_of_activity`,`review` from `activity_apply` where `sName`='$sname' order by `date_of_activity` desc";
			if(DB::query($sql)){
				//加入分页功能 默认为10
				if($getPage = DB::makePage(10))
					$this->page_max = $getPage;
				else
					return false;
				
				//容错处理 
				if(!empty($_GET['page']))
					$page_now =(intval($_GET['page']) <= $this->page_max)?intval($_GET['page']):$this->page_max ;
				else//若GET不到当前page 则默认是1
					$page_now = 1;
				$result = DB::getPage($page_now);
				return $result;
			}
			else
				return false;
		}

		/**
		  *page() 获取页码数据
		  *$page 当前页码 通过get取得
		  *$maxpage 最大页码 通过本类的属性取得
		  *return 页码数组
		  */
		function page($page,$maxpage){
			//当前页面容错处理
			$page = ($page > $maxpage)?$maxpage:$page;
			//上一页
			$page_prev = $page - 1;
			if($page_prev < 1)
				$page_prev = 1 ;  
			//下一页
			$page_next = $page + 1 ;
			if($page_next > $maxpage)
				$page_next = $maxpage;
			//把上述变量存入数组
			$arr_page = array(
				'page_prev' => $page_prev,
				'page_now' => $page,
				'page_next' => $page_next,
				'page_max' => $maxpage );
			return $arr_page;
		}
	}
?>