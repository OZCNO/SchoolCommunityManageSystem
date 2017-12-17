
var imgs;
var x;
var spans;

var timer;//轮播图的计时器

var aImage;
var aImage_length;
var imgs_index=0;
var aImage_index=0;



//一开始就加载的函数
function load(){
	//getAImage();//从后台获取宣传照片
	changImg()
	
}



//执行定时器的函数
function changImg(){
	imgs=document.getElementById('scrollImg').getElementsByClassName("imgs");
	x=document.getElementsByClassName("hover");//拿到当前的所有圆圈
	spans=document.getElementsByClassName("outline");
	timer=setInterval(function(){
		imgs_index++;
		if(imgs_index==imgs.length)
			imgs_index=0;
		for(i=0;i<imgs.length;i++){
			if(i==imgs_index){
				x[i].style.color="#fff";
				imgs[i].style.display="block";
				spans[i].style.display="block";
			}
			else{
				x[i].style.color="#b3c0cc";
				imgs[i].style.display="none";
				spans[i].style.display="none";
			}
		}
	},3000);
}

function mouseover(){
	clearInterval(timer);//清除计时器
}

function mouseout(){
	changImg();
}


//为圆圈单击绑定的事件
function addEvent(id){
	clearInterval(timer);//清除计时器
	imgs_index=id;
	for(i=0;i<imgs.length;i++){
		if(i==imgs_index){
			x[i].style.color="#fff";
			imgs[i].style.display="block";
			spans[i].style.display="block";
		}
		else{
			x[i].style.color="#b3c0cc";
			imgs[i].style.display="none";
			spans[i].style.display="none";
		}
	}
	changImg();
}


//点击上一张时调用的函数
function f_lastPic(){
	clearInterval(timer);//清除计时器
	imgs_index-=1;
	if(imgs_index<0)
		imgs_index=0;
	for(i=0;i<imgs.length;i++){
		if(i==imgs_index){
			x[i].style.color="#fff";
			imgs[i].style.display="block";
			spans[i].style.display="block";
		}
		else{
			x[i].style.color="#b3c0cc";
			imgs[i].style.display="none";
			spans[i].style.display="none";
		}
	}
	changImg();
	
}

//点击下一张时调用的函数
function f_nextPic(){
	clearInterval(timer);//清除计时器
	imgs_index+=1;
	if(imgs_index>=imgs.length)
		imgs_index=imgs.length-1;
	for(i=0;i<imgs.length;i++){
		if(i==imgs_index){
			x[i].style.color="#fff";
			imgs[i].style.display="block";
			spans[i].style.display="block";
		}
		else{
			x[i].style.color="#b3c0cc";
			imgs[i].style.display="none";
			spans[i].style.display="none";
		}
	}
	changImg();
	
}


/*
//点击更换下一批宣传图调用的函数
function next_borad(){
	if(aImage_length>=4){
		var temp=document.getElementById('imgss').getElementsByTagName("img");
		if(aImage_index+temp.length-1>=aImage_length)
			aImage_index=aImage_length-aImage_index-temp.length+aImage_index;
		for(var i=0;i<temp.length;i++){
			temp[i].src="../db/index/images/"+aImage[aImage_index+i].imgName;
		}
		aImage_index+=temp.length;
	}
}


//点击更换上一批宣传图调用的函数
function last_borad(){
	if(aImage_length>=4){
		var temp=document.getElementById('imgss').getElementsByTagName("img");
		if(aImage_index!=0){
			aImage_index-=4;
			if(aImage_index<0)
				aImage_index=0;
			if(aImage_index-temp.length<0)
				aImage_index=aImage_index+temp.length-aImage_index;
			for(var i=0;i<temp.length;i++){
				temp[i].src="../db/index/images/"+aImage[aImage_index-(temp.length-i)].imgName;
			}
		}
	}
}


//从后台获取宣传照片调用的函数
function getAImage(){
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
  	}
	else{
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 	} 
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			aImage=eval(xmlhttp.responseText);
			aImage_length=aImage.length;
    	}
 	}
	xmlhttp.open("POST",'main.php?controller=index&method=getAImage',true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	next_borad();
}

*/

