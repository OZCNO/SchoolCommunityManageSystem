<?php
	/**
	*$name:实例化的控制器名
	*$method：要调用的方法，默认为空
	*return:控制器对象
	*/
	function C($name,$method=null){
		require_once('/../../libs/Controller/'.$name.'Controller.class.php');
		$name.='Controller';
		$obj=new $name;
		if($method!=null){
			$obj->$method();
		}
		return $obj;
	}
	
	/**
	*$name:实例化的模型名
	*return:模型对象
	*/
	function M($name){
		require_once('/../../libs/Model/'.$name.'Model.class.php');
		$name.='Model';
		return (new $name);
	}
	
	/**
	*$name:实例化的视图名
	*return:视图对象
	*/
	function V($name){
		require_once('/../../libs/View/'.$name.'View.class.php');
		$name.='View';
		return (new $View);
	}
	
	/**
	*$path:第三方类库的路径
	*$name:实例化的第三方类名
	*$params:为类初始化的属性，为关联数组的形式，array('key'=>'value')
	*return:第三方类对象
	*/
	function ORG($path,$name,$params=array()){
		require_once('/../../libs/ORG/'.$path.$name.'.class.php');
		$obj=new $name();
		if(!empty($params)){
			foreach($params as $key=>$value){
				$obj->$key=$value;
			}
		}
		return $obj;
	}
	
	/**
	*$message:要弹框的信息，默认为hello
	*$url: 要跳转的地址
	*return :none
	*/
	function alertGo($message="hello",$url){
		echo "<script>alert('{$message}');location.href='$url';</script>";
	}
	
	/**
	*$message:要弹框的信息，默认为hello
	*return :none
	*/
	function alertBack($message="hello"){
		echo "<script>alert('{$message}');history.back();</script>";
	} 
	

	
?>