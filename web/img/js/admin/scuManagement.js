$(function(){
		
		
		$("#member").click(function(){
			document.location="admin.php?controller=sManage&method=iframe&a=scuShow";
		})
		$("#noww").click(function(){
			document.location="admin.php?controller=sManage&method=iframe&a=now";
		})
		$("#activity").click(function(){
			document.location="admin.php?controller=sManage&method=iframe&a=activity";
		})
    $('#club-man').click(function(){
      document.location="admin.php?controller=sManage&method=iframe&a=socAccount";
    })
		$("#admin").click(function(){
			document.location="#";
		})
		$("#yearReg").click(function(){
			document.location="admin.php?controller=sManage&method=iframe&a=yearReg";
		})
		$("#activeReg").click(function(){
			document.location="admin.php?controller=sManage&method=iframe&a=activeReg";
		})
		$("#msgFeedback").click(function(){
			document.location="admin.php?controller=sManage&method=iframe&a=msgFeedback";
		})
		$("#scuAccount").click(function(){
			document.location="admin.php?controller=sManage&method=iframe&a=scuAccount";
		})
  

})
	
function exit(){
	document.location="admin.php?controller=scuLogin&method=logout";
}
