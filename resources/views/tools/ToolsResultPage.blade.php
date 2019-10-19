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
			<div class="table-responsive info-tab">
				<table class="table  table-bordered head-type">
					<thead>
						<tr>
							<th>From:{{$from}}</th>
							<th>To:{{$to}}</th>
						</tr>
					</thead>
					<tbody>
                        @foreach($datas as $data)
                        @if($data)
                            @php
                            $array=explode("\t",$data);
                            @endphp
						<tr>
							<td>{{$array[0]}}</td>
							<td>{{$array[1]}}</td>
                        </tr>
                        @endif
                        @endforeach
					</tbody>
				</table>
			</div>
		@if($flag==0)
			<h2 style="color:#b9772e;text-align:center">Unfortunately we were unable to match any identifiers from your list.</h2>
		@endif
		</div>
@endsection
