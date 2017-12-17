$(function(){
		$("#member").css("color","#2057b2");
		$(".alert").hide();
		$(".addAlert").hide();
		$(".changeAlert").hide();
		
		$("#cancel").click(function(){
			$(".alert").hide();
		})
		$("#addSelect").click(function(){
			$("#a").append("<div class='addAlertIptRadio'><span>是否设为管理员</span><input type='radio' class='addIsYes' name='yes' value='true'>是<input type='radio' class='addIsNo' name='yes' checked='checked' value='false'>否</div>");
			$(".addIsYes").click(function(){
				$(".addAlertIptAdmin1").show();
			});
			$(".addIsNo").click(function(){
				$(".addAlertIptAdmin1").hide();
			});
			$(".addAlertIptAdmin1").hide();
			$(".addAlert").show();
			$(".changeAlert").hide();
			
			
		});
		$("#addAlertTopX").click(function(){
			$('.addAlertIptRadio').remove();
			$(".addAlert").hide();
			
		});
		$("#changeAlertTopX").click(function(){
			$(".changeAlert").hide();
		});
		$(".addAlertIptAdmin1").hide();
		$(".addAlertIptAdmin2").hide();
		
		$(".isYes").click(function(){
			
			$(".addAlertIptAdmin2").show();
		})
		$(".isNo").click(function(){
			$(".addAlertIptAdmin2").hide();
		})
		
})

//全选
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




//显示删除框前的判断
function dell(){
		one=document.getElementsByClassName('one');
		var j={};
		for(var i=0;i<one.length;i++){
			if(one[i].checked)
				j[i]=one[i].value;
		}
		j=JSON.stringify(j);
		if(j=="{}"){
			alert("请先选择要删除的成员!");
		}else{
			$(".alert").show();
		}
}
//删除成员
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
			url:"admin.php?controller=sManage&method=scuDelete",
			data:j,
			async:true,
			success:function(da){
				var x=eval("("+da+")");
				if(x.success)
					alert("删除成功！");
				else
					alert("删除失败！");
				document.location="admin.php?controller=sManage&method=scuShow";
			},
			error:function(){alert("请求失败");}
		});
}

//更新成员
function update(){
		one=document.getElementsByClassName('one');
		var j={};
		for(var i=0;i<one.length;i++){
			if(one[i].checked){
				j[i]=one[i].value;
			}
				
		}
		j=JSON.stringify(j);
		if(j=="{}"){
			alert("请先选择一个要更改的成员!");
		}else{
			$.ajax({
				type:"POST",
				url:"admin.php?controller=sManage&method=scusUpdate",
				data:j,
				async:true,
				success:function(da){
					$(".changeAlert").show();
					$(".addAlert").hide();
					$("#ID").hide();
					var aa=eval("("+da+")");
					$('#department').val(aa.department);
          $('#job').val(aa.job);
          $("#realname").val(aa.realname);
					document.getElementById('username').value=aa.username;
					document.getElementById('dname').value=aa.dname;
					document.getElementById('major').value=aa.major;
					document.getElementById('dclass').value=aa.class;
					document.getElementById('dorm').value=aa.dorm;
					document.getElementById('phone').value=aa.phone;
					document.getElementById('wechat').value=aa.wechat;
					document.getElementById('ID').value=aa.ID;	
				},
				error:function(){alert("请求失败");}
			});
		}
}
