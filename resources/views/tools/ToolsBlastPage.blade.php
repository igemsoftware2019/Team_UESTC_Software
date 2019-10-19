@extends('common.layouts')

@section('style')
<style>
			#download-btn {
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
			}
			div{word-wrap: break-word;word-break: break-all;}
			div span{
				font-size: 20px;	
			}
			.main-page div{
				margin-bottom: 20px;
				font-size: 16px;
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
			<h3>title</h3>
			<div>Your result:</div>
			<div>
				<p id="suibian">{{$result}}</p>
			</div>
			<a href="{{$address}}" download="{{$address}}" id="download-btn">Download</a>
		</div>
@endsection

@section('javascript')
        <script>
			var reg = RegExp('\n','g');
            $('#suibian').html($('#suibian').text().replace(reg,'<br>'))
        </script>
@endsection