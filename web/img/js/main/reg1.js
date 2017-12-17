ok1 = false;
ok2 = false;
ok3 = false;
ok4 = false;
$(function(){
	//验证用户名
	$("input[name='username']").focus(function(){
		$(this).parent().next().next().text('学号为9位数').css("color","#000");
	})
	.blur(function(){
		if($(this).val()==''){
			$(this).parent().next().next().text('学号不为空').css("color","#FF0000");
		}else if($(this).val().search(/^[1-9][0-9]{8}$/)==-1){
			$(this).parent().next().next().text('学号格式不正确').css("color","#FF0000");
		}
		else{
			var j={'username':$(this).val()};
			$.ajax({
				type:"POST",
				url:"main.php?controller=reg&method=check_user_exist",
				data:j,
				async:true,
				success:function(da){
					var x=eval("("+da+")");
					if(x.success){
						$("input[name='username']").parent().next().next().text('');
						ok1=true;
					}else{
						$("input[name='username']").parent().next().next().text('用户名已存在').css("color","#FF0000");
					}
				},
				error:function(){alert("请求失败");}
			});
		}
	});
	
	//验证密码
	$('input[name="pwd"]').focus(function(){
		$(this).parent().next().next().text('请输入8-15位的密码').css("color","#000");
	})
	.blur(function() {
		if($(this).val().length < 7 && $(this).val().length > 16){
			$(this).parent().next().next().text('密码长度不正确').css("color","#FF0000");
		}
		else if($(this).val() == ''){
			$(this).parent().next().next().text('密码不能为空').css("color","#FF0000");
		}
		else if($(this).val().search(/^[0-9a-zA-Z]{8,15}$/)==-1){
			$(this).parent().next().next().text('密码为数字或字母').css("color","#FF0000");
		}
		else{
			$(this).parent().next().next().text('');
			ok2 = true;
		}
	});
	//验证确认密码
	$('input[name="pwd2"]').focus(function(){
		$(this).parent().next().next().text('请输入同上规则的密码').css("color","#000");
	})
	.blur(function(){
		if($(this).val().length >= 8 && $(this).val().length <=15 && $(this).val()!='' 
			&& $(this).val() == $('input[name="pwd"]').val()) {
   			 $(this).parent().next().next().text('');
    			ok3=true;
    	}
		else if($(this).val() == ''){
			$(this).parent().next().next().text('密码不能为空').css("color","#FF0000");
		}
		else{
			$(this).parent().next().next().text('两次密码不一致').css("color","#FF0000");
			ok3 = true;
		}
	});
	//验证邮箱
	$('input[name="email"]').focus(function(){
		$(this).parent().next().next().text('请输入你常用的邮箱地址').css("color","#000");
	})
	.blur(function(){
		if($(this).val() == ''){
			$(this).parent().next().next().text('邮箱地址不能为空').css("color","#FF0000");
		}
		else if($(this).val().search(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==-1){
			$(this).parent().next().next().text('邮箱地址格式错误').css("color","#FF0000");
		}
		 
		else{
			$(this).parent().next().next().text('');
			ok4 = true;
		}
	});
});
	
//给提交按钮绑定这个函数，当所有情况都满足时，返回true，反之返回false
function confirm(){
	if(ok1 && ok2 && ok3 && ok4){
		return true;
	}
	else{
		return false;
	}
}