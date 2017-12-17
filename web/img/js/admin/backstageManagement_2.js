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
	$("#i_rightCheck").show();
	$("#i_rightReg").hide();
	$("#i_rightaReg").hide();
	$("#check").css("color","#2057b2");
  
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
