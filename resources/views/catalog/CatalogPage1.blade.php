@extends('common.layouts')
@section('style')
		<link rel="stylesheet" href="{{asset('static/css/catalog/catalog.css')}}">
@endsection

@section('content')
<div class="main-page container">
			<div class="row">
				<div class="part-select  clearfix">
					<div class="col-xs-4 text-center" style="background: #61839F;font-size:20px;line-height:40px;"><a href="{{route('catalog')}}" style="text-decoration:none;color:white">All The Parts by Type</a></div>
					<div class="col-xs-4 text-center" style="font-size:20px;line-height:40px;"><a href="{{route('catalog2')}}" style="text-decoration:none;color:white">Well Documented Parts</a></div>
					<div class="col-xs-4 text-center" style="font-size:20px;line-height:40px;"><a href="{{route('catalog3')}}" style="text-decoration:none;color:white">Frequently Used Parts</a></div>
				</div>
				<h5>Browse parts by type</h5>
				<div class="content">
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_03.png')}}">promoters(?)
							</div>
							<div><a href="##">List</a></div>
							<div>
								A promoter is a DNA sequence that tends to recruit transcriptional machinery and lead to transcription of the
								downstream DNA sequence.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_06.png')}}"><span>Ribosome<br>Binding<br>Site/about(?)</span>
							</div>
							<div><a href="##">List</a></div>
							<div>
								A ribosome binding site (RBS) is an RNA sequence found in mRNA to which ribosomes can bind and initiate
								translation.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_09.png')}}">Protein domains(?)
							</div>
							<div><a href="##">List</a></div>
							<div>
								Protein domains are portions of proteins cloned in frame with other proteins domains to make up a protein
								coding sequence. Some protein domains might change the protein's location, alter its degradation rate, target
								the protein for cleavage, or enable it to be readily purified.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_09.png')}}">Protein coding sequences (?)
							</div>
							<div><a href="##">List</a></div>
							<div>
								Protein coding sequences encode the amino acid sequence of a particular protein. Note that some protein coding
								sequences only encode a protein domain or half a protein. Others encode a full-length protein from start codon
								to stop codon. Coding sequences for gene expression reporters such as LacZ and GFP are also included here.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_11.png')}}">Protein domains(?)
							</div>
							<div><a href="##">List</a></div>
							<div>
								Protein domains are portions of proteins cloned in frame with other proteins domains to make up a protein
								coding sequence. Some protein domains might change the protein's location, alter its degradation rate, target
								the protein for cleavage, or enable it to be readily purified.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_13.png')}}">Translational units (?)
							</div>
							<div><a href="##">List</a></div>
							<div>
								Translational units are composed of a ribosome binding site and a protein coding sequence. They begin at the
								site of translational initiation, the RBS, and end at the site of translational termination, the stop codon.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_16.png')}}">Terminators (?):
							</div>
							<div><a href="##">List</a></div>
							<div>
								A terminator is an RNA sequence that usually occurs at the end of a gene or operon mRNA and causes
								transcription to stop.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_19.png')}}">DNA (?):
							</div>
							<div><a href="##">List</a></div>
							<div>
								DNA parts provide functionality to the DNA itself. DNA parts include cloning sites, scars, primer binding
								sites, spacers, recombination sites, conjugative tranfer elements, transposons, origami, and aptamers.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_21.png')}}">Plasmid backbones (?):
							</div>
							<div><a href="##">List</a></div>
							<div>
								A plasmid is a circular, double-stranded DNA molecules typically containing a few thousand base pairs that
								replicate within the cell independently of the chromosomal DNA. A plasmid backbone is defined as the plasmid
								sequence beginning with the BioBrick suffix, including the replication origin and antibiotic resistance marker,
								and ending with the BioBrick prefix.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_25.png')}}">Plasmids (?):
							</div>
							<div><a href="##">List</a></div>
							<div>
								A plasmid is a circular, double-stranded DNA molecules typically containing a few thousand base pairs that
								replicate within the cell independently of the chromosomal DNA. If you're looking for a plasmid or vector to
								propagate or assemble plasmid backbones, please see the set of plasmid backbones. There are a few parts in the
								Registry that are only available as circular plasmids, not as parts in a plasmid backbone, you can find them
								here. Note that these plasmids largely do not conform to the BioBrick standard.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								<img src="{{asset('static/images/分类搜索界面_28.png')}}">Primers (?)
							</div>
							<div><a href="##">List</a></div>
							<div>
								A primer is a short single-stranded DNA sequences used as a starting point for PCR amplification or sequencing.
								Although primers are not actually available via the Registry distribution, we include commonly used primer
								sequences here.
							</div>
						</div>
					</div>
					<div>
						<div class="block clearfix">
							<div>
								Composite parts (?)
							</div>
							<div><a href="##">List</a></div>
							<div>
								Composite parts are combinations of of two or more BioBrick parts.
							</div>
						</div>
					</div>
				</div>
				<!--<h5>Browse devices by type</h5>-->
				<!--<div style="display: flex;justify-content: space-between;flex-wrap: wrap;">-->
				<!--	<div class="text-block">-->
				<!--		<div><img src="{{asset('static/images/分类搜索界面_33.png')}}" height="35">Protein generators (?)</div>-->
				<!--	</div>-->
				<!--	<div class="text-block">-->
				<!--		<div><img src="{{asset('static/images/分类搜索界面_35.png')}}" height="35">Reporters (?)</div>-->
				<!--	</div>-->
				<!--	<div class="text-block">-->
				<!--		<div><img src="{{asset('static/images/分类搜索界面_40.png')}}" height="35">Receivers and senders (?)</div>-->
				<!--	</div>-->
				<!--	<div class="text-block">-->
				<!--		<div><img src="{{asset('static/images/分类搜索界面_31.png')}}" height="35">Inverters (?)</div>-->
				<!--	</div>-->
				<!--	<div class="text-block">-->
				<!--		<div><img src="{{asset('static/images/分类搜索界面_42.png')}}" height="35">Measurement devices (?)</div>-->
				<!--	</div>-->
				<!--</div>-->

			</div>
		</div>
@endsection

@section('javascript')
		<script type="text/javascript">
			function fun() {
				var out = $('.block').width();
				var width = out - 240;
				$('.block div:nth-child(3)').width(width);
				$('.block').each(function() {
					$(this).children('div').eq(0).outerHeight("");
					// 初始化高度,解决不能缩小问题
					var height1 = $(this).children('div').eq(0).outerHeight();
					var height3 = $(this).children('div').eq(2).outerHeight();
					if (height1 > height3) {
						$(this).children('div').eq(1).outerHeight(height1);
					} else {
						$(this).children('div').eq(0).outerHeight(height3);
						$(this).children('div').eq(1).outerHeight(height3);
					}
				})

			}
			$(fun);
			$(window).resize(fun);
			// 用于控制主要内容块的长宽
		</script>
@endsection