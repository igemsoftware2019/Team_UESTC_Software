var memberId =1200;//给新添加的部件
var getMemberId =0;//初始化相当于
var saveCookiesId = 4400;//保存时用到的cookie 的name
var dateString = new Date();
var dateToday = getDayMonthYear(dateString);//得到网页打开时间即创建时间
var newTime = dateString.getTime()%100000000;
document.getElementById('totalName').innerHTML ="Part name: NEW_"+newTime;//先根据时间自定义一个Name插入

function AddEle1() {//添加元件,读取文本框内容,赋予内容及ID,然后执行dontknow赋予事件, ++使后面ID能与前者区别开来
	var tag1 = document.getElementById('feature').value;
	var tag2 = document.getElementById('genename').value;
	var tag3 = document.getElementById('sequence').value;
	if(tag1.length <= 1){
		tag1 = "user-defined";
	}
	if(!tag2){
		tag2 = tag1;
	}
	var tag="<div id='"+memberId+"' data-type='"+tag1+"'data-name='"+tag2+"'data-start='' data-end='' class='md-mr-dd sbolv "+tag1 +" tooltip-show'data-modal='modal-15' data-sequence='"+tag3+"' data-original-title=''>" + tag2 +"</div>";
	document.getElementById('gridDemo-down').insertAdjacentHTML("beforeEnd",tag);
	var toolSavePart = "<span class=\"mytooltip\" id=\"tooltip"+memberId+"\"></span>"
	toolSavePart += "<span id=\"arrow"+memberId+"\" class = \"arrow\"></span>"
	document.getElementById('toolSavePart').insertAdjacentHTML("beforeEnd",toolSavePart);
	
	
	toolSavePart="";
	// document.getElementById('gridDemo-down').insertAdjacentHTML("beforeEnd","<div class='rect1' style='display: inline-block;'>"+tag+tag+"</div>");
	// document.getElementById('gridDemo-down').insertAdjacentHTML("beforeEnd",tag+tag);
	dynamicCount();//插入一个就动态生成一个，防止中途有删除导致其他方式计数不准
	dontknow();//重新添加一遍拖拽事件	
// 	var finalSequence = document.getElementsByClassName("sbolv");//原本是在tooltip中写入title，但是会出现无法修改的问题
// 	var lengthForSequence = finalSequence.length -1;//数组从0开始
// 	var content = finalSequence[lengthForSequence].getAttribute('data-sequence');
	memberId++;//使ID增加进而改变ID
	if(document.getElementById("gridDemo-down").offsetHeight>420){
		var numberToDelete = memberId-1;
		$("#" + numberToDelete).remove();
		alert("Error: Too much.")
	}
}

function change2(obj) {//改变元件,先读取文本框内容,然后赋予,obj获得其id
	var tag2 = document.getElementById('feature1'). value;
	var tag1 = document.getElementById('genename1').value;
	var tag3 = document.getElementById('sequence1').value;
	if(!tag2){
		tag2 = "user-defined";
	}
	if(!tag1){
		tag1 = tag2;
	}
	document.getElementById(obj).innerHTML = tag1;
	document.getElementById(obj).classList.remove("sbolv","barcode","binding","Biobrick","cds","conserved" ,"insulator" ,"misc","mutation","NULL","operator","polya","promoter","rbs","scar","start","stem_loop" ,"stop","tag","terminator","user-defined");//需要补充删除的种类们
	document.getElementById(obj).classList.add(tag2,"sbolv");
	document.getElementById(obj).setAttribute( 'data-sequence' , tag3 );//更新数据
	document.getElementById(obj).setAttribute( 'data-name' , tag1 );
	document.getElementById(obj).setAttribute( 'data-type' , tag2 );
	dynamicCount();
}
//////////////////
var definition = "";//定义全局变量存储definition
function AddEle3(){
	var theNameOfThisPart = document.getElementById('theNameOfThisPart').value;
	document.getElementById('totalName').innerHTML = "Part name: "+theNameOfThisPart;
	definition = document.getElementById('definition').value;
	definition = definition.replace(" \r\n"," \r\n            ");
	document.getElementById("close3").click();
}
////////////////
function clickToChoose2(obj){
	var cc = document.getElementById(obj);
	var dd = cc.getAttribute( 'class' );
	var ee = dd.replace('sbolvs ', '');
	document.getElementById("feature").value = ee;//改成对于的input中的id
}

function clickToChoose3(obj){
	var cc = document.getElementById(obj);
	var dd = cc.getAttribute( 'class' );
	var ee = dd.replace('sbolvs ', '');
	document.getElementById("feature1").value = ee;//改成对于的input中的id
}
//clickToChoose选择对应的元件,自动填入
////////////		
function clearTheSortablePart(){//弹窗判断清空
	var areYouSure = confirm("Are you sure?");
	if (areYouSure == true){
		document.getElementById('gridDemo-down').innerHTML = "";	}
	else{
	}
}
////////////			
function setsetCookie(){//save
	var cname = saveCookiesId;
	var cvalue = document.getElementById('gridDemo-down').innerHTML;
	var cname1 = saveCookiesId+1;
	var cvalue1 = document.getElementById('totalName').innerHTML;
	
	while (cvalue.indexOf(' \r\n')>=0){
		cvalue = cvalue.replace(' \r\n','');
	}//循环检查换行进行删除
	cvalue = cvalue.replace('			','');//为了删干净空格，后面调试发现之前写的存在bug故修复
	cvalue = cvalue.replace('\n','');
	var cnamevalue = cname + "=" + cvalue +";";
	cvalue1 = cname1 + "=" + cvalue1 +";";
	if(cvalue.length<20){
		if(!confirm("Noting exist,it would be covered,\r\nare you sure?")){
			return;
		}
	}
	
	document.cookie = cnamevalue;
	document.cookie = cvalue1;
}

function getgetCookie(){//load
	// saveCookiesId_1 = saveCookiesId-1;//如果想保存多条再进行,保存多条会导致刷新之后无法load 因为savecookie重新加载了
	var testForCookie = getCookie(saveCookiesId);
	var testForCookie2 = getCookie(saveCookiesId+1);
	document.getElementById('gridDemo-down').innerHTML = testForCookie;
	document.getElementById('totalName').innerHTML = testForCookie2;
	dontknow();//添加双击事件
	// removeDbclickEvent();
	dynamicCount();
}



function getCookie(cname){//获得cookie
	var name = cname + "=";
	
	var ca = document.cookie.split(';');//cookie存储时是以name1 = value1; name2 =value2 存储的,split分割开来

	for(var i=0; i<ca.length; i++) {
		var c = ca[i].trim();
		if (c.indexOf(name)==0) { return c.substring(name.length,c.length); }
	}//匹配,匹配到对应的返回对应值

	return "";//若无,则返回空
}

////////////////
function downloadTheCapture(){	//成图及下载	
	shareContent = document.getElementById("gridDemo-down");//需要截图的包裹的（原生的）DOM 对象
	if(shareContent.innerHTML.length<10){
		alert("Error: Noting exist.");
		return;
	}
	
	var DomJiedian = document.getElementsByClassName("sbolv");//magic
	var widthtotal = 0;
	for(var i=0; i<DomJiedian.length; i++){
		widthtotal +=DomJiedian[i].scrollWidth;
	}

	jietuweidian = document.getElementsByClassName("inPart")[0]
	var	topForCanvas = jietuweidian.style.top;
	leftForCanvas = jietuweidian.style.left;
	marginLeftForCanvas = jietuweidian.style.marginLeft;
	jietuweidian.style.top = 0;
	jietuweidian.style.left = 0;
	jietuweidian.style.marginLeft = 0;
	
	var width = shareContent.offsetWidth; //获取dom 宽度
	var height = shareContent.offsetHeight; //获取dom 高度
	var heighttotal = height;
	var canvas = document.createElement("canvas"); //创建一个canvas节点
	var scale = 2 ;//定义任意放大倍数 支持小数
	canvas.width = width * scale; //定义canvas 宽度 * 缩放
	canvas.height = height * scale; //定义canvas高度 *缩放
	canvas.getContext("2d").scale(scale, scale); //获取context,设置scale 
	var jishujun =  Math.ceil(widthtotal/window.screen.availWidth);
	
	if(widthtotal>window.screen.availWidth   ){
		widthtotal = window.screen.availWidth   +70;
		heighttotal = jishujun*140;
	}
	var opts = {
		scale: scale, // 添加的scale 参数
		canvas: canvas, //自定义 canvas
		logging: false, //日志开关，便于查看html2canvas的内部执行流程
		width: widthtotal, //dom 原始宽度
		height: heighttotal,
		useCORS: true ,// 【重要】开启跨域配置
		backgroundColor: "white",
		x:0,
		y:window.pageYOffset,
	};
	
	shareContent.style.position = "fixed";//magic
	html2canvas(shareContent,opts).then(function(canvas){//成图
		var context = canvas.getContext('2d');
		context.ImageSmoothingEnabled = false;//关闭抗锯齿
		context.webkitImageSmoothingEnabled = false;
		context.msImageSmoothingEnabled = false;
		context.imageSmoothingEnabled = false;
		var imgUri = canvas.toDataURL();
		var total = document.getElementById('totalName').innerHTML.replace("Part name: ","");
		openDownloadDialog( imgUri, total+'.png');
	})
	
	shareContent.style.position = "static";//magic
	jietuweidian.style.top = topForCanvas;
	jietuweidian.style.left = leftForCanvas;
	jietuweidian.style.marginLeft = marginLeftForCanvas;
}

	/**
	 * 通用的打开下载对话框方法，没有测试过具体兼容性
	 * @param url 下载地址，也可以是一个blob对象，必选
	 * @param saveName 保存文件名，可选
	 */
	function openDownloadDialog(url, saveName){
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
	
	function dynamicCount(){//动态生成start、end_sit用于刷新排序
		var setLength1 = 1;
		var orderByDiv = document.getElementsByClassName("sbolv");
		for(var i = 0; i <orderByDiv.length; i++){
			var tag3 = orderByDiv[i].getAttribute('data-sequence');//获得序列数据
			var tag2 = orderByDiv[i].getAttribute('data-name');
			var tag1 = orderByDiv[i].getAttribute('data-type');
			if(!tag3||tag3.length == 0){
				var title = "<div>Feature</div> \r\nPart_type : "+tag1+" \r\nname : "+tag2+" \r\nSequence length:0";//构建浮窗数据
				if(orderByDiv[i].getAttribute('class').indexOf("line") != -1 ){
					title = "Module type : "+tag1+" \r\nModule name : "+tag2;
				}
				orderByDiv[i].setAttribute( 'data-original-title' , title );
				continue;
			}
			orderByDiv[i].setAttribute( 'data-start' , setLength1 );//存储开始结束位点数据,再存入title 中，使其浮窗能够弹出
			var theEnd = setLength1 + tag3.length -1;
			orderByDiv[i].setAttribute( 'data-end' , theEnd );
			if(tag3.length >= 54){
				tag3 = tag3.slice(0,54);
				tag3 += "...";
			}

			var title = "<div>Feature</div> \r\nPart_type : "+tag1+" \r\nname : "+tag2+" \r\nStart_site : "+setLength1+" \r\nEnd_site : "+theEnd+" \r\nSequence:"+tag3;//构建浮窗数据
			orderByDiv[i].setAttribute( 'data-original-title' , title );
			setLength1 = theEnd+1;
		}
		tooltipFunction();
	}
	
// 	function removeDbclickEvent(){
// 		var orderByDiv = document.getElementsByClassName("line");
// 		for(var i = 0; i <orderByDiv.length; i++){
// 			orderByDiv[i].removeEventListener('dblclick',buttonno3,false);
// 		}
// 	}
	
	function sequenceConcat(){//将所有part字符串强行拼接
		var finalSequence = document.getElementsByClassName("sbolv");
		var finalSequence110 = '';
		for(var i=0; i<finalSequence.length; i++){//循环,进而将序列拼接,
			if(finalSequence[i].getAttribute('data-sequence')){
			finalSequence110 += finalSequence[i].getAttribute('data-sequence');
			}
		}
		return finalSequence110;
	}
	
	function downloadfasta(){
		var chargecharge = document.getElementById("gridDemo-down").innerHTML;
		var numbercharge = chargecharge.length;
		if(numbercharge>20){
			fasta();
		}
		else{
			alert("Error:Noting exist.");
		}
	}
	
	function fasta(){//创建fasta下载
		var longSequence = sequenceConcat();
		var total = document.getElementById('totalName').innerHTML.replace("Part name: ","");
		fastaSequence = ">ID|" + total + "\r\n";
		for(var i=0; i<longSequence.length/70; i++){
			fastaSequence +=longSequence.slice(i*70,i*70+70) + "\r\n";
		}
		var export_blob = new Blob([fastaSequence]);
		var urlObject = window.URL || window.webkitURL || window;
		var url1 = urlObject.createObjectURL(export_blob);//转成url格式
		openDownloadDialog(url1,total);//下载
	}
	
	function downloadgenBank(){
		var chargecharge = document.getElementById("gridDemo-down").innerHTML;
		var numbercharge = chargecharge.length;
		if(numbercharge>20){
			genBankSequence();
		}
		else{
			alert("Error:Noting exist.");
		}
	}
	
	function genBankSequence(){//合成序列为genBank格式
		var longSequence = sequenceConcat();
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
		var total = document.getElementById('totalName').innerHTML.replace("Part name: ","");
		if(definition){
			var theFistLine = "LOCUS       " + total + "            " +longSequence.length+" bp    DNA     linear       " + dateToday+'\r\nDEFINITION  '+definition+'\r\n';
		}else{
			var theFistLine = "LOCUS       " + total + "            " +longSequence.length+" bp    DNA     linear       " + dateToday+'\r\n';
		}
		var genBankValue = theFistLine + featureValue + genSequence;//拼接成最终genbank
		// document.getElementById("sequenceConcat").innerHTML = genBankValue;//调试完成后删除
		var export_blob = new Blob([genBankValue]);
		var urlObject = window.URL || window.webkitURL || window;
		var url1 = urlObject.createObjectURL(export_blob);//转成url格式
		openDownloadDialog(url1,total);//下载
	}

	function getDayMonthYear(obj){//日期转换为genBank格式日期，返回
		var month=new Array(12)
			month[0]="Jan"
			month[1]="Feb"
			month[2]="Mar"
			month[3]="Apr"
			month[4]="May"
			month[5]="June"
			month[6]="July"
			month[7]="Aug"
			month[8]="Sep"
			month[9]="Oct"
			month[10]="Nov"
			month[11]="Dec"
		var aa = obj.getDate();
		var bb = month[obj.getMonth()];
		var cc = obj.getFullYear();
		var dd = "";
		dd = aa + "-" + bb + "-" + cc;
		return dd;
	}
	
	function clickToChoose4(obj){
		var cc = document.getElementById(obj);
		var dd = cc.getAttribute( 'class' );
		var ee = dd.replace('sbolvs ', '');
		document.getElementById("feature4").value = ee;
	}
	var numberForModule=0;
	var moduleName=new Array();
	var moduleType=new Array();
	var moduleStartSite=new Array();
	var moduleEndSite=new Array();
	var moduleSequence = "";
	
	function saveModuleData(){//因为要用到两次所以放函数里
		moduleName[numberForModule]=document.getElementById("theNameOfThisModulePart").value;
		moduleType[numberForModule]=document.getElementById("feature4").value;
		moduleStartSite[numberForModule]=document.getElementById("startSite4").value*1;
		moduleEndSite[numberForModule]=document.getElementById("endSite4").value*1;
		if(!moduleName[numberForModule]&&moduleType[numberForModule]){
			moduleName[numberForModule]=moduleType[numberForModule];
		}
		if(!moduleName[numberForModule]){
			moduleName[numberForModule] = "user-defined";
		}
		if(!moduleType[numberForModule]){
			moduleType[numberForModule] = "user-defined";
		}
	}
	
	function nextPart(obj){//next按钮需要做的
		if(numberForModule!=0){
			if(!document.getElementById('startSite4').value){
				alert("Please enter start site. ");
				return("1");
			}else if(!document.getElementById('endSite4').value){
				alert("Please enter end site. ");
				return("1");
			}else if(document.getElementById('endSite4').value>moduleSequence.length){
				alert("End site can't be longer than sequence length.   "+moduleSequence.length+"bp");
				return("1");
			}else if(obj!=1&&document.getElementById('endSite4').value==moduleSequence.length){
				alert("You have done it,please press put it.");
				return;
			}
			saveModuleData();//存储数据
		}else if(numberForModule==0){
			if(document.getElementById('sequence4').value.length<1){
				alert("Please enter the sequence. ");
				return 1;
			}else{
				if(document.getElementById('feature4').value.length<1){
					document.getElementById('feature4').value = "user-defined";
				}
				if(document.getElementById('nameOfThisTotalPart').value.length<1){
					document.getElementById('nameOfThisTotalPart').value = "user-defined";
				}
				moduleName[0] = document.getElementById('nameOfThisTotalPart').value; 
				moduleType[0] = document.getElementById('feature4').value;
				moduleSequence = document.getElementById('sequence4').value;
				moduleStartSite[0] = 1;
				moduleEndSite[0] = moduleSequence.length;
			}
		}
		
		numberForModule++;
		if(numberForModule>1){
			var endSiteNumber = moduleEndSite[numberForModule-1]+1;
			document.getElementById("nextPartId").innerHTML = "<div><a>Total sequence length:  "+moduleSequence.length+"bp</a></div><div><a>NO."+numberForModule+" name:</a></div><input type='text' id='theNameOfThisModulePart'  placeholder=\"user-defined\"><div><a>NO."+numberForModule+" type:</a></div><input type='text' id='feature4'  placeholder=\"user-defined\"><div><a>Start site:</a></div><input type='text' id='startSite4' value='"+ endSiteNumber +"' disabled><div><a>End site</a></div><input onkeyup=\"this.value=this.value.replace(/[^0-9]/g,\'\')\" type='text' id='endSite4' >";
			document.getElementById("buttonPartId").innerHTML ="<button class='btn btn-info buttonStyle4' onclick='AddEle4()'>Put it!</button> <button class='btn btn-info buttonStyle4' onclick='prev()'>Prev</button><button class='btn btn-info buttonStyle4' onclick='nextPart()'>Next</button><button id=\"close4\" class=\'btn btn-info buttonStyle4 md-close\' onclick=\"setTimeout(\'renew2()\', 500 );\">Close me!</button>";
		}else if(numberForModule==1){
			document.getElementById("nextPartId").innerHTML = "<div><a>Total sequence length:  "+moduleSequence.length+"bp</a></div><div><a>NO."+numberForModule+" name:</a></div><input type='text' id='theNameOfThisModulePart'  placeholder=\"user-defined\"><div><a>NO."+numberForModule+" type:</a></div><input type='text' id='feature4'  placeholder=\"user-defined\"><div><a>Start site:</a></div><input type='text' id='startSite4' value='1' disabled><div><a>End site</a></div><input onkeyup=\"this.value=this.value.replace(/[^0-9]/g,\'\')\" type='text' id='endSite4' >";
			document.getElementById("buttonPartId").innerHTML ="<button class='btn btn-info buttonStyle4' onclick='AddEle4()'>Put it!</button> <button class='btn btn-info buttonStyle4' onclick='prev()'>Prev</button><button class='btn btn-info buttonStyle4' onclick='nextPart()'>Next</button><button id=\"close4\" class=\'btn btn-info buttonStyle4 md-close\' onclick=\"setTimeout(\'renew2()\', 500 );\">Close me!</button>";
		}
			tanchuang();//按钮改变了所以需要重新添加事件
	}
	
	function prev(){
		if(numberForModule!=1){//上一步应当删除本步存储的数据
			moduleName.splice(numberForModule,1);
			moduleType.splice(numberForModule,1);
			moduleStartSite.splice(numberForModule,1);
			moduleEndSite.splice(numberForModule,1);
			numberForModule--;
			document.getElementById("nextPartId").innerHTML = "<div><a>NO."+numberForModule+" name:</a></div><input type='text' id='theNameOfThisModulePart'  placeholder=\"user-defined\"><div><a>NO."+numberForModule+" type:</a></div><input type='text' id='feature4'  placeholder=\"user-defined\"><div><a>Start site:</a></div><input type='text' id='startSite4' disabled ><div><a>End site</a></div><input onkeyup=\"this.value=this.value.replace(/[^0-9]/g,\'\')\" type='text' id='endSite4' >";
			document.getElementById("buttonPartId").innerHTML ="<button class='btn btn-info buttonStyle4' onclick='AddEle4()'>Put it!</button> <button class='btn btn-info buttonStyle4' onclick='prev()'>Prev</button><button class='btn btn-info buttonStyle4' onclick='nextPart()'>Next</button><button id=\"close4\" class=\'btn btn-info buttonStyle4 md-close\' onclick=\"setTimeout(\'renew2()\', 500 );\">Close me!</button>";
			tanchuang();//按钮改变了所以需要重新添加事件
			document.getElementById("theNameOfThisModulePart").value = moduleName[numberForModule];
			document.getElementById("feature4").value = moduleType[numberForModule];
			document.getElementById("startSite4").value = moduleStartSite[numberForModule];
			document.getElementById("endSite4").value = moduleEndSite[numberForModule];
		}else if(numberForModule==1){
			renew2();
			document.getElementById("sequence4").value = moduleSequence;
		}
		
	}
	function renew2(){//前面的代码导致其延迟0.5秒执行
		numberForModule=0;
		document.getElementById("nextPartId").innerHTML = "<div><a>Module name:</a></div><input type='text' id='nameOfThisTotalPart'  placeholder=\"user-defined\" ><div><a>Module type:</a></div><input type='text' id='feature4'  placeholder=\"user-defined\"><div><a>Total sequence:</a></div><textarea type='text' id='sequence4' onkeyup='this.value=this.value.replace\(/[^actgATCG]/g,\"\"\)\' ></textarea>";
		document.getElementById("buttonPartId").innerHTML ="<button class='btn btn-info buttonStyle3' onclick='nextPart()'>Next</button><button class='btn btn-info buttonStyle3 md-close' id=\"close4\" onclick=\"setTimeout(\'renew2()\', 500 );\">Close me!</button>";
		tanchuang();
	}

	
	function AddEle4() {//添加元件,读取文本框内容,赋予内容及ID,然后执行dontknow赋予事件, ++使后面ID能与前者区别开来
		var panduan = nextPart(1);
		if(panduan==1){
			return;
		}
		var tag44 = "<div class = 'rect1' >"
		memberId++;
		tag44 += "<div id='"+memberId+"' data-type='"+moduleType[0]+"'data-name='"+moduleName[0]+"'data-start='' data-end='' class='md-mr-dd line sbolv "+moduleType[0] +" tooltip-show'data-modal='modal-15' data-original-title=''>" + moduleName[0] +"</div>";	
		var toolSavePart = "<span class=\"mytooltip\" id=\"tooltip"+memberId+"\"></span>"
		toolSavePart += "<span id=\"arrow"+memberId+"\" class = \"arrow\"></span>"
		document.getElementById('toolSavePart').insertAdjacentHTML("beforeEnd",toolSavePart);
		for(var i=1; i<moduleName.length; i++){
			memberId++
			var tag3 = moduleSequence.slice(moduleStartSite[i]-1,moduleEndSite[i]);
			tag44 += "<div id='"+memberId+"' data-type='"+moduleType[i]+"'data-name='"+moduleName[i]+"'data-start='' data-end='' class='md-mr-dd sbolv "+moduleType[i] +" tooltip-show'data-modal='modal-15' data-sequence='"+tag3+"' data-original-title=''>" + moduleName[i] +"</div>";
			var toolSavePart = "<span class=\"mytooltip\" id=\"tooltip"+memberId+"\"></span>"
			toolSavePart += "<span id=\"arrow"+memberId+"\" class = \"arrow\"></span>"
			document.getElementById('toolSavePart').insertAdjacentHTML("beforeEnd",toolSavePart);
		}
		tag44 +="</div>";
		document.getElementById('gridDemo-down').insertAdjacentHTML("beforeEnd",tag44);
		document.getElementById("close4").click();
		// document.getElementById('gridDemo-down').insertAdjacentHTML("beforeEnd","<div class='rect1' style='display: inline-block;'>"+tag+tag+"</div>");
		// document.getElementById('gridDemo-down').insertAdjacentHTML("beforeEnd",tag+tag);  
		dynamicCount();//插入一个就动态生成一个，防止中途有删除导致其他方式计数不准
		dontknow();//重新添加一遍拖拽事件
		
		numberForModule=0;//再初始化变量
		moduleName=new Array();
		moduleType=new Array();
		moduleStartSite=new Array();
		moduleEndSite=new Array();
		moduleSequence = "";
	// 	var finalSequence = document.getElementsByClassName("sbolv");//原本是在tooltip中写入title，但是会出现无法修改的问题
	// 	var lengthForSequence = finalSequence.length -1;//数组从0开始
	// 	var content = finalSequence[lengthForSequence].getAttribute('data-sequence');
		memberId++;//使ID增加进而改变ID
		if(document.getElementById("gridDemo-down").offsetHeight>420){
			var DOMToDelete = document.getElementsByClassName("rect1");
			DOMToDelete[DOMToDelete.length-1].remove();
			alert("Error: Too much.")
		}
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
	
		
	
