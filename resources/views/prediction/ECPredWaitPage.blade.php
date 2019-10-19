@extends('common.layouts')

@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        #result-btn {
            display: flex;
            background: #70a6e4;
            width: 150px;
            height: 40px;
            color: white;
            font-size: 20px;
            border-radius: 20px;
            text-decoration: none;
            justify-content: center;
            align-items: center;
            box-shadow: #c5d2d9 0 2px 2px 2px;
            text-align:center;
            border:none;
        }
        .footer{
            position: fixed;
            bottom: 0;
        }
    </style>
@endsection

@section('content')

    <div class="hidden" id="key">{{$key}}</div>
    <div class="hidden" id="query">{{$query}}</div>
    <div class="main-page container">
        <h3>Program is running...</h3>
        <p>Start time:<span id="start"></span></p>
        <p>Current time:<span id="current"></span></p>
        <p>Run time:<span id="run"></span></p>
        <h4>Your key is:{{$key}}</h4>
        <p>Remeber your key then you can search your result by this key</p>
        <div class="progress" style="width:40%">
				<div class="progress-bar progress-bar-success" style="width: 0%">
				</div>
			</div>
        <form method="POST" id="r-form">
        @csrf
        <input name="key" class="hidden" id='hide-input' value="">
        <input name="query" class="hidden" id='query' value="{{$query}}">
        <input id="result-btn" value="View results" type="submit" >
        <form>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        var start;
        var current="";
        function get(target) { //获取时间
            var date = new Date();
            var year = date.getFullYear();
            var month = date.getMonth();
            var day = date.getDate();
            var hour = date.getHours();
            var minute = date.getMinutes();
            var second = date.getSeconds();

            if (hour < 10) {
                hour = '0' + hour;
            }
            if (minute < 10) {
                minute = '0' + minute;
            }
            if (second < 10) {
                second = '0' + second;
            }
            var tar = document.getElementById(target);
            var time = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
            tar.innerHTML=time;
            if(target=="start"){
                start=date.getTime();
            }
            else{
                current=date.getTime();
                document.getElementById('run').innerHTML = parseInt((current - start)/1000);
            }
        }
        get('start');
        var rew = setInterval("get('current')", 1000);
        var key = $('#key').text();
        var query = $('#query').text();
        document.getElementById('result-btn').disabled=true;
        $(function(){
            var req = setInterval(function() {
                        var width = $('.progress').width();
                        var cur_width = $('.progress-bar').width();
                            cur_width = cur_width + width/60;
                            $('.progress-bar').width(cur_width);
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('ec_wait')}}",
                type: 'post',
                data: {
                    'key':key,
                    'query':query
                },
                success: function(data){
                    var width = $('.progress').width();
                        if( data.response== 1 ){
                            $('#r-form').attr('action',data.url);
                            $('#hide-input').val(data.key)
                            $('#result-btn').val('Result');
                            $('.progress-bar').width(width);
                            document.getElementById('result-btn').disabled=false;
                            clearInterval(rew);
                            clearInterval(req);
                        }
                        if($('.progress-bar').width()==width){
                            document.getElementById('result-btn').disabled=false;
                            clearInterval(rew);
                            clearInterval(req);
                        }
                        if( data.response == 2){
                            $('.main-page h3:first-child').text('Your sequence is wrong!')
                            clearInterval(rew);
                            clearInterval(req);
                        }
                }
        })
            },5000)
        })



    </script>
@endsection
