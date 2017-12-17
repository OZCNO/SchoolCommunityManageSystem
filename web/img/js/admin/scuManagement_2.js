
var id;
$(function(){
	$("#yearReg").css("color","#2057b2");
	$(".right_check").hide();
	$("#check_return").click(function() {
		$(".right_check").hide();
    $(".right").show();
	});
	
})

function yearCheckSubmit(review){
	var j={'id':id,'review':review}
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=checkSubmit",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
			if(x.success){
				document.location="admin.php?controller=sManage&method=yearReg";
			}else{
				alert("执行语句出错");
			}
      $(".right").show();
		},
		error:function(){alert("请求失败");}
	});
}



function check(idd){
	var j={'id':idd};
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=yearCheck",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
			id=x.sNO;
			$('#check .change_table_bgk2').each(function(index){
				switch(index){
					case 0:$(this).text(x.sName);break;
					case 1:$(this).text(x.date_of_entry);break;
					case 2:$(this).text(x.sFounder);break;
					case 3:$(this).text(x.date_of_found);break;
					case 4:$(this).text(x.tName);break;
					case 5:$(this).text(x.tTel);break;
					case 6:$(this).text(x.nhName);break;
					case 7:$(this).text(x.nhTel);break;
					case 8:$(this).text(x.fhName);break;
					case 9:$(this).text(x.fhTel);break;
					case 10:$(this).text(x.joinCondition);break;
					case 11:$(this).text(x.vNum);break;
					case 12:$(this).text(x.sAim);break;
					case 13:$(this).text(x.sSummary);break;
					case 14:$(this).text(x.sGlory);break;
				}
				
			});
			$(".right_check").show();
      $(".right").hide();
		},
		error:function(){alert("请求失败");}
	});
	
}

