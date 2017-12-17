$(function(){
	var ok1 = false;
	var ok3 = false;
	var ok5 = false;
	var ok6 = false;
	//验证姓名
	$('input[name="realname"]').focus(function(){
		$(this).parent().next().next().text('真实姓名').css("color","#000");
	})
	.blur(function(){
		if($(this).val()==''){
			$(this).parent().next().next().text('姓名不能为空').css("color","	#FF0000");
		}else if($(this).val().search(/^[\u4e00-\u9fa5]{2,4}$/)==-1){
			$(this).parent().next().next().text('姓名格式不正确').css("color","#FF0000");
		}
		else{
			$(this).parent().next().next().text('');
			ok1=true;
		}

	});
	$('input[name="major"]').focus(function(){
		$(this).parent().next().next().text('请填写专业代码').css("color","#000");
	})
	.blur(function(){
		if($(this).val()==''){
			$(this).parent().next().next().text('专业不能为空').css("color","	#FF0000");
		}else if($(this).val().search(/^[1-9][0-9]{5}$/)==-1){
			$(this).parent().next().next().text('专业格式不正确').css("color","#FF0000");
		}
		else{
			$(this).parent().next().next().text('');
			ok3=true;
		}

	});
	
	$('input[name="tel"]').focus(function(){
		$(this).parent().next().next().text('请输入手机号码').css("color","#000");
	})
	.blur(function(){
		if($(this).val()==''){
			$(this).parent().next().next().text('手机号不能为空').css("color","#FF0000");
		}else if($(this).val().search(/^1[345678][0-9]{9}$/)==-1){
			$(this).parent().next().next().text('手机号码格式不正确').css("color","#FF0000");
		}
		else{
			$(this).parent().next().next().text('');
			ok5=true;
		}

	});
	$('input[name="chat"]').focus(function(){
		$(this).parent().next().next().text('请输入你的微信号').css("color","#000");
	})
	.blur(function(){
		if($(this).val()==''){
			$(this).parent().next().next().text('微信不能为空').css("color","	#FF0000");
		}else if($(this).val().search(/^[a-zA-Z\d_]{5,}$/)==-1){
			$(this).parent().next().next().text('微信格式不正确').css("color","#FF0000");
		}
		else{
			$(this).parent().next().next().text('');
			ok6=true;
		}

	});
	$('.submitBtn').click(function(){
		if(ok1 && ok3 && ok5 && ok6){
			$('form').submit();
		}
		else{
			return false;
		}
	});

});