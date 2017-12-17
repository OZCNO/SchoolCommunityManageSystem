
<?php
	class socmemController{
		//社团成员管理 控制器
		
		
		private $sName;//私有属性sName 社团名称
		/**
		  *构造方法
		  *给属性sName赋值 无需多次调用
		  */
		function __construct(){
			$obj = M('regSubmit');
			$this->sName = $obj->getsName();
		}

        function iframe(){
            @session_start();
			if(isset($_SESSION['societyinfo'])){
				if(isset($this->sName))
				    VIEW::_assign('sName',$this->sName);
                if(!empty($_GET['a'])){
                	switch ($_GET["a"]) {
                		case 'socMember':
                			VIEW::_assign("jsurl","backstageManagement_1.js");
                			break;
                		case 'pendMember':
                			VIEW::_assign("jsurl","backstageManagement_2.js");
                			break;
            			case 'regsubShow':
            				VIEW::_assign("jsurl","backstageManagement_3.js");
            				break;
            			case 'actsubShow':
            				VIEW::_assign("jsurl","backstageManagement_4.js");
            				break;
                		default:
                			VIEW::_assign("jsurl","backstageManagement_1.js");
                			
                	}
                    VIEW::_assign("url",$_GET['a']);
                }
                else{
                    VIEW::_assign("url","socMember");
                }
                VIEW::_assign("host",$GLOBALS['host']);
				VIEW::display('admin/backstageManagement.html');
			}else{
				alertGO("请先登录","admin.php");
			}
        }
		/**
		  *socMember 方法
		  *获取已经通过审核、或者社团管理员添加的 默认过审的社团成员
		  *$para : 传的参数 'soc'  
		  */
		function socMember(){ 
			$para = 'soc';
			$socmem = M('socmem');
			//获取社团成员信息数组
			$socmem_arr = $socmem->getSocMember($para);
			//获取当前page作为参数
			$page_now = isset($_GET['page'])?intval($_GET['page']):1;
			//获取page数组
			$page_arr = $socmem->page($page_now,$socmem->page_max);
            if(!$socmem_arr)
                $socmem_arr=null;
			VIEW::_assign('page',$page_arr);
		    VIEW::_assign('socmem',$socmem_arr);
			VIEW::display('admin/backstageManagement_1.html');
			
            }
		
		
		
		/**
		  *pendMember方法
		  *获取待审核的社团成员
		  *$para : 传的参数 'pend'  
		  */
		function pendMember(){ 
			$para = 'pend';
			$socmem = M('socmem');
			//获取社团成员信息数组
			$pendmem_arr = $socmem->getSocMember($para);
			//获取当前page作为参数
			$page_now = isset($_GET['page'])?intval($_GET['page']):1;
			//获取page数组
			$page_arr = $socmem->page($page_now,$socmem->page_max);
			if(!$pendmem_arr)
                $pendmem_arr=null;
			VIEW::_assign('page',$page_arr);
			VIEW::_assign('pendmem',$pendmem_arr);
			VIEW::display('admin/backstageManagement_2.html');
			}
			
		


		//用于显示社团年度注册表
		function regsubShow(){ 
            if(isset($this->sName))
				VIEW::_assign('sName',$this->sName);
			VIEW::display('admin/backstageManagement_3.html');
		}
		//用于显示活动申请表
		function actsubShow(){ 
			$actsub = M('actlist');
			//获取社团所提交的申请表
			$actlist_arr = $actsub->getActReview($this->sName);
			//获取当前page作为参数
			$page_now = isset($_GET['page'])?intval($_GET['page']):1;
			//获取page数组
			$page_arr = $actsub->page($page_now,$actsub->page_max);
            if(!$actlist_arr)
                $actlist_arr=null;
            if(isset($this->sName))
				VIEW::_assign('sName',$this->sName);
			VIEW::_assign('actlist',$actlist_arr);
			VIEW::_assign('page',$page_arr);
			VIEW::display('admin/backstageManagement_4.html');
		}
		
		//--------------------以下是成员查询的function ----------
		
		/**
		  *search方法
		  *通过关键字搜索 获取社团成员信息
		  *$para : 传的参数 'search'  
		  */
		function search(){
			$para = 'search';
			$search = M('socmem');
			$search->getSocMember($para);
			//获取查询的社团成员信息数组
			$search_arr = $search->getSocMember($para);
			//获取当前page作为参数
			$page_now = isset($_GET['page'])?intval($_GET['page']):1;
			//获取page数组
			$page_arr = $search->page($page_now,$search->page_max);
			if($search_arr){
				VIEW::_assign('page',$page_arr);
				VIEW::_assign('socmem',$search_arr);
				VIEW::display('admin/backstageManagement_1.html');
			}
			else 
				alertGo("未查询到相关成员信息",'admin.php?controller=socmem&method=socMember');

		}
		/**
		  *search方法
		  *通过关键字搜索 获取待审社团成员信息
		  *$para : 传的参数 'search_pend'  
		  */
		function search_pend(){
			$para = 'search_pend';
			$search = M('socmem');
			//获取未审核社团成员信息数组
			$search_arr = $search-> getSocMember($para);
			//获取当前page作为参数
			$page_now = isset($_GET['page'])?intval($_GET['page']):1;
			//获取page数组
			$page_arr = $search->page($page_now,$search->page_max);
			if($search_arr){
				VIEW::_assign('page',$page_arr);
				VIEW::_assign('pendmem',$search_arr);
				VIEW::display('admin/backstageManagement_2.html');
			}
			else 
				alertGo("未查询到相关成员信息",'admin.php?controller=socmem&method=pendMember');
		}


		//--------------------以下是成员操作的function 指向 socManageModel----------

		/**
		  *del
		  *删除社团成员 (已过审)
		  */
		function del(){
			$socManage = M('socManage');
			$result = $socManage->del();
			if($result === 'null'){
				echo "<script>location.href='admin.php?controller=socmem&method=socMember'</script>";
			}
			else if($result){
				$message = "删除完成! \\n";
				foreach ($result as $key => $value) {
					$message .= $key." ".$value."\\n";
				}
				alertGo($message,'admin.php?controller=socmem&method=socMember');
			}
			else{
				alertBack("该社团成员信息不存在或已删除");
			}

		}
		/**
		  *review
		  *审核社团成员 (未过审)
		  */
		function review(){
			$socManage = M('socManage');
			$result = $socManage->review();
			if($result === 'null'){
				echo "<script>location.href='admin.php?controller=socmem&method=pendMember'</script>";
			}
			else if($result){
				$message = "审核完成! \\n";
				foreach ($result as $key => $value) {
					$message .= $key." ".$value."\\n";
				}
				alertGo($message,'admin.php?controller=socmem&method=pendMember');
			}
			else{
				alertBack("审核失败:该社团成员信息不存在或已删除");
			}
		}
	}
?>
