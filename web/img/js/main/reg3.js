//x,y 坐标,radius 半径,process 百分比,backColor 中心颜色, proColor 进度颜色, fontColor 中心文字颜色
function DrowProcess(x,y,radius,process,backColor,proColor,fontColor){
	var canvas = document.getElementById('myCanvas');
	if (canvas.getContext) {
		var cts = canvas.getContext('2d');
	}else{
		return;
	}
	//css设置的canvas和直接在标签里或js里设置的不一样，css只是设置元素本身大小，而绘图表面会是默认大小300x150像素
	canvas.width=200;
	canvas.height=200;
	canvas.marginTop=20;
	cts.beginPath();  
	// 坐标移动到圆心  
	cts.moveTo(x, y);  
	// 画圆,圆心是24,24,半径24,从角度0开始,画到2PI结束,最后一个参数是方向顺时针还是逆时针  
	cts.arc(x, y, radius, 0, Math.PI * 2, false);  
	cts.closePath();  
	// 填充颜色  
	cts.fillStyle = backColor;  
	cts.fill();

	cts.beginPath();  
	// 画扇形的时候这步很重要,画笔不在圆心画出来的不是扇形  
	cts.moveTo(x, y);  
	// 跟上面的圆唯一的区别在这里,不画满圆,画个扇形  
	cts.arc(x, y, radius, Math.PI * 1.5, Math.PI * 1.5 -  Math.PI * 2 * process / 100, true);  
	cts.closePath();  
	cts.fillStyle = 'rgba(2,255,0,0.1)';  
	cts.fill(); 
	
	//填充背景白色
	cts.beginPath();  
	cts.moveTo(x, y); 
	cts.arc(x, y, radius - (radius * 0.26), 0, Math.PI * 2, true);  
	cts.closePath();
	cts.fillStyle = 'rgba(255,255,255,0.9)';  
	cts.fill(); 

	// 画一条线  
	cts.beginPath();  
	cts.arc(x, y, radius-(radius*0.30), 0, Math.PI * 2, true);  
	cts.closePath();  
	// 与画实心圆的区别,fill是填充,stroke是画线  
	cts.strokeStyle = backColor;  
	cts.stroke();  
	  
	//在中间写字 
	cts.font = "bold 32pt Arial";  
	cts.fillStyle = fontColor;  
	cts.textAlign = 'center';  
	cts.textBaseline = 'middle';  
	cts.moveTo(x, y);  
	cts.fillText(process+"%", x, y);  
	
}
bfb = 0;
time=0;
function Start(){
	DrowProcess(100,100,100,bfb,'#ddd','#6495ED','#6495ED');
	t = setTimeout(Start,15);
	if(bfb>=100){
		clearTimeout(t);
		bfb=0;
		return;
	}
	bfb+=1;
}


