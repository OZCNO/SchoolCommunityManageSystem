<?php
	class activityModel{
		public function activity(){
			@session_start();
			$sql="select `aNO`,`aName`,`hName`,`date_of_entry`,`location`,`category` from `scu_activity`";
			DB::query($sql);
			if(($arr['page']=DB::makePage(10))>0){
				$_SESSION['sql']=$sql;
				$arr['date']=DB::getPage(1);
			}	
			else{
				unset($_SESSION['sql']);
				$arr['page']=1;
			}
			return $arr;
		}
		
		public function getPage($p){
			@session_start();
			if(isset($_SESSION['sql'])){
				DB::query($_SESSION['sql']);
				if(($arr['page']=DB::makePage(10))>0){
					$arr['date']=DB::getPage($p);
				}	
			}else{
				$arr['page']=1;
			}
				
			return $arr;
		}
		
		public function getDate_activity(){
			$aNO=$_POST['aNO'];
			$sql="select `aNO`,`aName`,`aContent`,`location`,`hName`,`category` from `scu_activity` where `aNO`={$aNO}";
			DB::query($sql);
			return DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
		}
		
        //修改活动
        public function activitySubmit(){
            $aImg=trim(self::getImageUrl($_POST['editorValue']));
            return DB::update("scu_activity",array("aName"=>$_POST['aname'],"hName"=>$_POST['hname'],"location"=>$_POST['location'],'aContent'=>$_POST['editorValue'],'aImg'=>$aImg,'category'=>$_POST['category']),"ssssss","`aNO`=".$_POST['aNO']);

        }

        //获取活动内容中图片的路径
        public function getImageUrl($text){
            preg_match_all('/\<img\s+src\=\"([\w:\/\.]+)\"/',$text,$result);
            $res=" ";
            foreach($result[1] as $v){
                $res=$res.$v.",";
            }
            return substr($res,0,-1);
        }

        //添加新活动
        public function activityAdd(){
            $aImg=trim(self::getImageUrl($_POST['editorValue']));
            return DB::insert("scu_activity",array("aName"=>$_POST['aname'],"hName"=>$_POST['hname'],"location"=>$_POST['location'],'aContent'=>$_POST['editorValue'],'aImg'=>$aImg,'category'=>$_POST['category']),"ssssss");
        }

        //删除活动对应的照片
        public function activityDel(){
            DB::query("select `aImg` from `scu_activity` where `aNO`={$_POST['aNO']}");            
            $arr=DB::fetch(DB::FETCH_ONE,DB::FETCH_ASSOC);
            $arr=json_decode($arr);
            $arr=explode(',',$arr->aImg);
            foreach($arr as $v){
                $path=getcwd().'/'.substr($v,8);
                if(is_file($path))
                    unlink($path);
            }
        }

            
	}
?>
