<?php
	class socSubmitController{
		//社团提交控制器
		
		
		//===========================

		//显示社团年度注册表
		// function regsubShow(){
		// 	VIEW::_assign('url','admin/backstageManagement_3.html');
		// 	VIEW::display('admin/backstageManagement.html');
		// }
		// //显示社团活动申请表
		// function actsubShow(){
		// 	VIEW::_assign('url','admin/backstageManagement_4.html');
		// 	VIEW::display('admin/backstageManagement.html');
		// }
		//===========================
		
		
		//社团年度注册表提交
		function regSubmit(){
			$regSubmit = M('regSubmit');
			$result = $regSubmit->submit();
			if($result){
				alertBack("提交成功，请耐心等待审核");
			}
			else{
				alertBack("提交失败");
            }
			
		}
		
		//社团活动申请表提交
		function actSubmit(){
			$actSubmit = M('actSubmit');
			$result = $actSubmit->submit();
			if($result){
				alertBack("提交成功，请耐心等待审核");
			}
			else{
				alertBack("提交失败");
            }
		}
		
		
	}
?>
