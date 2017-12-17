var idd;
function openNew(){
  //获取页面的高度和宽度
  var sWidth = document.documentElement.scrollWidth;
	var sHeigth = document.documentElement.scrollHeight;
				
	//获取可视区域
	var wHeight = document.documentElement.clientHeight;
	
	var oMask = document.getElementById("add-bg");
	oMask.style.height = sHeigth+"px";
	oMask.style.width = sWidth+"px";
	oMask.style.display = 'block';
	
	var oContent = document.getElementById("add-content");
	oContent.style.display = 'block';

  //获取add-content文本内容的宽度和高度
	var dWidth = oContent.offsetWidth;
	var dHeight = oContent.offsetHeight;
	
	oContent.style.left = (sWidth-dWidth)/4 + "px";
	oContent.style.top = (wHeight-dHeight)/2 + "px";
	var oClose = document.getElementById("add-close");
	oMask.onclick = oClose.onclick = function(){
	  oMask.style.display = 'none';
	  oContent.style.display = 'none';
	}
}
//显示修改账号信息的框，并通过ajax获取相应的数据
function update(id){
  $('#add-mess').text("");
	var oChange = document.getElementById("change");
	openNew();
	oChange.innerHTML="修改信息";
  //根据id获取数据
	var j={'id':id};
  idd=id;
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=socAccountGet",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
      $('#sUsername').val(x.sUsername);
      $('#sName').val(x.sName);
		},
		error:function(){alert("请求失败");}
	});
  
}
var flag=true;
$(function(){
	    $("#club-man").css("color","#2057b2");
			var oChange = document.getElementById("change");
			var oAc = document.getElementsByClassName("account-op");
			
			//提交验证
			var oSub = document.getElementById("add-submit");
			var oMsg = document.getElementById("add-mess");
			var oIpt = document.getElementsByClassName("input");
	    oSub.onclick = function(){
          if(flag){
              var j={'sPassword':$('#password').val(),'ID':idd}
	            $.ajax({
		              type:"POST",
		              url:"admin.php?controller=sManage&method=socAccountSubmit",
		              data:j,
		              async:true,
		              success:function(da){
			                var x=eval("("+da+")");
                      if(!x.flag){
                          alert("修改失败");
                          location.reload(true);
                      }else{
                          alert("修改成功");
                          location.reload(true);
                      }
		              },
		              error:function(){alert("请求失败");}
	            });
            }else{
              return false;
            }
				    return true;
			}
      
	   	var pwd2 = document.getElementById("rpassword");
			//添加新管理员的确认按钮
			pwd2.onblur = function(){
			    var pwd = document.getElementById("password");
	   	    var pwd2 = document.getElementById("rpassword");
			    if(pwd2.value != pwd.value){
				      oMsg.innerHTML = "两次输入的密码不一致！";
					    oMsg.style.color = "#ff0000";
              flag=false;
						  return false;
			    }
			    else {
              flag=true;
					    oMsg.innerHTML = "";
			    }
      }
});

 

		


		
