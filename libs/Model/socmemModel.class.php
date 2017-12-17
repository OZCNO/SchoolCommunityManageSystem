<?php
	class socmemModel{
		public $page_max;
		private $sort;

		/**
		  *getSocMember 方法 获取社团成员表格信息
		  *$para : 传入的参数 soc:获取全部社团成员 pend:获取全部待审社团成员 
		  *			search:按条件查询社团成员 search_pend:按条件查询待审社团成员
		  *return: 数组 包含 社团会员信息(已通过社团审核)    
		  */
		function getSocMember($para){
			//初始化
			@session_start();
			if(isset($_SESSION['societyinfo'])){
				//用户已经登录 
				$socManager = $_SESSION['societyinfo'];
				$value =$socManager['admin_username'];
				$table = 'societyinfo';


				///*排序功能拓展
				
				if($rst = $this->sort())
					$sql_order = $rst;
				else
					$sql_order = null;
				// 到时候在fetch方法加进order语句
				// 默认传入$sql_ord = "order by us.`date_of_entry` desc"
				// */




				//获取完整过审社团成员信息
				if($para == 'soc'){  
					$socmem = json_decode($this->fetch($value,$table,1,null,$sql_order),true);
					return $socmem;
				}



				//获取全部待审社团成员信息
				else if($para =='pend'){
					$pendmem = json_decode($this->fetch($value,$table,0,null,$sql_order),true);
					return $pendmem;
				}



				//社团成员的检索
				else if($para == 'search' || $para == 'search_pend'){
					//若检测到post了查询的关键信息
					if($_POST){
						//把相关信息存入temp临时数组并去掉传入的空值元素
						$temp = array();
						foreach ($_POST as $key => $arr_value) {
							//用临时数组$temp存放查询的条件
							$temp[$key]=$arr_value;
							//没有输入的查询条件从临时数组中除掉
							if($arr_value=='')
								unset($temp[$key]);
						}
						if(!empty($temp)){
							//根据传入的参数变更查询条件
							switch ($para) {
								case 'search':
									$searchmem = json_decode($this->fetch($value,$table,2,$temp,$sql_order),true);
									break;
								case 'search_pend':
									$searchmem = json_decode($this->fetch($value,$table,3,$temp,$sql_order),true);
									break;
								
								default:
									die('查询错误');
									break;
							}
							if($result = $searchmem)
								return $result;	
							else
								return false;
						}
						
					
					}
					//没有关键信息post 则从session获取 
					else if($_SESSION['search_sql']){
						// $temp = $_SESSION['temp'];
						$sql = $_SESSION['search_sql'];
						switch ($para) {
								case 'search':
									// $searchmem = json_decode($this->fetch($value,$table,2,$temp),true);
									$searchmem = json_decode($this->fetch(null,null,null,null,$sql_order,$sql),true);
									break;
								case 'search_pend':
									$searchmem = json_decode($this->fetch(null,null,null,null,$sql_order,$sql),true);
									// $searchmem = json_decode($this->fetch($value,$table,3,$temp),true);
									break;
								
								default:
									die('查询错误');
									break;
						}
						// $searchmem = json_decode($this->fetch($value,$table,2,$temp),true);
						if($result = $searchmem)
							return $result;	
						else
							return false;
					}
				}
				else
					return false;
				
			}
			else{
				// alertBack("请先登录");
				return false;
			}
		}
		
		
		/**
		  *fetch 方法  
		  *$value: 传入sql查询相关的值
		  *$table : 数据库表
		  *$flag: 一个标志 用于识别不同的数据库操作 1:获取过审社团成员   0:获取待审社团成员  2\3:搜索过审、待审成员
		  *$where: 条件 该值传入为关联数组 此处用于 成员模糊查询 like 
		  *$sql:sql语句 已存入session的sql语句可以直接传入调用
		  */
		
		function fetch($value=null,$table=null,$flag=null,$where=null,$order=null,$sql=null){
			if($flag ===1){
				//sql 语句
				// $sql = "select sm.* from ".$table." as t,`society_member` as sm where `susername` = '$value' and t.sName=sm.sName and review = '1'" ;
				$sql = "select * from ".$table." as si,`user_sno` as us,`userinfo` as ui where `susername` = '$value' and si.`sno`=us.`sno` and us.`username`=ui.`username` and `review`='1'";
			}
			else if($flag ===0){
				//sql 语句
				// $sql = "select sm.* from ".$table." as t,`society_member` as sm where `susername` =  '$value'  and t.sName=sm.sName and review = '0'" ;
				$sql = "select * from ".$table." as si,`user_sno` as us,`userinfo` as ui where `susername` = '$value' and si.`sno`=us.`sno` and us.`username`=ui.`username` and `review`='0'";
			}
			else if ($flag === 2 || $flag === 3 ) {
				switch ($flag) {
					case '2':
						// $sql = "select sm.* from ".$table." as t,`society_member` as sm where `susername` = '$value' and t.sName=sm.sName and review = '1'" ;
						$sql = "select * from ".$table." as si,`user_sno` as us,`userinfo` as ui where `susername` = '$value' and si.`sno`=us.`sno` and us.`username`=ui.`username` and `review`='1'";
						break;
					case '3':
						// $sql = "select sm.* from ".$table." as t,`society_member` as sm where `susername` = '$value' and t.sName=sm.sName and review = '0'" ;
						$sql = "select * from ".$table." as si,`user_sno` as us,`userinfo` as ui where `susername` = '$value' and si.`sno`=us.`sno` and us.`username`=ui.`username` and `review`='0'";
						break;
					default:
						die('获取查询数据过程出错');
						break;
				}
				if(!empty($where)){
					$sql .= " and (";
					foreach ($where as $key => $arr_value) {
						$arr_value = '%'.$arr_value.'%';
						$sql .= " ui.`$key` like '$arr_value' and";
					}
					$sql = substr($sql, 0,-3);
					$sql .=")";
				}
				// 执行完查询以后将sql语句存入session下次直接query
				$_SESSION['search_sql'] = $sql;
			}
			else
				$sql = isset($sql)?$sql:"select `sName` from ".$table." where  `susername` =  '$value' ";
			//拼接order语句
			$sql .= isset($order)?$order:' order by us.`date_of_entry` desc';
			//查询
			DB::query($sql);
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
		/**
		  *sort() 获取排列方式 并生成sql 的order语句
		  *$fields:允许排列的合法字段
		  *$order:需进行排列的字段
		  *$sort:排列方式  asc 或 desc
		  *return:$sql_order  or  false
		  */
		function sort(){
			$fields = array('name','sex','ui.username','dept','tel','wechat','smRemark','date_of_entry');
			//获得字段
			$order = isset($_GET['order']) ? $_GET['order'] : '';
			//获取排列方式
			$sort = isset($_GET['sort'])?$_GET['sort']:''; 
			if($order=='username'){
				$order = 'ui.username';
			}
			if(in_array($order,$fields)){
				if( $sort == 'desc'){
					//组合order子句   order by 字段 desc
					$sql_order = "order by $order desc";
					return $sql_order;
				}
				else{
					//条件不成立，组合order子句   order by 字段 asc
					$sql_order = "order by $order asc";
					return $sql_order;
				}
			}
			else 
				return false;
		}
		
			
	}
?>