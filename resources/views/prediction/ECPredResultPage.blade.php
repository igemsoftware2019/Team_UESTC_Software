@extends('common.layouts')
@section('style')
<style>
	.main-page div{
		margin: 20px 0;
	}
</style>
@endsection

@section('content')

<div class="main-page container">
			<h2>Sequence</h2>
			<div style="border: 1px solid #f27d5c;border-radius: 10px;padding: 10px;">
			{{$datas[0]->sequence}}
			</div>
			<div><span>ECNumber ：{{$datas[0]->ecnumber}}<span></div>
			@if($datas[0]->score)
			<div><span>Score ：{{$datas[0]->score}}<span></div>
			@else
			<div><span>ECNumber ：NULL<span></div>
			@endif
			@if($datas[0]->ecnumber!="no Prediction" && $datas[0]->ecnumber!="non Enzyme")
			<div><span><a href="https://www.brenda-enzymes.org/enzyme.php?ecno={{$datas[0]->ecnumber}}" target="blank">more information</a></span></div>
			@endif
		</div>
@endsection
