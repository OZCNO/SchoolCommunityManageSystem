function attention(){
	img=document.getElementById("attention_img");
	span=document.getElementById("attention_span");
	if(img.src.indexOf('attened')>=0){
		img.src="./img/images/atten.png";
		span.innerHTML="关注";
	}

	else{
		img.src="./img/images/attened.png";
		span.innerHTML="取消关注";
	}	
	
}

$(function(){
	//ajax
	$("#concern").click(function(){
		// alert("ajax started");
		var sno = "3";//以后动态获取 这里要改
		var jsn = {'username':$("input[name='username']").val(),'sNO':sno};
		$.ajax({ 
			    type: "POST", 	
				url: "main.php?controller=userInfo&method=concern",
				data: jsn,
				async:true,
				success: function(data){
					var x=eval("("+data+")");
					if(x.success){
						attention();
					} else {
						attention();
					}  
				},
				error: function(jqXHR){     
				   alert("发生错误：" + jqXHR.status);  
				}

			});
	});
	//申请加入社团
	$(".joinSociety").click(function(3){
		var j={'sNO':sNo};
		$.ajax({
			type:"POST",
			url:"main.php?controller=joinSociety&method=join",
			data:j,
			async:true,
			success:function(da){
				var x=eval("("+da+")");
				if(x.success){
					alert("申请成功");
					document.location="main.php?controller=index&method=show2";
				}else if(x.success==2){
					
				}else{
					alert("申请失败");
				}
			},
			error:function(){alert("登录表单提交请求失败");}
		});
	}
	//滚动条
	 $(window).scroll(function () {
	    var ref_min = $("#floatdiv")[0];
		if (!ref_min) return;
	    var scroll_top = $(window).scrollTop();
		/*var ref_height_min = ref_min.offsetTop+ref_min.offsetHeight;*/
	    if (scroll_top >124) {
	        $("#floatdiv").addClass("canfloat");
	    }else {
	        $("#floatdiv").removeClass("canfloat");
	    }
     });     
});