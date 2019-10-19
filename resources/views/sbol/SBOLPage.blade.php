@extends('common.layouts')

@section('style')
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/sbol/theme.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/sbol/sbol-visual.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/sbol/sbolvs-visual.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/sbol/component.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/sbol/mycss.css')}}">
		<style type="text/css">
			body,html{
				min-width: 1100px;
			}
		</style>
@endsection


@section('content')
<div style="height:110px">
</div>
<div>
		<div class = "outPart">
			<div class = "leftPart">
				<table>
				<tr class="md-trigger" data-modal="modal-16"><td>Add New Member</td></tr>
				<tr class ="md-tanchuang" data-modal="modal-13"><td>Add Module Part</td></tr>
				<tr class="md-conment" data-modal="modal-14"><td>Add Details</td></tr>
				<tr onclick = "clearTheSortablePart()"><td>Clear</td></tr>
				<tr onclick = "setsetCookie()"><td>Cache</td></tr>
				<tr onclick = "getgetCookie()"><td>Load</td></tr>
				
				</table> 
			</div>
			<div></div>
			<h2 id="totalName" ></h2>
			<div class = "inPart"> 
				
				<div id="gridDemo-down" class="col downStyle">
				</div>
				
				<div class = "trash" id="gridDemo-up">
					9999999999999\r\n99999999999999\r\n99999999999999\r\n99999999999999
				</div>
				<div id = "toolSavePart"></div>
			</div>
			
		</div>
		
		<div class = "buttonBottomLineStyle">
			<button class="btn btn-info buttonStyle" onclick = "downloadTheCapture()">Download PNG</button>
			<button class="btn btn-info buttonStyle" onclick = "downloadfasta()">Download FASTA</button>
			<button class="btn btn-info buttonStyle" onclick = "downloadgenBank()">Download GenBank</button>
		</div>
		<!-- <div  class="col-for-useless col>
			<div id="gridDemo-up" class="col boxOfGridDemoUp">
			</div>
		</div> -->
		<!-- 左边部分 -->
	




		<div class="md-modal md-effect-add" id="modal-16" style="user-select:none">
			<div class="md-content ">
				<h3>Try to add</h3>
				<div class = 'innerBox'>
				<div class = "innerLeft">
					<a>Part name:</a><input type="text" id="genename" > 
					<a>Part type:</a><input type="text" id="feature">
					<a>Sequence:</a><textarea type="text" id="sequence" onkeyup="this.value=this.value.replace(/\s+/g,'')"></textarea>
				</div>
				<div class ="innerRight">
					<div id='3000' class='sbolvs barcode' onclick ="clickToChoose2(3000)"> barcode</div>
					<div id='3001' class='sbolvs binding' onclick ="clickToChoose2(3001)"> binding</div>
					<div id='3002' class='sbolvs Biobrick' onclick ="clickToChoose2(3002)"> Biobrick</div>
					<div id='3003' class='sbolvs cds' onclick ="clickToChoose2(3003)"> cds</div>
					<div id='3012' class='sbolvs scar' onclick ="clickToChoose2(3012)"> scar</div>
					<div id='3013' class='sbolvs stem_loop' onclick ="clickToChoose2(3013)"> stem_loop</div>
					<div id='3016' class='sbolvs insulator' onclick ="clickToChoose2(3016)"> insulator</div>	
					<div id='3004' class='sbolvs conserved' onclick ="clickToChoose2(3004)"> conserved</div>
					<div id='3005' class='sbolvs polya' onclick ="clickToChoose2(3005)"> polya</div>
					<div id='3006' class='sbolvs mutation' onclick ="clickToChoose2(3006)"> mutation</div>
					<div id='3007' class='sbolvs operator' onclick ="clickToChoose2(3007)"> operator</div>
					<div id='3014' class='sbolvs tag' onclick ="clickToChoose2(3014)"> tag</div>
					<div id='3018' class='sbolvs user-defined' onclick ="clickToChoose2(3018)"> user-defined</div>
					<div id='3008' class='sbolvs promoter' onclick ="clickToChoose2(3008)"> promoter</div>
					<div id='3009' class='sbolvs rbs' onclick ="clickToChoose2(3009)"> rbs</div>
					<div id='3010' class='sbolvs start' onclick ="clickToChoose2(3010)"> start</div>
					<div id='3011' class='sbolvs stop' onclick ="clickToChoose2(3011)"> stop</div>
					<div id='3015' class='sbolvs terminator' onclick ="clickToChoose2(3015)"> terminator</div>
					<div id='3017' class='sbolvs misc' onclick ="clickToChoose2(3017)"> misc</div>
					<div id='3019' class='sbolvs Signature' onclick ="clickToChoose2(3019)"> Signature</div>
				</div>
				</div>
				<div class = "buttonLineStyle">
					<button class="btn btn-info buttonStyle3" onclick="AddEle1();">Put it!</button>
					<button class="btn btn-info md-close buttonStyle3">Close me!</button>
				</div>
			</div>
		</div>
		<!-- 添加 -->
		<div class="md-modal md-effect-change" id="modal-15">
			<div class="md-content">
				<h3>Try to change the style</h3>
				<div class = 'innerBox'>
				<div class = "innerLeft">
					<a>Part name:</a><input type="text" id="genename1" >
					<a>Part type:</a><input type="text" id="feature1" >
					<a>Sequence:</a><textarea type="text" id="sequence1" onkeyup="this.value=this.value.replace(/[^actgATCG]/g,'')" ></textarea>
				</div>
				<div class = "innerRight">
					<div id='3000' class='sbolvs barcode' onclick ="clickToChoose3(3000)"> barcode</div>
					<div id='3001' class='sbolvs binding' onclick ="clickToChoose3(3001)"> binding</div>
					<div id='3002' class='sbolvs Biobrick' onclick ="clickToChoose3(3002)"> Biobrick</div>
					<div id='3003' class='sbolvs cds' onclick ="clickToChoose3(3003)"> cds</div>
					<div id='3012' class='sbolvs scar' onclick ="clickToChoose3(3012)"> scar</div>
					<div id='3013' class='sbolvs stem_loop' onclick ="clickToChoose3(3013)"> stem_loop</div>
					<div id='3016' class='sbolvs insulator' onclick ="clickToChoose3(3016)"> insulator</div>
					<div id='3004' class='sbolvs conserved' onclick ="clickToChoose3(3004)"> conserved</div>
					<div id='3005' class='sbolvs polya' onclick ="clickToChoose3(3005)"> polya</div>
					<div id='3006' class='sbolvs mutation' onclick ="clickToChoose3(3006)"> mutation</div>
					<div id='3007' class='sbolvs operator' onclick ="clickToChoose3(3007)"> operator</div>
					<div id='3014' class='sbolvs tag' onclick ="clickToChoose3(3014)"> tag</div>
					<div id='3018' class='sbolvs user-defined' onclick ="clickToChoose3(3018)"> user-defined</div>
					<div id='3008' class='sbolvs promoter' onclick ="clickToChoose3(3008)"> promoter</div>
					<div id='3009' class='sbolvs rbs' onclick ="clickToChoose3(3009)"> rbs</div>
					<div id='3010' class='sbolvs start' onclick ="clickToChoose3(3010)"> start</div>
					<div id='3011' class='sbolvs stop' onclick ="clickToChoose3(3011)"> stop</div>
					<div id='3015' class='sbolvs terminator' onclick ="clickToChoose3(3015)"> terminator</div>
					<div id='3017' class='sbolvs misc' onclick ="clickToChoose3(3017)"> misc</div>
					<div id='3019' class='sbolvs Signature' onclick ="clickToChoose3(3019)"> Signature</div>
				</div>
				</div>
				<div class = "buttonLineStyle">
					<button class="btn btn-info buttonStyle3" onclick="change2(getMemberId)" >Change it!</button>
					<button class="btn btn-info buttonStyle3 md-close">Close me!</button>
				</div>
			</div>
		</div>
		<!-- 转换 -->
		<div class="md-modal md-effect-comment" id="modal-14">
			<div class="md-content">
				<h3>Enter something details</h3>
				<div style="user-select:none;height:200px;" >
					<div class="heightForInput2" >
						<a>Name:</a><input type="text" id="theNameOfThisPart" >
					</div>
					<div class="heightForInput1">
						<a>Definition:</a><textarea type="text" id="definition" ></textarea>
					</div>
				</div>
				<div class = "buttonLineStyle">
					<button class="btn btn-info buttonStyle3" onclick="AddEle3();">Put it!</button>
					<button id="close3" class="btn btn-info buttonStyle3  md-close" >Close me!</button>
				</div>
			</div>
		</div>
		
		<div class="md-modal md-effect-comment" id="modal-13">
			<div class="md-content">
				<h3>Put a module part</h3>
				<div class = 'innerBox'>
					<div class="innerLeft" id="nextPartId">
						<div><a>Module name:</a></div><input type="text" id="nameOfThisTotalPart" placeholder="user-defined" autocomplete="off">
						<div><a>Module type:</a></div><input type="text" id="feature4" placeholder="user-defined" autocomplete="off">
						<div><a>Total sequence:</a></div><textarea type="text" id="sequence4" onkeyup="this.value=this.value.replace(/[^actgATCG]/g,'')"></textarea>
					</div>
					<div class = "innerRight">
						<div id='3000' class='sbolvs barcode' onclick ="clickToChoose4(3000)"> barcode</div>
						<div id='3001' class='sbolvs binding' onclick ="clickToChoose4(3001)"> binding</div>
						<div id='3002' class='sbolvs Biobrick' onclick ="clickToChoose4(3002)"> BioBrick</div>
						<div id='3003' class='sbolvs cds' onclick ="clickToChoose4(3003)"> cds</div>
						<div id='3012' class='sbolvs scar' onclick ="clickToChoose4(3012)"> scar</div>
						<div id='3013' class='sbolvs stem_loop' onclick ="clickToChoose4(3013)"> stem_loop</div>
						<div id='3016' class='sbolvs insulator' onclick ="clickToChoose4(3016)"> insulator</div>
						<div id='3004' class='sbolvs conserved' onclick ="clickToChoose4(3004)"> conserved</div>
						<div id='3005' class='sbolvs polya' onclick ="clickToChoose4(3005)"> polya</div>
						<div id='3006' class='sbolvs mutation' onclick ="clickToChoose4(3006)"> mutation</div>
						<div id='3007' class='sbolvs operator' onclick ="clickToChoose4(3007)"> operator</div>
						<div id='3014' class='sbolvs tag' onclick ="clickToChoose4(3014)"> tag</div>
						<div id='3018' class='sbolvs user-defined' onclick ="clickToChoose4(3018)"> user-defined</div>
						<div id='3008' class='sbolvs promoter' onclick ="clickToChoose4(3008)"> promoter</div>
						<div id='3009' class='sbolvs rbs' onclick ="clickToChoose4(3009)"> rbs</div>
						<div id='3010' class='sbolvs start' onclick ="clickToChoose4(3010)"> start</div>
						<div id='3011' class='sbolvs stop' onclick ="clickToChoose4(3011)"> stop</div>
						<div id='3015' class='sbolvs terminator' onclick ="clickToChoose4(3015)"> terminator</div>
						<div id='3017' class='sbolvs misc' onclick ="clickToChoose4(3017)"> misc</div>
						<div id='3019' class='sbolvs Signature' onclick ="clickToChoose4(3019)"> Signature</div>
					</div>
				</div>
				<div id = "buttonPartId" class = "buttonLineStyle">
					<button class="btn btn-info buttonStyle3" onclick="nextPart()">Next</button>
					<button class="btn btn-info buttonStyle3 md-close" id="close4" onclick="setTimeout('renew2()', 500 );">Close me!</button>
				</div>
				
			</div>
		</div>

		<div class="md-overlay"></div>

</div>
@endsection

@section('javascript')
<!-- 弹窗的样式 -->

<!-- 放下面是因为app需要引用已有的id，放上面id还未加载会报错 -->
<script src="{{asset('static/js/sbol/Sortable.js')}}"></script>
<script src="{{asset('static/js/sbol/app.js')}}"></script>
<script src="{{asset('static/js/sbol/modernizr.custom.js')}}"></script>
<script src="{{asset('static/js/sbol/html2canvas.min.js')}}"></script>
<script src="{{asset('static/js/sbol/prettify.js')}}"></script>
<script src="{{asset('static/js/sbol/classie.js')}}"></script>
<script src="{{asset('static/js/sbol/modalEffects.js')}}"></script>
<script src="{{asset('static/js/sbol/myjs.js')}}"></script>
@endsection