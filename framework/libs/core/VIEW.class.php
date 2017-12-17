<?php
	class VIEW{
		public static $sview;
		/**
		*初始化视图引擎
		*$viewname:视图引擎的类名
		*$config:设置该视图引擎的配置信息，以关联数组的形式，默认为一个空数组
		*return: none
		*/
		public static function init($viewname,$config=array()){
			static::$sview=new $viewname;
			if(!empty($config)){
				foreach($config as $key=>$value){
					static::$sview->$key=$value;
				}
			}
		}
		
		/**
		*封装了smarty的assign方法，可以一次性传递多个数据， 一关联数组的形式
		*$arr：要赋值的数据，关联数组的形式，默认为空数组
		*return:none
		*/
		public static function assign($arr=array()){
			if(!empty($arr)){
				foreach($arr as $key=>$value){
					self::$sview->assign($key,$value);
				}
			}
			
		}
		
		public static function _assign($key,$value){
			self::$sview->assign($key,$value);
		}
		
		/**
		*封装了smarty的display方法，不使用smarty的缓存机制
		*$date：要展示的html文件,默认为空
		*return:none
		*/
		public static function display($date=null){
			if(!empty($date)){
				self::$sview->display($date);
			}
		}
	}
?>