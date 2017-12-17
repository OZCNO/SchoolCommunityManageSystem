<?php
	class mysqll{
		private static $db;
		private static $result;
        private static $stmt;
		/**
		*连接数据库
		*$config:为连接数据库的配置信息，采用关联数组的形式，默认为一个空数组
		*error:throw a exception,
	     **/
		function connect($config=array()){
			$host=isset($config['host'])?$config['host']:"";
			$user=isset($config['user'])?$config['user']:"";
			$password=isset($config['password'])?$config['password']:"";
			$dbname=isset($config['dbname'])?$config['dbname']:"";
			$charset=isset($config['charset'])?$config['charset']:"utf8";
            $db=new mysqli($host,$user,$password,$dbname);
			if(mysqli_connect_errno()){
				throw new Exception(mysqli_conncet_error());
			}
			self::$db=$db;
			$this->setCharset($charset);
		}
	    /**
         * 设置字符集
         * $charset:字符集
         * return:success=$charset,failure=throw a exception
         * */	
		function setCharset($charset){
			$flag=self::$db->set_charset($charset);
			if(!$flag){
				throw new Exception(self::$db->error);
			}
            else{
				return self::$db->character_set_name();
			}
		}
		
        /**
         * 获取数据库使用的字符集
		 **/
		function getCharset(){
			return self::$db->character_set_name();
		}
		
		/**
		*执行sql语句
		*$sql: 要执行的sql语句
        $params:第一个元素为要传递的参数类型值，后面传的元素要是引用类型
		*retrun: 执行失败return false,执行SELECT, SHOW, DESCRIBE或 EXPLAIN查询会返回一个mysqli_result 对象，其他查询则返回TRUE。
		*/
		function query($sql,$params=[]){
            self::$stmt=self::$db->prepare($sql);
            if(!empty($params)){
                $flag=call_user_func_array(array(self::$stmt,"bind_param"),$params);
                if($flag){
                    self::$stmt->execute();
                    if(method_exists(self::$stmt,'get_result'))
                        self::$result=self::$stmt->get_result();
                    return true;
                }
                else
                    return false;
            }else{
                self::$stmt->execute();
                if(method_exists(self::$stmt,'get_result'))
                    self::$result=self::$stmt->get_result();
                return true;
            }
		}
		
		/**
		*设置结果集的偏移量
		*$offest:要设置的偏移量，从0开始， 默认为0,最大为numRows-1；
		*retrun: false or true
		*/
		function seek($offest=0){
			$offest=intval($offest);
			if($offest<0||$offest>=$this->numRows())
                return false;
            if(self::$result)
                return self::$result->data_seek($offest);
            else
                return false;
		}
		
		/**
		*从结果集中获取一行数据，并封装成一位数组
		*$type:获取数组的类型，三选一,MYSQLI_ASSOC,MYSQLI_NUM,MUSQLI_BOTH
		*return:false or 数组
		*/
		function fetchOne($type=MYSQLI_ASSOC){
			if(empty(self::$result))
				throw new Exception("结果集为空，请先执行查询，再获取数据");
			return self::$result->fetch_array($type);
		}
		
		/**
		*从结果集中获取全部数据，并封装成二维数组
		*$type:获取数组的类型，三选一,MYSQLI_ASSOC,MYSQLI_NUM,MUSQLI_BOTH
		*return:空数组 or 二维数组
		*/
		function fetchAll($type=MYSQLI_ASSOC){
			if(empty(self::$result))
				throw new Exception("结果集为空,请先执行查询，再获取数据");
			while($r=self::$result->fetch_array($type)){
				$arr[]=$r;
			}
			return isset($arr)?$arr:array();
		}
		
		/**
		*从结果集中获取一列数据，并封装成一个新对象
		*return: 对象 or false
		*/
		function fetchObject(){
			if(empty(self::$result))
				throw new Exception("结果集为空,请先执行查询，再获取数据");
			return self::$result->fetch_object();
		}
		
		/**
		*返回上一次查询影响的行数
		*return:执行成功则返回>=0的整数，失败返回-1
		*/
		function affectedRows(){
            if(!empty(self::$stmt)){
                return self::$stmt->affected_rows;
            }
            return false;
		}
		
		/**
		*返回上次插入语句，自增长的id,失败return false
		*/
		function insertId(){
			if(!empty(self::$db))
				return self::$db->insert_id;
			else
				return false;
		}
		
		
		/**
		*获取结果集的列数
		*return: >=0
		*/
		function fields(){
			if(!empty(self::$result))
				return self::$result->field_count;
			else
				throw new Exception("请先执行查询");
		}
		
		
		/**
		*获取结果集数据的行数
		*return:false or >0的整数
		*/
		function numRows(){
			if(!empty(self::$result)){
				$temp=self::$result->num_rows;
				if($temp<=0)
					return false;
				else
					return $temp;
			}else
			    throw new Exception("请先执行查询");
		}
		
		/*释放结果集
		*/
		function freeResult(){
			if(!empty(self::$result))
				self::$result->free();
		}
		
		/**
		*往表中插入数据
		*$table:要插入的表
		*$arr:要字段以及值
        *$type:参数的类型
		*return: false or 插入的id
		*/
		function insert($table,$arr=array(),$type){
			if(!empty($arr)){
				foreach($arr as $key=>&$value){
					$k[]='`'.$key.'`';
					$v[]=&$value;
                    $t[]="?";
				}
			}
			if(!empty($table)){
				$sql='insert into `'.$table.'`';
				$strk=implode(',',$k);
				$strv=implode(',',$t);
				$sql.='('.$strk.')  ';
                array_unshift($v,$type);
                $sql.='values('.$strv.')';
				self::$result=$this->query($sql,$v);
				return true;
			}else{
				return false;
			}
		}
		
		
		/**
		*更新表中的数据
		*$table:要更新的表
		*$arr:要更新的字段及值
		*$where:条件
		*return: false or 影响的行数
		*/
		function update($table,$arr=array(),$type=null,$where=null){
			if(!empty($table)){
				$sql="update `$table` set  ";
				foreach($arr as $key=>&$value){
                    $sql.='`'.$key.'`'.'='.'?'.',';
                    $v[]=&$value;
				}
				$sql=substr($sql,0,count($sql)-2);
				$sql.="    ";
				if(!empty($where)){
					$sql.=' where   '.$where;
                }
                if(!empty($v))
                    array_unshift($v,$type);
				$this->query($sql,$v);
				return $this->affectedRows();
			}else
				return false;
		}
		
		/*
		*删除表中的数据
		*$table:表名
		*$where:条件
		*return: false or 影响的行数
		*/
		function del($table,$where){
			if(!empty($table)){
				$sql="delete from `$table`     ";
				if(!empty($where)){
					$sql.='  where '.$where;
				}
				$this->query($sql);
				return $this->affectedRows();
			}else
				return false;
		}
	}
    
?>
