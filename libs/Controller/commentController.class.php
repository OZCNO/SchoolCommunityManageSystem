<?php 
	/**
	* commentController 
	* 新增的社团展示页面留言面板控制器
	*/
	class commentController{
		/*

		//获取留言控制器
		function getComment(){

		}
		*/


		//添加留言控制器
		function addComment(){
			$addCommMod = M('comment');
			$add_result = $addCommMod ->addComment();
			if($add_result)
				alertBack('评论成功');
			else
				alertBack('服务器错误,请稍后再试');
		}
	}
 ?>