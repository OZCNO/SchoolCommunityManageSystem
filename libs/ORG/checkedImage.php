<?php
//登录的验证码生成文件
	//新建验证码的文件
	/*
		@$img_w:要生成的验证码的宽度
		@$img_h:要生成的验证码的高度
		@$count:验证码的码值数，默认为4
		@$fontSize:字体大小
		return:none
	*/
	function createCheckedImage($img_w,$img_h,$count=4,$fontSize=20){
		@session_start();
		//生成一个有a-z，1-9的数组
		$arr=array_merge(range('A','Z'),range('a','z'),range(1,9));
		$str="";//存放验证码的码值
		for($i=0;$i<$count;$i++){
			 $str.= $arr[rand(0,60)];
		}
		$_SESSION['checkedString']=md5(strtolower($str));
		//生成画布
		$img=imagecreatetruecolor($img_w,$img_h);
		//生成背景色
		$bg_color=imagecolorallocate($img,0xf0,0xf0,0xf0);
		//设置画布的背景色
		imagefill($img,0,0,$bg_color);
		//设置字体
		$fontName="./img/font/ARIALUNI.TTF";
		
		//获取每一个码值的宽高
		$str_w=imagefontwidth($fontSize);
		$str_h=imagefontheight($fontSize);
		
		//验证码码值的起始宽高
		$x=($img_w-($str_w*$count))/2;
		$y=($img_h)/2+11;
		
		for($i=0;$i<9;$i++){
			$color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imageline($img,mt_rand(0,$img_w),mt_rand(0,$img_h),mt_rand(0,$img_w),mt_rand(0,$img_h),$color);
		}
		for($i=0;$i<$count;$i++){
			//给字体设置颜色
			$str_color=imagecolorallocate($img,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
			imagettftext($img,$fontSize,mt_rand(5,55),$x,$y,$str_color,$fontName,$str[$i]);
			$x+=$str_w+4;
		}
		header('Content-type:image/png');
		imagepng($img);
		imagedestroy($img);
	}

?>