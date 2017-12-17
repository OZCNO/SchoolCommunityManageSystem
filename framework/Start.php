<?php
	/*框架的启动引擎类*/
	//包含框架中所有的类文件
	error_reporting( E_ALL&~E_NOTICE );
	require_once('include_list.php');
	foreach($list as $value){
		require_once($value);
	}
	
	class Start{
		private static $config;
		private static $controller;
		private static $method;
		
		//初始化试图引擎类
		private static function init_view(){
			VIEW::init("Smarty",self::$config['smarty_config']);
		}
		
		//初始化数据库引擎类;
		private static function init_db(){
			DB::init("mysqll",self::$config['db_config']);
		}
		
		//启动程序
		public static function run($config,$first,$mFirst){
			self::$config=$config;
			self::init_view();
			self::init_db();
			if (isset($_SERVER['QUERY_STRING']) && !isset($_GET['controller']) && !isset($_GET['method'])) {
				require('function/url_encode.php');
				$url_info = geturl($_SERVER['QUERY_STRING'],$key_url_md_5);//接收所有参数
				$c=isset($url_info['controller'])?$url_info['controller']:$first;
				$m=isset($url_info['method'])?$url_info['method']:$mFirst;
				self::$controller=$c;
				self::$method=$m;
			}
			else{
				self::$controller=isset($_GET['controller'])?$_GET['controller']:$first;
				self::$method=isset($_GET['method'])?$_GET['method']:$mFirst;
			}

			$obj=C(self::$controller,self::$method);
			
		}
	}



		
?>