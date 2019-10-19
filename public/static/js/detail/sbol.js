var memberId =1200;//给新添加的部件
var getMemberId =0;//初始化相当于
var cishu = 0;
window.onload = dataPass();
window.onload = nomalStyle();
window.onload = insertToolTip(); 

//数据传输从这里  去掉function ，对应变量数据传输即可
//function deal(){
// var part = @json($part);
// var features = @json($features);


////////////////  下载部分
function downloadTheCapture(){	//成图及下载
	var shareContent = document.getElementById("gridDemo-down");//需要截图的包裹的（原生的）DOM 对象
	$('html,body').animate({scrollTop: '0px'}, 10);
	document.body.scrollTop = 0;
	var width = shareContent.offsetWidth; //获取dom 宽度
	var height = shareContent.offsetHeight; //获取dom 高度
	var canvasForSbol = document.createElement("canvas"); //创建一个canvas节点
	var scale = 2; //定义任意放大倍数 支持小数
	canvasForSbol.width = width * scale; //定义canvas 宽度 * 缩放
	canvasForSbol.height = height * scale; //定义canvas高度 *缩放
	canvasForSbol.getContext("2d").scale(scale, scale); //获取context,设置scale
	console.log(width);
	var opts = {
		scale: scale, // 添加的scale 参数
		canvas: canvasForSbol, //自定义 canvas
		logging: false, //日志开关，便于查看html2canvas的内部执行流程
		width: width, //dom 原始宽度
		height: height,
		useCORS: true ,// 【重要】开启跨域配置
		backgroundColor: "white",
	};
	
	html2canvas(shareContent,opts).then(function(canvasForSbol){//成图
		var context = canvasForSbol.getContext('2d');
		context.ImageSmoothingEnabled = false;//关闭抗锯齿
		context.webkitImageSmoothingEnabled = false;
		context.msImageSmoothingEnabled = false;
		context.imageSmoothingEnabled = false;
		var imgUri = canvasForSbol.toDataURL();

		openDownloadDialog( imgUri, totalNameTry+'.png')

	})
	shareContent.style.position = "static";

}

function openDownloadDialog(url, saveName){//通用的打开下载对话框方法
	if(typeof url == 'object' && url instanceof Blob)
	{
		url = URL.createObjectURL(url); // 创建blob地址
	}
	var aLink = document.createElement('a');
	aLink.href = url;
	aLink.download = saveName || ''; // HTML5新增的属性，指定保存文件名，可以不要后缀，注意，file:///模式下不会生效
	var event;
	if(window.MouseEvent) event = new MouseEvent('click');
	else
	{
		event = document.createEvent('MouseEvents');
		event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
	}
	aLink.dispatchEvent(event);
}


function dataPass(){//普通赋数组由于magic原因不能使用
	siteStartArray1 = new Array(siteStartArray.length)
	siteEndArray1 = new Array(siteEndArray.length)
	featureArray1 = new Array(featureArray.length)
	nameArray1 = new Array(nameArray.length)
	sequenceDirection1 = new Array(sequenceDirection.length)
	siteStartArray.forEach(function(item, index){
		siteStartArray1[index] = item;
	})
	siteEndArray.forEach(function(item, index){
		siteEndArray1[index] = item;
	})
	featureArray.forEach(function(item, index){
		featureArray1[index] = item;
	})
	nameArray.forEach(function(item, index){
		nameArray1[index] = item;
	})
	sequenceDirection.forEach(function(item, index){
		sequenceDirection1[index] = item;
	})
}

//图形化界面需要代码
function nomalStyle(){

	var tag1 = "";
	for (var i = 0; i < siteStartArray1.length; i++) {//排序
		for (var j = 0; j < siteStartArray1.length-i-1; j++) {//冒起起始点最小的,起始点相同终止点最大的,起始点终止点相同特征不为misc的
			if(siteStartArray1[j] > siteStartArray1[j+1]||siteStartArray1[j] == siteStartArray1[j+1]&&siteEndArray1[j]<siteEndArray1[j+1]||siteStartArray1[j] == siteStartArray1[j+1]&&siteEndArray1[j]==siteEndArray1[j+1]&&featureArray1[j+1]!="misc_feature"){
				var c = siteStartArray1[j];
				siteStartArray1[j] = siteStartArray1[j+1];
				siteStartArray1[j+1] = c;
				c = siteEndArray1[j];
				siteEndArray1[j] = siteEndArray1[j+1];
				siteEndArray1[j+1] = c;
				c = nameArray1[j];
				nameArray1[j] = nameArray1[j+1];
				nameArray1[j+1] = c;
				c = featureArray1[j];
				featureArray1[j] = featureArray1[j+1];
				featureArray1[j+1] = c;
				c = sequenceDirection1[j];
				sequenceDirection1[j] = sequenceDirection1[j+1];
				sequenceDirection1[j+1] = c;
			}
		}
	}
	
	
	for(var k = 0; k<siteStartArray1.length; k++){
		var memberId = 1500+k;
		var tag3 =sequenceTotal.slice(siteStartArray1[k],siteEndArray1[k]);
		var tag = "";
		if(sequenceDirection1[k]==1){
		tag="<div id='"+memberId+"' data-type='"+featureArray1[k]+"-1'data-name='"+nameArray1[k]+"'data-start='"+siteStartArray1[k]+"' data-end='"+siteEndArray1[k]+"' class='md-mr-dd sbolv "+featureArray1[k] +"-1 tooltip-show'data-modal='modal-15' data-sequence='"+tag3+"' data-original-title=''>" + nameArray1[k] +"</div>";
		}else{
			tag="<div id='"+memberId+"' data-type='"+featureArray1[k]+"'data-name='"+nameArray1[k]+"'data-start='"+siteStartArray1[k]+"' data-end='"+siteEndArray1[k]+"' class='md-mr-dd sbolv "+featureArray1[k] +" tooltip-show'data-modal='modal-15' data-sequence='"+tag3+"' data-original-title=''>" + nameArray1[k] +"</div>";
		}
		tag1 += tag;
	}
	document.getElementById("gridDemo-down").innerHTML = tag1;
	document.getElementById("totalName").innerHTML = "Part name: "+totalNameTry;
	getTitle();//添加浮窗事件
	if(document.getElementById("gridDemo-down").offsetHeight>=390||cishu == 1){
		document.getElementById("gridDemo-down").style.overflowX = "scroll";
		document.getElementById("gridDemo-down").style.whiteSpace = "nowrap";
		cishu =1;
	}else{
		document.getElementById("gridDemo-down").style.overflowX = "initial";
		document.getElementById("gridDemo-down").style.whiteSpace = "normal";
	}
}

function specialStyle(){
	// dealUpdataData();
	for (var i = 0; i < siteStartArray.length; i++) {//排序
		for (var j = 0; j < siteStartArray.length-i-1; j++) {//冒起起始点最小的,起始点相同终止点最大的,起始点终止点相同特征不为misc的
			if(siteStartArray[j] > siteStartArray[j+1]||siteStartArray[j] == siteStartArray[j+1]&&siteEndArray[j]<siteEndArray[j+1]||siteStartArray[j] == siteStartArray[j+1]&&siteEndArray[j]==siteEndArray[j+1]&&featureArray[j+1]!="misc_feature"){
				var c = siteStartArray[j];
				siteStartArray[j] = siteStartArray[j+1];
				siteStartArray[j+1] = c;
				c = siteEndArray[j];
				siteEndArray[j] = siteEndArray[j+1];
				siteEndArray[j+1] = c;
				c = nameArray[j];
				nameArray[j] = nameArray[j+1];
				nameArray[j+1] = c;
				c = featureArray[j];
				featureArray[j] = featureArray[j+1];
				featureArray[j+1] = c;
				c = sequenceDirection[j];
				sequenceDirection[j] = sequenceDirection[j+1];
				sequenceDirection[j+1] = c;
			}
		}
	}

	for (var i = 0; i < siteStartArray.length-1; i++) {//删除重复
		if(siteStartArray[i] == siteStartArray[i+1]&&siteEndArray[i] == siteEndArray[i+1]){
			siteStartArray.splice(i+1,1);
			siteEndArray.splice(i+1,1);
			nameArray.splice(i+1,1);
			featureArray.splice(i+1,1);
			sequenceDirection.splice(i+1,1);
			i--;
		}
	}

	var includeArray = new Array();
	var reproduceArray = new Array();

	for (i = 0; i < siteStartArray.length; i++) {//将包含关系\重复关系的位置存入
		includeArray[i] = new Array();
		reproduceArray[i] = new Array();
		var k = 0;
		var l = 0;
		for(var j =i+1; j<siteStartArray.length; j++){
			if(siteStartArray[i]<=siteStartArray[j]&&siteEndArray[i]>=siteEndArray[j]){
				includeArray[i][k] = j;
				k++;
			}
			if(siteStartArray[i]<siteStartArray[j]&&siteEndArray[i]<siteEndArray[j]&&siteEndArray[i]>=siteStartArray[j]){
				reproduceArray[i][l] = j;
				l++;
			}
	}}

	for(i = includeArray.length-1; i>=0; i--){//清楚重复的位置数据
		for(j = includeArray[i].length-1; j>=0; j--){
			var deleteNumber = includeArray[i][j];
			for(k =0; k<i; k++){
				for(l =0; l<=includeArray[k].length; l++){
					if(deleteNumber==includeArray[k][l]){
						includeArray[k].splice(l,1);
						l--;
					}
				}
			}
		}
	}

	var writeDownTheNumber = 0;
	var writeDownTheNumber1 = 0;
	var writeDownTheNumber2 = 0;
	var writeDownTheNumber3 = 0;
	var tagForInclude2 ="";
	var tag555 = "";
	var tag333 = "";
	var everyPart = new Array(siteStartArray.length-1)
	for(i = 0; i < siteStartArray.length; i++){//新版本导入HTML中
		var tag3 =sequenceTotal.slice(siteStartArray[i]-1,siteEndArray[i]);
		if(sequenceDirection[i]==0){
			everyPart[i] = "<div id='"+i+"'data-type='"+featureArray[i]+"' data-name='"+nameArray[i]+"'data-start='"+siteStartArray[i]+"' data-end='"+siteEndArray[i]+"' class='md-mr-dd sbolv "+featureArray[i] +" tooltip-show'data-modal='modal-15' data-sequence='"+tag3+"' data-original-title=''>" + nameArray[i] +"</div>";
		}else if(sequenceDirection[i]==1){
			everyPart[i] = "<div id='"+i+"'data-type='"+featureArray[i]+"-1' data-name='"+nameArray[i]+"'data-start='"+siteStartArray[i]+"' data-end='"+siteEndArray[i]+"' class='md-mr-dd sbolv "+featureArray[i] +"-1 tooltip-show'data-modal='modal-15' data-sequence='"+tag3+"' data-original-title=''>" + nameArray[i] +"</div>";					
		}
	}
	for(i = 0; i < siteStartArray.length; i++){
		if(includeArray[i].length>0){
			everyPart[i] = "<div class = 'rect1'>"+ everyPart[i];
			var diguinumber = includeArray[i][includeArray[i].length-1]
			moliu(diguinumber);
		}
		if(reproduceArray[i].length>0){
			everyPart[i] = "<div class = 'rect2'>"+ everyPart[i];
			var diguinumber = reproduceArray[i][reproduceArray[i].length-1]
			moliu2(diguinumber);
		}
		tag555 += everyPart[i];
	}
	
	function moliu(lastInclude){//递归函数来添加</div>
		if(includeArray[lastInclude].length>0){
			var diguinumber= includeArray[lastInclude][includeArray[lastInclude].length-1]
			moliu(diguinumber);
			return;
		}else{
			everyPart[lastInclude] = everyPart[lastInclude] + "</div>";
			return;
		}
	}
	function moliu2(lastInclude){//递归函数来添加</div>
		if(reproduceArray[lastInclude].length>0){
			var diguinumber= reproduceArray[lastInclude][reproduceArray[lastInclude].length-1]
			moliu2(diguinumber);
			reproduceArray[lastInclude].shift();
			return;
		}else if(includeArray[lastInclude].length>0){
			var diguinumber = includeArray[lastInclude][includeArray[lastInclude].length-1]
			moliu(diguinumber);
			return;
		}else{
			everyPart[lastInclude] = everyPart[lastInclude] + "</div>";
			return;
		}
	}
	document.getElementById("gridDemo-down").innerHTML = tag555;
	getTitle();
	document.getElementById("totalName").innerHTML = "Part name: "+totalNameTry;
	if(document.getElementById("gridDemo-down").offsetHeight>260){
		document.getElementById("gridDemo-down").style.overflowX = "scroll";
		document.getElementById("gridDemo-down").style.whiteSpace = "nowrap";
	}
}

function getTitle(){//动态生成start、end_sit用于刷新排序
	var orderByDiv = document.getElementsByClassName("tooltip-show");
	for(var i = 0; i <orderByDiv.length; i++){
		var tag3 = orderByDiv[i].getAttribute('data-sequence');//获得序列数据
		var tag2 = orderByDiv[i].getAttribute('data-name');
		var tag1 = orderByDiv[i].getAttribute('data-type');
		var start11 = orderByDiv[i].getAttribute('data-start');
		var end11 = orderByDiv[i].getAttribute('data-end');
		var sequenceLength = tag3.length;
		if(tag3.length >= 64){
			tag3 = tag3.slice(0,64);
			tag3 += "...";
		}
		var title = "<div>Feature</div> \r\nPart_type : "+tag1+" \r\nName : "+tag2+" \r\nStart_site : "+start11+" \r\nEnd_site : "+end11+" \r\nSequence length : "+sequenceLength + "\r\nSequence : "+tag3;//构建浮窗数据
		orderByDiv[i].setAttribute( 'data-original-title' , title );
	}
	tooltipFunction();
}

function fasta(){//创建fasta下载
	var longSequence = sequenceTotal;
	fastaSequence = ">ID|" + totalNameTry + "  DE=" + descriptionForFasta + "\r\n"; //descriptionForGenbank后来传输数据时候需要替换
	for(var i=0; i<longSequence.length/70; i++){
		fastaSequence +=longSequence.slice(i*70,i*70+70) + "\r\n";
	}
	var export_blob = new Blob([fastaSequence]);
	var urlObject = window.URL || window.webkitURL || window;
	var url1 = urlObject.createObjectURL(export_blob);//转成url格式
	openDownloadDialog(url1,totalNameTry);//下载
}


function genBankSequence(){//合成序列为genBank格式并且下载
		var longSequence = sequenceTotal;
		var genSequence = "ORIGIN \r\n";
		for(var i=0; i<longSequence.length/60; i++){
			var j = 60*i;
			var h = j+1;
			if(i==0){//前排等宽右对齐
				genSequence += "    "+h;
			}
			else if(i==1){
				genSequence += "   "+h;
			}
			else if(i>=2&&i<17){
				genSequence += "  "+h;
			}
			else{
				genSequence += " "+h;
			}
			for(var k=0; k<=5; k++){
				genSequence += " " + longSequence.slice(j+k*10,j+k*10+10);
			}
			genSequence += " \r\n";

		}
		genSequence += "//";

		var featureValue = "FEATURES            Location/Qualifiers \r\n";
		var finalFeature = document.getElementsByClassName("sbolv");
		var blank = "                     ";
		for(var i=0; i<finalFeature.length; i++){//循环,进而将序列拼接,
			var startA = finalFeature[i].getAttribute('data-start');
			var endA = finalFeature[i].getAttribute('data-end');
			var theName = finalFeature[i].innerHTML;
			var theType = finalFeature[i].getAttribute('data-type');
			var a = 16-theType.length;
			theType += blank.slice(1,a);
			featureValue += "     " + theType +  startA +".."+ endA +' \r\n';
			featureValue += "                    /label=" + theName + " \r\n";
		}
		if(totalDefinition){
			var theFistLine = "LOCUS       " + totalNameTry + "            " +longSequence.length+" bp    DNA     linear       " + dateToday+'\r\nDEFINITION  '+totalDefinition+'\r\n';
		}else{
			var theFistLine = "LOCUS       " + totalNameTry + "            " +longSequence.length+" bp    DNA     linear       " + dateToday+'\r\n';
		}
		var genBankValue = theFistLine + featureValue + genSequence;//拼接成最终genbank
		// document.getElementById("sequenceConcat").innerHTML = genBankValue;//调试完成后删除
		var export_blob = new Blob([genBankValue]);
		var urlObject = window.URL || window.webkitURL || window;
		var url1 = urlObject.createObjectURL(export_blob);//转成url格式
		openDownloadDialog(url1,totalNameTry);//下载
	}
	
	function tooltipFunction(){
	        $('.sbolv').each(function(){
	            $(this).mouseover(function(){
	                     var tooltip=$(this).attr('data-original-title');
	                     var left=$(this).position().left;
	                     var top =$(this).position().top;
						 var width = $(this).width();
						 var height = $(this).height();
						 var idForTooltip = $(this).attr('id');
	                     showTooltip(tooltip,left,top,true,idForTooltip,width,height)
	                    }
	            );
	            $(this).mouseout(function(){
					var idForTooltip = $(this).attr('id');
	                showTooltip('','','',false,idForTooltip,'','')
	            })
	        });
	        function showTooltip(html,left,top,bool,idForTooltip,width,height){
	            if(bool){
				  $("#tooltip"+idForTooltip).html(html).show().css({'top':top,'left':left})
				  var length=$("#tooltip"+idForTooltip).width()/2+10;
				  var Hlength=$("#tooltip"+idForTooltip).height();
				  $("#tooltip"+idForTooltip).css({'margin-left':-length+width/2,'margin-top':-Hlength-10})
				  
				  $("#arrow"+idForTooltip).show().css({'top':top,'left':left})
				  var length=$("#arrow"+idForTooltip).width()/2+10;
				  var hlength=$("#arrow"+idForTooltip).height();
				  $("#arrow"+idForTooltip).css({'margin-left':-length+width/2,'margin-top':-hlength+9.8})
	            }else{
	                 $('#tooltip'+idForTooltip).hide();
					 $('#arrow'+idForTooltip).hide();
	            }
	        }
	    }
	    
	    function insertToolTip(){
			var numberOfFeature = siteStartArray.length;
			var toolSavePart = "";
	    	for(var i= 0; i<numberOfFeature; i++){
	    		memberId = i;
	    		memberId2 = i*1+1500;
	    		toolSavePart += "<span class=\"mytooltip\" id=\"tooltip"+memberId+"\"></span>";
				toolSavePart += "<span id=\"arrow"+memberId+"\" class = \"arrow\"></span>";
				toolSavePart += "<span class=\"mytooltip\" id=\"tooltip"+memberId2+"\"></span>";
				toolSavePart += "<span id=\"arrow"+memberId2+"\" class = \"arrow\"></span>";
	    	}
	    	document.getElementById('toolSavePart').insertAdjacentHTML("beforeEnd",toolSavePart);
	    }
