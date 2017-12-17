<?php
	class sManageController{
		
	//活动发布
		public function activity(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('activity');
				$arr=$model->activity();
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",1);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_5.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		public function activityGetpage(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('activity');
				$arr=$model->getPage($_GET['page']);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",$_GET['page']);
					VIEW::_assign("page",$arr['page']);
					
				}
				VIEW::display('admin/scuManagement_5.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		public function activityUpdate(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('activity');
				$arr=$model->getDate_activity();
                $arr=json_decode($arr);
                VIEW::_assign("data",$arr);
                VIEW::display('admin/scuManagement_5_3.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		public function activitySubmit(){
			$model=M('activity');
		    $name=$model->activitySubmit();
			if($name>0){
				alertGO('更新成功','admin.php?controller=sManage&method=activity');
			}else{
				alertGO('更新失败了','admin.php?controller=sManage&method=activity');
            }
		}
		
		public function activity_add(){
			$model=M('activity');
			$name=$model->activityAdd();
			if($name!=false){
				alertGO('发布活动成功','admin.php?controller=sManage&method=activity');
			}
			else{
				alertGO('发布活动失败','admin.php?controller=sManage&method=activity');
            }
		}
		
		public function activityDel(){
            $model=M('activity');
            $model->activityDel();//删除活动对应的照片
			if(DB::del('scu_activity',"aNO={$_POST['aNO']}")>0)
				echo json_encode(array('success'=>true));
			else
				echo json_encode(array('success'=>false));
            
		}
        
        //删除多余的上传的图片
        public function remove($dir="img/images/upload",$qian='/SCU/web/'){
			@session_start();
			if(!empty($_SESSION['admin'])){
                $handler=opendir($dir);
                while(($filename=readdir($handler))!==false){
                    if($filename != "." && $filename !=".."){
                        $fullpath=$dir.'/'.$filename;
                        $hand=opendir($fullpath);
                        $i=0;
                        while(($file=readdir($hand))!==false){
                            if($file != "." && $file!=".."){
                                $files[]=($qian.$fullpath.'/'.$file);
                                $i++;
                            }
                        }
                        if($i==0){
                            rmdir($fullpath);
                        }
                        closedir($hand);
                    }
                }
                closedir($handler);
                $sql="select `aImg` from `scu_activity`";
                DB::query($sql);
                $arr=DB::fetch(DB::FETCH_ALL,DB::FETCH_ASSOC);
                foreach(json_decode($arr) as $v){
                    $v=explode(',',$v->aImg);
                    foreach($v as $k){
                        $tFiles[]=$k;
                    }
                }
                foreach($files as $k){
                    if(!in_array($k,$tFiles)){
                        $temp=getcwd().substr($k,8);
                        if(is_file($temp))
                            unlink($temp);               
                    }
                }
                self::activity();
            }
            else{
				alertGO("请先登录","admin.php");
            }
        }
        
	
	//现有社团
		//显示页面
        public function now(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				//当有查询框有数据时，接收数据
				$realname=isset($_POST['realname'])?$_POST['realname']:'';
				$department=isset($_POST['department'])?$_POST['department']:'';
				
				//实例化模板，并调用方法
				$model=M('now');
				if(empty($_POST))
					$arr=$model->now();
				else
					$arr=$model->nowFind($realname,$department);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",1);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_3.html');
			}
			else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//获取现有社团数据
		public function getNow(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('now');
				$arr=$model->getNow();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
		
		//根据页码获取现有社团页
		public function nowgetPage(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('now');
				$arr=$model->getPage($_GET['page']);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",$_GET['page']);
					VIEW::_assign("page",$arr['page']);
					
				}
				VIEW::display('admin/scuManagement_3.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//删除所选页面
		public function nowDelete(){
			$model=M('now');
			foreach($_POST as $k=>$v)
				$arr=$k;
			$arr=$model->delMember($arr);
			echo $arr;
		}
		
		
	//活动注册审核
		//显示页面
		public function activeReg(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('activeReg');
				$arr=$model->getActiveReg();
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",1);
					VIEW::_assign("page",$arr['page']);
					
				}
				VIEW::display('admin/scuManagement_4.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//获取指定页
		public function activeRegGetpage(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('activeReg');
				$arr=$model->activeRegGetpage($_GET['page']);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",$_GET['page']);
					VIEW::_assign("page",$arr['page']);
					
				}
				VIEW::display('admin/scuManagement_4.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//获取审核信息
		public function activeCheck(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('activeReg');
				$arr=$model->checkActiveReg();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//审核
		public function activeSubmit(){
			$model=M('activeReg');
			$arr=$model->activeSubmit();
			echo $arr;
		}
		
		
		
	//年度注册审核
		//显示页面
		public function yearReg(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('yearReg');
				$arr=$model->getYearReg();
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",1);
					VIEW::_assign("page",$arr['page']);
					
				}
				VIEW::display('admin/scuManagement_2.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//获取审核信息
		public function yearCheck(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('yearReg');
				$arr=$model->checkYearReg();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//审核
		public function checkSubmit(){
			$model=M('yearReg');
			$arr=$model->checkSubmit();
			echo $arr;
		}
		
		//获取指定页
		public function yearRegGetpage(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('yearReg');
				$arr=$model->yearRegGetpage($_GET['page']);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",$_GET['page']);
					VIEW::_assign("page",$arr['page']);
					
				}
				VIEW::display('admin/scuManagement_2.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}

	
		
		
	//管理成员模块（校社联人员）
	
		//显示或查询页面
		public function scuShow(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				//当有查询框有数据时，接收数据
				$realname=isset($_POST['realname'])?$_POST['realname']:'';
				$department=isset($_POST['department'])?$_POST['department']:'';
				
				//实例化模板，并调用方法
				$model=M('scuManage');
				if(empty($_POST))
					$arr=$model->showMember();
				else
					$arr=$model->getMember($realname,$department);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",1);
					VIEW::_assign("page",$arr['page']);
					
				}
				VIEW::display('admin/scuManagement_1.html');
			}
			else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//获取指定页
		public function getPage(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('scuManage');
				$arr=$model->getPage($_GET['page']);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",$_GET['page']);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_1.html');
			}else{
				alertGO("请先登录","admin.php");
			}
		}
		
		//删除所选页面
		public function scuDelete(){
			$model=M('scuManage');
			foreach($_POST as $k=>$v)
				$arr=$k;
			$temp=$model->delMember($arr);
			echo $temp;
			
		}
		
		//获取所选数据
		public function scusUpdate(){
			$model=M('scuManage');
			foreach($_POST as $k=>$v)
				$arr=$k;
			$arr=$model->getUpdateMember($arr);
			echo $arr;
		}
		
		
		//更新数据
		public function scuUpdate(){
			$model=M('scuManage');
			echo $model->updateMember();

			alertGO("更新成功","admin.php?controller=sManage&method=scuShow");
		}
		
		
		//添加页面
		public function scuAdd(){
			$model=M('scuManage');
			$temp=$model->addMember();
			if($temp==0||$temp==false){
				alertGO("添加失败","admin.php?controller=sManage&method=scuShow");
			}else{
				alertGO("添加成功","admin.php?controller=sManage&method=scuShow");
			}
			unset($_POST);
		}
    //信息反馈模块
        //获取当前所有的反馈信息，默认由iframe调用
        public function msgFeedback(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('feedback');
				$arr=$model->index();
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",1);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_6.html');
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //根据页码获取信息反馈内容
        public function msgFeedbackPage(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('feedback');
				$arr=$model->getPage($_GET['page']);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",$_GET['page']);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_6.html');
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //根据id获取数据，通过ajax调用
        public function msgFeedbackGet(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('feedback');
				$arr=$model->getDataById();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //回复信息反馈
        public function msgFeedbackPost(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('feedback');
				$arr=$model->insertInto();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //删除信息反馈
        public function msgFeedbackDel(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('feedback');
				$arr=$model->del();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
    //账号管理模块
        //显示账号管理模块，默认由iframe调用
        public function scuAccount(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('scuaccount');
				$arr=$model->index();
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",1);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_7.html');
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //根据页码获取数据
        public function scuAccountPage(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('scuaccount');
				$arr=$model->getPage($_GET['page']);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",$_GET['page']);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_7.html');
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //根据id获取数据，通过ajax调用
        public function scuAccountGet(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('scuaccount');
				$arr=$model->getDataById();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //确认修改
        public function scuAccountSubmit(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('scuaccount');
				$arr=$model->update();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}

        }
        //删除管理员账号
        public function scuAccountDel(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('scuaccount');
				$arr=$model->del();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //添加管理员账号
        public function scuAccountPost(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('scuaccount');
				$arr=$model->add();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //判断用户名是否存在
        public function scuAccountExist(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('scuaccount');
				$arr=$model->exist();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
    //社团管理员模块
        //显示账号管理模块，默认由iframe调用
        public function socAccount(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('socaccount');
				$arr=$model->index();
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",1);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_8.html');
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //根据页码获取数据
        public function socAccountPage(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('socaccount');
				$arr=$model->getPage($_GET['page']);
				if(is_array($arr)){
					if(isset($arr['date'])){
						VIEW::_assign("arr",json_decode($arr['date']));
					}
					VIEW::_assign("p",$_GET['page']);
					VIEW::_assign("page",$arr['page']);
				}
				VIEW::display('admin/scuManagement_8.html');
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //根据id获取数据，通过ajax调用
        public function socAccountGet(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('socaccount');
				$arr=$model->getDataById();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }
        //确认修改
        public function socAccountSubmit(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('socaccount');
				$arr=$model->update();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}

        }
        //判断用户名是否存在
        public function socAccountExist(){
			@session_start();
			if(!empty($_SESSION['admin'])){
				$model=M('socaccount');
				$arr=$model->exist();
				echo json_encode($arr);
			}else{
				alertGO("请先登录","admin.php");
			}
        }

    //外层框架调用的方法
        public function iframe(){
            @session_start();
			if(!empty($_SESSION['admin'])){
				VIEW::_assign("usr",$_SESSION['admin']['username']);
                if(!empty($_GET['a'])){
                    switch($_GET['a']){
                    case "now":
				        VIEW::_assign("jsurl","scuManagement_3.js");
                        break;
                    case "activity":
				        VIEW::_assign("jsurl","scuManagement_5.js");
                        break;
                    case "activeReg":
				        VIEW::_assign("jsurl","scuManagement_4.js");
                        break;
                    case "yearReg":
				        VIEW::_assign("jsurl","scuManagement_2.js");
                        break;
                    case "scuShow":
				        VIEW::_assign("jsurl","scuManagement_1.js");
                        break;
                    case "msgFeedback":
				        VIEW::_assign("jsurl","scuManagement_6.js");
                        break;
                    case "scuAccount":
				        VIEW::_assign("jsurl","scuManagement_7.js");
                        break;
                    case "socAccount":
                        VIEW::_assign("jsurl","scuManagement_8.js");
                        break;
                    default:
                        VIEW::_assign("jsurl","scuManagement_1.js");
                    }
                    
                    VIEW::_assign("url",$_GET['a']);
                }
                else{
                    VIEW::_assign("url","scuShow");
                }
                VIEW::_assign('host',$GLOBALS['host']);
				VIEW::display('admin/scuManagement.html');
			}else{
				alertGO("请先登录","admin.php");
			}
        }    
        //显示活动发布
        public function activityShow(){
            VIEW::display('admin/scuManagement_5_2.html');
        }
    }
?>
