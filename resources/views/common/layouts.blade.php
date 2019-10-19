<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- 头部 -->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
		<link rel="stylesheet" href="{{asset('static/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('static/css/layouts/modle.css')}}">
        @section('style')

        @show
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}" defer></script>

		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	</head>
	<body>
 <!--        登录栏（勿改动） -->
	<!--	<div id="app">-->
	<!--		<div class="top-part navbar-fixed-top" style="z-index:1500;background:#fff;">-->
	<!--		 <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> -->
	<!--			<div class="container">-->
	<!--				<div class="row">-->
	<!--					<div class="left-part">-->
	<!--						<a href="{{route('main')}}" style="color: rgba(0, 0, 0, 0.9);font-family:'Nunito', sans-serif;font-size:18px;text-decoration:none">-->
	<!--							{{ config('app.name', 'Laravel') }}-->
	<!--						</a>-->
	<!--					</div>-->
	<!--				 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">-->
	<!--					<span class="navbar-toggler-icon"></span>-->
	<!--				</button>-->


						
	<!--				</div>-->
	<!--			</div>-->
	<!--		 </nav> -->
	<!--		</div>-->
	<!--</div>-->
        @section('top-navbar')
        @show
		<nav class="navbar nav-top navbar-default navbar-fixed-top " role="navigation">
			<div class="container">
                <div class="row" style="position: relative;display:flex;align-items:center">
                   <!-- 蓝色顶栏 -->
                   @section('navbar-header')

                   	<div class="navbar-header">
                    <a href="{{route('main')}}">
                    <img srcset="{{asset('static/images/logo.svg')}}" style="height:46px">
                    </a>
						<button id="xs-btn" class="navbar-toggle" type="button">
							 <span class="sr-only">Toggle Navigation</span>    
							 <span class="icon-bar" style="background: white;"></span>
							 <span class="icon-bar" style="background: white;"></span>
							 <span class="icon-bar" style="background: white;"></span>
						</button>
					</div>
					
					<div class="collapse navbar-collapse navbar-responsive-collapse" style="border:none">
						<ul class="nav navbar-nav pull-right">
							<li><a href="{{route('search')}}">Search</a></li>
							<li><a href="{{route('prediction')}}">Prediction</a></li>
							<li><a href="{{route('catalog')}}">Catalog</a></li>
							<li><a href="{{route('tools')}}">Tools</a></li>
							<li><a href="{{route('sbol')}}">SBOL</a></li>
							<li><a href="{{route('download')}}">Download</a></li>
						</ul>
                    </div>
                    <div class="right-part">
							<ul class="ml-auto" style="display:flex;list-style:none;float:right;margin-bottom:0px">
								<!-- Authentication Links -->
								@guest
									<li class="nav-item" style="padding-right:5px;border-right:2px solid white;">
										<a class="nav-link" href="{{ route('login') }}" style="color: white;font-weight:initial">{{ __('Login') }}</a>
									</li>
									@if (Route::has('register'))
										<li class="nav-item" style="margin-left:5px">
											<a class="nav-link" href="{{ route('register') }}" style="color: white;font-weight:initial">{{ __('Register') }}</a>
										</li>
									@endif
								@else
									<li class="nav-item dropdown" >
										<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
											{{ Auth::user()->name }} <span class="caret"></span>
										</a>

										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
											<a class="dropdown-item" href="{{ route('logout') }}"
											onclick="event.preventDefault();
															document.getElementById('logout-form').submit();">
												{{ __('Logout') }}
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										</div>
									</li>
								@endguest
							</ul>
						</div>
                    @show
					<!-- 侧边导航栏 -->
                    @section('left-navbar')
                    
                    @show
				</div>
			</div>
			@section('search-navbar')
                    
            @show
		</nav>
		
		
		<!-- 内容 -->
		@section('content')
		
		@show
        <!-- 尾部 -->
		<footer class="clearfix">
            @section('footer')
			<div class="container">
				<div class="row">
					<div>
						<div class="footer-left" style="display:flex;align-items: center;">
                    <a href="{{route('main')}}">
                    <img srcset="{{asset('static/images/foot.svg')}}" style="height:90px;">
                    </a>   
						<div >
							<h3>Contact Us</h3>
							<p>uestcsoftware@vip.qq.com</p>
							<p>NO.2006.Xiyuan Avenue,UESTC,Chengdu,China</p>
							<p>© BioMaster 2019  Statement</p>
						</div>
					</div>
					<div class="footer-right">
						<ul class="clearfix">
							<li>iGEM</li>
							<li>QuickGO</li>
							<li>UniProt</li>
							<li>EPD</li>
							<li>NCBI</li>
							<li>BioGRID</li>
							<li>BRENDA</li>
						</ul>
						<ul class="clearfix">
							<li>STRING</li>
							<li>RegulonDB</li>
							<li>PromEC</li>
							<li>EMBL-EBI</li>
							<li>KEGG</li>
							<li>ExplorEnz</li>
						</ul>
						
					</div>
					</div>
				</div>
            </div>
            @show
        </footer>
        <!-- js脚本 -->
		<script src="{{asset('static/jquery/jquery.min.js')}}"></script>
		<script type="text/javascript">
			$('#xs-btn').on('click', function() {
				var content = $(".navbar-header + div");
				if (content.hasClass("collapse")) {
					$(content).removeClass('collapse');
				} else {
					$(content).addClass('collapse');
				}
			})
		</script>
		
        @section('javascript')

        @show
	</body>
</html>
