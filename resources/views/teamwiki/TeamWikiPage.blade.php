@extends('common.layouts')

@section('style')
<style type="text/css">
			body{min-width:690px}
			.main-page h3 {
				color: #2560a4;
				font-size: 20px;
				font-weight: 600;
				margin: 40px 0;
			}

			.content {
				padding-left: 20px;
			}

			.content>div {
				margin-bottom: 60px;
			}

			.tit {
				border-bottom: 1px solid #f27d5c;
				font-size: 18px;
				padding-bottom: 10px;
				margin-bottom: 10px;
			}

			.tit span {
				display: inline-block;
				font-size: initial;
				background: #70a6e4;
				color: white;
				padding: 0 10px;
				border-radius: 10px;
				margin-left: 20px;
			}

			.t-head {
				border-right: 1px solid #f27d5c;
				width: 50px;
				padding-right: 10px;
				float: left;
				font-size: 15px;
				font-weight: 600;
			}

			.t-head+p {
				padding-left: 10px;
				word-wrap: break-word;
				word-break: break-all;
				overflow: hidden;
			}

			.bt {
				border: 1px solid black;
				border-bottom: transparent;
				border-radius: 10px 10px 0 0;
				width: 120px;
				height: 20px;
				text-align: center;
				background: #b3d6ff;
			}

			.block1 {
				border: 1px solid black;
				border-radius: 0 10px 10px 10px;
				padding: 10px;
			}

			.block2 {
				position: relative;
				margin-bottom: 40px;
				min-height: 100px;
			}

			.block2:before {
				content: '';
				width: 200px;
				height: 40px;
				display: block;
				position: absolute;
				z-index: -1;
				border-top: 1px dashed #70a6e4;
				border-left: 1px dashed #70a6e4;
			}

			.block2:after {
				content: '';
				width: 200px;
				height: 40px;
				display: block;
				position: absolute;
				z-index: -1;
				right: 0;
				bottom: 0;
				border-bottom: 1px dashed #70a6e4;
				border-right: 1px dashed #70a6e4;
			}

			.block2 img {
				margin: 0 10px;
				position: absolute;
				top: 1px
			}

			.rewards {
				padding-top: 20px;
				display: inline-block;
				justify-content: space-around;
				width: calc(100% - 110px);
				margin-left: 110px;
			}

			.rewards span {
				display: inline-block;
				width: 49%;
				margin: 5px 0;
				padding: 0 5px;

			}

			@media screen and (max-width: 600px) {
				.rewards {
					width: 100%;
					margin-left: 0;
					padding-top: 97px;
				}

				.rewards span {
					display: inline-block;
					width: 100%;
					text-align: center;
				}
			}
		</style>
@endsection


@section('content')
    <div class="main-page container">
                <h3>Team Wiki</h3>
                <div class="content">
                @foreach($datas as $data)
                    <div id="">
                        <div class="tit">{{$data->year}}_{{$data->team}}<span>Bio-bricks</span></div>
                        <div class="t-head">Title</div>
                        <p>{{$data->title}}</p>
                        
                        <div class="block2">
							<img src="{{asset('static/images/reward.jpg')}}">
                            <div class="rewards">
                                <span>Medal</span>
                                <span>Keywords</span>
								<span>{{$data->medal}}</span>
								@if($data->keywords==null)
								<span>There is no data yet.</span>
								@else
                                <span>{{$data->keywords}}</span>
                                @endif
                            </div>
                        </div>
						<div class="bt">Description</div>
                        <div class="block1">
							<div class="clearfix">
								<div><span>&nbsp;&nbsp;</span>{{$data->abstract}}</div>
							@if(file_exists($root.'/public/static/teamwiki/'.$data->year.'/'.$data->team.'_01.png'))
								<div class="col-xs-6 col-md-3 thumbnail">
                            	<img src="{{asset('static/teamwiki/'.$data->year.'/'.$data->team.'_01.png')}}">
								</div>
							@endif
							@if(file_exists($root.'/public/static/teamwiki/'.$data->year.'/'.$data->team.'_02.png'))
								<div class="col-xs-6 col-md-3 thumbnail">
                            	<img src="{{asset('static/teamwiki/'.$data->year.'/'.$data->team.'_02.png')}}">
								</div>
							@endif
							@if(file_exists($root.'/public/static/teamwiki/'.$data->year.'/'.$data->team.'_03.png'))
								<div class="col-xs-6 col-md-3 thumbnail">
                            	<img src="{{asset('static/teamwiki/'.$data->year.'/'.$data->team.'_03.png')}}">
								</div>
							@endif
							</div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
@endsection