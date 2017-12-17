var username;
var idd;
function openNew2(){
	//获取页面的高度和宽度
	var sWidth = document.documentElement.scrollWidth;
  var sHeigth = document.documentElement.scrollHeight;
				
  //获取可视区域
	var wHeight = document.documentElement.clientHeight;
	
	var oMask = document.getElementById("add-bg");
	oMask.style.height = sHeigth+"px";
	oMask.style.width = sWidth+"px";
	oMask.style.display = 'block';
	
	var oContent = document.getElementById("add-content2");
	oContent.style.display = 'block';
	
	//获取add-content文本内容的宽度和高度
	var dWidth = oContent.offsetWidth;
	var dHeight = oContent.offsetHeight;
	
	oContent.style.left = (sWidth-dWidth)/4 + "px";
	oContent.style.top = (wHeight-dHeight)/2 + "px";
	var oClose = document.getElementById("add-close");
	var oCbtn2 = document.getElementById("center-sub2");
	oCbtn2.onclick=oMask.onclick = oClose.onclick = function(){
	  oMask.style.display = 'none';
	  oContent.style.display = 'none';
	}
}
//查看某一条信息反馈
function view(id){
	var oRt = document.getElementById("reply-title");
	var oRta = document.getElementById("reply-textarea");
	var oCbtn = document.getElementById("center-sub");
	var oCbtn2 = document.getElementById("center-sub2");
	var oCnerHTML= document.getElementById("change");
	openNew2();
	oCnerHTML.innerHTML="查看";
	oRt.disabled = true;
	oRta.disabled = true;
	oCbtn.style.display = 'none';
	oCbtn2.style.display = 'block';
  //根据id获取数据
	var j={'id':id};
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=msgFeedbackGet",
		data:j,
		async:true,
		success:function(da){
			var x=eval("("+da+")");
      $('#reply-title').val(x.msg_title);
      $('#reply-textarea').val(x.msg_content);
		},
		error:function(){alert("请求失败");}
	});
  return false;
}
//显示回复信息反馈
function reply(user){
	var oRt = document.getElementById("reply-title");
	var oRta = document.getElementById("reply-textarea");
	var oCbtn = document.getElementById("center-sub");
	var oCbtn2 = document.getElementById("center-sub2");
	var oChange= document.getElementById("change");
  //保存是谁提交的用户反馈
  username=user;
	openNew2();
	oChange.innerHTML="回复";
	oRt.disabled = false;
	oRta.disabled = false;
	oCbtn2.style.display = 'none';
	oCbtn.style.display = 'block';
  $('#reply-title').val("");
  $('#reply-textarea').val("");
}
//将回复信息反馈的内容添加到数据库
function replySubmit(){
  /*
   *可以在这里写js验证，验证只需不为空即可，验证通过才执行下面的语句
   *
   * */
	var j={'msg_title':$('#reply-title').val(),'msg_content':$('#reply-textarea').val(),'msg_who':username,'msg_flag':0};
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=msgFeedbackPost",
		data:j,
		async:true,
		success:function(da){
      var x=eval('('+da+')');
      if(x.flag)
        alert("回复成功");
      else
        alert("回复失败");
      $('#add-bg').hide();
      $('#add-content2').hide();
		},
		error:function(){alert("请求失败");}
	});
}
//将要删除的id存储
function del(id){
 
	var oDelContent = document.getElementById("del");
		  oDelContent.style.display = 'block';
  idd=id;
}
//确认删除
function dell(){
	var j={'id':idd};
	$.ajax({
		type:"POST",
		url:"admin.php?controller=sManage&method=msgFeedbackDel",
		data:j,
		async:true,
		success:function(da){
      var x=eval('('+da+')');
      if(x.flag){
        $("#del").hide();
        location.reload(true);
      }
      else
        alert("删除失败");
		},
		error:function(){alert("请求失败");}
	});
}

$(function(){
	$("#msgFeedback").css("color","#2057b2");
	//确认是否删除
  var oCn = document.getElementById("cn");
	var oDelContent = document.getElementById("del");
	oDelContent.style.display = 'none';
	oCn.onclick = function(){
	  oDelContent.style.display = 'none';
	}
});
