@extends('common.layouts')
@section('style')
		<link rel="stylesheet" href="{{asset('static/css/searchafter/searchafter.css')}}">
@endsection

@section('left-navbar')
<div style="position:absolute;max-height:calc(100vh - 216px);width:22%;overflow-y:auto;border-radius:0 0 5px 5px;top:100%">
	<form action="{{route('recommended')}}" method="POST" id="r-form">
		@csrf
		<div class="left-p">
			<ul  id="checkbox-1">
				<li><a href="javascript:void(0)">All</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox" class="hidden"   name="type[]" value="Terminator">Terminator</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox" class="hidden"  name="type[]" value="RBS">RBS</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="DNA">DNA</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden"name="type[]" value="Coding">Coding</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Reporter">Reporter</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Regulatory">Regulatory</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="RNA">RNA</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Project">Project</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Generator">Generator</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Composite">Composite</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Inverter">Inverter</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Intermediate">Intermediate</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Signalling">Signalling</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Measurement">Measurement</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Other">Other</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Temporary">Temporary</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Translational_Unit">Translational_Unit</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Plasmid_Backbone">Plasmid_Backbone</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Primer">Primer</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Cell">Cell</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Device">Device</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Plasmid">Plasmid</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Tag">Tag</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Conjugation">Conjugation</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="T7">T7</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Protein_Domain">Protein_Domain</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Scar">Scar</a></li>
				<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Promoter">Promoter</a></li>
			</ul>
			<button style="width: 90px;margin-top: 5px;height: 30px;background:#c8e0ff;border: none;border-radius: 5px;" id="r-btn-1">submit</button>
		</div>
		@section('keyword_right')
		<div class="right-p">
			<div class="p1">
				Sort by:
				<ul  id="r-select">
					<li id="r-btn-3"><a href="javascript:void(0)">Key Words Match</a></li>
					<li id="r-btn-4"><a href="javascript:void(0)">Adjusted Weight</a></li>
				</ul>
			</div>
			<div class="p2">
				<div class="formula">
					<span>formula</span>
					scolk = <br>&nbsp;&nbsp;Part_Use*weight[1]<br>+Word_Amount*weight[2]<br>+Reference_Amount*weight[3]<br>+Submit_Time*weight[4]
					
				</div>
				<div class="weight">
					<span>weight</span>
					<div style="font-size:16px;font-weight:600">Adjust the weight below</div>
					<div>please fill in 1 to 10</div>
					
					<ul class="weight-input">
						<li><pre style="padding:0;background:none;border:none">P_U*weight[1]</pre>
							<div class='triangles'>
								<div class='triangle-up'></div>
								<div class='triangle-down'></div>
							</div>
							<input type="text" value='{{$part_use}}' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="part_use">
						</li>
						<li><pre style="padding:0;background:none;border:none">W_A*weight[2]</pre>
							<div class='triangles'>
								<div class='triangle-up'></div>
								<div class='triangle-down'></div>
							</div>
							<input type="text" value='{{$word_amount}}' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="word_amount">
						</li>
						<li><pre style="padding:0;background:none;border:none">R_A*weight[3]</pre>
							<div class='triangles'>
								<div class='triangle-up'></div>
								<div class='triangle-down'></div>
							</div>
							<input type="text" value='{{$reference_amount}}' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="reference_amount">
						</li>
						<li><pre style="padding:0;background:none;border:none">S_T*weight[4]</pre>
							<div class='triangles'>
								<div class='triangle-up'></div>
								<div class='triangle-down'></div>
							</div>
							<input type="text" value='{{$submit_time}}' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="submit_time">
						</li>
					</ul>
					<button style="width: 90px;margin-top: 5px;height: 30px;background:#c8e0ff;border: none;border-radius: 5px;" id="r-btn-2">submit</button>
				
				</div>
			</div>
		</div>
		@show
		</form>
</div>
		
@endsection

@section('search-navbar')
		<div type="button" data-toggle="modal" data-target="#mymodal" class="visible-sm visible-xs" style="position: absolute;width:100%;top:100%;background: white;font-size: 18px;text-align: center;box-shadow: darkgrey 0 4px 5px;height: 30px;line-height: 30px;border:1px solid #70a6e4">screen
			<img src="{{asset('static/images/筛选.png')}}" style="width: 20px;"></div>
@endsection

@section('content')
		<div class="modal" id="mymodal">
			<div class="modal-dialog select-modal">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<div class="modal-body" style="overflow-y:auto ;">
						<div class="other-part">
							<form action="{{route('recommended')}}" method="POST" id="other-form">
							@csrf
							<div class="other-part1">
								<ul class="search-option clearfix" id="checkbox-2">
										<li><a href="javascript:void(0)">All</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox" class="hidden"   name="type[]" value="Terminator">Terminator</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox" class="hidden"  name="type[]" value="RBS">RBS</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="DNA">DNA</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden"name="type[]" value="Coding">Coding</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Reporter">Reporter</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Regulatory">Regulatory</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="RNA">RNA</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Project">Project</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Generator">Generator</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Composite">Composite</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Inverter">Inverter</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Intermediate">Intermediate</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Signalling">Signalling</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Measurement">Measurement</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Other">Other</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Temporary">Temporary</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Translational_Unit">Translational_Unit</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Plasmid_Backbone">Plasmid_Backbone</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Primer">Primer</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Cell">Cell</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Device">Device</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Plasmid">Plasmid</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Tag">Tag</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Conjugation">Conjugation</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="T7">T7</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Protein_Domain">Protein_Domain</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox" class="hidden" name="type[]" value="Scar">Scar</a></li>
										<li><a href="javascript:void(0)"><input type="checkbox"  class="hidden" name="type[]" value="Promoter">Promoter</a></li>
								</ul>
								<button style="width: 90px;margin-top: 5px;height: 30px;background:#c8e0ff;border: none;border-radius: 5px;" id="l-btn-1">submit</button>
							</div>
							<div class="other-part2">
								<div class="sort-part" >
									<h4>Sort by:</h4>
									<ul class="search-option clearfix" id="other-select">
										<li id="l-btn-4"><a href="javascript:void(0)">Adjusted Weight</a></li>
										<li id="l-btn-3"><a href="javascript:void(0)">Key Words Match</a></li>
									</ul>
								</div>
								<div class="weight-part">
									<div class='p1 clearfix'>
										<h4>Formula</h4>
										<div>
											<div>scolk</div>
											<ul>
												<li>
													<div class="pull-left">=Part_Use</div>
													<div class='pull-right'>*weight[1]</div>
												</li>
												<li>
													<div class="pull-left">+Word_Amount</div>
													<div class='pull-right'>*weight[2]</div>
												</li>
												<li>
													<div class="pull-left">+Reference_Amount</div>
													<div class='pull-right'>*weight[3]</div>
												</li>
												<li>
													<div class="pull-left">+Submit_Time</div>
													<div class='pull-right'>*weight[4]</div>
												</li>
											</ul>
										</div>
									</div>
									<div class='p2'>
										<h4>Weight</h4>
										<div style="font-size:16px;font-weight:600">Adjust the weight below</div>
										<div>please fill in 1 to 10</div>
										
										<ul class="weight-input">
											<li>P_U*weight[1]
												<div class='triangles'>
													<div class='triangle-up'></div>
													<div class='triangle-down'></div>
												</div>
												<input type="text" value='{{$part_use}}' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="part_use">
											</li>
											<li>W_A*weight[2]
												<div class='triangles'>
													<div class='triangle-up'></div>
													<div class='triangle-down'></div>
												</div>
												<input type="text" value='{{$word_amount}}' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="word_amount">
											</li>
											<li>R_A*weight[3]
												<div class='triangles'>
													<div class='triangle-up'></div>
													<div class='triangle-down'></div>
												</div>
												<input type="text" value='{{$reference_amount}}' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="reference_amount">
											</li>
											<li>S_T*weight[4]
												<div class='triangles'>
													<div class='triangle-up'></div>
													<div class='triangle-down'></div>
												</div>
												<input type="text" value='{{$submit_time}}' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="submit_time">
											</li>
											<button style="width: 90px;margin: 5px;height: 30px;background:#c8e0ff;border: none;border-radius: 5px;" id="l-btn-2">submit</button>
										</ul>
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- 主要内容 -->
		<div class="main-page clearfix">
			<div class="container">
				<div class='row'>
					<div class="main-part">
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
									<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="iconfont" style="color: black">&#xe62e;</i></a>
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
									<input type="text" style="display:none" value="iGEM_ID" id="forphp" name="type">
								</form>
							</div>
						</div>
						<h5>{{$choose}}</h5>
						<div id="result">
						@foreach($datas as $data)
							@if($p%10==1)
								@php
									$q=intdiv($p,10);
									$q=$q+1
								@endphp
							@if($q==1)
							<div class="showpage hidepage" id="page{{$q}}">
							@else
							<div class="hidepage" id="page{{$q}}">
							@endif
									@endif
									<div style="border-radius:3px;margin:5px;background-color:white;padding:20px;padding-top:10px">
										<div style="width:100%;line-height:35px;">
											<div style="float:left;width:50%"><a href="{{route('result',['igemid'=>$data['part_name']])}}" style="font-weight:800">{{$data['part_name']}}</a></div>
											<div style="float:left;width:25%">●{{$data['type']}}</div>
											<div style="">{{$data['length']}}bp</div>
										</div>
										<div style="width:100%;line-height:30px;margin-bottom:10px">
											<div style="">{{$data['short_description']}}</div>
										</div>
										<div style="width:100%;line-height:20px;height:20px">
											<div style="float:left;width:5%;text-align:center;border-radius:5px;background-color:#c8e0ff;margin-right:12px" >{{$data['stat']}}</div>
											<div style="float:left;width:5%;text-align:center;border-radius:5px;background-color:#c8e0ff">{{$data['works']}}</div>
										</div>
										<div style="width:100%;line-height:30px">
											<div style="">{{$data['team']}}</div>
										</div>
									</div>
									@if($p%10==0 || $p==$count)
							</div>
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
							<input type="text" id="choice" value="1"  style="width:50px;">
							<span>of {{$total_page}}</span>
							<a href="javascript:void(0)" id="btn-Go" onclick="changepage(5)">Go</a>
							<a href="javascript:void(0)" id="btn-Next" onclick="changepage(3)">Next<i class="iconfont">&#xe628;</i></a>
							<a href="javascript:void(0)" id="btn-Last" onclick="changepage(4)">Last<i class="iconfont" style="margin-right: -8px;">&#xe628;</i><i class="iconfont">&#xe628;</i></a>
						</div>
		
					</div>
				</div>
			</div>
		</div>
		<div class="hidden" id="user-select">
			<ul id="sel-1">
				@if($types=='all')
				<li>{{$types}}</li>
				@else
				@foreach($types as $type)
				<li>{{$type}}</li>
				@endforeach
				@endif
			</ul>
			<ul id="sel-2">
				<li>{{$choose}}</li>
			</ul>
			<ul id="sel-3">
				<li>{{$part_use}}</li>
				<li>{{$word_amount}}</li>
				<li>{{$reference_amount}}</li>
				<li>{{$submit_time}}</li>				
			</ul>
		</div>
@endsection

@section('javascript')
		<script src="{{asset('static/js/searchafter/searchafter.js')}}"></script>
		<script>
			$(document).ready(function(){
				$('#sel-1 li').each(function(index){
					
					var target = $(this).html();
					if(target=='all'||index==27){
						$('#checkbox-1 li,#checkbox-2 li').addClass('selected');
						$('#checkbox-1 input,#checkbox-2 input').prop('checked', true);
					}
					else{
						$('input[value='+target+']').parent('a').parent('li').addClass('selected');
						$('input[value='+target+']').prop('checked', true);
					}
				})
				
				
				var target2 = $('#sel-2 li').html();
				if(target2=='Best match'){
					$('#r-btn-3').addClass('selected');
					$('#l-btn-3').addClass('selected');
				}
				if(target2=='Recommended'){
					$('#r-btn-4').addClass('selected');
					$('#l-btn-4').addClass('selected');
				}
				
				$('#sel-3 li').each(function(index){
					var value = $(this).html();
					$('.weight-input li').eq(index).find('input').val(value);
				})
			})
				
		</script>
		<script>
				$('#r-btn-1').on('click',function(){
					$('#r-form').attr('action','{{route('type')}}').submit();
				})
				$('#r-btn-2,#r-btn-3').on('click',function(){
					$('#r-form').attr('action','{{route('best')}}').submit();
				})
				$('#r-btn-4').on('click',function(){
					$('#r-form').attr('action','{{route('recommended')}}').submit();
				})
				$('#l-btn-1').on('click',function(){
					$('#other-form').attr('action','{{route('type')}}').submit();
				})
				$('#l-btn-2,#l-btn-3').on('click',function(){
					$('#other-form').attr('action','{{route('best')}}').submit();
				})
				$('#l-btn-4').on('click',function(){
					$('#r-form').attr('action','{{route('recommended')}}').submit();
				})
				$('#checkbox-1 li:not(:first-child)').on('click',function(){
					
					if($(this).hasClass('selected')){
						$(this).removeClass('selected');
						$(this).find('input').prop('checked', false);
					}
					else{
						$(this).addClass('selected');
						$(this).find('input').prop('checked', true);
					}
					$('#checkbox-1 li:not(:first-child)').each(function(index){
						if($(this).hasClass('selected')){
							if(index==27){
								$('#checkbox-1 li:first-child').addClass('selected');
							}
						}
						else{
							$('#checkbox-1 li:first-child').removeClass('selected');
							return false;
						}
					})
				})
				$('#checkbox-2 li:not(:first-child)').on('click',function(){
					
					if($(this).hasClass('selected')){
						$(this).removeClass('selected');
						$(this).find('input').prop('checked', false);
					}
					else{
						$(this).addClass('selected');
						$(this).find('input').prop('checked', true);
					}
					$('#checkbox-2 li:not(:first-child)').each(function(index){
						if($(this).hasClass('selected')){
							if(index==27){
								$('#checkbox-2 li:first-child').addClass('selected');
							}
						}
						else{
							$('#checkbox-2 li:first-child').removeClass('selected');
							return false;
						}
					})
				})
				$('#checkbox-1 li:first-child,#checkbox-2 li:first-child').on('click',function(){
					if($(this).hasClass('selected')){
						$('#checkbox-1 li,#checkbox-2 li').removeClass('selected');
						$('#checkbox-1,#checkbox-2 li').find('input').prop('checked', false);
					}
					else{
						$('#checkbox-1 li,#checkbox-2 li').addClass('selected');
						$('#checkbox-1,#checkbox-2').find('input').prop('checked', true);
					}
				})
				</script>
				<script>
				function changepage(message){
				var pageid;
				var choice = "page"+$("#choice").val();
				var showtable = $("#result > .showpage");
				pageid = $("#result > .showpage").attr('id');
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
						if(pageid!=$('#result > div:last-child').attr('id'))
						{
							showtable.removeClass('showpage');
							showtable.next().addClass('showpage');
						}
						break;
					case 4:
						showtable.removeClass('showpage');
						$('#result > div:last-child').addClass('showpage');
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
				pageid = $("#result > div.showpage").attr('id');
				pageid=pageid.substring(4);
				$("#choice").val(pageid);
			}
		</script>
@endsection