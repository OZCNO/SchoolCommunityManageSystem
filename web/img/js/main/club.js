function club(){
var lis=document.getElementById('left-nav').getElementsByTagName('li');
var arrows=document.getElementById('arrows1').getElementsByTagName('li');
var tables=document.getElementById('clubStudy').getElementsByTagName('table');
var aHead=document.getElementById('aHead');
var liNo=0;
lis[0].style.backgroundColor="#fff";
arrows[0].style.backgroundColor="#fff";
arrows[0].style.borderRight="0";
arrows[1].style.borderRight="0.06rem solid #a5a5a5";
arrows[2].style.borderRight="0.06rem solid #a5a5a5";
arrows[3].style.borderRight="0.06rem solid #a5a5a5";


	for(i=0;i<lis.length;i++){
		lis[i].onclick=function(){
			lis[liNo].style.backgroundColor="";
			arrows[liNo].style.backgroundColor="";
			tables[liNo].style.display="none";
			arrows[liNo].style.borderRight="0.06rem solid #a5a5a5";
			for(j=0;j<lis.length;j++){
				if(this==lis[j]){
					lis[j].style.backgroundColor="#fff";
					arrows[j].style.backgroundColor="#fff";
					tables[j].style.display='block';
					arrows[j].style.borderRight="0";
					aHead.innerHTML=lis[j].innerHTML;
					liNo=j;
				}
			}
		}
	}
}