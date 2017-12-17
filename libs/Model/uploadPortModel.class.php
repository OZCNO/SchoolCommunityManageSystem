<?php
	class uploadPortModel{
		//上传头像模型
		function upload(){
			//定义用户信息
			if($_POST['username'])
				$info = array('username'=>$_POST['username']);
			//判断是否上传头像
			if(!empty($_FILES['portrait'])){	
				//获取用户上传文件信息
				$pic_info = $_FILES['portrait'];
				
				//判断文件上传到临时文件是否出错
				if($pic_info['error'] >0){
					$error_msg = '上传错误:';
					switch($pic_info['error']){
						case 1: $error_msg .= '文件大小超过了php.ini中upload_max_filesize选项限制的值！'; break;
						case 2: $error_msg .= '文件大小超过了表单中max_file_size选项指定的值！'; break;
						case 3: $error_msg .= '文件只有部分被上传！'; break;
						case 4: $error_msg .= '没有文件被上传！'; break;
						case 6: $error_msg .= '找不到临时文件夹！'; break;
						case 7: $error_msg .= '文件写入失败！'; break;
						default: $error_msg .='未知错误！'; break; 
					}
					// echo $error_msg;
					return false;
				}
				
				//获取上传文件的类型
				$type = substr(strrchr($pic_info['name'],'.'),1);
				//判断上传文件类型
				if($type !== 'jpg'){
					echo '图像类型不符合要求，允许的类型为:jpg';
					return false;
				}
				else{
					//获取原图图像大小
					list($width, $height) = getimagesize($pic_info['tmp_name']);
					//设置缩略图的最大宽度和高度
					$maxwidth = $maxheight= 90;
					//自动计算缩略图的宽和高
					if($width > $height){
						//缩略图的宽等于$maxwidth
						$newwidth = $maxwidth;
						//计算缩略图的高度
						$newheight = round($newwidth*$height/$width);
					}else{
						//缩略图的高等于$maxwidth
						$newheight = $maxheight;
						//计算缩略图的高度
						$newwidth = round($newheight*$width/$height);
					}
					//绘制缩略图的画布
					$thumb = imageCreateTrueColor($newwidth,$newheight);
					//依据原图创建一个与原图一样的新的图像
					$source = imagecreatefromjpeg($pic_info['tmp_name']);
					//依据原图创建缩略图
					/**
					  *@param $thumb 目标图像
					  *@param $source 原图像
					  *@param 0,0,0,0 分别代表目标点的x坐标和y坐标，源点的x坐标和y坐标
					  *@param $newwidth 目标图像的宽
					  *@param $newheight 目标图像的高
					  *@param $width 原图像的宽
					  *@param $height 原图像的高
					  */
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					//设置缩略图保存路径
					$new_file = './img/images/portrait/'.$info['username'].'.jpg';
					//保存缩略图到指定目录
					if(imagejpeg($thumb,$new_file,100)){
						if($this->is_exist($info['username'])){
							$arr = array('portrait'=>$new_file);
							$where = " `username`='".$info['username']."'";
							DB::update('userinfo',$arr,$where);
							return true;
						}
						else
							return false;
							
					}	
					else 
						return false;
						
				}
			}
		}

		function is_exist($username){
			$sql = "select `username`  from `userinfo`";
			if(DB::query($sql))
				return true;
			else
				return false;
		}
	}
?>