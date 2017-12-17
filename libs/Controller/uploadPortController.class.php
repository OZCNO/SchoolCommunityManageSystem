<?php
	class uploadPortController{
		//上传头像控制器
		function upload(){
			$upload = M('uploadPort');
			if($id = $upload->upload())
				alertGo('头像保存成功','main.php?controller=login&method=showPI2');
			else
				alertGo('头像保存失败','main.php?controller=login&method=showPI2');
		}
	}
?>