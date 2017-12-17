$(function(){
  	$(".searchIframe").hide();
			$(".searchContent").show();
			$(".userSearch").click(function(){
				$(".searchContent").show();
				$(".searchIframe").hide();
				$(".seniorSearch").css("background","#cfdcfd");
				$(".userSearch").css("background","#fff");
				
			});
			$(".seniorSearch").click(function() {
				$(".searchIframe").show();
				$(".searchContent").hide();
				$(".seniorSearch").css("background","#fff");
				$(".userSearch").css("background","#cfdcfd");
			}); 
				$("#reg").css("color","#2057b2");
				$("#i_rightNow").hide();
				$("#i_rightCheck").hide();
				$("#i_rightReg").show();
				$("#i_rightaReg").hide();
				laydate({
				  elem: '#date', 
				  event: 'focus' 
				});	
  
});

function check3(){
	inputs=document.getElementById('inputDiv').getElementsByTagName('input');
	spans=document.getElementById('inputDiv').getElementsByTagName('span');
	textareas=document.getElementById('textareaDiv').getElementsByTagName('textarea');
	tSpans=document.getElementById('textareaDiv').getElementsByTagName('span');
	for(i=0;i<inputs.length;i++){
		if(inputs[i].value==""){
			alert(spans[i].innerHTML+'不能为空');
			return false;
		}
	}
	for(i=0;i<textareas.length;i++){
		if(textareas[i].value==""){
			alert(tSpans[i].innerHTML+'不能为空');
			return false;
		}
	}
	return true;
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
