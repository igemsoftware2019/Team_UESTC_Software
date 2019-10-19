@extends('common.layouts')
@section('style')
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/main/main.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/main/s.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/main/normalize.css')}}" />
@endsection

@section('content')
<div class="main-page container" style="padding-top: 25px;">
			<div class="third_row" style="position: relative;">
			</div>


			<!-- 3D carousel -->

			<div class="htmleaf-container">
				<div class="main_banner">
					<div class="main_banner_wrap">
						<div class="main_banner_box" id="m_box">
							<a href="javascript:void(0)" class="banner_btn js_pre" onfocus="this.blur();">
								<span class="banner_btn_arrow"><i></i></span>
							</a>
							<a href="javascript:void(0)" class="banner_btn btn_next js_next" onfocus="this.blur();">
								<span class="banner_btn_arrow"><i></i></span>
							</a>
							<ul>
								<li id="imgCard0">
									 <a href="http://2019.igem.org/Team:UESTC-Software" target="_blank"><span style="opacity:0;"></span></a> 
									<img src="{{asset('static/images/1004.png')}}" alt="">
									<!-- <p style="bottom:0" align="center">xxxxxxxxxxxxxxxxxxxxxx</p> -->
								</li>
								<li id="imgCard1">
									 <a href="{{route('prediction')}}" target="_blank"><span style="opacity:0.4;"></span></a>      
									<img src="{{asset('static/images/EC.png')}}" alt="">
									<!-- <p align="center">xxxxxxxxxxxxxxxxxxxxxx</p> -->
								</li>
								<li id="imgCard2">
									 <a><span style="opacity:0.4;" ></span></a> 
									<img src="{{asset('static/images/education.png')}}" alt="">
									<!-- <p align="center">xxxxxxxxxxxxxxxxxxxxxx</p> -->
								</li>
								<li id="imgCard3">
									 <a href="{{route('sbol')}}" target="_blank"><span style="opacity:0.4;"></span></a> 
									<img src="{{asset('static/images/SBOL.png')}}" alt="">
									<!-- <p align="center">xxxxxxxxxxxxxxxxxxxxxx</p> -->
								</li>
								<li id="imgCard4">
									 <a href="{{route('tools')}}" target="_blank"><span style="opacity:0.4;"></span></a>  
									<img src="{{asset('static/images/tool.png')}}" alt="">
									<!-- <p align="center">xxxxxxxxxxxxxxxxxxxxxx</p> -->
								</li>
								<li id="imgCard5">
									 <a><span style="opacity:0.4;"></span></a>
									<img src="{{asset('static/images/wiki.png')}}" alt="">
									<!-- <p align="center">xxxxxxxxxxxxxxxxxxxxxx</p> -->
								</li>
								<li id="imgCard6">
									 <a href="{{route('download')}}" target="_blank"><span style="opacity:0.4;"></span></a>
									<img src="{{asset('static/images/download.png')}}" alt="">
									<!-- <p align="center">xxxxxxxxxxxxxxxxxxxxxx</p> -->
								</li>
							</ul>
						</div>
						<!--序列号按钮-->
						<div class="btn_list">
							<span class="curr"></span><span></span><span></span><span></span><span></span><span></span><span></span>
						</div>
					</div>
				</div>
			</div>
			<!-- introduction -->
			<div class="introduction" style="">
				<div style="font-size: 0;">
					<div>
						<div class="slim"></div>
						<div class="bold"></div>
						<p class="title">Introduction</p>
					</div>
					<div>
						<div class="slim"></div>
						<div class="bold"></div>
						<p class="title">Introduction</p>
					</div>
				</div>
				<div class="block1">
					<div class="block2">
						<img src="{{asset('static/images/教育.jpg')}}" style="border-radius: 10%; width: 160px; height: 100px; display:inline-block;" />
						<div style="display: inline-block;vertical-align: top">
							
							<!-- <div class="txt1">
								<p class="txt_title">Education: </p>
							</div> -->
							<div class="txt2">
								<p>Follow us to explore Synthetic Biology~Click Brochure and read it!</p>
							</div>
							<button onclick="myfun()"  style="cursor:pointer;height: 30px;width: 100px;background: linear-gradient(to right,#ff815cf7
,#ea5c18);border-radius:20px;border: none;color: white;font-size: 18px;">View</button>
						</div>
					</div>

					<div class="block2">
						<img src="{{asset('static/images/ProP.jpg')}}" style="border-radius: 10%; width: 160px; height: 100px; display:inline-block;" />
						<div style="display: inline-block;vertical-align: top">
							<!-- <div class="txt1">
								<p class="txt_title">Promoter Prediction : </p>
							</div> -->
							<div class="txt2">
								<p>BioMaster offers a tool for promoter prediction. Check <a href="http://2018.igem.org/Team:UESTC-Software/Model">here</a> to learn more about our strategy and model. </p>
							</div>
						</div>
					</div>

					<div class="block2">
						<img src="{{asset('static/images/版权.png')}}" style="border-radius: 10%; width: 160px; height: 100px; display:inline-block;" />
						<div style="display: inline-block;vertical-align: top">
							<!-- <div class="txt1">
								<p class="txt_title">Statement: </p>
							</div> -->
							<div class="txt2">
								<p>Our database follows Creative Commons (CC BY 4.0). Please check our statement to view all original databases and their licenses.</p>
							</div>
						</div>
					</div>
					<div class="block2">
						<img src="{{asset('static/images/EC.jpg')}}" style="border-radius: 10%; width: 160px; height: 100px; display:inline-block;" />
						<div style="display: inline-block;vertical-align: top">
							<!-- <div class="txt1">
								<p class="txt_title">EC Prediction: </p>
							</div> -->
							<div class="txt2">
								<p>BioMaster offers a tool for EC number prediction. Check <a href="https://2019.igem.org/Team:UESTC-Software/Model">here</a> to learn more about our strategy and model. </p>
							</div>
						</div>
					</div>
					<div class="block2">
						<img src="{{asset('static/images/下载.jpg')}}" style="border-radius: 10%; width: 160px; height: 100px; display:inline-block;" />
						<div style="display: inline-block;vertical-align: top">
							<!-- <div class="txt1">
								<p class="txt_title">Download: </p>
							</div> -->
							<div class="txt2">
								<p>You can get BioMaster data through download in XML, SQL and CSV format. </p>
							</div>
						</div>
					</div>
					<div class="block2">
						<img src="{{asset('static/images/SX.jpg')}}" style="border-radius: 10%; width: 160px; height: 100px; display:inline-block;" />
						<div style="display: inline-block;vertical-align: top">
							<!-- <div class="txt1">
								<p class="txt_title">Screening Strategy: </p>
							</div> -->
							<div class="txt2">
								<p>BioMaster is based on iGEM Registry, and uses BLAST+ to match entries in other databases. We have screened BLAST+ result during the process, check <a href="https://2019.igem.org/Team:UESTC-Software/Model">here</a> to learn about our screening model.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div style="background: #333D53;height:100%;width: 100%;position: fixed;top:0;left:0;display: none;z-index:5000" id="dd">
	<span id="close_all" style="color: white;font-size: 40px;float: right;" >×</span>
	<div class="flipbook-viewport">
		<div class="container">
			<div class="flipbook">
				<div style="background-image:url('{{asset('static/images/book/book1.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book2.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book3.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book4.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book5.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book6.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book7.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book8.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book9.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book10.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book11.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book12.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book13.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book14.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book15.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book16.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book17.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book18.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book19.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book20.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book21.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book22.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book23.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book24.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book25.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book26.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book27.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book28.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book29.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book30.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book31.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book32.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book33.jpg')}}')"></div>
				<div style="background-image:url('{{asset('static/images/book/book34.jpg')}}')"></div>


			</div>
		</div>
	</div>
</div>
@endsection

@section('javascript')
		<script src="{{asset('static/js/main/main.js')}}"></script>
		<script type="text/javascript">
			$("#buttons span").click(function() {
				$("#buttons span").removeClass('on');
				$(this).addClass("on");
			})
			$(window).resize(function() {
				var out = $('.block2').width();
				var txt = out-200;
				$('.txt2 p').width(txt)
			});
		</script>
		<script type="text/javascript" src="../../../public/static/js/main/modernizr.2.5.3.min.js"></script>
		<script type="text/javascript" src="../../../public/static/js/main/bookshelf.js"></script>
		<script type="text/javascript">

		function loadApp() {
		
			// Create the flipbook
		
			$('.flipbook').turn({
					// Width
		
					width:922,
					
					// Height
		
					height:600,
		
					// Elevation
		
					elevation: 50,
					
					// Enable gradients
		
					gradients: true,
					
					// Auto center this flipbook
		
					autoCenter: true
		
			});
		}

// Load the HTML4 version if there's not CSS transform

		yepnope({
			test : Modernizr.csstransforms,
			yep: ['../../../public/static/js/main/turn.js'],
			nope: ['../../../public/static/js/main/turn.html4.min.js'],
			both: ['../../../public/static/css/main/basic.css'],
			complete: loadApp
		});

		function myfun(){
			$('#dd').fadeIn(1000);
		}
		 window.onload=function () {
			 var close_all=document.getElementById("close_all");
		      close_all.onclick=function () {
				  $('#dd').fadeOut();
		      }
	 }
</script>
@endsection