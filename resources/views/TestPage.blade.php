<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- 头部 -->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>

        </head>
	<body>
        <div style="background:blue">
		<!-- <div> -->
        <img src="{{asset('svg/logo.svg')}}">
        </div>
	</body>
</html>
