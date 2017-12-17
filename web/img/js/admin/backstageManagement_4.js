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
	$("#i_rightNow").hide();
	$("#i_rightCheck").hide();
	$("#i_rightReg").hide();
	$(".opBgk").hide();
	$("#i_rightaReg").show();
	$("#activReg").css("color","#2057b2");
	$(".operationLook").click(function(){
		$(".opBgk").show();
	})
	$(".submitClose").click(function(){
		$(".opBgk").hide();
	})
	$(".operationDel").click(function(){
		$(".opBgk").show();
	})
	$("#right_sbts").click(function(){
		$(".opBgk").show();
	})
	
  
});

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
