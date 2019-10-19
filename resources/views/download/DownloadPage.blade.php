@extends('common.layouts')

@section('style')
<style type="text/css">
			body{
				
				background-size: cover;
			}
			.main-page{
				display: flex;
				align-items: center;
			}
			.main-page a{
				display: block;
				height: 60px;
				width: 200px;
				background: linear-gradient(to right,#5c7add,#7748f4);
				color: white;
				border-radius: 100px;
				text-align: center;
				line-height: 60px;
				text-decoration: none;
			}
			.main-page a:hover,.main-page a:focus{
				text-decoration: none;
				color: white;
				background: linear-gradient(to right,#5c7add,#7748f4);
			}
			.main-page a:active {
			    background: linear-gradient(to right,#5c7add,#7748f4)
			}
			.contain{
				width:1100px;
				margin:0px auto;
				margin-top: 100px;
				position: relative;
			}
			.imgInLeft{
				position: absolute;
				right:55%;
				z-index: -1;
				max-width:1200px;
				width:800px;
				height:400px;
				margin-left: -400px;
				margin-top: -50px;
				background-position: 30% 0%;
				
			}
			.whiteDiv{
				border-radius:3px;
				margin-left: 35%;
				width:650px;
				background-color: white;
				padding:50px;
				box-shadow:0 20px 30px -16px rgba(9,9,16,.2) ;
			}
			.logggg{
				width:70px;
			}
			.fontttt{
				font-size: 50px;
				margin-left: 20px;
				color:#215fae;
				font-weight: 700;
				
			}
			.blockPart{
				width:300px;
				height:230px;
				background-color: white;
				position:absolute;
				box-shadow:0 20px 30px -16px rgba(9,9,16,.2) ;
				padding:15px 30px;
				border-radius: 3px;
			}
			.blockPart img{
				width:180px;
				
			}
			.blockPart a{
				font-weight: 600;
				
			}
			.blockPartDown{
				width:260px;
				height:100px;
				background-color: white;
				position:absolute;
				box-shadow:0 20px 30px -16px rgba(9,9,16,.2) ;
				padding:15px 15px;
			}
		    .blockPartDown:hover{
				transform: scale(1.1,1.1);
				cursor: pointer;
			}
			.blockPartDown img{
				width:70px;
				float:left;
				margin-right: 10px;
			}
			.blockPartDown font{
				font-size:30px;
			}
			.blockPartDown div{
				font-size:15px;
				color:#a79f9f;
			}
			


		</style>
@endsection

@section('content')

<div class="contain">
	<img class = "imgInLeft" src="{{asset('static/images/bk4.png')}}">
	
	<div class = "whiteDiv">
		<div style ="line-height:70px;vertical-align:center;display:flex;margin-bottom:10px">
			<img class = "logggg" src="{{asset('static/images/download01.svg')}}">
			<font class = "fontttt">Download</font>
		</div>
		<div style = "text-align: justify;">
			We downloaded the iGEM part and feature information in the iGEM Registry, and then mapped the part to the protein in UniProt through BLAST. Then, using UniProt as a bridge, we obtained the information of each common database in batches through api. Finally, we integrated all the data into the following three formats for download.
		</div>
	</div>
</div>

<div style="display:flex;position:relative;width:1200px;margin:0px auto;margin-top:230px;">
	<div style ="height:300px"></div>
	<div class = "blockPart"style="left:10%">
		<div>
			<img src="{{asset('static/images/xml.png')}}">
		</div>
		<div style="padding-top:15px">
			Extensible Markup Language (XML) is a markup language that defines a set of rules for encoding documents in a format that is both human-readable and machine-readable. 
		</div>
		<div style="position:absolute;bottom:15px">
			<a href="{{route('xml_download')}}">Download</a>
		</div>
	</div>
	
	<div class = "blockPart"style="left:40%">
		<div>
			<img src="{{asset('static/images/csv.png')}}">
		</div>
		<div style="padding-top:15px">
			Comma-separated values(CSV) files are delimited text file that uses a comma to seperate values, which stores tabular data in plain text. 
		</div>
		<div style="position:absolute;bottom:20px">
			<a href="{{route('csv_download')}}">Download</a>
		</div>
	</div>
	
	<div class = "blockPart"style="left:70%">
		<div>
			<img src="{{asset('static/images/sql.png')}}">
		</div>
		<div style="padding-top:15px">
			Structured Query Language(SQL) is a domain-specific language used in programming and designed for managing data.
		</div>
		<div style="position:absolute;bottom:15px">
			<a href="{{route('sql_download')}}">Download</a>
		</div>
	</div>
</div>

<div style="display:flex;position:relative;width:1200px;margin:0px auto;">
	<div style ="height:100px"></div>
	<div class = "blockPartDown" style="left:25%">
		<img src="{{asset('static/images/github.jpg')}}">
		<font>GitHub</font>
		<div style="font-size:15px"> GitHub </div>
	</div>
	<div class = "blockPartDown" style="left:55%">
		<img src="{{asset('static/images/docker.png')}}">
		<font>Docker</font>
		<div > Docker </div>
	</div>
</div>



<!--<div class="main-page container">-->
<!--			<div style="display: flex;justify-content: space-around;width:100%;font-size:20px">-->
<!--				<a download="" href="{{route('xml_download')}}">xml</a>-->
<!--				<a download="" href="{{route('csv_download')}}">csv</a>-->
<!--				<a download="" href="{{route('sql_download')}}">sql</a>-->
<!--			</div>-->
<!--</div>-->
		
		
		
		
		
@endsection 