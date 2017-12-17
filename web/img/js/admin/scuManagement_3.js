var id;
$(function(){
	$("#noww").css("color","#2057b2");
	$(".transparent_bgk_del").hide();
	$(".right_f").hide();
	$("#OperationCancel").click(function(){
		$(".transparent_bgk_del").hide();
	})
	$(".change_table_sbt").click(function(){
    $("#now").show();
		$(".right_f").hide();
	})

});

function dell(){
		one=document.getElementsByClassName('one');
		var j={};
		for(var i=0;i<one.length;i++){
			if(one[i].checked)
				j[i]=one[i].value;
		}
		j=JSON.stringify(j);
		if(j=="{}"){
			alert("请先选择要删除的社团!");
		}else{
			$(".transparent_bgk_del").show();
		}
}

function del(){
	one=document.getElementsByClassName('one');
	var j={};
	for(var i=0;i<one.length;i++){
		if(one[i].checked)
		j[i]=one[i].value;
	}
	j=JSON.stringify(j);
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=nowDelete",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
			if(x.success)
				alert("删除成功！");
			else
				alert("删除失败！");
			document.location="admin.php?controller=sManage&method=now";
		},
		error:function(){alert("请求失败");}
	});
}

function getData(idd){
	var j={'id':idd};
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=getNow",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
			id=x.sNO;
			$('#nownow .change_table_bgk2').each(function(index){
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
			$(".right_f").show();
      $("#now").hide();
		},
		error:function(){alert("请求失败");}
	});
  return false;
}
function changeState(){
	var x=document.getElementsByClassName("one");
	if(document.getElementById("all").checked){
		for(i=0;i<x.length;i++){
			x[i].checked=true;
		}
	}
	else{
		for(i=0;i<x.length;i++){
			x[i].checked=false;
		}
	}
}
