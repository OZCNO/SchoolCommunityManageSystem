var idd;
var aflag=true;//添加用户的js验证是否通过
var uflag=true;//修改用户的js验证是否通过
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
  var aaa=document.getElementById('username');
  aaa.disabled=true;
	oChange.innerHTML="修改信息";
  $('#add-submit').show();
  $('#add-submit2').hide();
  $('#password').attr("placeholder","不输入则不修改");
  //根据id获取数据
	var j={'id':id};
  idd=id;
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=scuAccountGet",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
      $('#username').val(x.username);
      $('#realname').val(x.realname);
      $('#work').val(x.work);
      $('#phone').val(x.phone);
      $('#department').val(x.department);
      $('#major').val(x.major);
		},
		error:function(){alert("请求失败");}
	});
  
}
//显示删除框，并存储待删除的id
function del(id){
  idd=id;
	var oDelContent = document.getElementById("del");
	oDelContent.style.display = 'block';
}
//删除的确认按钮
function dell(){
	var j={'id':idd};
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=scuAccountDel",
		data:j,
		async:true,
		success:function(da){
      var x=eval('('+da+')');
      if(x.flag==3){
        alert("删除成功");
        parent.location.reload(true);
      }else if(x.flag==2){
        alert("您无权进行此操作");
        location.reload(true);
      }
      else if(x.flag==1){
        alert("删除成功");
        location.reload(true);
      }else{
        alert("删除失败");
        location.reload(true);
      }
		},
		error:function(){alert("请求失败");}
	});  
}



function add(){
	/*var oSub = document.getElementById("add-submit2");*/
	var oMsg = document.getElementById("add-mess");
	var oIpt = document.getElementsByClassName("input");
	//提交验证
	/*oSub.onclick = function(){*/
		for(var i = 0;i < oIpt.length-1;i++){
			if(oIpt[i].value==""){
				oMsg.innerHTML = "表单不能有空项";
				oMsg.style.color = "#ff0000";
				oIpt[i].focus();
				return false;
			}
			else{
				oMsg.innerHTML = "";
			
		}
	}
	//密码输入时显示确认密码框
	
var pwd = document.getElementById("password");
var pwd2 = document.getElementById("rpassword");


	//添加新管理员的确认按钮
	/*pwd2.onblur = function(){*/
			if(pwd2.value != pwd.value){
				oMsg.innerHTML = "两次输入的密码不一致！";
				oMsg.style.color = "#ff0000";
				return false;
			}
			else {
				oMsg.innerHTML = "";
			}
	/*	}*/
  /*
   *
   *
   * 需要在此处先进行验证，两次密码输入一致，以及表单框不为空，
   *当aflag为true时进行数据的添加操作
   * */
        if(aflag){
	        var j={'username':$('#username').val(),'realname':$('#realname').val(),'work':$('#work').val(),'phone':$('#phone').val(),'department':$('#department').val(),'major':$('#major').val(),'password':$('#password').val()};
	        $.ajax({
		      type:"POST",
		      url:"admin.php?controller=sManage&method=scuAccountPost",
		      data:j,
		      async:true,
		      success:function(da){
			      var x=eval("("+da+")");
            if(x.flag==0&&x.flag==false){
              alert("添加失败！");
              location.reload(true);
            }else if(x.flag==1){
              alert("添加成功！");
              location.reload();
            }
		      },
		      error:function(){alert("请求失败");}
	        });
        }

}



//用户框失去焦点绑定的函数，即检查用户名是否存在
function exist(){
          var j={'username':$('#username').val()}
	        $.ajax({
		      type:"POST",
		      url:"admin.php?controller=sManage&method=scuAccountExist",
		      data:j,
		      async:true,
		      success:function(da){
			      var x=eval("("+da+")");
            if(x.flag==0){
                $('#add-mess').text("用户名已经存在").css("color","#ff0000");
                aflag=false;
              
            }else{
              $('#add-mess').text("");
              aflag=true;
            }
		      },
		      error:function(){alert("请求失败");}
	        });
}


$(function(){
	$("#scuAccount").css("color","#2057b2");
			var oBtn = document.getElementById("account-add");
			var oChange = document.getElementById("change");
			var oAc = document.getElementsByClassName("account-op");
		
		//添加新成员
			$('#account-add').click(function(){openNew();
          		$('#add-submit2').show();
          		$('#add-submit').hide();
          		var aaa=document.getElementById('username');
          		aaa.disabled=false;
          		$('#password').attr("placeholder","");
				oChange.innerHTML="添加新成员";
		
          		$('#add-mess').text("");
          		$('#username').val("");
          		$('#realname').val("");
          		$('#work').val("");
          		$('#phone').val("");
          		$('#department').val("");
          		$('#major').val("");

          	})
					
		
			
			
			
			
			//提交验证
			var oSub = document.getElementById("add-submit");
			var oMsg = document.getElementById("add-mess");
			var oIpt = document.getElementsByClassName("input");
      var flag=true;
			//提交验证，修改信息的确认
			$('#add-submit').click(function(){
					for(var i = 0;i < oIpt.length-1;i++){
          if(i!=6||i!=7)
            continue;
					if(oIpt[i].value==""){
						oMsg.innerHTML = "表单不能有空项";
						oMsg.style.color = "#ff0000";
						oIpt[i].focus();
            flag=false;
            break;
					}
					else{
						oMsg.innerHTML = "";
					}

				}
        /*
         *这里需要添加两次密码输入一致的验证，
         *
         *
         * */
        if(flag&&uflag){
	        var j={'ID':idd,'username':$('#username').val(),'realname':$('#realname').val(),'work':$('#work').val(),'phone':$('#phone').val(),'department':$('#department').val(),'major':$('#major').val(),'password':$('#password').val()};
	        $.ajax({
		      type:"POST",
		      url:"admin.php?controller=sManage&method=scuAccountSubmit",
		      data:j,
		      async:true,
		      success:function(da){
			      var x=eval("("+da+")");
            if(x.flag==0||x.flag==false){
              alert("修改失败");
              location.reload(true);
            }else if(x.flag==1){
              alert("修改成功");
              location.reload(true);
            }else if(x.flag==2){
              alert("您无权修改此账号的相关信息！");
              location.reload(true);
            }else if(x.flag==3){
              alert("修改成功，请重新登录");
              parent.location.reload();
            }
		      },
		      error:function(){alert("请求失败");}
	        });
        }
				return true;
			})
  

			var oDelContent = document.getElementById("del");
			var oCn = document.getElementById("cn");
			$('#del').css("display","none");
			$('#cn').click(function(){
				$('#del').css("display","none");
			})
});
