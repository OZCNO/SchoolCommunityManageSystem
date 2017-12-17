var id;
$(function(){
	$("#activeReg").css("color","#2057b2");
	$(".activity_right_check").hide();
	$("#activityOperationChange").click(function() {
		$(".activity_right_check").show();
	});
	$("#activity_check_return").click(function() {
    $(".right").show();
		$(".activity_right_check").hide();
	});
})

function check(idd){
	var j={'id':idd};
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=activeCheck",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
			id=x.aNO;
			$('#check .change_table_bgk2').each(function(index){
				switch(index){
					case 0:$(this).text(x.sName);break;
					case 1:$(this).text(x.applicantName);break;
					case 2:$(this).text(x.aName);break;
					case 3:$(this).text(x.date_of_activity);break;
					case 4:$(this).text(x.aType);break;
					case 5:$(this).text(x.aPlace);break;
					case 6:$(this).text(x.aPerson);break;
					case 7:$(this).text(x.aTel);break;
					case 8:$(this).text(x.ahName);break;
					case 9:$(this).text(x.aeName);break;
					case 10:if(x.isBrand=="是"){document.getElementById('cy').checked='checked';}else{document.getElementById('cn').checked='checked';};break;
					case 11:$(this).text(x.aSummary);break;
				}
				
			});
			$(".activity_right_check").show();
      $(".right").hide();
		},
		error:function(){alert("请求失败");}
	});
}

function activeSubmit(review){
	var j={'id':id,'review':review}
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=activeSubmit",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
			if(x.success){
				document.location="admin.php?controller=sManage&method=activeReg";
			}else{
				alert("执行语句出错");
			}
      $(".right").show();
		},
		error:function(){alert("请求失败");}
	});
}
