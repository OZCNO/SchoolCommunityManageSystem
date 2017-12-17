//判断登录的用户名，密码，验证码是否正确的标识
var flag_usr=false;//用户名
var flag_pwd=false;//密码
var flag_check=false;//验证码

//更改验证码调用的函数
function getCheckedImage(){
	document.getElementById('checkedImage').src=
	"./main.php?controller=login&method=getCheckedImage&t="+new Date();
}

//给登录框添加的事件处理
function addClick(){
	//给登录框绑定失去and获取焦点事件
	$('input[name="username"]')
		.focus(function(){
			if(flag_pwd&&flag_check) 	$('.tips').text("");})
		.blur(function(){
			if($(this).val() == ''){
				$('.tips').text('请输入用户名').css("color","#FF0000");
				flag_usr=false;
			}
			else if($(this).val().length!=9){
				$('.tips').text('用户名格式不正确').css("color","#FF0000");
				flag_usr=false;
			}
			else{
				flag_usr=true;
				$('.tips').text("");
			}
	});
	//给密码框绑定获取and失去焦点事件
	$('input[name="password"]')
		.focus(function(){
			if(flag_usr&&flag_check)	$('.tips').text("");})
		.blur(function() {
			if(flag_usr){
				if($(this).val() == ''){
					$('.tips').text('请输入密码').css("color","#FF0000");
					flag_pwd=false;
				}
				else{
					flag_pwd=true;
					$('.tips').text("");
				}
			}
	});	
	//给验证码绑定失去and获取焦点事件
	$('input[name="check_text"]')
		.focus(function(){
			if(flag_usr&&flag_pwd)	$('.tips').text("");})
		.blur(function() {
			if($(this).val() == ''){
				$('.tips').text('请输入验证码').css("color","#FF0000");
				flag_check=false;
			}
			else{
				flag_check=true;
				$('.tips').text("");
			}
	});	
	//给登录的关闭按钮绑定函数
	$('.close').click(function(){
		$('.back_mark').hide();//隐藏空div，
		$('.layout').slideUp(300);//关闭登录框
	});
}
//单击登录绑定的函数
function login(){
	addClick();
	$('.back_mark').show();//显示一个空div，用来设置弹出登录界面后的背景色
	$('.back_mark').height($(document).height());//设置空div的高度为当前页面高度
	$('.layout').slideDown(500);//显示登录框，以200毫秒的速率显示出来
}
//登录表单提交前的认证
function check_str(){
	if(flag_usr&&flag_pwd&&flag_check){
		jsn="data="+document.getElementById("check_text").value;
		$.ajax({
			type:"POST",
			url:"./main.php?controller=login&method=check_text",
			data:jsn,
			async:true,
			success:function(d){
				var x=eval("("+d+")");
				if(x.success){
					var jsn={'username':$("#username").val(),'password':$("#password").val(),'auto_login':document.getElementById('auto_login').checked};
					$.ajax({
						type:"POST",
						url:"main.php?controller=login&method=login",
						data:jsn,
						async:true,
						success:function(d){

							var x=eval("("+d+")");
							if(x.success==1){
								document.location.reload();
							}	
							else if(x.success==0){
								$(".tips").text("密码错误!");
								$("#password").val('');
								$('#check_text').val('');
								getCheckedImage();
							}
							else{
								$(".tips").text("用户名不存在,请先注册!");
								$("#password").empty();
								$('#check_text').val();
								getCheckedImage();
							}
						}
					});
				}
				else{
					$('.tips').text("验证码错误").css("color","#FF0000");
					$("#password").val('');
					$('#check_text').val('');
					getCheckedImage();
				}
			},
			error:function(){alert("请求失败");flag=false;}
		});
	}
}

$(function(){
    //当前页面
    var li=$("ul#nav li");
    $("ul#nav a").each(function(i){
    	$this=$(this);
    	if($this[0].href==String(window.location)){ //如果是点击添加的话刷新就没有了 
            li.eq(i).addClass("present");  
        }  
    });
	//主页活动栏
    $("#hot").click(function() {
        $("#mode1").hide("slow");
        $("#mode3").hide("slow");
        $("#mode2").show("slow");
    });
    $("#main").click(function() {
        $("#mode2").hide();
        $("#mode3").hide();
        $("#mode1").fadeIn("30000");
    });
    $("#history").click(function() {
        $("#mode1").hide("slow");
        $("#mode2").hide("slow");
        $("#mode3").slideDown("normal");
    });
    // 放大二维码
    var x = -170;
    var y = 20;
    $("#showPic").mouseover(function(e){ 
        this.myTitle = this.title; 
        this.title = ""; 
        var imgTitle = "<br/>"+this.myTitle;
        this.title="";
        var tooltip = "<div id='tooltip'><img src='"+ this.href +"' />"+imgTitle+"</div>"; 
        $("body").append(tooltip);            
        $("#tooltip")
            .css({
                "top": (e.pageY+y) + "px",
                "left":  (e.pageX+x)  + "px"
            }).show("fast");    
    }).mouseout(function(){
        this.title = this.myTitle;
        $("#tooltip").remove(); 
    }).mousemove(function(e){   
        $("#tooltip")
            .css({
                "top": (e.pageY+y) + "px",
                "left":  (e.pageX+x)  + "px"
            });
    });
    //菜单
    var open=false;
    $("#menu").click(function() {
        if(!open){
           $(".top").css("height","287px");
           open=true;    
        }
        else{
            $(".top").css("height","74px");
            open=false;
        }
    });
    //
    $(window).resize(function(){
	    if($("#menu").css("display")=="none"&&open){
	       $(".top").css("height","74px");
	       open=false; 
	    }
    });
   	//个人中心
	var flag=false;
	$(".nextAlert").hide();
    $("#hvr").mouseover(function(){
		$(".nextAlert").show();
		flag=false;
	})
	.mouseout(function(){
		$(".nextAlert").hide();
		flag=true;
	})
	$(".nextAlert").mouseout(function(){
		if(flag)  $(".nextAlert").hide();
	})
	$(".nextAlert").mouseover(function(){
		if(flag)  $(".nextAlert").show();
	});

});