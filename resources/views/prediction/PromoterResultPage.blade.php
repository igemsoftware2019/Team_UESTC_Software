@extends('common.layouts')


@section('style')
<style type="text/css">
			#btn-1,#btn-2 {
				display: flex;
				background: #70a6e4;
				margin-right: 40px;
				padding: 0 20px;
				color: white;
				font-size: 20px;
				border-radius: 40px;
				text-decoration: none;
				justify-content: center;
				align-items: center;
				box-shadow: #c5d2d9 0 2px 2px 2px;
			}
			.main-page{
				padding-top: 40px;
			}
			#key{
				font-size: 24px;
			}
			.info-tab{
				word-wrap: break-word;
				word-break: break-all;
			}
			.info-tab .head-type{
				border-color: #666;
			}
			.info-tab .head-type th,.info-tab .head-type td{
				border-color:#666;
			}
			.info-tab h5 + .table{
				margin-bottom: 20px;
			}
			.info-tab p{
				padding: 0 5px;
			}
			.table{
				border-collapse:separate;
				border: 1px solid #f27d5c;
				border-radius: 5px;
				margin-bottom: 0;
			}
			.table tbody tr th,.table thead tr th{
				border-right: 1px solid #f27d5c;
			    border-bottom: 1px solid #f27d5c;
				border-left: none;
				border-top: none;
				line-height: 100%;
				width:180px;
			}
			.table thead tr th{
				background: #c8e0ff;
				vertical-align: top;
			}
			.table tbody tr:last-child th,.table tbody tr:last-child td{
				border-bottom:none;
			}
			.table th:last-child,.table td:last-child{
				border-right: none;
			}
			.table thead th:first-child{
				border-radius: 5px 0 0 0;
			}
			.table thead th:last-child{
				border-radius: 0 5px 0 0;
			}
			.table tbody tr td,.table thead tr td{
				border-right: 1px solid #f27d5c;
			    border-bottom: 1px solid #f27d5c;
				border-top: none;
				border-left: none;
			}
		</style>
@endsection

@section('content')
<div class="main-page container">
			
            @if (!$judge)
                <div>
                        <h3 id="num-result"></h3>
                        <p style="font-size: 18px;">
                            {{-- Note:make sure your sequence long enough,otherwise the result is meanless!<br>
                            For more details,please see the document! --}}
                            Note:Please make sure your key is exist!
                        </p>
                </div>					

            @elseif($judge == 1)
                <p style="font-size: 18px;">You key is:<span id="key">{{$key}}</span></p>
                <div style="display: flex;">
                        <a id="btn-1" href="javascript:void(0)">View Raw Results</a>
                        <a id="btn-2" href="javascript:void(0)">View Selected Results</a>
                    </div>
                <br><br/>
                <div class="table-responsive info-tab" id="tab-1">
                    <table class="table  table-bordered head-type">
                        <thead>
                            <tr>
                                <th>Region_start</th>
                                <th>Region_end</th>
                                <th>Prom_Exon</th>
                                <th>Prom_Intron</th>
                                <th>Prom_3UTR</th>
                                <th>Average_score</th>
                                <th>Label</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($viewr as $sqr)
                                <tr>
                                    <td>{{$sqr->Region_start}}</td>
                                    <td>{{$sqr->Region_end}}</td>
                                    <td>{{$sqr->Prom_Exon}}</td>
                                    <td>{{$sqr->Prom_Intron}}</td>
                                    <td>{{$sqr->Prom_3UTR}}</td>
                                    <td>{{$sqr->Average_score}}</td>
                                    <td>{{$sqr->Label}}</td>
                                </tr>
                            @endforeach	
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive info-tab hidden" id="tab-2">
                    @if(!$len)

                        Note: Make sure your sequence long enough, otherwise the result is meanless! For more details, please see document.
                        <br>No promoter found!
                    @else
                        {{$len}}Promoter Found!
                    
                        <table class="table  table-bordered head-type">
                            <thead>
                                <tr>
                                    <th>Region_start</th>
                                    <th>Region_end</th>
                                    <th>Score</th>					
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($optim as $sqrr)
                                    <tr>
                                        <td>{{$sqrr->Region_start}}</td>
                                        <td>{{$sqrr->Region_end}}</td>
                                        <td>{{$sqrr->Score}}</td>			
                                    </tr>
                                @endforeach	
                            </tbody>
                        </table>
                    @endif
                </div>
            @elseif($judge == 2)
                <p style="font-size: 18px;">You key is:<span id="key">{{$key}}</span></p>
                <div style="display: flex;">
                        <a id="btn-1" >View raw results</a>
                        <a id="btn-2">View Selected results</a>
                    </div>
                <br><br/>

                <div class="table-responsive info-tab" id="tab-1">
                    <table class="table  table-bordered head-type">
                        <thead>
                            <tr>
                                <th>Region_start</th>
                                <th>Region_end</th>
                                <th>Score</th>
                                <th>Label</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($viewr as $sqr)
                                <tr>
                                    <td>{{$sqr->Region_start}}</td>
                                    <td>{{$sqr->Region_end}}</td>
                                    <td>{{$sqr->Score}}</td>
                                    <td>{{$sqr->Label}}</td>
                                </tr>
                            @endforeach	
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive info-tab hidden" id="tab-2">
                    @if(!$len)

                        Note: Make sure your sequence long enough, otherwise the result is meanless! For more details, please see document.<br>
                        No promoter found!
                    @else
                        {{$len}}Promoter Found!
                        <table class="table  table-bordered head-type">
                            <thead>
                                <tr>
                                    <th>Region_start</th>
                                    <th>Region_end</th>
                                    <th>Score</th>					
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($optim as $sqrr)
                                    <tr>
                                        <td>{{$sqrr->Region_start}}</td>
                                        <td>{{$sqrr->Region_end}}</td>
                                        <td>{{$sqrr->Score}}</td>			
                                    </tr>
                                @endforeach	
                            </tbody>
                        </table>
                    @endif
                </div>
            @endif

</div>
@endsection


@section('javascript')
<script>
			document.getElementById('btn-1').onclick=function(){
				document.getElementById('tab-2').classList.add('hidden');
				document.getElementById('tab-1').classList.remove('hidden');
			}
			document.getElementById('btn-2').onclick=function(){
				document.getElementById('tab-1').classList.add('hidden');
				document.getElementById('tab-2').classList.remove('hidden');
			}
		</script>
@endsection