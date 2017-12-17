
$(function(){
	$('#password_a').focus(function(){$('#tips_a').text('');});
	$('#username_a').focus(function(){$('#tips_a').text('');});
	$('#password_b').focus(function(){$('#tips_b').text('');});
	$('#username_b').focus(function(){$('#tips_b').text('');});
	$("#formForSt").show();
	$(".sTitle").css("color","#0000ff");
	$("#formForSl").hide();
	$(".sTitle").click(function(){
		$("#formForSt").show();
		$("#formForSl").hide();
		$(".sTitle").css("color","#0000ff");
		$(".slTitle").css("color","#000");
		$(".SCUL1").css("background","#fff");
		$(".SCUL2").css("background","#fafafa");
	})
	$(".slTitle").click(function(){
		$("#formForSl").show();
		$("#formForSt").hide();
		$(".slTitle").css("color","#0000ff");
		$(".sTitle").css("color","#000");
		$(".SCUL2").css("background","#fff");
		$(".SCUL1").css("background","#fafafa");
	})
});

function reset_a(){
	$('#username_a').val("");
	$('#password_a').val("");
}

function reset_b(){
	$('#username_b').val("");
	$('#password_b').val("");
}

function check_a(){
	if($('#username_a').val()!=''){
		if($("#password_a").val()!=''){
			var json={'username_a':$('#username_a').val(),'password_a':$('#password_a').val()};
			$.ajax({
				type:"POST",
				url:"admin.php?controller=backstageLogin&method=login",
				data:json,
				async:true,
				success:function(da){
					var x=eval("("+da+")");
					if(x.success==1){
						location.href="admin.php?controller=socmem&method=iframe";
					}
					else if(x.success==0){
						$('#tips_a').text("密码错误").css("color","#FF0000");
						$('#password_a').val("");
					}
					else{
						$('#tips_a').text("用户名不存在").css("color","#FF0000");
						$('#password_a').val("");
					}
				},
				error:function(){alert("登录表单提交请求失败");}
			});
		}
		else{
			$('#tips_a').text("请输入密码").css("color","#FF0000");
		}
	}
	else{
		$('#tips_a').text("请输入用户名").css("color","#FF0000");
	}
}

function check_b(){
	if($('#username_b').val()!=''){
		if($("#password_b").val()!=''){
			var json={'admin_usr':$('#username_b').val(),'admin_pwd':$('#password_b').val()};
			$.ajax({
				type:"POST",
				url:"admin.php?controller=scuLogin&method=login",
				data:json,
				async:true,
				success:function(da){
					var x=eval("("+da+")");
					if(x.success==1){
						location.href="admin.php?controller=sManage&method=iframe";
					}
					else if(x.success==0){
						$('#tips_b').text("密码错误").css("color","#FF0000");
						$('#password_b').val("");
					}
					else if(x.success==-1){
						$('#tips_b').text("用户名不存在").css("color","#FF0000");
						$('#password_b').val("");
					}else{
						$('#tips_b').text("未知错误").css("color","#FF0000");
						$('#password_b').val("");
					}
				},
				error:function(){alert("登录表单提交请求失败");}
			});
		}
		else{
			$('#tips_b').text("请输入密码").css("color","#FF0000");
		}
	}
	else{
		$('#tips_b').text("请输入用户名").css("color","#FF0000");
	}
}
