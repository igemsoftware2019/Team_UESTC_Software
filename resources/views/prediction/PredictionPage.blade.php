@extends('common.layouts')
@section('style')
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('static/css/prediction/style.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/prediction/fileinput.min.css')}}"/>
		<style>
			html,body{
				min-width: 768px;
			}
			.Species{
				display: none;
			}
		</style>
@endsection

@section('content')
<div class="container main-page" style="margin: 0 auto;">
		  <div style="margin-top:20px">
		  	<button type="button" id="bt1" class="btn btn-primary btn-lg">EC_Prediction</button>
		  	<button type="button" id="bt2" class="btn btn-primary btn-lg">Promoter_Prediction</button>
			<input  name="1" id="canshu" value="" style="display: none;" />
		  	<h4 class="ec_show">The Enzyme Commission number (EC number) is a numerical classification scheme for enzymes, based on the chemical reactions they catalyze. It is a four digit numerical representation, four elements separated by periods (eg, EC 3.1.3.16 - Protein-serine/threonine phosphatase).
      <br>You provide a protein sequence, then we give you a probabilistic EC number and more information about the enzyme in BRENDA.</h4>
      <h4 class="Promoter_show hidden">We constructed a CNN-based promoter predictor. In the preprocess of the sequence, we use the method of 'One Hot Encoding' to convert the nucleotide sequence containing ATCG into a numerical value.Sliding window was used to identify promoter regions in large-scale sequences.<br>You provide a nuclic sequence, then we give you a probabilistic promoter and more information about the promoter in EMBL.</h4>
		  </div>


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
			<div class="row" style="display: flex; justify-content: center;">
				<div class="sousuo">
					<div class="col-lg-4  col-lg-offset-6 col-md-4 col-md-offset-5">

						<a class="content_1" href="javascript:;"></a>
						<a class="content_2" href="javascript:;"></a>


						<div class=" signin ">
							<!-- <div class="signin-head"><img src="images/test/head_120.png" alt="" class="img-circle"></div> -->

							<form class="form-signin f1" role="form" method="POST" action="{{route('ec_sqr')}}">
                                @csrf
								<h3 style="margin-top: -20px;">Sequence:</h3>
								<textarea class="form-control" rows="2" style="margin-bottom:20px;" name="query"></textarea>
								<div class="Species">
                                    <h3 class="small_1">Species:</h3>
                                    <select class="form-control" id="3001" name="species">
                                        <optgroup label="---Prokaryotes---"></optgroup>
                                        <!-- <option value='Ecoli_sigma54'>Ecoli_sigma54</option> -->
                                        <option value='Ecoli_sigma70'>Ecoli_sigma70</option>
                                        <option value='Bacillus'>Bacillus</option>
                                        <optgroup label="---Eukaryotes---"></optgroup>
                                        <option value='Human'>Human</option>
                                        <option value='Mouse'>Mouse</option>
                                        <option value='Arabis'>Arabis</option>
                                    </select>
                                    <h4 class="s_hidden">Example: Abiotrophia defectiva</h4>
                                </div>
                                <input type='text' name="type" class="hidden type">
								<button class="btn btn-lg btn-block" type="submit" style="background:#fff;border:1px solid #d3d3d3;margin-bottom: 20px; font-weight: 600; color: #f27d5c;bottom-color:orange; width: 60%; margin:0 auto ;margin-top:30px;">Submit</button>
                            </form>

                            <form class="form-signin f2" role="form" method="post" action="{{route('ec_okey')}}">
							@csrf
                                <h5>Input your key</h5>
                                <input type='text' name="type" class="hidden type">
								<div class="input-group" style="margin-top: 20px;">
									<input class="form-control" type="text" name="key">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit" style="position: relative;">
											Go!
										</button>
									</span>
								</div>
							</form>

						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="container two" id="main4" style="display: none;">
			<div class="row" style="display: flex;
justify-content: center;">
				<div class="sousuo ">
					<div class="col-lg-4  col-lg-offset-6 col-md-4 col-md-offset-5">
						<a class="content_1" href="javascript:;"></a>
						<a class="content_2" href="javascript:;"></a>
						<div class=" signin ">
							<h1 class="small_1">Upload a file</h1>
							<div class="form-group">
                                <form class="form-signin f3" role="form" method="post" action="{{route('ec_file')}}" enctype="multipart/form-data" autocomplete='off'>
                                    @csrf
								    <input id="input-b2" name="file" type="file" class="file" data-show-preview="false" style="margin-bottom:10px;">
                                    <div class="Species" >
                                    <h3 style="margin-top: 10px;" class="small_1">Species:</h3>
                                    <select class="form-control" id="2000">
                                        <option value="" selected></option>
                                        <optgroup label="---Prokaryotes---"></optgroup>
                                        <!-- <option value='Ecoli_sigma54'>Ecoli_sigma54</option> -->
                                        <option value='Ecoli_sigma70'>Ecoli_sigma70</option>
                                        <option value='Bacillus'>Bacillus</option>
                                        <optgroup label="---Eukaryotes---"></optgroup>
                                        <option value='Human'>Human</option>
                                        <option value='Mouse'>Mouse</option>
                                        <option value='Arabis'>Arabis</option>
                                    </select>
                                    <h4 class="s_hidden" style="margin-bottom:20px;">Example: Abiotrophia defectiva</h4>
                                    <input class="form-control hidden" id="1000" style="width: 80%" type="text" name="species">
                                    </div>
                                    <input type='text' name="type" class="hidden type">
                                   <button class="btn btn-lg btn-block" type="submit" style="background:#fff;border:1px solid #d3d3d3;margin-bottom: 20px; font-weight: 600; color: #f27d5c;bottom-color:orange; width: 60%; margin:0 auto ;margin-top:30px;">Submit</button>
                                </form>
                            </div>
                            <form class="form-signin f2" role="form" method="post" action="{{route('ec_okey')}}">
								@csrf
                                <h5 class="small_2">Input your key</h5>
                                <!-- <textarea class="form-control" ></textarea> -->
                                <input type='text' name="type" class="hidden type">

                                <div class="input-group" style="margin-top: 20px;">
                                    <input class="form-control"  type="text" name="key">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" style="position: relative;">
                                            Go!
                                        </button>
                                    </span>
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@endsection

@section('javascript')
<script src="{{asset('static/js/prediction/main.js')}}"></script>
        <script src="{{asset('static/js/prediction/fileinput.min.js')}}"></script>
		<script>
			$(document).ready(function() {
			$(".input-group").attr("style", "margin-bottom: 20px;");

		})
		</script>
		<script>
			$(".content_1").click(function() {

				$("#main").attr("style", "display: none");
				$("#main4").attr("style", "display: none");
				$("#main2").attr("style", "display: none;");
				$("#main").attr("style", "display: block;");

			})
			$(".content_2").click(function() {
				$("#main").attr("style", "display: none");
				$("#main4").attr("style", "display: none");
				$("#main2").attr("style", "display: none;");
				$("#main4").attr("style", "display: block;");
			})
		</script>
		<script type="text/javascript">
			var input = $('#canshu');
			$("#bt1").attr("class","btn btn-primary btn-lg active")
			$("#bt1").click(function() {
				$(".Species").attr("style", "display: none");
				input.val();
                input.val('1');
                $("#bt1").attr("class","btn btn-primary btn-lg ")
				$("#bt2").attr("class","btn btn-primary btn-lg ")
				$("#bt1").attr("class","btn btn-primary btn-lg active")
                $('.type').each(function(){
                    $(this).val('EC_Prediction')
                })
                $('.f1').attr('action',"{{route('ec_sqr')}}")
                $('.f2').attr('action',"{{route('ec_okey')}}")
                $('.f3').attr('action',"{{route('ec_file')}}")
                $('.ec_show').removeClass('hidden');
                $('.Promoter_show').addClass('hidden');
			})
			$("#bt2").click(function() {
				$(".Species").attr("style", "display: block");
				input.val();
                input.val('2');
				$("#bt1").attr("class","btn btn-primary btn-lg ")
				$("#bt2").attr("class","btn btn-primary btn-lg ")
				$("#bt2").attr("class","btn btn-primary btn-lg active")
                $('.type').each(function(){
                    $(this).val('Promoter_Prediction')
                })
                $('.f1').attr('action',"{{route('promoter_sqr')}}")
                $('.f2').attr('action',"{{route('promoter_okey')}}")
                $('.f3').attr('action',"{{route('promoter_file')}}")
                $('.ec_show').addClass('hidden');
                $('.Promoter_show').removeClass('hidden');
			})
		</script>
		<script type="text/javascript">

			$('#1000').val($('#2000 option:selected').text());

			$("#2000").change(function(){
				$('#1000').val($('#2000 option:selected').text());

			}
            )

			$('#3002').val($('#3001 option:selected').text());

			$("#3001").change(function(){
				$('#3002').val($('#3001 option:selected').text());

			}
            )


		</script>
		<script src="{{asset('static/bootstrap/js/bootstrap.js')}}"></script>
@endsection
