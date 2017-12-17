
$(function(){
		
			$("#reg").click(function(){
				document.location="admin.php?controller=socmem&method=iframe&a=regsubShow";
			});
			$("#check").click(function(){
				document.location="admin.php?controller=socmem&method=iframe&a=pendMember";
			});
			$("#rnow").click(function(){
				document.location="admin.php?controller=socmem&method=iframe&a=socMember";
			});
			$("#activReg").click(function(){
				document.location="admin.php?controller=socmem&method=iframe&a=actsubShow";
			});
		});

