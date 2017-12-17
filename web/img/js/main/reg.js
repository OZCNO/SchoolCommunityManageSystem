var psdFlag=true;
var repsdFlag=true;
var snoFlag=true;

function reset(){
	document.getElementsByTagName("input").value="";
}
function psdTip(){
	var tip=document.getElementsByClassName("errorTip")[0];
	tip.innerHTML="请输入6-12位密码,只能包含数字，字母，下划线";
	tip.style.color="#222";
}
function repsdTip(){
	var tip=document.getElementsByClassName("errorTip")[0];
	tip.innerHTML="请再次输入密码";
	tip.style.color="#222";
}
function checkSno(x){
	var tip=document.getElementsByClassName("errorTip")[0];
	var sno=x.value;
	var reg=/^[1-9][0-9]{8}$/;
	if(sno=="") return;
	if(!reg.test(sno)){
		tip.innerHTML="学号格式错误";
		snoFlag=false;
		return false;
	}
	tip.innerHTML="";
	snoFlag=true;
	check();
}
function checkPsd(x){
	var tip=document.getElementsByClassName("errorTip")[0];
	var reg=/^\w{6,12}/;
	tip.style.color="red";
	tip.innerHTML="";
	if(x.value=="") return;
	if(!reg.test(x.value)){
		tip.innerHTML="密码只能包含6~12位数字/字母/下划线";
		psdFlag=false;
		return false;
	}
	tip.innerHTML="";
	psdFlag=true;
	check();
}
function checkRepsd(x){
	var tip=document.getElementsByClassName("errorTip")[0];
	var psd=document.getElementsByName("psd")[0].value;
	var repsd=x.value;
	tip.style.color="red";
	tip.innerHTML="";
	if(repsd=="") return;
	if(psd!==repsd){
		tip.innerHTML="密码不一致";
		repsd=false;
		return false;
	}
	tip.innerHTML="";
	repsdFlag=true;
	check();
}
function check(){
	var tip=document.getElementsByClassName("errorTip")[0];
	if(!snoFlag){
		tip.innerHTML="学号格式错误";
		return false;
	}
	if(!psdFlag){
		tip.innerHTML="密码只能包含6~12位数字/字母/下划线";
		return false;
	}
	if(!repsdFlag){
		tip.innerHTML="密码不一致";
		return false;
	}
}