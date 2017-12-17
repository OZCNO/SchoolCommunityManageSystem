function change(){
var lis=document.getElementById('aNav').getElementsByTagName('li');
var models=document.getElementsByClassName("model");
var pre=0;
lis[0].style.color="#06f";
models[2].style.display="none";
models[1].style.display="none";

	for(i=0;i<lis.length;i++){
		lis[i].onclick=function(){
			models[pre].style.display='none';
			lis[pre].style.color="#000";
			for(j=0;j<lis.length;j++){
				if(this==lis[j]){
					models[j].style.display='block';
					lis[j].style.color="#06f";
					pre=j;
				}
			}
		}
	}
}