<?php
	//数据库引擎类
	class DB{
		
		const FETCH_ONE='getone';
		const FETCH_ALL='getall';
		const FETCH_OBJ='getobj';
		const FETCH_NUM=MYSQL_NUM;
		const FETCH_ASSOC=MYSQL_ASSOC;
		const FETCH_BOTH=MYSQL_BOTH;
		
		private static $page;//存放总页数
		private static $arr=null;//存放分页后每一页的数据
		private static $db;//存储实例化mysql类的对象
		//初始化数据库
		public static function init($name,$config){
			self::$db=new $name;
			if(!empty($config)){
				self::$db->connect($config);
			}else{
				return false;
			}
		}
		
		//执行sql语句,返回执行结果，一般用于create,grand,select等操作
		//若是要执行insert，update，delete操作可使用，insert，update,delete方法
		public static function query($sql,$params=[]){
			if(!empty($sql)){
				return self::$db->query($sql,$params);
			}
			else{
				return false;
			}
		}
		
		//返回结果集中的行数
		public static function numRows(){
			return self::$db->numRows();
		}
		
		//返回结果集中的列数
		public static function fields(){
			return self::$db->fields();
		}
		
		//获取数据库使用的字符集
		public static function getCharset(){
			return self::$db->getCharset();
		}
		
		//设置数据库连接的字符集
		public static function setCharset($charset=null){
			if(!empty($charset)){
				return self::$db->setCharset($charset);
			}else{
				return false;
			}
		}
		
		/**分页
		$content:每页的行数
		return :分的页数
		*/
		public static function makePage($content){
			self::$page=ceil(self::numRows()/$content);
			if(self::$page<=0)
				return false;
			for($i=0;$i<self::$page;$i++)
				self::$arr[]=self::fetchNum($content);
			return self::$page;
		}
		
		/**获取指定页的数据
		$i:页码（从1到总页数）
		return :json格式的数据
		*/
		public static function getPage($i){
			if($i<1||$i>count(self::$arr))
				return false;
			return json_encode(self::$arr[$i-1]);
		}
		
		/**
		*获取指定行数的结果集，
		*$num：行数
		*return :json格式的字符串  
		*/
		public static function fetchNum($num){
			$arr=null;
			for($i=0;$i<$num;$i++){
				$temp=self::$db->fetchOne(DB::FETCH_ASSOC);
				if(!$temp){
					break;
				}
				$arr[]=$temp;
			}
			return $arr;
		}
		
		//设置结果集的偏移量
		public static function seek($offest=null){
			$temp=self::$db->seek($offest);
			return $temp;
			
		}
		
		/*获取结果集中的数据,
		$type的可选值为DB::FETCH_ALL,DB::FETCH_ONE,DB::FETCH_OBJ
		$dateType的可选值为DB::FETCH_NUM,DB::FETCH_ASSOC,DB::FETCH_BOTH
		return json数据*/
		public static function fetch($type,$dateType){
			switch($type){
				case DB::FETCH_ONE:
					$jsstr=json_encode(self::$db->fetchOne($dateType));
					break;
				case DB::FETCH_ALL:
					$jsstr=json_encode(self::$db->fetchAll($dateType));
					break;
				case DB::FETCH_OBJ:
					$jsstr=json_encode(self::$db->fetchObject());
					break;
				default:$jsstr="";
			}
			return $jsstr;
		}
		
		//返回上一次执行所影响的行数
		public static function affectedRows(){
			return self::$db->affectedRows();
		}
		
		//返回上一次插入的id
		public static function insertId(){
			return self::$db->insertId();
		}
		
		//释放结果集
		public static function freeResult(){
			self::$db->freeResult();
		}
		
		//插入数据
		public static function insert($table,$arr,$type){
			if(!empty($table)){
				return self::$db->insert($table,$arr,$type);
			}else{
				return false;
			}
		}
		
		//更新数据
		public static function update($table,$arr=array(),$type=null,$where=null){
			if(!empty($table)){
				return self::$db->update($table,$arr,$type,$where);
			}else{
				return false;
			}
		}
		
		//删除数据
		public static function del($table,$where){
			if(!empty($table)){
				return self::$db->del($table,$where);
			}else{
				return false;
			}
		}
		
	}

?>
