function hasPlaceholderSupport(){
			var input = document.createElement('input');
			return ('placeholder' in input);
		}
// function hasPlaceholderSupportTxt(){
// 	var input = document.createElement('textarea');
// 	return ('placeholder' in textarea);
// }
// function getCheckedImage_contactUs(){
// 	document.getElementById('checkedd').src="./main.php?controller=index&method=getCheckedImage_contactUs&t="+new Date();
// }

// $(function(){
// 	if(!hasPlaceholderSupport()){
// 		var $phdIe = $("input[id='phdIe']");
// 		$phdIe = $phdIe.attr("placeholder");
// 	}
// 	if(!hasPlaceholderSupportTxt()){
// 		var $txtPhdIe = $("textarea[id='txtPhdIe']");
// 		$txtPhd = $txtPhdIe.attr("placeholder");
// 	}
// })
