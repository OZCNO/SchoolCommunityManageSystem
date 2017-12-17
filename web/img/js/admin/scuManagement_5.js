var id;
$(function(){
		$("#activity").css("color","#2057b2");
		$(".actShow_transparent_bgk_del").hide();
		$(".actShow_transparent_bgk_change").hide();
	
	$("#OperationCancel").click(function(){
		$(".actShow_transparent_bgk_del").hide();
	})
	
	$("#imgX_add").click(function(){
		$("#actShow_transparent_bgk_add").hide();
	})
	$("#imgX_change").click(function(){
		$("#actShow_transparent_bgk_change").hide();
	})
	
});
	
//发布新活动
function add(){
	window.location.href = "http://localhost/SCU/web/admin.php?controller=sManage&method=activityShow";
}

var aNO;
function dell(iddd){
	aNO=iddd;
	$(".actShow_transparent_bgk_del").show();
}
//删除活动
function del(){
	var j={'aNO':aNO};
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=activityDel",
		data:j,
		async:true,
		success:function(da){
			var aa=eval("("+da+")");
			if(aa.success){
				alert("删除成功");
				document.location="admin.php?controller=sManage&method=activity";
			}
			else{
				alert("删除失败");
				document.location="admin.php?controller=sManage&method=activity";
			}
		},
		error:function(){alert("请求失败");}
	});
	
}

