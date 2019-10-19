@extends('common.layouts')
@section('style')		
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="{{asset('static/css/search/style.css')}}">
<style>
	html,body{
		min-width: 768px;
	}
</style>
@endsection

@section('content')
<div class="main-page">
	<div class="container two" id="main" style="display: block;">
				@if ($errors->any())
					<div class="alert alert-danger" style="margin-top:20px;margin-bottom:0px">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			<div class="row" style= "display: flex;
justify-content: center;" >

				<div class="sousuo">
					
					<div class="col-lg-4  col-lg-offset-6 col-md-4 col-md-offset-5">

					<a class="content_1" href="javascript:;"></a>
					<a class="content_2" href="javascript:;"></a>
					<a class="content_3" href="javascript:;"></a>
					<a class="content_4" href="javascript:;"></a>

						<div class=" signin ">
							<!-- <div class="signin-head"><img src="images/test/head_120.png" alt="" class="img-circle"></div> -->
							<h1>Search</h1>
							<form class="form-signin" role="form" method="post" action="{{route('searchafter')}}">
                                @csrf
								<h3>ID:</h3>
								<input type="text" class="form-control"   style="padding: 20px;" id="ss1" name="keyword">
								<h3>Type of ID:</h3>
								<select class="form-control" id="ss2" name="type">
									<option value="iGEM_ID">iGEM_ID</option>
									<option value="Epd_ID">EPD_ID</option>
									<option value="UniProt_ID">UniProt_ID</option>
									<option value="Gene_Name">Gene_Name</option>
								</select>
								<button class="btn btn-lg btn-block" type="submit" style="background:#fff;border:1px solid #d3d3d3;margin-bottom: 20px; font-weight: 600; color: #f27d5c;bottom-color:orange; width: 60%; margin:0 auto ;margin-top:30px;">Submit</button>
							</form>
							
						</div>
					</div>
					
				</div>


			</div>
		</div>
		
		<div class="container two" id="main4" style="display: none;">
		
			<div class="row" style= "display: flex;
justify-content: center;" >
		
				<div class="sousuo" >
					
					<div class="col-lg-4  col-lg-offset-6 col-md-4 col-md-offset-5">
		
					<a class="content_1" href="javascript:;"></a>
					<a class="content_2" href="javascript:;"></a>
					<a class="content_3" href="javascript:;"></a>
					<a class="content_4" href="javascript:;"></a>
					
		
						<div class=" signin ">
							
							<h1>Search</h1>
							<form class="form-signin" role="form" action="{{route('blast')}}">
								@csrf
								<h3>Sequence:</h3>
								<input type="text" class="form-control"   style="padding: 20px; height: 30px;" id="ss1" name="query">
								<h3>e-value:</h3>
								<select class="form-control" id="ss5">
									<option>1e-5</option>
									<option>2e-5</option>
									<option>3e-5</option>
									<option>4e-5</option>
									<option>5e-5</option>
								</select>
								<input type="text" class="hidden" id="ss4" name="evalue">
								<button class="btn btn-lg btn-block" type="submit" style="background:#fff;border:1px solid #d3d3d3;margin-bottom: 20px; font-weight: 600; color: #f27d5c;bottom-color:orange; width: 60%; margin:0 auto ;margin-top:30px;">Submit</button>
							</form>
							
						</div>
					</div>
					
				</div>

		
			</div>
			
		</div>
		<div class="container two" id="main3" style="display: none;">
		
		<div class="row" style= "display: flex; justify-content: center;" >		
			<div class="sousuo" >					
				<div class="col-lg-4  col-lg-offset-6 col-md-4 col-md-offset-5">	
				<a class="content_1" href="javascript:;"></a>
				<a class="content_2" href="javascript:;"></a>
				<a class="content_3" href="javascript:;"></a>
				<a class="content_4" href="javascript:;"></a>						
					<div class=" signin ">							
						<h1>Search</h1>
						<form class="form-signin" role="form" method="post" action="{{route('teamsearch')}}">
							@csrf
							<a class="an" id="Keywords" style="font-size: 20px; display: inline-block; color: #f27d5c;text-decoration:none" href="javascript:;">Keywords</a>
							<div style="display: inline-block;">
							</div>
							<a class="an" id="Team" style="display: inline-block; font-size: 20px; color: black;text-decoration:none" href="javascript:;">Team</a>
							<input type="text" class="form-control"   style="padding: 20px; height: 30px;" id="ss1" name="keyword">
							<h5 id="differ">Example:&nbsp;&nbsp;&nbsp;cellulose</h5>								
						<button class="btn btn-lg btn-block" type="submit" style="background:#fff;border:1px solid #d3d3d3;margin-bottom: 20px; font-weight: 600; color: #f27d5c;bottom-color:orange; width: 60%; margin:0 auto ;margin-top:30px;">Submit</button>
							<input class="hidden" value="keyword" id="K_T" name="type">
						</form>						
					</div>
				</div>					
			</div>		
		</div>		
</div>
		<div class="container two" id="main2" style="display: none;">
		
			<div class="row" style= "display: flex;
justify-content: center;" >
		
				<div class="sousuo" >
					
					<div class="col-lg-4  col-lg-offset-6 col-md-4 col-md-offset-5">
		
					<a class="content_1" href="javascript:;"></a>
					<a class="content_2" href="javascript:;"></a>
					<a class="content_3" href="javascript:;"></a>
					<a class="content_4" href="javascript:;"></a>
					
		
						<div class=" signin ">
							
							<h1>Search</h1>
							<form class="form-signin" role="form" method="post" action="{{route('searchafter')}}">
								@csrf
								<h3>Keyword</h3>
								<input type="text" class="form-control"   style="padding: 20px; height: 30px;" id="ss1" name="keyword">
								<input type="text" class="hidden" name="type" value="Keyword">
								<h5>Example:&nbsp;&nbsp;&nbsp;cellulose</h5>
								
								<button class="btn btn-lg btn-block" type="submit" style="background:#fff;border:1px solid #d3d3d3;margin-bottom: 20px; font-weight: 600; color: #f27d5c;bottom-color:orange; width: 60%; margin:0 auto ;margin-top:30px;">Submit</button>
							</form>
							
						</div>
					</div>
					
				</div>
		
		
			</div>
			
		</div>	
	</div>
		
		
@endsection
		
@section('javascript')
		<script src="{{asset('static/bootstrap/js/bootstrap.js')}}"></script>
		<script src="{{asset('static/js/search/main.js')}}"></script>
		<script>
			$("#Keywords").click(function(){
				$(".an").attr("style","color:black;display: inline-block; font-size: 20px;");
				$("#Keywords").attr("style","color:#f27d5c;display: inline-block; font-size: 20px;");
				$("#differ").text('Example:cellulose')
				$('#K_T').val('keyword')

			})
			$("#Team").click(function(){
				$(".an").attr("style","color:black;display: inline-block; font-size: 20px;");
				$("#Team").attr("style","color:#f27d5c;display: inline-block; font-size: 20px;");
				$("#differ").text('Example: UESTC-Software')
				$('#K_T').val('team')
			})
			$(".content_1").click(function(){
				
				$("#main").attr("style","display: none");
				$("#main4").attr("style","display: none");
				$("#main3").attr("style","display: none");
				$("#main2").attr("style","display: none;");
				$("#main").attr("style","display: block;");
				
			})
			$(".content_2").click(function(){
				$("#main").attr("style","display: none");
				$("#main4").attr("style","display: none");
				$("#main3").attr("style","display: none");
				$("#main2").attr("style","display: none;");
				$("#main2").attr("style","display: block;");			
			})
			$(".content_3").click(function(){
				$("#main").attr("style","display: none");
				$("#main4").attr("style","display: none");
				$("#main3").attr("style","display: none");
				$("#main2").attr("style","display: none;");
				$("#main3").attr("style","display: block;");					
			})
			$(".content_4").click(function(){
				
				$("#main").attr("style","display: none");
				$("#main4").attr("style","display: none");$("#btn").on('click',function(){
				$('#ss3').val($('#ss2').val())
			})
				$("#main2").attr("style","display: none;");
				$("#main3").attr("style","display: none");
				$("#main4 ").attr("style","display: block;");
				
			})
		</script>
		<script>
			$("#btn").on('click',function(){
				$('#ss3').val($('#ss2').val())
			})
			$("#btn2").on('click',function(){
				$('#ss4').val($('#ss5').val())
			})
		</script>
@endsection