$(function(){
	//切换
	$("#perInfor").click(function(){
		$("#rightMid,#information").css("display","block");
		$("#intention,#attend").css("display","none");
		$(this).css("backgroundColor","#fff");
		$("#perOrg").css("backgroundColor","lightgrey");
	});	
	$("#perOrg").click(function(){
		$("#intention,#attend").css("display","block");
		$("#rightMid,#information").css("display","none");
		$(this).css("backgroundColor","#fff");
		$("#perInfor").css("backgroundColor","lightgrey");
	});
	$("#perInfor").click();
	
	function finishChangeInfor(){
		$("#edit").text("编辑");
		$("#edit").removeClass("finish");
		$(".editable").attr("disabled","disabled");	
		$(".editable").addClass("edit");
	}
	function changeInfor(){
		$("#edit").text("完成");
		$("#edit").addClass("finish");
		$(".editable").removeAttr('disabled');
		$(".editable").removeClass("edit");	
	}
	// 编辑信息
	$("#edit").click(function(){
		var i=0;
		if($(this).hasClass('finish')){
			if(!(telFlag&&wechatFlag&&emailFlag)) return false;
			// 信息无误,获取并上传信息
			var jsn = {'username':$("input[name='username']").val(),'tel':newTel,'email':newEmail,'wechat':newWechat};

			$.ajax({ 
			    type: "POST", 	
				url: "main.php?controller=userInfo&method=setInfo",
				data: jsn,
				async:true,
				success: function(data){
					var data=eval("("+data+")");
					if(data.success){
						finishChangeInfor();	
					} else {			 
						if(i==0){
							finishChangeInfor();
							return;
						}
						alert("不符合要求，修改失败");
					}  
				},
				error: function(jqXHR){ 
				   alert("发生错误：" + jqXHR.status);  
				}

			});
		}
		else{
			changeInfor();
			// 验证信息
			telFlag=true;
			emailFlag=true;
			wechatFlag=true;
			newTel=$('input[name="tel"]').val();
			newEmail=$('input[name="email"]').val();
			newWechat=$('input[name="wechat"]').val();
			//手机，邮箱，微信号，只要有一个被编辑修改就得上传新值，
			$(".editable").change(function(){
				tip=$(this).parent().next().next();
				tip.css("display","block");
				//手机验证
				if($(this).attr("name")=='tel'){
					telFlag=false;
					if($(this).val()==""){	
						tip.text("手机号不能为空");
					}else if($(this).val().search(/^1[345678][0-9]{9}$/)==-1){						
						tip.text("手机填写错误");
					}else{
						tip.text("");
						tip.css("display","none");
						newTel=$(this).val();
						i++;
						telFlag=true;
					}
				}
				//邮箱验证
				else if($(this).attr("name")=='email'){
					emailFlag=false;
					if($(this).val()==""){
						tip.text('邮箱地址不能为空');
					}else if($(this).val().search(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==-1){
						tip.text('邮箱地址填写错误');
					}else{
						tip.text("");					
						tip.css("display","none");
						newEmail=$(this).val();
						i++;
						emailFlag=true;
					}
				}
				//微信验证
				else{
					wechatFlag=false;
					if($(this).val()==''){
						tip.text('微信号不能为空');
					}else if($(this).val().search(/^[a-zA-Z]{1}[a-zA-Z\d_-]{5,19}$/)==-1){
						tip.text('微信号填写错误');
					}else{
						tip.text("");
						tip.css("display","none");
						newWechat=$(this).val();
						i++;
						wechatFlag=true;
					}
				}
			})
		}
	});

	//上传图片
	$("input[type=file]").change(function(){
		$(this).parents(".uploader").find(".filename").val($(this).val());
	});
	$("input[type=file]").each(function(){
		if($(this).val()==""){
			$(this).parents(".uploader").find(".filename").val("No file selected...");
		}
	});
	//打开，关闭
	$("#editPhoto").click(function(){
		$('.back_mark').show();
		$('.back_mark').height($(document).height());
		$('.uploadPhoto').slideDown(500);
	});
	$(".close").click(function(){
		$('.back_mark').hide();
		$(".uploadPhoto").slideUp("fast");
	});
});