@extends('common.layouts')
@section('style')
		<link rel="stylesheet" href="{{asset('static/css/searchafter/searchafter.css')}}">
		<style>
			.showpage{
				display: table !important;
			}
		</style>
@endsection

@section('content')
		<div class="main-page clearfix" style="margin-top:20px">
			<div class="container">
				<div class='row'>
					<div >
						<div style="margin: 0 auto;width: 90%;">
						@if ($errors->any())
							<div class="alert alert-danger" style="margin-top:20px;margin-bottom:0px">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
							<div class="tab-selected">iGEM_ID</div>	
							<div class="search">
								<div class="search-dropdown">
									<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="iconfont" style="color: white">&#xe62e;</i></a>
									<ul class="dropdown-menu">
		                            <li><a href="javascript:void(0)">iGEM_ID</a></li>
		                            <li><a href="javascript:void(0)">Epd_ID</a></li>
		                            <li><a href="javascript:void(0)">UniProt_ID</a></li>
		                            <li><a href="javascript:void(0)">Gene_Name</a></li>
		                            <li><a href="javascript:void(0)">Keyword</a></li>
									</ul>
								</div>
								<form method="post" action="{{route('searchafter')}}">
									@csrf
									<input type="text" name="keyword">
									<input type="submit" value="search">
									<input type="text" style="display:none" value="iGEM_ID"  id="forphp" name="type">
								</form>
							</div>
						</div>
						<h5>{{$choose}}</h5>
						<div id="result" class="table-responsive info-tab  div-head">
						@foreach($datas as $data)
							@if($p%10==1)
								@php
									$q=intdiv($p,10);
									$q=$q+1
								@endphp
							@if($q==1)
							<table class="table table-bordered head-type showpage hidepage" id="page{{$q}}">
							@else
							<table class="table table-bordered head-type hidepage" id="page{{$q}}">
							@endif
								<thead>
									<tr>
										<th>Part_id</th>
										<th>Identity</th>
										<th>Align_len</th>
										<th>Site</th>
										<th>Bitscore</th>
										<th>Ex</th>
									</tr>
								</thead>
								<tbody>
									@endif
									<tr>
										<td><a href="{{route('result',['igemid'=>$data['igemid']])}}">{{$data['igemid']}}</a></td>
										<td>{{$data['identity']}}</td>
										<td>{{$data['align_len']}}</td>
										<td>{{$data['site']}}</td>
										<td>{{$data['bitscore']}}</td>
										<td>{{$data['ex']}}</td>
									</tr>
									@if($p%10==0 || $p==$count)
								</tbody>
							</table>
							@endif
								@php
									$p++
								@endphp
						@endforeach
						</div>
						<!-- ajax分页 -->
					    <div class="page-select" id="page1">
							<a href="javascript:void(0)" id="btn-First" onclick="changepage(1)"><i class="iconfont" style="margin-right: -8px;">&#xe629;</i><i class="iconfont">&#xe629;</i>First</a>
							<a href="javascript:void(0)" id="btn-Prev" onclick="changepage(2)"><i class="iconfont">&#xe629;</i>Prev</a>
							<span>Page</span>
							<input type="text" id="choice"  style="width:50px;">
							<span>of {{$total_page}}</span>
							<a href="javascript:void(0)" id="btn-Go" onclick="changepage(5)">Go</a>
							<a href="javascript:void(0)" id="btn-Next" onclick="changepage(3)">Next<i class="iconfont">&#xe628;</i></a>
							<a href="javascript:void(0)" id="btn-Last" onclick="changepage(4)">Last<i class="iconfont" style="margin-right: -8px;">&#xe628;</i><i class="iconfont">&#xe628;</i></a>
						</div>
		
					</div>
				</div>
			</div>
		</div>
@endsection

@section('javascript')
		<script src="{{asset('static/js/searchafter/searchafter.js')}}"></script>
				<script>
				function changepage(message){
				var pageid;
				var choice = "page"+$("#choice").val();
				var showtable = $("#result table.showpage");
				pageid = $("#result table.showpage").attr('id');
				switch(message)
				{
					case 1:
						showtable.removeClass('showpage');
						$('#page1').addClass('showpage');
						break;
					case 2:
						if(pageid!='page1'){
						showtable.removeClass('showpage');
						showtable.prev().addClass('showpage');
					}
						break;
					case 3:
						if(pageid!=$('#result table:last-child').attr('id'))
						{
							showtable.removeClass('showpage');
							showtable.next().addClass('showpage');
						}
						break;
					case 4:
						showtable.removeClass('showpage');
						$('#result table:last-child').addClass('showpage');
						break;
					case 5:
						var num=$("#choice").val();
						if((/^(\+|-)?\d+$/.test(num)) && num>0 && num<={{$total_page}})
						{
							showtable.removeClass('showpage');
							$("#"+choice).addClass('showpage');
						}
						break;
				}
				pageid = $("#result table.showpage").attr('id');
				pageid=pageid.substring(4);
				$("#choice").val(pageid);
			}
		</script>
@endsection