@extends('common.layouts')
@section('style')
<link rel="stylesheet" href="{{asset('static/css/detail/style.css')}}">
<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=Promise%2Cfetch"></script>

<script src="{{asset('static/js/detail/cytoscape.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('static/css/sbol/sbol-visual.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('static/css/detail/mycss.css')}}">
@stop

@section('left-navbar')
<a class="nav-dropdown" href="javascript:void(0)" ><i class="iconfont hidden-xs" style="font-size: 50px;">&#xe686;</i></a>
					<div class='nav-part-xs hidden'>  
						<!-- 手机横屏导航栏 -->
						@if($flag==1)
							<div>{{$igemid}}</div>
							<ul class="organisms clearfix">
									@foreach($uniids as $value)
									<li><a href="{{route('result',['igemid'=>$igemid,'uniid'=>$value->uniid])}}">{{$value->uniid}}</a></li>
									@endforeach
									</li>	
							</ul>
						@endif
						<div>Information</div>
						<ul class="libs">
							<li class="dropup-x li-selected">
								<a class="dropdown-x-toggle" href="javascript:void(0)">iGEM</a>
									<ul class="dropdown-x-menu">
										<li><a href="#Igem_id">ID</a></li>
										<li><a href="#Igem_Information">Information</a></li>
										<li><a href="#Igem_Design">Design</a></li>
										<li><a href="#Igem_Relatedparts">Related parts</a></li>
										@if($parts_features->isNotempty()) 
										<li><a href="#Igem_Feature">Feature</a></li>
										@else
										<li class="banned"><a href="#Igem_Feature">Feature</a></li>
										@endif
										<li><a href="#Igem_Sequence">Sequence</a></li>
									</ul>
							</li>
				@if($flag==1)
					@if($uni->isNotempty())
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Uniprot</a>
								<ul class="dropdown-x-menu">
									<li><a href="#Uniprot_id">ID</a></li>
									@if($uni_comments->isNotempty())
									<li ><a href="#Uniprot_Function">Function</a></li>
									@else
									<li class="banned"><a href="#Uniprot_Function">Function</a></li>
									@endif
									<!-- <li ><a href="#Uniprot_Comment">Comment</a></li> -->
									@if($uni_features->isNotempty())
									<li ><a href="#Uniprot_Feature">Feature</a></li>
									@else
									<li class="banned"><a href="#Uniprot_Feature">Feature</a></li>
									@endif
									@if($uni_cross->isNotempty())
									<li ><a href="#Uniprot_Crossreference">Cross reference</a></li>
									@else
									<li class="banned"><a href="#Uniprot_Crossreference">Cross reference</a></li>
									@endif
									<li ><a href="#Uniprot_Keywords">Keywords</a></li>
									<!-- <li ><a href="#Uniprot_Evidence">Evidence</a></li> -->
									@if($uni_publications->isNotempty())
									<li ><a href="#Uniprot_Publications">Publications</a></li>
									@else
									<li class="banned"><a href="#Uniprot_Publications">Publications</a></li>
									@endif
									<li ><a href="#Uniprot_Sequence">Sequence</a></li>
								</ul>
							</li>
					@else
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">UniProt</a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#Uniprot_id">ID</a></li>
									<li class="banned"><a href="#Uniprot_Function">Function</a></li>
									<li class="banned"><a href="#Uniprot_Comment">Comment</a></li>
									<li class="banned"><a href="#Uniprot_Feature">Feature</a></li>
									<li class="banned"><a href="#Uniprot_Crossreference">Cross reference</a></li>
									<li class="banned"><a href="#Uniprot_Keywords">Keywords</a></li>
									<li class="banned"><a href="#Uniprot_Evidence">Evidence</a></li>
									<li class="banned"><a href="#Uniprot_Publications">Publications</a></li>
									<li class="banned"><a href="#Uniprot_Sequence">Sequence</a></li>
								</ul>
							</li>
					@endif
						@if($kegg_flag==1)
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG</a>
								<ul class="dropdown-x-menu">
									<li><a href="#KEGG_id">ID</a></li>
									@if($kegg1[0]->pathway!=NULL)
									<li><a href="#KEGG_Pathway">Pathway</a></li>
									@else
									<li class="banned"><a href="#KEGG_Pathway">Pathway</a></li>
									@endif
									@if($kegg1_module->isNotEmpty())
									<li><a href="#KEGG_Module">Module</a></li>
									@else
									<li class="banned"><a href="#KEGG_Module">Module</a></li>
									@endif
									<li><a href="#KEGG_Crossreference">Cross reference</a></li>
									<li><a href="#KEGG_Sequence">Sequence</a></li>
									@if($kegg1_reference->isNotEmpty())
									<li><a href="#KEGG_Reference">Reference</a></li>
									@else
									<li class="banned"><a href="#KEGG_Reference">Reference</a></li>
									@endif
								</ul>
							</li>
					@else
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG</a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#KEGG_id">ID</a></li>
									<li class="banned"><a href="#KEGG_Pathway">Pathway</a></li>
									<li class="banned"><a href="#KEGG_Module">Module</a></li>
									<li class="banned"><a href="#KEGG_Crossreference">Cross reference</a></li>
									<li class="banned"><a href="#KEGG_Sequence">Sequence</a></li>
									<li class="banned"><a href="#KEGG_Reference">Reference</a></li>
								</ul>
							</li>
					@endif
							<li class="dropup-x">
							<a class="dropdown-x-toggle"  href="javascript:void(0)">ANNOTATION</a>
								<ul class="dropdown-x-menu">
									@if($Gos->isNotempty())
									<li><a href="#ANNOTATION_GO">GO</a></li>
									@else
									<li class="banned"><a href="#ANNOTATION_GO">GO</a></li>
									@endif
									@if($kegg_flag==1 && $ko_flag==1)
									@if($kegg2->isNotempty())
									<li><a href="#ANNOTATION_KEGGko">KEGG KO</a></li>
									@else
									<li class='banned'><a href="#ANNOTATION_KEGGko">KEGG KO</a></li>
									@endif
									@if($kegg2_pathways->isNotempty())
									<li><a href="#ANNOTATION_Pathway">Pathway</a></li>
									@else
									<li class="banned"><a href="#ANNOTATION_Pathway">Pathway</a></li>
									@endif
									@if($kegg2->isNotempty())
									<li><a href="#ANNOTATION_Brite">Brite</a></li>
									@else
									<li class="banned"><a href="#ANNOTATION_Brite">Brite</a></li>
									@endif
									@else
									<li class='banned'><a href="#ANNOTATION_KEGGko">KEGG KO</a></li>
									<li class='banned'><a href="#ANNOTATION_Pathway">Pathway</a></li>
									<li class='banned'><a href="#ANNOTATION_Brite">Brite</a></li>
									@endif
								</ul>
							</li>
					@if($kegg_flag==1 && $ec_flag==1)
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Enzyme</a>
								<ul class="dropdown-x-menu">
									<li><a href="#Enzyme_id">ID</a></li>
									<li><a href="#Enzyme_Brenda">BRENDA</a></li>
								</ul>
							</li>
							<li class="dropup-x">
							<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG enzyme</a>
								<ul class="dropdown-x-menu">
									@if($kegg3!=NULL)
									<li><a href="#KEGGenzyme_id">ID</a></li>
									@if($kegg3[0]->comment)
									<li><a href="#KEGGenzyme_Comment">Comment</a></li>
									@else
									<li class="banned"><a href="#KEGGenzyme_Comment">Comment</a></li>
									@endif
									@if($kegg3_references!=NULL)
									<li><a href="#KEGGenzyme_Reference">Reference</a></li>
									@else
									<li class="banned"><a href="#KEGGenzyme_Reference">Reference</a></li>
									@endif
									@else
									<li class="banned"><a href="#KEGGenzyme_id">ID</a></li>
									<li class="banned"><a href="#KEGGenzyme_Comment">Comment</a></li>
									<li class="banned"><a href="#KEGGenzyme_Reference">Reference</a></li>
									@endif
								</ul>
							</li>
					@else
									<li class="dropup-x">
										<a class="dropdown-x-toggle" href="javascript:void(0)">Enzyme</a>
										<ul class="dropdown-x-menu">
											<li class="banned"><a href="#Enzyme_id">ID</a></li>
											<li class="banned"><a href="#Enzyme_Brenda">BRENDA</a></li>
										</ul>
									</li>
									<li class="dropup-x">
										<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG enzyme</a>
										<ul class="dropdown-x-menu">
											<li class="banned"><a href="#KEGGenzyme_id">ID</a></li>
											<li class="banned"><a href="#KEGGenzyme_Comment">Comment</a></li>
											<li class="banned"><a href="#KEGGenzyme_Reference">Reference</a></li>
										</ul>
									</li>
					@endif
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Interaction</a>
								<ul class="dropdown-x-menu">
									@if($str_flag==1)
									<li><a href="#cy">STRING</a></li>
									@else
									<li class="banned"><a href="#cy">STRING</a></li>
									@endif
									@if($genename && $Biogrid_interaction->isNotempty())
									<li><a href="#Interaction_Biogrid">BioGRID</a></li>
									@else
									<li class="banned"><a href="#Interaction_Biogrid">BioGRID</a></li>
									@endif
								</ul>
							</li>
				@else
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">UniProt</a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#Uniprot_id">ID</a></li>
									<li class="banned"><a href="#Uniprot_Function">Function</a></li>
									<li class="banned"><a href="#Uniprot_Comment">Comment</a></li>
									<li class="banned"><a href="#Uniprot_Feature">Feature</a></li>
									<li class="banned"><a href="#Uniprot_Crossreference">Cross reference</a></li>
									<li class="banned"><a href="#Uniprot_Keywords">Keywords</a></li>
									<li class="banned"><a href="#Uniprot_Evidence">Evidence</a></li>
									<li class="banned"><a href="#Uniprot_Publications">Publications</a></li>
									<li class="banned"><a href="#Uniprot_Sequence">Sequence</a></li>
								</ul>
							</li>
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG</a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#KEGG_id">ID</a></li>
									<li class="banned"><a href="#KEGG_Pathway">Pathway</a></li>
									<li class="banned"><a href="#KEGG_Module">Module</a></li>
									<li class="banned"><a href="#KEGG_Crossreference">Cross reference</a></li>
									<li class="banned"><a href="#KEGG_Sequence">Sequence</a></li>
									<li class="banned"><a href="#KEGG_Reference">Reference</a></li>
								</ul>
							</li>
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">ANNOTATION</a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#ANNOTATION_GO">GO</a></li>
									<li class="banned"><a href="#ANNOTATION_KEGGko">KEGG KO</a></li>
									<li class="banned"><a href="#ANNOTATION_Pathway">Pathway</a></li>
									<li class="banned"><a href="#ANNOTATION_Brite">Brite</a></li>
								</ul>
							</li>
							<li class="dropup-x">
								<a class="dropdown-x-toggle"href="javascript:void(0)">Enzyme</a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#Enzyme_id">ID</a></li>
									<li class="banned"><a href="#Enzyme_Brenda">BRENDA</a></li>
								</ul>
							</li>
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG enzyme</a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#KEGGenzyme_id">ID</a></li>
									<li class="banned"><a href="#KEGGenzyme_Comment">Comment</a></li>
									<li class="banned"><a href="#KEGGenzyme_Reference">Reference</a></li>
								</ul>
							</li>
							<li class="dropup-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Interaction</a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#cy">STRING</a></li>
									<li class="banned"><a href="#Interaction_Biogrid">BioGRID</a></li>
								</ul>
							</li>
						@endif		
							<li id="Download_nav">
								<a href="#Download">Download</a>
							</li>
						</ul>
                    </div>

                        <!-- 电脑导航栏 -->
						<div class='nav-part'>
						<div>{{$igemid}}</div>
							<ul class="organisms">
								<li class="dropdown-x li-selected">
								<a class="dropdown-x-toggle" href="javascript:void(0)">{{$uni_num}} Hits<i class="iconfont pull-right">&#xe62d;</i></a>
								@if($flag==1)
								<ul class="dropdown-x-menu">
									@foreach($uniids as $value)
									<li><a href="{{route('result',['igemid'=>$igemid,'uniid'=>$value->uniid])}}">{{$value->uniid}}</a></li>
									@endforeach
								</ul>
								@endif
								</li>	
							</ul>

						<div>Information</div>
						<ul class="libs">
						<li class="dropdown-x li-selected">
							<a class="dropdown-x-toggle" href="javascript:void(0)">iGEM<i class="iconfont pull-right ">&#xe62d;</i></a>
							<ul class="dropdown-x-menu">
								<li><a href="#Igem_id">ID</a></li>
								<li><a href="#Igem_Information">Information</a></li>
								<li><a href="#Igem_Design">Design</a></li>
								<li><a href="#Igem_Relatedparts">Related parts</a></li>
								@if($parts_features->isNotempty()) 
								<li><a href="#Igem_Feature">Feature</a></li>
								@else
								<li class="banned"><a href="#Igem_Feature">Feature</a></li>
								@endif
								<li><a href="#Igem_Sequence">Sequence</a></li>
							</ul>
						</li>
				@if($flag==1)
					@if($uni->isNotempty())
							<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">UniProt<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li><a href="#Uniprot_id">ID</a></li>
									@if($uni_comments->isNotempty())
									<li ><a href="#Uniprot_Function">Function</a></li>
									@else
									<li class="banned"><a href="#Uniprot_Function">Function</a></li>
									@endif
									<!-- <li ><a href="#Uniprot_Comment">Comment</a></li> -->
									@if($uni_features->isNotempty())
									<li ><a href="#Uniprot_Feature">Feature</a></li>
									@else
									<li class="banned"><a href="#Uniprot_Feature">Feature</a></li>
									@endif
									@if($uni_cross->isNotempty())
									<li ><a href="#Uniprot_Crossreference">Cross reference</a></li>
									@else
									<li class="banned"><a href="#Uniprot_Crossreference">Cross reference</a></li>
									@endif
									<li ><a href="#Uniprot_Keywords">Keywords</a></li>
									<!-- <li ><a href="#Uniprot_Evidence">Evidence</a></li> -->
									@if($uni_publications->isNotempty())
									<li ><a href="#Uniprot_Publications">Publications</a></li>
									@else
									<li class="banned"><a href="#Uniprot_Publications">Publications</a></li>
									@endif
									<li ><a href="#Uniprot_Sequence">Sequence</a></li>
								</ul>
							</li>
					@else
							<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">UniProt<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#Uniprot_id">ID</a></li>
									<li class="banned"><a href="#Uniprot_Function">Function</a></li>
									<li class="banned"><a href="#Uniprot_Comment">Comment</a></li>
									<li class="banned"><a href="#Uniprot_Feature">Feature</a></li>
									<li class="banned"><a href="#Uniprot_Crossreference">Cross reference</a></li>
									<li class="banned"><a href="#Uniprot_Keywords">Keywords</a></li>
									<li class="banned"><a href="#Uniprot_Evidence">Evidence</a></li>
									<li class="banned"><a href="#Uniprot_Publications">Publications</a></li>
									<li class="banned"><a href="#Uniprot_Sequence">Sequence</a></li>
								</ul>
							</li>
					@endif
					@if($kegg_flag==1)
							<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li><a href="#KEGG_id">ID</a></li>
									@if($kegg1[0]->pathway!=NULL)
									<li><a href="#KEGG_Pathway">Pathway</a></li>
									@else
									<li class="banned"><a href="#KEGG_Pathway">Pathway</a></li>
									@endif
									@if($kegg1_module->isNotEmpty())
									<li><a href="#KEGG_Module">Module</a></li>
									@else
									<li class="banned"><a href="#KEGG_Module">Module</a></li>
									@endif
									<li><a href="#KEGG_Crossreference">Cross reference</a></li>
									<li><a href="#KEGG_Sequence">Sequence</a></li>
									@if($kegg1_reference->isNotEmpty())
									<li><a href="#KEGG_Reference">Reference</a></li>
									@else
									<li class="banned"><a href="#KEGG_Reference">Reference</a></li>
									@endif
								</ul>
							</li>
					@else
							<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#KEGG_id">ID</a></li>
									<li class="banned"><a href="#KEGG_Pathway">Pathway</a></li>
									<li class="banned"><a href="#KEGG_Module">Module</a></li>
									<li class="banned"><a href="#KEGG_Crossreference">Cross reference</a></li>
									<li class="banned"><a href="#KEGG_Sequence">Sequence</a></li>
									<li class="banned"><a href="#KEGG_Reference">Reference</a></li>
								</ul>
							</li>
					@endif
							<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">ANNOTATION<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									@if($Gos->isNotempty())
									<li><a href="#ANNOTATION_GO">GO</a></li>
									@else
									<li class="banned"><a href="#ANNOTATION_GO">GO</a></li>
									@endif
									@if($kegg_flag==1 && $ko_flag==1)
									@if($kegg2->isNotempty())
									<li><a href="#ANNOTATION_KEGGko">KEGG KO</a></li>
									@else
									<li class='banned'><a href="#ANNOTATION_KEGGko">KEGG KO</a></li>
									@endif
									@if($kegg2_pathways->isNotempty())
									<li><a href="#ANNOTATION_Pathway">Pathway</a></li>
									@else
									<li class="banned"><a href="#ANNOTATION_Pathway">Pathway</a></li>
									@endif
									@if($kegg2->isNotempty())
									<li><a href="#ANNOTATION_Brite">Brite</a></li>
									@else
									<li class="banned"><a href="#ANNOTATION_Brite">Brite</a></li>
									@endif
									@else
									<li class='banned'><a href="#ANNOTATION_KEGGko">KEGG KO</a></li>
									<li class='banned'><a href="#ANNOTATION_Pathway">Pathway</a></li>
									<li class='banned'><a href="#ANNOTATION_Brite">Brite</a></li>
									@endif
								</ul>
							</li>
					@if($kegg_flag==1 && $ec_flag==1)
							<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Enzyme<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li><a href="#Enzyme_id">ID</a></li>
									<li><a href="#Enzyme_Brenda">BRENDA</a></li>
								</ul>
							</li>
							<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG enzyme<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									@if($kegg3!=NULL)
									<li><a href="#KEGGenzyme_id">ID</a></li>
									@if($kegg3[0]->comment)
									<li><a href="#KEGGenzyme_Comment">Comment</a></li>
									@else
									<li class="banned"><a href="#KEGGenzyme_Comment">Comment</a></li>
									@endif
									@if($kegg3_references!=NULL)
									<li><a href="#KEGGenzyme_Reference">Reference</a></li>
									@else
									<li class="banned"><a href="#KEGGenzyme_Reference">Reference</a></li>
									@endif
									@else
									<li class="banned"><a href="#KEGGenzyme_id">ID</a></li>
									<li class="banned"><a href="#KEGGenzyme_Comment">Comment</a></li>
									<li class="banned"><a href="#KEGGenzyme_Reference">Reference</a></li>
									@endif
								</ul>
							</li>
					@else
					<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Enzyme<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#Enzyme_id">ID</a></li>
									<li class="banned"><a href="#Enzyme_Brenda">BRENDA</a></li>
								</ul>
					</li>
					<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG enzyme<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#KEGGenzyme_id">ID</a></li>
									<li class="banned"><a href="#KEGGenzyme_Comment">Comment</a></li>
									<li class="banned"><a href="#KEGGenzyme_Reference">Reference</a></li>
								</ul>
					</li>
					@endif
							<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Interaction<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									@if($str_flag==1)
									<li><a href="#cy">STRING</a></li>
									@else
									<li class="banned"><a href="#cy">STRING</a></li>
									@endif
									@if($genename && $Biogrid_interaction->isNotempty())
									<li><a href="#Interaction_Biogrid">BioGRID</a></li>
									@else
									<li class="banned"><a href="#Interaction_Biogrid">BioGRID</a></li>
									@endif
								</ul>
							</li>
				@else
				<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Uniprot<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#Uniprot_id">ID</a></li>
									<li class="banned"><a href="#Uniprot_Function">Function</a></li>
									<li class="banned"><a href="#Uniprot_Comment">Comment</a></li>
									<li class="banned"><a href="#Uniprot_Feature">Feature</a></li>
									<li class="banned"><a href="#Uniprot_Crossreference">Cross reference</a></li>
									<li class="banned"><a href="#Uniprot_Keywords">Keywords</a></li>
									<li class="banned"><a href="#Uniprot_Evidence">Evidence</a></li>
									<li class="banned"><a href="#Uniprot_Publications">Publications</a></li>
									<li class="banned"><a href="#Uniprot_Sequence">Sequence</a></li>
								</ul>
				</li>
				<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#KEGG_id">ID</a></li>
									<li class="banned"><a href="#KEGG_Pathway">Pathway</a></li>
									<li class="banned"><a href="#KEGG_Module">Module</a></li>
									<li class="banned"><a href="#KEGG_Crossreference">Cross reference</a></li>
									<li class="banned"><a href="#KEGG_Sequence">Sequence</a></li>
									<li class="banned"><a href="#KEGG_Reference">Reference</a></li>
								</ul>
				</li>
				<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">ANNOTATION<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#ANNOTATION_GO">GO</a></li>
									<li class="banned"><a href="#ANNOTATION_KEGGko">KEGG KO</a></li>
									<li class="banned"><a href="#ANNOTATION_Pathway">Pathway</a></li>
									<li class="banned"><a href="#ANNOTATION_Brite">Brite</a></li>
								</ul>
				</li>
				<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Enzyme<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#Enzyme_id">ID</a></li>
									<li class="banned"><a href="#Enzyme_Brenda">BRENDA</a></li>
								</ul>
				</li>
				<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">KEGG enzyme<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#KEGGenzyme_id">ID</a></li>
									<li class="banned"><a href="#KEGGenzyme_Comment">Comment</a></li>
									<li class="banned"><a href="#KEGGenzyme_Reference">Reference</a></li>
								</ul>
				</li>
				<li class="dropdown-x">
								<a class="dropdown-x-toggle" href="javascript:void(0)">Interaction<i class="iconfont pull-right">&#xe62d;</i></a>
								<ul class="dropdown-x-menu">
									<li class="banned"><a href="#cy">STRING</a></li>
									<li class="banned"><a href="#Interaction_Biogrid">BioGRID</a></li>
								</ul>
				</li>
				@endif	
							<li id="Download_nav">
								<a href="#Download">Download</a>
							</li>
						</ul>
					</div> 


@stop

@section('content')
<div class="main-page container">
			<div class="row">
				<div class="main-content col-sm-10 col-sm-offset-2 col-xs-12">
					<div class="igem-part">
						 <h2><strong>{{$igemid}}</strong></h2>
						 <div class="clearfix part-name-Igem part-name"  id="Igem_id">
							<div class="part-line"></div>
							<div  ><span >iGEM</span></div>
							<div class=" part-line"></div>
						 </div>
						 <div class="info">
							 <ul>
								<li><div class="text-right">Part name</div><p>{{$igemid}}</p></li>
								<!--<li><div class="text-right">Key words</div><p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p></li>-->
								<li><div class="text-right">Description</div><p>{{$igem[0]->description}}</p></li>
								<li><div class="text-right">Use</div><p>{{$igem[0]->uses}}</p></li>
							</ul>
						 </div>
						 
						 <h4 id="Igem_Information"><strong>Information</strong></h4>
						 <h5>Main</h5>
						 <div class="table-responsive info-tab Main">
							 <table class="table table-bordered">
								 <tbody>
									<tr>
										<th >Part Type</th>
										<td >{{$igem[0]->part_type}}</td>
									</tr>
									<tr>
										<th>Nickname</th>
										<td>{{$igem[0]->nickname}}</td>
									</tr>
									<tr>
										<th>Designer(s)</th>
										<td>{{$igem[0]->author}}</td>
									</tr>

									<tr>
										<th>DNA Status</th>
										<td>{{$igem[0]->status}}</td>
									</tr>

									<tr>
										<th>Qualitative Experience</th>
										<td>{{$igem[0]->works}}</td>
									</tr>
									<tr>
										<th>Group Favorite</th>
										<td>Skip</td>
									</tr>
									<tr>
										<th>Star Rating</th>
										<td>{{$igem[0]->rating}}</td>
									</tr>
									<tr>
										<th>Delete This Part</th>
										<td>Skip</td>
									</tr>
									</tbody>
							 </table>
						 </div>
						 @if($Igem_pa->isNotempty())
						 <h5>Parameters</h5>
						 <div class="table-responsive info-tab Parameters">
							
							 <table  class="table  table-bordered">
								 <tbody>
									@foreach($Igem_pa as $value)
									<tr>
										<th>{{$value->name}}</th>
										<td>{{$value->value}}</td>
									</tr>
									@endforeach
									</tbody>
							 </table>
						 </div>
						 @endif
						 @if(!empty($catalog_array))
						 <div class="Catalog clearfix">
							 <h5>Catalog</h5>
							 @foreach($catalog_array as $value)
							 @if($value!=NULL)
							 <div class="text-block text-center col-md-3">
								 <div>{{$value}}</div>
							 </div>
							 @endif
							 @endforeach
						 </div>
						 @endif
						 <h4 id="Igem_Design"><strong>Design</strong></h4>
						 <div class="info">
							 <ul>
								<li><div class="text-right">Designed by</div><p>{{$igem[0]->author}}</p></li>
								@if($Igem_group->isNotempty())
								@if($Igem_group[0]->gr)
								<li><div class="text-right">Submit team</div>
								<p>
									@if($Igem_group[0]->flag==0)
									{{$Igem_group[0]->gr}}
									@elseif($Igem_group[0]->flag==1)
									@php
									$submit_array=explode("_",$Igem_group[0]->gr)
									@endphp
									<a href="http://{{$submit_array[0]}}.igem.org/Team:{{$submit_array[1]}}" target="blank">{{$Igem_group[0]->gr}}</a>
									@endif
								</p></li>
								@endif
								@endif
							 </ul>
						 </div>
						 <div class="table-responsive Design">
							 @if($igem[0]->notes)
							 <h5>Design notes</h5>
							 <p>{{$igem[0]->notes}}</p>
							 @endif
							 @if($igem[0]->source)
							 <h5>Source</h5>
							 <p>{{$igem[0]->source}}</p>
							 @endif
						</div>
							
						<h4 id="Igem_Relatedparts"><strong>Related parts</strong></h4>
						<div class="Related clearfix"> 
							<div class="text-block text-center col-md-3 ">
								<div><a href="http://parts.igem.org/cgi/partsdb/related.cgi?part={{$igemid}}" target="blank">Related parts</a></div>
							</div>
							@if($team==NULL)
							<div class="text-block text-center col-md-3 ">
								<div>No other parts by the team</div>
							</div>
							@else
							<div class="text-block text-center col-md-3 ">
								<div><a class="dialog_open" href="#other_p">Other parts by the team</a></div>
							</div>
							@endif
							@if($tw_num==0)
							<div class="text-block text-center col-md-3 ">
								<div>This part has no twins</div>
							</div>
							@else
							<div class="text-block text-center col-md-3 ">
								<div><a class="dialog_open" href="#twins">This part has {{$tw_num}} twins</a></div>
							</div>
							@endif
						</div>
						@if($team!=NULL)
						<div id="other_p">
							<div class="mask"></div>
							<div class="dialog dialog_position_center">
								<div class="header">
								<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h3 class="modal-title">The table</h3>
								</div>
								<div class="table-responsive info-tab Crossreference div-head">
									<table  class="table  table-bordered head-type">
									<thead>
										<tr>
											<th>Team</th>
											<th>iGEM ID</th>
										</tr>
									</thead>
										<tbody>
											@foreach($other_ids as $value)
											<tr>
												<td>{{$team}}</td>
												<td>{{$value->igemid}}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						@endif
						@if($tw_num!=0)
						<div id="twins">
							<div class="mask"></div>
							<div class="dialog dialog_position_center">
								<div class="header">
								<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h3 class="modal-title">The table</h3>
								</div>
								<div class="table-responsive info-tab Crossreference div-head">
									<table  class="table  table-bordered head-type">
									<thead>
										<tr>
											<th>iGEM ID</th>
											<th>twins</th>
										</tr>
									</thead>
										<tbody>
											@foreach($tw_array as $value)
												<tr>
													<td>{{$igemid}}</td>
													<td>{{$value}}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						@endif
						@if($parts_features->isNotempty()) 
						<h4 id="Igem_Feature"><strong>Feature</strong></h4>
						<div class="table-responsive info-tab Igem_feature div-head text-scroll">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>ID</th>
										 <th>Type</th>
										 <th>Label</th>
										 <th>Start</th>
										 <th>End</th>
										 <th>Direction</th>
									</tr>
								</thead>
								<tbody>
									@foreach($parts_features as $feature )
									<tr>
										<td>{{$feature->feature_id}}</td>
										<td>{{$feature->feature_type}}</td>
										<td>{{$feature->label}}</td>
										<td>{{$feature->start_pos}}</td>
										<td>{{$feature->end_pos}}</td>
										@if($feature->reverse==1)
										<td>Rev</td>
										@else
										<td>Fwd</td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
		<div id="sbol-detail" style="margin-top:20px">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="javascript:void(0)" onclick="nomalStyle()">type1</a></li>	
			<li ><a data-toggle="tab" href="javascript:void(0)" onclick="specialStyle()">type2</a></li>
		</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="Igem_sbol_pub-1">
								<h5 id="totalName">Part name: </h5>
								<div id="gridDemo-down"></div>
								<div id = "toolSavePart"></div>
							</div>
						</div>
						<div class="clearfix">
							<!--<div class="text-block text-center col-md-3 ">-->
							<!--	<div><a href="javascript:void(0)" onclick = "downloadTheCapture()" >download as png</a></div>-->
							<!--</div>-->
							<div class="text-block text-center col-md-3 ">
								<div><a href="javascript:void(0)" onclick = "fasta()">download as fasta</a></div>
							</div>
							<div class="text-block text-center col-md-3 ">
								<div><a href="javascript:void(0)" onclick = "genBankSequence()">download as GenBank</a></div>
							</div>
						</div>
		<script type="text/javascript">	
			var part = @json($sbol_part); 
			var features = @json($sbol_features);
		
			var memberId =1200;//给新添加的部件
			var getMemberId =0;//初始化相当于
		
			var nameArray = new Array();
			var featureArray = new Array();
			var siteStartArray = new Array();
			var siteEndArray = new Array();
			var sequenceDirection = new Array();
			var totalNameTry = "";
				descriptionForFasta = part[0].short_desc
				sequenceTotal = part[0].sequence
				totalNameTry  = part[0].part_name;
				totalDefinition = part[0].short_desc;  //或者.short_desc
				dateToday = part[0].creation_date;
		
				for(var i=0; i< features.length; i++){//features是ZYN自定义的一个变量
					if(features[i].feature_type){
						featureArray[i] = features[i].feature_type;
						if(features[i].label){
							nameArray[i] = features[i].label;
						}else{
							nameArray[i] = features[i].feature_type;
						}
						siteStartArray[i] = features[i].start_pos;
						siteEndArray[i] =  features[i].end_pos;
						if(features[i].reverse){
							sequenceDirection[i] = features[i].reverse;
						}else{
							sequenceDirection[i] = 0;
						}
				
					}
				}
		</script>
						</div>
						 	@endif
						 
						 <h4 id="Igem_Sequence"><strong>Sequence</strong></h4>
						 <div class="Sequence clearfix"> 
							
							 <div class="text-block text-center col-md-3 ">
								 <div><a href="http://beta.labgeni.us/registries/parts_registry/?part={{$igemid}}" target="blank">View plasmid</a></div>
							 </div>
							 <div class="text-block text-center col-md-3 ">
								 <div><a href="https://synbiohub.org/public/igem/{{$igemid}}/1" target="blank">SBOL format</a></div>
							 </div>
							 <div class="text-block text-center col-md-3 ">
								 <div><a href="http://parts.igem.org/cgi/partsdb/dna_info.cgi?part={{$igemid}}" target="blank">Length in plasmids</a></div>
							 </div>
						 </div>
						@if($igem[0]->sequence)
						<h5>Sequence</h5>
						 <div>
							<div>
								<span class="sequence-text">{{$igem[0]->sequence}}</span>
								<button type="button" class="modal-btn dialog_open hidden" href="#Igem_Sequence-m1">show all</button>
								<div id="Igem_Sequence-m1">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
								            <div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h3 class="modal-title">All sequence</h3>
											</div>
											<div style="max-height: 500px;overflow-y:auto;word-break:break-all">
												{{$igem[0]->sequence}}
											</div>
									</div>
								</div>
							</div>
						 </div>
						@endif
				@if($flag==1 && $igem_len>0)		
						<h4 id="Igem_Site"><strong>Site</strong></h4>
						@foreach($uniids as $value)
						<div style="height:40px;background:#ffdcd2;border:1px solid #ef882f;Position:relative;margin-top:10px">
							<ul style="list-style:none">
								<li><div style="width:{{($value->query_length)/$igem_len*100}}%;background:{{$color_array[($z%2)]}};height:100%;Position:absolute;margin-left:{{($value->query_start)/$igem_len*100}}%;text-align:center">{{$value->uniid}}</div></li>
							</ul>
						</div>
						@php
						$z++
						@endphp
						@endforeach
				@endif
			@if($flag==1)
						@if($uni->isNotempty())
						 <div class="clearfix part-name-Uniprot part-name"  id="Uniprot_id">
							<div class="part-line"></div>
							<div  ><span >UniProt</span></div>
							<div class="part-line"></div>	
						 </div>
						 <div class="info">
							 <ul>
								@foreach($unichars as $unichar=>$value)
								 		@if($uni[0]->$value)
								 		<li><div class="text-right">{{$unichar}}</div><p>{{$uni[0]->$value}}</p></li>
										@endif
								@endforeach
								@if($fullname[0]->fullname)
								<li><div class="text-right">Protein</div><p>{{$fullname[0]->fullname}}</p></li>
								@endif
								<li><div class="text-right">Uniprot page</div><p><a href="https://www.uniprot.org/uniprot/{{$uni[0]->uniid}}" target="view_window">www.uniprot.org/uniprot/{{$uni[0]->uniid}}</a></p></li>
							 </ul>
						 </div>
						 @endif
						 @if($uni_comments->isNotempty())
						 <h4 id="Uniprot_Function"><strong>Function</strong></h4>
						 <div>
							 @foreach($uni_comments as $uni_comment)
							 <h5>{{$uni_comment->type}}</h5>
							 <p>{{$uni_comment->text}}</p>
							 @endforeach
						 </div>
						 @endif
						 @if($uni_features->isNotempty())
						 <h4 id="Uniprot_Feature"><strong>Feature</strong></h4>
						 <h5>Protein _ feature description</h5>
						 <div class="table-responsive info-tab Protein_feature text-scroll div-head">	 
							 <table  class="table  table-bordered head-type">
								 <thead>
									 <tr>
										 <th>Feature key:Description</th>
										 <th>Position(s)</th>
										 <th>Graphical view</th>
										 <th>Length</th>
									 </tr>
								 </thead>
								 <tbody>
									 @foreach($uni_features as $feature)
									 <tr>
										 <td>{{$feature->type}}</td>
										 @if($feature->position==NULL)
										 <td>{{$feature->begin_position}}-{{$feature->end_position}}</td>
										 <td><div style="background-color:#ffdcd2;width: 180px;height: 20px;"><div style="background-color:#f27d5c;height: 100%;width: {{(($feature->end_position)-($feature->begin_position))/$seq_len*100}}%;margin-left: {{($feature->begin_position)/$seq_len*100}}%;"></div></div></td>
										 <td>{{($feature->end_position)-($feature->begin_position)}}</td>
										 @elseif($feature->position!=NULL)
										 <td>{{$feature->position}}</td>
										 <td><div style="background-color:#ffdcd2;width: 180px;height: 20px;"><div style="background-color:#f27d5c;height: 100%;width: 4px;margin-left: {{($feature->position)/$seq_len*100}}%;"></div></div></td>
										 <td>1</td>
										 @endif
										 
									 </tr>
									 @endforeach
									 
								 </tbody>
							 </table>
						 </div>
						 @endif
						 @if($uni_cross->isNotempty())
						 <h4 id="Uniprot_Crossreference"><strong>Cross reference</strong></h4>
						 <div class="table-responsive info-tab Crossreference text-scroll">
							 <table  class="table  table-bordered">
								<tbody>
									@foreach($uni_cross as $cross)
									<tr>
										<th >{{$cross->type}}</th>
										<td >{{$cross->dbid}}</td>
									</tr>
									@endforeach
								</tbody>
							 </table>
						 </div>
						 @endif
						 @if($uni->isNotempty())
						 <h4 id="Uniprot_Keywords"><strong>Keywords</strong></h4>
						 <div >
							<p>{{$uni[0]->keyword}}</p>
						 </div>
						 @endif
						 @if($uni_publications->isNotempty())
						 <h4 id="Uniprot_Publications"><strong>Publications</strong></h4>
						 <ul class="nav nav-tabs">
							 @foreach($uni_publications as $uni_publication)
								@if($i==0)
								<li class="active"><a data-toggle="tab" href="#pub-{{$i+1}}">{{$i+1}}</a></li>
									@php
									$i++
									@endphp
								@elseif($i!=0 && $i<=9)
								<li><a data-toggle="tab" href="#pub-{{$i+1}}">{{$i+1}}</a></li>
									@php
									$i++
									@endphp
								@endif
							 @endforeach
							 	<li><a data-toggle="tab" href="#pub-{{$i+1}}">Show more</a></li>
						 </ul>
						 <div class="tab-content">
							@foreach($uni_publications as $uni_publication)
								 @if($j==0)
								 	<div class="tab-pane active" id="pub-{{$j+1}}">	 
										<div>
												@if($uni_publication->title)
												<p class="font-weight:900">{{$uni_publication->title}}</p>
												@endif
												@if($uni_publication->person)
											 	<div>{{$uni_publication->person}}</div>
											 	@endif
											 	<div>{{$uni_publication->citation}}</div>
											 	<div>Cited for:{{$uni_publication->cited_for}}</div>
												@if($uni_publication->strain)
												<div>Strain:{{$uni_publication->strain}}</div>
												@endif
												@if($uni_publication->dbreference)
												<div>dbreference:{{$uni_publication->dbreference}}</div>
												@endif
										</div>
									</div>
									@php
									$j++
									@endphp
								 @elseif($j!=0 && $j<=9)
								 	<div class="tab-pane" id="pub-{{$j+1}}">
									 	<div>
												@if($uni_publication->title)
												<p class="font-weight:900">{{$uni_publication->title}}</p>
												@endif
												@if($uni_publication->person)
											 	<div>{{$uni_publication->person}}</div>
											 	@endif
											 	<div>{{$uni_publication->citation}}</div>
											 	<div>Cited for:{{$uni_publication->cited_for}}</div>
												@if($uni_publication->strain)
												<div>Strain:{{$uni_publication->strain}}</div>
												@endif
												@if($uni_publication->dbreference)
												<div>dbreference:{{$uni_publication->dbreference}}</div>
												@endif
										</div>
									</div>
									@php
									$j++
									@endphp
								 @endif
							@endforeach
							<div class="tab-pane" id="pub-{{$j+1}}"><div><p><a href="https://www.uniprot.org/uniprot/{{$uni[0]->uniid}}/publications" target="blank">https://www.uniprot.org/uniprot/{{$uniid}}/publications</a></p></div></div>
						 </div>
						 @endif
						 <!-- 改动！下面secquence加show more 按钮，样式基本同上 -->
						@if($uni->isNotempty())
						 <h4 id="Uniprot_Sequence"><strong>Sequence</strong></h4>
						 <h5>Sequence</h5>
						 <div>
							 
							 <span class="sequence-text">{{$uni[0]->sequence}}</span>
                             <button type="button" class="modal-btn dialog_open hidden" href="#Uniprot_Sequence-m1">show all</button>
                             <div id="Uniprot_Sequence-m1">
							 	<div class="mask"></div>
                                <div class="dialog dialog_position_center">
								 	<div class="header">
										<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">All sequence</h3>
									</div>
									<div style="max-height: 500px;overflow-y:auto;">
									{{$uni[0]->sequence}}
									</div>
								</div>
                             </div>
						 </div>
						@endif
						 
			    @if($kegg_flag==1)
						 <div class="clearfix part-name-KEGG part-name" id="KEGG_id">
							<div class="part-line"></div>
							<div  ><span >KEGG</span></div>
							<div class="part-line"></div>
						 </div>
						 <div class="info">
							 <ul>
								<li><div class="text-right">KEGG entry</div><p>{{$kegg1[0]->entry}}</p></li>
								@if($kegg1[0]->name!=NULL)
								<li><div class="text-right">Gene name</div><p>{{$kegg1[0]->name}}</p></li>
								@endif
								@if($kegg1[0]->orthology!=NULL)
								<li><div class="text-right">Definition KO</div><p>{{$kegg1[0]->orthology}}</p></li>
								@endif
								<li><div class="text-right">Organism</div><p><a href="{{$kegg1[0]->organism_url}}" target="blank">{{$kegg1[0]->organism_short}}</a>&nbsp;&nbsp;{{$kegg1[0]->organism_full}}</p></li>
								@if($kegg1[0]->position!=NULL)
								<li><div class="text-right">Genome map position</div><p>{{$kegg1[0]->position}}</p></li>
								 @endif
								 @if($kegg1[0]->position_url!=NULL)
								 <li><div class="text-right">Kegg gene positon</div><p><a href="{{$kegg1[0]->position_url}}" target="blank">{{$kegg1[0]->position_url}}</a></p></li>
								 @endif
								 <li><div class="text-right">Brite</div><p><a href="{{$kegg1[0]->brite_url}}" target="blank">{{$kegg1[0]->brite_url}}</a></p></li>
							</ul>
						 </div>
						 @if($kegg1[0]->pathway!=NULL)
						 <h4 id="KEGG_Pathway"><strong>Pathway</strong></h4>
						 <div class="table-responsive Pathway">
							 <p>{{$kegg1[0]->pathway}}</p>
						 </div>
						 @endif
						 @if($kegg1_module->isNotEmpty())
						 <h4 id="KEGG_Module"><strong>Module</strong></h4>
						 <div class="table-responsive Module">
							 <p><a href="{{$kegg1_module[0]->module_url}}" target="blank">{{$kegg1_module[0]->module_id}}&nbsp;&nbsp;{{$kegg1_module[0]->module}}</a></p>
						 </div>
						 @endif
						
						 <h4 id="KEGG_Crossreference"><strong>Cross reference</strong></h4>
						 <div class="table-responsive Crossreference">
							 <p>{{$kegg1[0]->dblinks}}</p>
						 </div>
						 
						 <h4 id="KEGG_Sequence"><strong>Sequence</strong></h4>
						 <ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#KEGG_Sequence_pub-1">aaseq</a></li>
							@if($kegg1[0]->ntseq!=NULL)
							<li><a data-toggle="tab" href="#KEGG_Sequence_pub-2">ntseq</a></li>
							@endif
						 </ul>
						 <div class="tab-content">
							 <div class="tab-pane active" id="KEGG_Sequence_pub-1"><div><p>aaseq</p><span class="sequence-text">{{$kegg1[0]->aaseq}}</span>
                                     <button type="button" href="#KEGG_Sequence_pub-m1" class="dialog_open modal-btn hidden">show all</button>
                                     <div id="KEGG_Sequence_pub-m1">
									 	<div class="mask"></div>
                                        <div class="dialog dialog_position_center">
											<div class="header">
												<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h3 class="modal-title">All sequence</h3>
											</div>
											<div style="max-height: 500px;overflow-y:auto;">
												{{$kegg1[0]->aaseq}}
											</div>
                                        </div>
                                     </div>
                                 </div></div>
							 @if($kegg1[0]->ntseq!=NULL)
							 <div class="tab-pane" id="KEGG_Sequence_pub-2"><div><p>ntseq</p><span class="sequence-text">{{$kegg1[0]->ntseq}}</span>
                                     <button type="button" href="#KEGG_Sequence_pub-m2" class="dialog_open modal-btn hidden">show all</button>
                                     <div id="KEGG_Sequence_pub-m2">
									 	<div class="mask"></div>
                                        <div class="dialog dialog_position_center">
											<div class="header">
												<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h3 class="modal-title">All sequence</h3>
											</div>
											<div style="max-height: 500px;overflow-y:auto;">
											{{$kegg1[0]->ntseq}}
											</div>
                                        </div>
                                     </div>
                                 </div></div>
							 @endif
						 </div>
						 @if($kegg1_reference->isNotEmpty())
						 <h4 id="KEGG_Reference"><strong>Reference</strong></h4>
						 <ul class="nav nav-tabs">
							@foreach($kegg1_reference as $kegg1_ref)
							 	@if($u==0)
							<li  class="active"><a data-toggle="tab" href="#KEGG_Reference_pub-{{$u+1}}">{{$u+1}}</a></li>
								@php
								$u++
								@endphp
								@elseif($u!=0)
							<li><a data-toggle="tab" href="#KEGG_Reference_pub-{{$u+1}}">{{$u+1}}</a></li>	 
								@php
								$u++
								@endphp
								@endif
							@endforeach
						</ul>
						 <div class="tab-content">
							 @foreach($kegg1_reference as $kegg1_ref)
							 	@if($v==0)
							<div class="tab-pane active" id="KEGG_Reference_pub-{{$v+1}}">
								<div>
									@foreach($kegg1_ref->toArray() as $key=>$value)
										@if($value)
											<p>{{$key}}</p>{{$value}}
										@endif
									@endforeach
								</div>
							</div>
								@php
								$v++
								@endphp
								@elseif($v!=0)
								<div class="tab-pane" id="KEGG_Reference_pub-{{$v+1}}">
								<div>
									@foreach($kegg1_ref->toArray() as $key=>$value)
										@if($value)
											<p>{{$key}}</p>{{$value}}
										@endif
									@endforeach
								</div>
							</div>
								@php
								$v++
								@endphp
								@endif
							@endforeach
						 </div>
						 @endif
				@endif	
					 
						<div class="clearfix part-name-ANNOTATION part-name">
							<div class="part-line"></div>
							<div  ><span>ANNOTATION</span></div>
							<div class="part-line"></div>
						</div>
					@if($Gos->isNotempty())	
						<h4 id="ANNOTATION_GO"><strong>GO</strong></h4>
						<div id="go" class="table-responsive info-tab ANNOTATION_GO div-head">
						@foreach($Gos as $Go)
							@if($p%5==1)
							@php
							$q=intdiv($p,5);
							$q=$q+1
							@endphp
							@if($q==1)
							<table  class="table table-bordered head-type showpage hidepage" style="word-wrap:initial;word-break: initial;" id="go_page{{$q}}">
							@else
							<table  class="table table-bordered head-type hidepage" style="word-wrap:initial;word-break: initial;" id="go_page{{$q}}">
							@endif	
								<thead>
									<tr>
										 <th>Gene Product</th>
										 <th>Symbol</th>
										 <th>Qualifier</th>
										 <th>GO Term</th>
										 <th>Evidence</th>
										 <th>Reference</th>
										 <th>With/From</th>
										 <th>Taxon</th>
										 <th>Assigned by</th>
									</tr>
								</thead>
								<tbody>
									@endif
									<tr>
										<td>{{$Go->gene_product}}</td>
										<td>{{$Go->symbol}}</td>
										<td>{{$Go->qualifier}}</td>
										<td><a href="{{$Go->go_term_l}}" target="blank">{{$Go->go_term}}</a></td>
										<td><a href="{{$Go->evidence_l}}" target="blank">{{$Go->evidence_code}}</a>--{{$Go->evidence}}</td>
										<td><a href="{{$Go->reference_l}}" target="blank">{{$Go->reference}}</a></td>
										<td>{{$Go->with_from}}</td>
										<td><a href="{{$Go->taxon_l}}" target="blank">{{$Go->taxon}}</a></td>
										<td>{{$Go->assigned_by}}</td>
									</tr>
								@if($p%5==0 || $p==$count)
							</tbody>
							</table>
							@endif
								@php
								$p++
								@endphp
							@endforeach
						</div>
						<!-- 分页 -->
						<div style="text-align: center;margin-top:10px;">
							<a href="javascript:void(0)" onclick="changepage(1,'go',{{$pages}})"><i class="iconfont" style="margin-right: -8px;">&#xe629;</i><i class="iconfont">&#xe629;</i>First</a>
							<a href="javascript:void(0)" onclick="changepage(2,'go',{{$pages}})"><i class="iconfont">&#xe629;</i>Prev</a>
							<span>Page</span>
							<input class="choice" type="text" style="width:50px;" value="1">
							<span>of {{$pages}}</span>
							<a href="javascript:void(0)" onclick="changepage(5,'go',{{$pages}})">Go</a>
							<a href="javascript:void(0)" onclick="changepage(3,'go',{{$pages}})">Next<i class="iconfont">&#xe628;</i></a>
							<a href="javascript:void(0)" onclick="changepage(4,'go',{{$pages}})">Last<i class="iconfont" style="margin-right: -8px;">&#xe628;</i><i class="iconfont">&#xe628;</i></a>
						</div>
						@endif
			@if($kegg_flag==1)
						@if($ko_flag==1)
						<h4 id="ANNOTATION_KEGGko"><strong>KEGG KO</strong></h4>
						<!-- <div class="text-part">Key ssr3451；key ssr5678</div> -->
						<div class="info">
							<ul>
								@if($kegg2->isNotempty())
								<li><div class="text-right">Entry</div><p>{{$kegg2[0]->entry}}</p></li>
								<li><div class="text-right">Name</div><p>{{$kegg2[0]->name}}</p></li>
								<li><div class="text-right">Definition</div><p>{{$kegg2[0]->definition}}</p></li>
								@endif
								@if($ecn)
								<li><div class="text-right">EC number</div><p>{{$ecn}}</p></li>
								@endif
							</ul>
						</div>
						@if($kegg2_pathways->isNotempty())
						<h4 id="ANNOTATION_Pathway"><strong>Pathway</strong></h4>
						<div class="text-part text-scroll">
							@foreach($kegg2_pathways as $pathway)
							<p><a href="{{$pathway->pathway_url}}" target="blank">{{$pathway->pathid}}</a>&nbsp;&nbsp;{{$pathway->pathway}}</p>
							@endforeach
						</div>
						@endif
						@if($kegg2->isNotempty())
						<h4 id="ANNOTATION_Brite"><strong>Brite</strong></h4>
						<div class="text-part text-scroll">
							@foreach($kegg2 as $brite)
							<p><a href="{{$brite->brite_url}}" target="blank">{{$brite->brite_url}}</a></p>
							@endforeach
						</div>
						@endif
						@endif
				@if($ec_flag==1)
						<div class="clearfix part-name-Enzyme part-name"  id="Enzyme_id">
							<div class="part-line"></div>
							<div  ><span >Enzyme</span></div>
							<div class="part-line"></div>
						</div>
						<div class="info">
							<ul>
								<li><div class="text-right">EC number</div><p>{{$ecn}}</p></li>
								@if($Recommendedname->isNotempty())
								<li><div class="text-right">Recommended name</div><p>{{$Recommendedname[0]->recommendedname}}</p></li>
								@endif
								@if($Reaction->isNotempty())
								<li><div class="text-right">Reaction</div>
								<p>
									@foreach($Reaction as $value)
									{{$value->reaction}}<br/>
									@endforeach
								</p></li>
								@endif
							</ul>
						</div>
						<h4 id="Enzyme_Brenda"><strong>BRENDA</strong></h4>
						<div class="text-center">
							<div class="organism-select dropdown-x clearfix">
								<div  class="org-text">the all organisms</div>
								<div class="dropdown-x-toggle org-btn" ><i class="iconfont">&#xe62d;</i></div>
								<ul class="dropdown-x-menu" style="max-height">
									<li><a href="javascript:void(0)">the all organisms</a></li>
									@foreach($organism as $value)
									@if($value)
									<li><a href="javascript:void(0)">{{$value}}</a></li>
									@endif
									@endforeach
								</ul>
							</div>
						</div>
						<h5>Basical Information</h5>
						<div class="table-responsive info-tab Enzyme_Basical_Information org-table1 div-head">
							<table  class="table table-bordered head-type">
								<thead>
									<tr>
										 <th>Part</th>
										 <th>Data</th>
										 <th>Commentary</th>
										 <th>Organism</th>
										 <th>Literature</th>
									</tr>
								</thead>
								<tbody>
									@if($Synonyms->isNotEmpty())
									<tr>
										<td>Synonyms<button type="button" href="#Enzyme_Basical_Information-m1" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Synonyms[0]->synonyms}}</td>
										<td>{{$Synonyms[0]->commentary}}</td>
										<td>{{$Synonyms[0]->organism}}</td>
										<td>{{$Synonyms[0]->literature}}</td>
									</tr>
									@endif
									@if($Temperatureoptimum->isNotEmpty())
									<tr>
										<td>Temperature optimum<button type="button" href="#Enzyme_Basical_Information-m2" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Temperatureoptimum[0]->temperatureoptimum}}</td>
										<td>{{$Temperatureoptimum[0]->commentary}}</td>
										<td>{{$Temperatureoptimum[0]->organism}}</td>
										<td>{{$Temperatureoptimum[0]->literature}}</td>
									</tr>
									@endif
									@if($Temperaturerange->isNotEmpty())
									<tr>
										<td>Temperature range<button type="button" href="#Enzyme_Basical_Information-m3" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Temperaturerange[0]->temperaturerange}}</td>
										<td>{{$Temperaturerange[0]->commentary}}</td>
										<td>{{$Temperaturerange[0]->organism}}</td>
										<td>{{$Temperaturerange[0]->literature}}</td>
									</tr>
									@endif
									@if($Temperaturestability->isNotEmpty())
									<tr>
										<td>Temperature-stability<button type="button" href="#Enzyme_Basical_Information-m4" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Temperaturestability[0]->temperaturestability}}</td>
										<td>{{$Temperaturestability[0]->commentary}}</td>
										<td>{{$Temperaturestability[0]->organism}}</td>
										<td>{{$Temperaturestability[0]->literature}}</td>
									</tr>
									@endif
									@if($Phoptimum->isNotEmpty())
                                    <tr>
										<td>PH optimum<button type="button" href="#Enzyme_Basical_Information-m5" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Phoptimum[0]->phoptimum}}</td>
										<td>{{$Phoptimum[0]->commentary}}</td>
										<td>{{$Phoptimum[0]->organism}}</td>
										<td>{{$Phoptimum[0]->literature}}</td>
									</tr>
									@endif
									@if($Phstability->isNotEmpty())
                                    <tr>
										<td>PH-stability<button type="button" href="#Enzyme_Basical_Information-m6" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Phstability[0]->phstability}}</td>
										<td>{{$Phstability[0]->commentary}}</td>
										<td>{{$Phstability[0]->organism}}</td>
										<td>{{$Phstability[0]->literature}}</td>
									</tr>
									@endif
									@if($Molecularweight->isNotEmpty())
                                    <tr>
										<td>Molecular weight<button type="button" href="#Enzyme_Basical_Information-m7" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Molecularweight[0]->molecularweight}}</td>
										<td>{{$Molecularweight[0]->commentary}}</td>
										<td>{{$Molecularweight[0]->organism}}</td>
										<td>{{$Molecularweight[0]->literature}}</td>
									</tr>
									@endif
									@if($Pivalue->isNotEmpty())
                                    <tr>
										<td>PI value<button type="button" href="#Enzyme_Basical_Information-m8" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Pivalue[0]->pivalue}}</td>
										<td>{{$Pivalue[0]->commentary}}</td>
										<td>{{$Pivalue[0]->organism}}</td>
										<td>{{$Pivalue[0]->literature}}</td>
									</tr>
									@endif
									@if($Engineering->isNotEmpty())
                                    <tr>
										<td>Engineering<button type="button" href="#Enzyme_Basical_Information-m9" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Engineering[0]->engineering}}</td>
										<td>{{$Engineering[0]->commentary}}</td>
										<td>{{$Engineering[0]->organism}}</td>
										<td>{{$Engineering[0]->literature}}</td>
									</tr>
									@endif
									@if($Application->isNotEmpty())
                                    <tr>
										<td>Application<button type="button" href="#Enzyme_Basical_Information-m10" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Application[0]->application}}</td>
										<td>{{$Application[0]->commentary}}</td>
										<td>{{$Application[0]->organism}}</td>
										<td>{{$Application[0]->literature}}</td>
									</tr>
									@endif
									@if($Specificactivity->isNotEmpty())
                                    <tr>
										<td>Special activity<button type="button" href="#Enzyme_Basical_Information-m11" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Specificactivity[0]->specificactivity}}</td>
										<td>{{$Specificactivity[0]->commentary}}</td>
										<td>{{$Specificactivity[0]->organism}}</td>
										<td>{{$Specificactivity[0]->literature}}</td>
									</tr>
									@endif
									@if($Sourcetissue->isNotEmpty())
                                    <tr>
										<td>Source tissue<button type="button" href="#Enzyme_Basical_Information-m12" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Sourcetissue[0]->sourcetissue}}</td>
										<td>{{$Sourcetissue[0]->commentary}}</td>
										<td>{{$Sourcetissue[0]->organism}}</td>
										<td>{{$Sourcetissue[0]->literature}}</td>
									</tr>
									@endif
								</tbody>
							</table>
							<div>
								@if($Synonyms->isNotEmpty())
								<div id="Enzyme_Basical_Information-m1">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
												<thead>
													<tr>
														<th>Data</th>
														<th>Commentary</th>
														<th>Organism</th>
														<th>Literature</th>
													</tr>
												</thead>
													<tbody>
														@foreach($Synonyms as $value)
														<tr>
															<td>{{$value->synonyms}}</td>
															<td>{{$value->commentary}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Temperatureoptimum->isNotEmpty())
								<div id="Enzyme_Basical_Information-m2">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
											<div class="header">
												<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h3 class="modal-title">The table</h3>
											</div>
											<div>
												<div class="table-responsive info-tab Crossreference div-head">
													<table  class="table  table-bordered head-type">
                                                    <thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
														<tbody>
															@foreach($Temperatureoptimum as $value)
															<tr>
                                                                <td>{{$value->temperatureoptimum}}</td>
                                                                <td>{{$value->commentary}}</td>
																<td>{{$value->organism}}</td>
																<td>{{$value->literature}}</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
									</div>
								</div>
								@endif
								@if($Temperaturerange->isNotEmpty())
								<div id="Enzyme_Basical_Information-m3">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
												<thead>
													<tr>
														<th>Data</th>
														<th>Commentary</th>
														<th>Organism</th>
														<th>Literature</th>
													</tr>
												</thead>
													<tbody>
														@foreach($Temperaturerange as $value)
														<tr>
															<td>{{$value->temperaturerange}}</td>
															<td>{{$value->commentary}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Temperaturestability->isNotEmpty())
								<div id="Enzyme_Basical_Information-m4">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
														@foreach($Temperaturestability as $value)
														<tr>
															<td>{{$value->temperaturestability}}</td>
															<td>{{$value->commentary}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Phoptimum->isNotEmpty())
								<div id="Enzyme_Basical_Information-m5">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
														@foreach($Phoptimum as $value)
														<tr>
															<td>{{$value->phoptimum}}</td>
															<td>{{$value->commentary}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Phstability->isNotEmpty())
								<div id="Enzyme_Basical_Information-m6">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
														@foreach($Phstability as $value)
														<tr>
															<td>{{$value->phstability}}</td>
															<td>{{$value->commentary}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Molecularweight->isNotEmpty())
								<div id="Enzyme_Basical_Information-m7">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
													@foreach($Molecularweight as $value)
															<tr>
                                                                <td>{{$value->molecularweight}}</td>
                                                                <td>{{$value->commentary}}</td>
																<td>{{$value->organism}}</td>
																<td>{{$value->literature}}</td>
															</tr>
															@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Pivalue->isNotEmpty())
								<div id="Enzyme_Basical_Information-m8">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
														@foreach($Pivalue as $value)
															<tr>
                                                                <td>{{$value->pivalue}}</td>
                                                                <td>{{$value->commentary}}</td>
																<td>{{$value->organism}}</td>
																<td>{{$value->literature}}</td>
															</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Engineering->isNotEmpty())
								<div id="Enzyme_Basical_Information-m9">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
															@foreach($Engineering as $value)
															<tr>
                                                                <td>{{$value->engineering}}</td>
                                                                <td>{{$value->commentary}}</td>
																<td>{{$value->organism}}</td>
																<td>{{$value->literature}}</td>
															</tr>
															@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Application->isNotEmpty())
								<div id="Enzyme_Basical_Information-m10">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
															@foreach($Application as $value)
															<tr>
                                                                <td>{{$value->application}}</td>
                                                                <td>{{$value->commentary}}</td>
																<td>{{$value->organism}}</td>
																<td>{{$value->literature}}</td>
															</tr>
															@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Specificactivity->isNotEmpty())
								<div id="Enzyme_Basical_Information-m11">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
															@foreach($Specificactivity as $value)
															<tr>
                                                                <td>{{$value->specificactivity}}</td>
                                                                <td>{{$value->commentary}}</td>
																<td>{{$value->organism}}</td>
																<td>{{$value->literature}}</td>
															</tr>
															@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
								@if($Sourcetissue->isNotEmpty())
								<div id="Enzyme_Basical_Information-m12">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<div class="header">
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">The table</h3>
										</div>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
													<thead>
                                                        <tr>
                                                            <th>Data</th>
															<th>Commentary</th>
															<th>Organism</th>
                                                            <th>Literature</th>
                                                        </tr>
								                    </thead>
													<tbody>
															@foreach($Sourcetissue as $value)
															<tr>
                                                                <td>{{$value->sourcetissue}}</td>
                                                                <td>{{$value->commentary}}</td>
																<td>{{$value->organism}}</td>
																<td>{{$value->literature}}</td>
															</tr>
															@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								@endif
							</div>
						</div>
						
						<h5>Experiment Information</h5>
						<div class="table-responsive info-tab Enzyme_Experiment_Information org-table1 div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										<th>Part</th>
										<th>Data/Commentary</th>
										<th>Organism</th>
										<th>Literature</th>
									</tr>
								</thead>
								<tbody>
									@if($Crystal->isNotEmpty())
									<tr>
										<td>Crystal<button type="button" href="#Enzyme_Experiment_Information-m1" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Crystal[0]->commentary}}</td>
										<td>{{$Crystal[0]->organism}}</td>
										<td>{{$Crystal[0]->literature}}</td>
									</tr>
									@endif
									@if($Purification->isNotEmpty())
									<tr>
										<td>Purification<button type="button" href="#Enzyme_Experiment_Information-m2" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Purification[0]->commentary}}</td>
										<td>{{$Purification[0]->organism}}</td>
										<td>{{$Purification[0]->literature}}</td>
									</tr>
									@endif
									@if($Storagestability->isNotEmpty())
									<tr>
										<td>Storage stability<button type="button" href="#Enzyme_Experiment_Information-m3" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Storagestability[0]->storagestability}}</td>
										<td>{{$Storagestability[0]->organism}}</td>
										<td>{{$Storagestability[0]->literature}}</td>
									</tr>
									@endif
									@if($Oxidationstability->isNotEmpty())
									<tr>
										<td>Oxidation stability<button type="button" href="#Enzyme_Experiment_Information-m4" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Oxidationstability[0]->oxidationstability}}</td>
										<td>{{$Oxidationstability[0]->organism}}</td>
										<td>{{$Oxidationstability[0]->literature}}</td>
									</tr>
									@endif
									@if($Organicsolventstability->isNotEmpty())
                                    <tr>
										<td>Organic solvent stability<button type="button" href="#Enzyme_Experiment_Information-m5" class="modal-btn dialog_open">the all table</button></td>
										<td>{{$Organicsolventstability[0]->organicsolvent}};{{$Organicsolventstability[0]->commentary}}</td>
										<td>{{$Organicsolventstability[0]->organism}}</td>
										<td>{{$Organicsolventstability[0]->literature}}</td>
									</tr>
									@endif
								</tbody>
							</table>
							<div>
							@if($Crystal->isNotEmpty())
								<div id="Enzyme_Experiment_Information-m1">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<header>
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">the table</h3>
										</header>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
												<thead>
													<tr>
														<th>Data/Commentary</th>
														<th>Organism</th>
														<th>Literature</th>
													</tr>
												</thead>
													<tbody>
														@foreach($Crystal as $value)
														<tr>
															<td>{{$value->commentary}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							@endif
							@if($Purification->isNotEmpty())
							<div id="Enzyme_Experiment_Information-m2">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<header>
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">the table</h3>
										</header>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
												<thead>
													<tr>
														<th>Data/Commentary</th>
														<th>Organism</th>
														<th>Literature</th>
													</tr>
												</thead>
													<tbody>
														@foreach($Purification as $value)
														<tr>
															<td>{{$value->commentary}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							@endif
							@if($Storagestability->isNotEmpty())
							<div id="Enzyme_Experiment_Information-m3">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<header>
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">the table</h3>
										</header>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
												<thead>
													<tr>
														<th>Data/Commentary</th>
														<th>Organism</th>
														<th>Literature</th>
													</tr>
												</thead>
													<tbody>
														@foreach($Storagestability as $value)
														<tr>
															<td>{{$value->storagestability}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							@endif
							@if($Oxidationstability->isNotEmpty())
							<div id="Enzyme_Experiment_Information-m4">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<header>
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">the table</h3>
										</header>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
												<thead>
													<tr>
														<th>Data/Commentary</th>
														<th>Organism</th>
														<th>Literature</th>
													</tr>
												</thead>
													<tbody>
														@foreach($Oxidationstability as $value)
														<tr>
															<td>{{$value->oxidationstability}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							@endif
							@if($Organicsolventstability->isNotEmpty())
							<div id="Enzyme_Experiment_Information-m5">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
										<header>
											<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											<h3 class="modal-title">the table</h3>
										</header>
										<div>
											<div class="table-responsive info-tab Crossreference div-head">
												<table  class="table  table-bordered head-type">
												<thead>
													<tr>
														<th>Data</th>
														<th>Commentary</th>
														<th>Organism</th>
														<th>Literature</th>
													</tr>
												</thead>
													<tbody>
														@foreach($Organicsolventstability as $value)
														<tr>
															<td>{{$value->organicsolvent}}</td>
															<td>{{$value->commentary}}</td>
															<td>{{$value->organism}}</td>
															<td>{{$value->literature}}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							@endif
							</div>
						</div>
						
					@if($Localization->isNotEmpty())
						<h5>Localization</h5>
						<div class="table-responsive info-tab text-scroll org-table2 div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>Localization</th>
										 <th>Commentary</th>
										 <th>Organism</th>
										 <th>Idgo</th>
										 <th>Literature</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Localization as $value)
									<tr>
										<td>{{$value->localization}}</td>
										<td>{{$value->commentary}}</td>
										<td>{{$value->organism}}</td>
										<td>{{$value->idgo}}</td>
										<td>{{$value->literature}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif

					@if($Kmvalue->isNotEmpty())
						<h5>KM value</h5>
						<div class="table-responsive info-tab text-scroll org-table2 div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>KM value</th>
										 <th>Substrate</th>
										 <th>Commentary</th>
										 <th>Organism</th>
										 <th>Ligandstructure ID</th>
										 <th>Literature</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Kmvalue as $value)
									<tr>
										<td>{{$value->kmvalue}}</td>
										<td>{{$value->substrate}}</td>
										<td>{{$value->commentary}}</td>
										<td>{{$value->organism}}</td>
										<td>{{$value->ligandstructureId}}</td>
										<td>{{$value->literature}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif

					@if($Metalsions->isNotEmpty())
						<h5>Metalsions</h5>
						<div class="table-responsive info-tab text-scroll org-table2 div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>Metalsions</th>
										 <th>Commentary</th>
										 <th>Organism</th>
										 <th>Ligandstructure ID</th>
										 <th>Literature</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Metalsions as $value)
									<tr>
										<td>{{$value->metalsIons}}</td>
										<td>{{$value->commentary}}</td>
										<td>{{$value->organism}}</td>
										<td>{{$value->ligandstructureid}}</td>
										<td>{{$value->literature}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif

					@if($Ic50value->isNotEmpty())
						<h5>IC50 value</h5>
						<div class="table-responsive info-tab text-scroll org-table2 div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>IC50 Value</th>
										 <th>Inhibitor</th>
										 <th>Organism</th>
										 <th>Commentary</th>
										 <th>Literature</th>
									</tr>
								</thead>
								<tbody>
								@foreach($Ic50value as $value)
									<tr>
										<td>{{$value->ic50value}}</td>
										<td>{{$value->inhibitor}}</td>
										<td>{{$value->organism}}</td>
										<td>{{$value->commentary}}</td>
										<td>{{$value->literature}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					@endif

					@if($Pathway->isNotEmpty())
						<h5>Pathway</h5>
						<div class="table-responsive info-tab text-scroll div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>Pathway</th>
										 <th>BRENDA Link</th>
										 <th>KEGG Link</th>
										 <th>MetaCyc Link</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Pathway as $value)
									<tr>
										<td>{{$value->pathway}}</td>
										@if($value->source_database=='MetaCyc')
										<td>-</td>
										<td>-</td>
										<td>{{$value->link}}</td>
										@elseif($value->source_database=='BRENDA')
										<td>{{$value->link}}</td>
										<td>-</td>
										<td>-</td>
										@elseif($value->source_database=='KEGG')
										<td>-</td>
										<td>{{$value->link}}</td>
										<td>-</td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif

					@if($Inhibitors->isNotEmpty())
						<h5>Inhibitors</h5>
						<div class="table-responsive info-tab text-scroll org-table2 div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>Inhibitor</th>
										 <th>Commentary</th>
										 <th>Organism</th>
										 <th>Literature</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Inhibitors as $value)
									<tr>
										<td>{{$value->inhibitor}}</td>
										<td>{{$value->commentary}}</td>
										<td>{{$value->organism}}</td>
										<td>{{$value->literature}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif

					@if($Substratesproducts->isNotEmpty())
						<h5>Substrate/product</h5>
						<div class="table-responsive info-tab text-scroll org-table2 div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>Substrate</th>
										 <th>Product</th>
										 <th>Commentary(Substrate)</th>
										 <th>Literature(Substrate)</th>
										 <th>Organism(Substrate)</th>
										 <th>Commentary(Product)</th>
										 <th>Literature(Product)</th>
										 <th>Organism(Product)</th>
										 <th>Reversibility</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Substratesproducts as $value)
									<tr>
										<td>{{$value->substrates}}</td>
										<td>{{$value->products}}</td>
										<td>{{$value->commentarysubstrates}}</td>
										<td>{{$value->literaturesubstrates}}</td>
										<td>{{$value->organismsubstrates}}</td>
										<td>{{$value->commentaryproducts}}</td>
										<td>{{$value->literatureproducts}}</td>
										<td>{{$value->organismproducts}}</td>
										<td>{{$value->reversibility}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif
						<h5>Reference</h5>
						<ul class="nav nav-tabs">
							@foreach($References as $Reference)
							@if($x==0)
							<li class="active"><a data-toggle="tab" href="#Enzyme_Brenda_Reference_pub-{{$x+1}}">{{$x+1}}</a></li>
								@php
								$x++
								@endphp
							@elseif($x!=0 && $x<=9)
							<li><a data-toggle="tab" href="#Enzyme_Brenda_Reference_pub-{{$x+1}}">{{$x+1}}</a></li>
								@php
								$x++
								@endphp
							@endif
						@endforeach
						<li><a data-toggle="tab" href="#Enzyme_Brenda_Reference_pub-{{$x+1}}">Show more</a></li>
						</ul>
						<div class="tab-content">
							@foreach($References as $Reference)
							@if($y==0)
							<div class="tab-pane active" id="Enzyme_Brenda_Reference_pub-{{$y+1}}">
								<div>
									@if($Reference->title)
									<p>{{$Reference->title}}</p>
									@endif
									@if($Reference->authors)
									<div>{{$Reference->authors}}</div>
									@endif
									@if($Reference->pubmedId)
									<div>PMID:{{$Reference->pubmedId}}</div>
									@endif
									@if($Reference->ecnumber)
									<div>EC Number:{{$Reference->ecnumber}}</div>
									@endif
									@if($Reference->reference)
									<div>Reference:{{$Reference->reference}}</div>
									@endif
									@if($Reference->journal)
									<div>Journal:{{$Reference->journal}}</div>
									@endif
									@if($Reference->volume)
									<div>Volume:{{$Reference->volume}}</div>
									@endif
									@if($Reference->pages)
									<div>Pages:{{$Reference->pages}}</div>
									@endif
									@if($Reference->year)
									<div>Year:{{$Reference->year}}</div>
									@endif
									@if($Reference->organism)
									<div>Organism:{{$Reference->organism}}</div>
									@endif
									@if($Reference->commentary)
									<div>Commentary:{{$Reference->commentary}}</div>
									@endif
								</div>
							</div>
								@php
								$y++
								@endphp
							@elseif($y!=0 && $y<=9)
							<div class="tab-pane" id="Enzyme_Brenda_Reference_pub-{{$y+1}}">
								<div>
									@if($Reference->title)
									<p>{{$Reference->title}}</p>
									@endif
									@if($Reference->authors)
									<div>{{$Reference->authors}}</div>
									@endif
									@if($Reference->pubmedId)
									<div>PMID:{{$Reference->pubmedId}}</div>
									@endif
									@if($Reference->ecnumber)
									<div>EC Number:{{$Reference->ecnumber}}</div>
									@endif
									@if($Reference->reference)
									<div>Reference:{{$Reference->reference}}</div>
									@endif
									@if($Reference->journal)
									<div>Journal:{{$Reference->journal}}</div>
									@endif
									@if($Reference->volume)
									<div>Volume:{{$Reference->volume}}</div>
									@endif
									@if($Reference->pages)
									<div>Pages:{{$Reference->pages}}</div>
									@endif
									@if($Reference->year)
									<div>Year:{{$Reference->year}}</div>
									@endif
									@if($Reference->organism)
									<div>Organism:{{$Reference->organism}}</div>
									@endif
									@if($Reference->commentary)
									<div>Commentary:{{$Reference->commentary}}</div>
									@endif
								</div>
							</div>
								@php
								$y++
								@endphp
							@endif
						@endforeach
							<div class="tab-pane"id="Enzyme_Brenda_Reference_pub-{{$x+1}}"><div><p><a href="https://www.brenda-enzymes.info/enzyme.php?ecno={{$ecn}}&onlyTable=Reference" target="blank">https://www.brenda-enzymes.info/enzyme.php?ecno={{$ecn}}&onlyTable=Reference</a></p></div></div>
						</div>
						
						<div class="clearfix part-name-KEGGenzyme part-name" id="KEGGenzyme_id">
							<div class="part-line"></div>
							<div><span>KEGG enzyme</span></div>
							<div class="part-line"></div>
						</div>
						@if($kegg3!=NULL)
						<div class="info">
							<ul>
								<li><div class="text-right">name</div><p>{{$kegg3[0]->ecnumber}}</p></li>
								<li><div class="text-right">class</div><p><a href="{{$kegg3[0]->class_url}}" target="blank">{{$kegg3[0]->class}}</a></p></li>
							</ul>
						</div>
						<h5>Reaction IUBMB</h5>
						<div class="text-part" style="border-color: #666;">
							<p>{{$kegg3[0]->reaction}}</p>
						</div>
						@if($kegg3[0]->all_reac)
						<h5>Reaction KEGG</h5>
						<div class="text-part" style="border-color: #666;">
							<p>{{$kegg3[0]->all_reac}}
									<a href="{{$kegg3[0]->all_reac_url}}" target="blank" style="text-decoration:none;background:white;color: #f27d5c;border: #f27d5c 1px solid;border-radius: 20px;padding: 0 5px 0 7px;">show more</a>
							</p>
						</div>
						@endif
						@endif
						@if($kegg3_pathways!=NULL)
						<h5>Pathway</h5>
						<div class="text-part" style="border-color: #666;">
						@foreach($kegg3_pathways as $pathway)	
						<p><a href="{{$pathway->pathway_url}}" target="blank">{{$pathway->pathid}}</a>&nbsp;&nbsp;{{$pathway->pathway}}</p>
						@endforeach
						</div>	
						@endif
						@if($kegg3!=NULL)
						<h5>Orthology</h5>
						<div class="text-part" style="border-color: #666;">
							<p>{{$kegg3[0]->orthology}}</p>
						</div>
						@if($kegg3[0]->comment)
						<h4 id="KEGGenzyme_Comment"><strong>Comment</strong></h4>
						<h5>KEGG Comment</h5>
						<div class="text-part" style="margin-bottom: 35px;">{{$kegg3[0]->comment}}</div>
						@endif
						@endif
						@if($kegg3_references!=NULL)
						<h4 id="KEGGenzyme_Reference"><strong>Reference</strong></h4>

						<h5>KEGG reference</h5>
						<ul class="nav nav-tabs">
							 @foreach($kegg3_references as $kegg3_reference)
								@if($m==0)
								<li class="active"><a data-toggle="tab" href="#KEGGenzyme_Reference_KEGG-reference_pub-{{$m+1}}">{{$m+1}}</a></li>
									@php
									$m++
									@endphp
								@elseif($m!=0 && $m<=9)
								<li><a data-toggle="tab" href="#KEGGenzyme_Reference_KEGG-reference_pub-{{$m+1}}">{{$m+1}}</a></li>
									@php
									$m++
									@endphp
								@endif
							 @endforeach
						 </ul>
						 <div class="tab-content">
							@foreach($kegg3_references as $kegg3_reference)
								 @if($n==0)
								 	<div class="tab-pane active" id="KEGGenzyme_Reference_KEGG-reference_pub-{{$n+1}}">	 
										<div>
											@if($kegg3_reference->title)
											<p>{{$kegg3_reference->title}}</p>
											@endif
											<div>{{$kegg3_reference->authors}}</div>
											@if($kegg3_reference->journal)
											<div>journal:{{$kegg3_reference->journal}}</div>
											@endif
											<div>ID:{{$kegg3_reference->kke}}</div>
											@if($kegg3_reference->reference!="" && $kegg3_reference->reference!="1")
											<div>reference:{{$kegg3_reference->reference}}</div>
											@endif
										</div>
									</div>
									@php
									$n++
									@endphp
								 @elseif($n!=0 &&$n<=9)
								 	<div class="tab-pane" id="KEGGenzyme_Reference_KEGG-reference_pub-{{$n+1}}">
									 	<div>
											@if($kegg3_reference->title)
											<p>{{$kegg3_reference->title}}</p>
											@endif
											<div>{{$kegg3_reference->authors}}</div>
											@if($kegg3_reference->journal)
											<div>journal:{{$kegg3_reference->journal}}</div>
											@endif
											<div>ID:{{$kegg3_reference->kke}}</div>
											@if($kegg3_reference->reference!="" && $kegg3_reference->reference!="1")
											<div>reference:{{$kegg3_reference->reference}}</div>
											@endif
										</div>
									</div>
									@php
									$n++
									@endphp
								 @endif
							@endforeach
						</div>
						@endif
						@if(!empty($Refs))
						<h5>ExplorEnz reference</h5>
						<ul class="nav nav-tabs">
							@foreach($Refs as $Ref)
							@if($a==0)
							<li class="active"><a data-toggle="tab" href="#KEGGenzyme_Reference_ExplorEnz-reference_pub-{{$a+1}}">{{$a+1}}</a></li>
								@php
								$a++
								@endphp
							@elseif($a!=0 && $a<=9)
							<li><a data-toggle="tab" href="#KEGGenzyme_Reference_ExplorEnz-reference_pub-{{$a+1}}">{{$a+1}}</a></li>
								@php
								$a++
								@endphp
							@endif
						@endforeach
							<li><a data-toggle="tab" href="#KEGGenzyme_Reference_ExplorEnz-reference_pub-{{$a+1}}">Show more</a></li>
						</ul>
						<div class="tab-content">
							@foreach($Refs as $Ref)
							@if($b==0)
							<div class="tab-pane active" id="KEGGenzyme_Reference_ExplorEnz-reference_pub-{{$b+1}}">
								<div>
									@if($Ref[0]->title)
									<p>{{$Ref[0]->title}}</p>
									@endif
									@if($Ref[0]->author)
									<div>{{$Ref[0]->author}}</div>
									@endif
									@if($Ref[0]->pubmed_id)
									<div>PMID:{{$Ref[0]->pubmed_id}}</div>
									@endif
									<div>Cite key:{{$Ref[0]->cite_key}}</div>
									<div>Type:{{$Ref[0]->type}}</div>
									@if($Ref[0]->language)
									<div>Language:{{$Ref[0]->language}}</div>
									@endif
									@if($Ref[0]->journal)
									<div>Journal:{{$Ref[0]->journal}}</div>
									@endif
									@if($Ref[0]->volume)
									<div>Volume:{{$Ref[0]->volume}}</div>
									@endif
									<div>Year:{{$Ref[0]->year}}</div>
									@if($Ref[0]->first_page)
									<div>First page:{{$Ref[0]->first_page}}</div>
									@endif
									@if($Ref[0]->last_page)
									<div>Last page:{{$Ref[0]->last_page}}</div>
									@endif
									@if($Ref[0]->booktitle)
									<div>Book title:{{$Ref[0]->booktitle}}</div>
									@endif
									@if($Ref[0]->editor)
									<div>Editor:{{$Ref[0]->editor}}</div>
									@endif
									@if($Ref[0]->edition)
									<div>Edition:{{$Ref[0]->edition}}</div>
									@endif
									@if($Ref[0]->publisher)
									<div>Publisher:{{$Ref[0]->publisher}}</div>
									@endif
									@if($Ref[0]->address)
									<div>Address:{{$Ref[0]->address}}</div>
									@endif
									@if($Ref[0]->erratum)
									<div>Erratum:{{$Ref[0]->erratum}}</div>
									@endif
									@if($Ref[0]->entry_title)
									<div>Entry title:{{$Ref[0]->entry_title}}</div>
									@endif
									@if($Ref[0]->patent_yr)
									<div>Patent yr:{{$Ref[0]->patent_yr}}</div>
									@endif
									@if($Ref[0]->link)
									<div>Link:{{$Ref[0]->link}}</div>
									@endif
									@if($Ref[0]->doi)
									<div>Doi:{{$Ref[0]->doi}}</div>
									@endif
									@if($Ref[0]->last_change)
									<div>Last change:{{$Ref[0]->last_change}}</div>
									@endif
								</div>
							</div>
								@php
								$b++
								@endphp
							@elseif($b!=0 && $b<=9)
							<div class="tab-pane" id="KEGGenzyme_Reference_ExplorEnz-reference_pub-{{$b+1}}">
								<div>
									@if($Ref[0]->title)
									<p>{{$Ref[0]->title}}</p>
									@endif
									@if($Ref[0]->author)
									<div>{{$Ref[0]->author}}</div>
									@endif
									@if($Ref[0]->pubmed_id)
									<div>PMID:{{$Ref[0]->pubmed_id}}</div>
									@endif
									<div>Cite key:{{$Ref[0]->cite_key}}</div>
									<div>Type:{{$Ref[0]->type}}</div>
									@if($Ref[0]->language)
									<div>Language:{{$Ref[0]->language}}</div>
									@endif
									@if($Ref[0]->journal)
									<div>Journal:{{$Ref[0]->journal}}</div>
									@endif
									@if($Ref[0]->volume)
									<div>Volume:{{$Ref[0]->volume}}</div>
									@endif
									<div>Year:{{$Ref[0]->year}}</div>
									@if($Ref[0]->first_page)
									<div>First page:{{$Ref[0]->first_page}}</div>
									@endif
									@if($Ref[0]->last_page)
									<div>Last page:{{$Ref[0]->last_page}}</div>
									@endif
									@if($Ref[0]->booktitle)
									<div>Book title:{{$Ref[0]->booktitle}}</div>
									@endif
									@if($Ref[0]->editor)
									<div>Editor:{{$Ref[0]->editor}}</div>
									@endif
									@if($Ref[0]->edition)
									<div>Edition:{{$Ref[0]->edition}}</div>
									@endif
									@if($Ref[0]->publisher)
									<div>Publisher:{{$Ref[0]->publisher}}</div>
									@endif
									@if($Ref[0]->address)
									<div>Address:{{$Ref[0]->address}}</div>
									@endif
									@if($Ref[0]->erratum)
									<div>Erratum:{{$Ref[0]->erratum}}</div>
									@endif
									@if($Ref[0]->entry_title)
									<div>Entry title:{{$Ref[0]->entry_title}}</div>
									@endif
									@if($Ref[0]->patent_yr)
									<div>Patent yr:{{$Ref[0]->patent_yr}}</div>
									@endif
									@if($Ref[0]->link)
									<div>Link:{{$Ref[0]->link}}</div>
									@endif
									@if($Ref[0]->doi)
									<div>Doi:{{$Ref[0]->doi}}</div>
									@endif
									@if($Ref[0]->last_change)
									<div>Last change:{{$Ref[0]->last_change}}</div>
									@endif
								</div>
							</div>
								@php
								$b++
								@endphp
							@endif
						@endforeach
							<div class="tab-pane"id="KEGGenzyme_Reference_ExplorEnz-reference_pub-{{$b+1}}"><div><p><a href="https://www.enzyme-database.org/query.php?ec=EC+{{$ecn}}" target="blank">https://www.enzyme-database.org/query.php?ec=EC+{{$ecn}}</a></p></div></div>
						</div>
							@endif
						@endif
				@endif
						@if($str_flag==1)
						<div class="clearfix part-name-Interaction part-name">
							<div class="part-line"></div>
							<div ><span>Interaction</span></div>
							<div class="part-line"></div>
						</div>
						
						<div class="box" style="background:white;width:100%;border-radius:10px;box-shadow: #9b9ea5b0 0 1px 2px 2px;padding:0 5px 5px 5px"> 
								<div id="cy" style="height:500px;width:100%;border-radius:10px;">
								<!-- 加载String的图 -->
								<script>
									var data =@json($data);
									var style =@json($style);

									Promise.all([Promise.resolve(style),
									Promise.resolve(data)
									])
									.then(function(dataArray){
										var cy = window.cy = cytoscape({
										container: document.getElementById('cy'),

										layout: {
											name: 'random',

									fit: true, // whether to fit to viewport	
									padding: 30, // fit padding
									boundingBox: undefined, // constrain layout bounds; { x1, y1, x2, y2 } or { x1, y1, w, h }
									animate: false, // whether to transition the node positions
									animationDuration: 500, // duration of animation in ms if enabled
									animationEasing: undefined, // easing of animation if enabled
									animateFilter: function ( node, i ){ return true; }, // a function that determines whether the node should be animated.  All nodes animated by default on animate enabled.  Non-animated nodes are positioned immediately when the layout starts
									ready: undefined, // callback on layoutready
									stop: undefined, // callback on layoutstop
									transform: function (node, position ){ return position; } // transform a given node position. Useful for changing flow direction in discrete layouts 
										},
										style: dataArray[0],
										elements: dataArray[1]
										});
										cy.userZoomingEnabled( false );
										cy.on('click','node',function(){
											document.getElementById("test1").style.display="none";
											document.getElementById("test2").style.display="none";
											
											var aa = this.data('id');
											var bb = this.data('name');
											var cc = this.data('information');
											if(this.data('igemid')!=""){
												var dd = this.data('igemid');
											}
											else {
												var dd="null";
											}
											document.getElementById("node").innerHTML="<span>part name:  </span>"+dd+"<br/>"+"<span>strid:  </span>"+aa+"<br/>"+"<span>name:  </span>"+bb+"<br/>"+"<span>information:  </span>"+"<br/>"+cc+"<br/>"
											document.getElementById("test1").style.display="block";
											var top=$('#cy').offset().top;
											var left=$('#cy').offset().left;
											var widthcy=$('#cy').width();
											var heightcy=$('#cy').height();
											var width=$('#test1').outerWidth();
											var height=$('#test1').outerHeight();
											if(this.renderedPosition('x')<(widthcy/2)){
												var x=this.renderedPosition('x')+left+this.renderedOuterHeight()/2+20;
											}
											else{
												var x=this.renderedPosition('x')+left-this.renderedOuterHeight()/2-20-width;
											}
											if(this.renderedPosition('y')<(heightcy/2)){
												var y=this.renderedPosition('y')+top-this.renderedOuterHeight()/2;
											}
											else{
												var y=this.renderedPosition('y')+top+this.renderedOuterHeight()/2-height;
											}
											$('#test1').offset({left:x,top:y});
										})
										cy.on('click','edge',function(){
											document.getElementById("test1").style.display="none";
											document.getElementById("test2").style.display="none";
											var score = this.data('score');
											var nscore = this.data('nscore');
											var fscore = this.data('fscore');
											var pscore = this.data('pscore');
											var ascore = this.data('ascore');
											var escore = this.data('escore');
											var dscore = this.data('dscore');
											var tscore = this.data('tscore');	

											document.getElementById("score").innerHTML="<span>score:</span>"+score;
											document.getElementById("nscore").innerHTML="<span>nscore  :</span>"+nscore;
											document.getElementById("fscore").innerHTML="<span>fscore  :</span>"+fscore;
											document.getElementById("pscore").innerHTML="<span>pscore  :</span>"+pscore;
											document.getElementById("ascore").innerHTML="<span>ascore  :</span>"+ascore;
											document.getElementById("escore").innerHTML="<span>escore  :</span>"+escore;
											document.getElementById("dscore").innerHTML="<span>dscore  :</span>"+dscore;
											document.getElementById("tscore").innerHTML="<span>tcore  :</span>"+tscore;
											document.getElementById("test2").style.display="block";
											
											var edge_x = (cy.getElementById(this.data('source')).renderedPosition('x')+cy.getElementById(this.data('target')).renderedPosition('x'))/2
											var edge_y = (cy.getElementById(this.data('source')).renderedPosition('y')+cy.getElementById(this.data('target')).renderedPosition('y'))/2
											var top=$('#cy').offset().top;
											var left=$('#cy').offset().left;
											var widthcy=$('#cy').width();
											var heightcy=$('#cy').height();
											var width=$('#test2').outerWidth();
											var height=$('#test2').outerHeight();
											var x=edge_x+left-width/2;
											var y=edge_y+top-height/2;
											$('#test2').offset({left:x,top:y});
										})
									});
											</script>
									</div>

									<!-- <div class="table-responsive info-tab Protein_feature text-scroll">
							 <h5>Protein _ feature description</h5>
							 <table  class="table  table-bordered head-type">
								 <thead>
									 <tr>
										 <th>Feature key:Description</th>
										 <th>Position(s)</th>
										 <th>Graphical view</th>
										 <th>Length</th>
									 </tr>
								 </thead>
								 <tbody>
									 @foreach($uni_features as $feature)
									 <tr>
										 <td>{{$feature->type}}</td>
										 @if($feature->position==NULL)
										 <td>{{$feature->begin_position}}-{{$feature->end_position}}</td>
										 <td><div style="background-color:#ffdcd2;width: 180px;height: 20px;"><div style="background-color:#f27d5c;height: 100%;width: {{(($feature->end_position)-($feature->begin_position))/$seq_len*100}}%;margin-left: {{($feature->begin_position)/$seq_len*100}}%;"></div></div></td>
										 <td>{{($feature->end_position)-($feature->begin_position)}}</td>
										 @elseif($feature->position!=NULL)
										 <td>{{$feature->position}}</td>
										 <td><div style="background-color:#ffdcd2;width: 180px;height: 20px;"><div style="background-color:#f27d5c;height: 100%;width: 4px;margin-left: {{($feature->position)/$seq_len*100}}%;"></div></div></td>
										 <td>1</td>
										 @endif
										 
									 </tr>
									 @endforeach
									 
								 </tbody>
							 </table>
						 </div> -->
								</div>

							<div id="test1" style="width:300px;background:white;display:none;border-radius:10px;border: 2px solid #b3d0f5;">
							<div class="clearfix">
								<button type="button" class="close" onclick="document.getElementById('test1').style.display='none'"><img src="../../../public/static/images/close.png" style="width:30px"></button>
							</div>
							<div id="node"></div>
							<div style="word-wrap: break-word;word-break: break-all;"></div>
						</div>
						<div id="test2" style="display:none;width:350px;background:white;border-radius:10px;border: 2px solid rgb(116, 93, 242);">
						
							<div id="edge">
							<div class="head clearfix">
								<button type="button" class="close" onclick="document.getElementById('test2').style.display='none'"><img src="../../../public/static/images/close.png" style="width:30px"></button>
							</div>
							<div class="clearfix">
								<div class=" information" style="float:left">
								<table class="stringtable">
									<tr>
									<td id="score"></td>
									<td style="padding-left:10px">combined score</td>
									</tr>
									<tr>
									<td id="nscore"></td>
									<td style="padding-left:10px">gene neighborhood score</td>
									</tr>
									<tr>
										<td id="fscore"></td>
										<td style="padding-left:10px">gene fusion score</td>
									</tr>
									<tr>
										<td id="pscore"></td>
										<td style="padding-left:10px">phylogenetic profile score</td>
									</tr>
									<tr>
										<td id="ascore"></td>
										<td style="padding-left:10px">coexpression score</td>
									</tr>
									<tr>
										<td id="escore"></td>
										<td style="padding-left:10px">experimental score</td>
									</tr>
									<tr>
										<td id="dscore"></td>
										<td style="padding-left:10px">database score</td>
									</tr>
									<tr>
										<td id="tscore"></td>
										<td style="padding-left:10px">textmining score</td>
									</tr>
									<tr>
										<td id="www"></td>
									</tr>
								</table>
								</div>
								<div class=" note" style="float:left;margin-left:30px">
								<table class="stringtable">
									<tr>
										
										
									</tr>
									<tr>
										
										
									</tr>
									<tr>
									
										
									</tr>
									<tr>
										
										
									</tr>
									<tr>
									
										
									</tr>
									<tr>
										
										
									</tr>
									<tr>
								
									
									</tr>
									<tr>
								
									
									</tr>
								</table>
								</div>
							</div>
							</div>
						</div>
				@if($interactions->isNotempty())
  				<h5>Interaction</h5>
						<div class="table-responsive info-tab Interaction_KEGGPathways text-scroll div-head">
							<table  class="table  table-bordered head-type">
								<thead>
									<tr>
										 <th>Category</th>
										 <th>Term</th>
										 <th>Description</th>
										 <th>fdr</th>
									</tr>
								</thead>
								<tbody>
									@foreach($interactions as $interaction)
									<tr>
										<td>{{$interaction->category}}</td>
										<td>{{$interaction->term}}</td>
										<td>{{$interaction->description}}</td>
										<td>{{$interaction->fdr}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
				@endif
						@endif
						
						@if($genename && $Biogrid_interaction->isNotempty())
						<h4 id="Interaction_Biogrid"><strong>BioGRID</strong></h4>
						<div class="clearfix">
							<div class="example" style="padding-bottom:10px">
								<span>{{$genename}}</span>
								<div>
									<div>Physical Interaction</div>
									<div>Genetic Interaction</div>
								</div>
							</div>
							<div class="text-scroll">
								<table  class="table  table-bordered" >
									<thead>
										<tr>
											 <th>Gene</th>
											 <th>BioGRID ID</th>
											 <th>Experimental Evidence Code</th>
											 <th>Author</th>
											 <th>Pubmed ID</th>
										</tr>
									</thead>
									<tbody>
										@foreach($Biogrid_interaction as $value)
										@if($value->experimental_system_type=='physical')
										<tr class='PI'>
										@elseif($value->experimental_system_type=='genetic')
										<tr class='GI'>
										@endif
											<td>{{$value->intgenname}}</td>
											<td>{{$value->biogrid_intid}}</td>
											<td>{{$value->experimental_system}}
											<button type="button" href="#biogrid_m{{$g}}" class="modal-btn dialog_open">show all</button>
											</td>
											<td>{{$value->author}}</td>
											<td>{{$value->pubmedid}}</td>
										</tr>
											@php
											$g++
											@endphp
										@endforeach
									</tbody>
								</table>
								@foreach($Biogrid_interaction as $value)
								<div  id="biogrid_m{{$e}}">
									<div class="mask"></div>
								    <div class="dialog dialog_position_center">
								        <div class="modal-content">
											<header>
												<button type="button" class="close dialog_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h3 class="modal-title">{{$value->experimental_system}}</h3>
											</header>
											<div style="max-height: 500px;overflow-y:auto;">
												@foreach($Biogrid_type as $bio_types)
													@foreach($bio_types as $bio_type)
														@if($bio_type->Type_n == $value->experimental_system)
														{{$bio_type->explain}}
														@endif
													@endforeach
												@endforeach
											</div>
										</div>
									</div>
								</div>
							
							@php
							$e++
							@endphp
							@endforeach
							</div>
							<div style="font-size: 18px;font-weight: 600;float: right;">
								<a href="http://thebiogrid.org/search.php?search={{$genename}}&organism=all" target="blank" style="text-decoration: none;color: #000000;">More<img src="{{asset('static/images/主页5_03.jpg')}}" height="12px"></a>
							</div>
						</div>
					@endif
		@endif
						
						<div class="clearfix part-name-Download part-name" id="Download">
							<div class="part-line"></div>
							<div><span>Download</span></div>
							<div class="part-line"></div>
						</div>
						
						<div class="Related clearfix">
							 <div class="text-block text-center col-md-3 ">
								 <div><a href="{{route('detail_download',['igemid'=>$igemid,'type'=>'fasta'])}}">iGEM FASTA</a></div>
							 </div>
							 <div class="text-block text-center col-md-3 ">
								 <div><a href="{{route('detail_download',['igemid'=>$igemid,'type'=>'feature'])}}">iGEM Feature</a></div>
							 </div>
							 <div class="text-block text-center col-md-3 ">
								 <div><a href="{{route('detail_download',['igemid'=>$igemid,'type'=>'unisequence'])}}">UniProt Sequence</a></div>
							 </div>
							 <div class="text-block text-center col-md-3 ">
								 <div><a href="{{route('detail_download',['igemid'=>$igemid,'type'=>'aasequence'])}}">KEGG AA sequence</a></div>
							 </div>
							 <div class="text-block text-center col-md-3 ">
							 	<div><a href="{{route('detail_download',['igemid'=>$igemid,'type'=>'ntsequence'])}}">KEGG NT sequence</a></div>
							 </div>
							 <div class="text-block text-center col-md-3 ">
							 	<div><a href="{{route('detail_download',['igemid'=>$igemid,'type'=>'xml'])}}">BioMaster XML</a></div>
							 </div>
						</div>

						<div class="clearfix part-name-Comment part-name">
							<div class="part-line"></div>
							<div><span>Comment</span></div>
							<div class="part-line"></div>
						</div>
						<div class="comment-part-1">
						<div class="comments" id="comments">
							@if($comments->isNotEmpty())
									@foreach($comments as $comment)
									@if($l%3==1)
									@php
									$t=intdiv($l,3);
									$t=$t+1
									@endphp
									@if($t==1)
										<div class="showpage hidepage" id="comments_page{{$t}}">
									@else
										<div class="hidepage" id="comments_page{{$t}}">
									@endif
									@endif
											<div class="user-name">{{$comment->name}}</div>
											<div class="comment-message"><span>Date</span><span>{{$comment->updated_at}}</span></div>
											<p style="font-size: 16px;">{{$comment->comment}}</p>
									@if($l%3==0 || $l==$count_cm)
										</div>
									@endif	
									@php
									$l++
									@endphp
								@endforeach							
							@else
							<div class="text-center"><h3>No one has posted a comment yet, let’s post some.</h3></div>
							@endif
						</div>
						@if($comments->isNotEmpty())
						<div class="page-select text-center">
								<a href="javascript:void(0)" onclick="changepage(1,'comments',{{$pages_cm}})"><i class="iconfont" style="margin-right: -8px;">&#xe629;</i><i class="iconfont">&#xe629;</i>First</a>
								<a href="javascript:void(0)" onclick="changepage(2,'comments',{{$pages_cm}})"><i class="iconfont">&#xe629;</i>Prev</a>
								<span>Page</span>
								<input class="choice" type="text" value="1"  style="width:50px;">
								<span>of {{$pages_cm}}</span>
								<a href="javascript:void(0)" onclick="changepage(5,'comments',{{$pages_cm}})">Go</a>
								<a href="javascript:void(0)" onclick="changepage(3,'comments',{{$pages_cm}})">Next<i class="iconfont">&#xe628;</i></a>
								<a href="javascript:void(0)" onclick="changepage(4,'comments',{{$pages_cm}})">Last<i class="iconfont" style="margin-right: -8px;">&#xe628;</i><i class="iconfont">&#xe628;</i></a>
						</div>
						@endif
					</div>					
					<div class="comment-part-2">
						<div style="width: 80%;">
							<p>Any comments on this part?</p>
								@if ($errors->any())
									<div class="alert alert-danger" style="margin-top:20px;margin-bottom:0px">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
							<form method="post" action="{{route('comment_write')}}">
								@csrf
								<textarea style="resize: none" class="comments" name="comment"></textarea>
								<input name="igemid" value="{{$igemid}}" class="hidden">
								<input type="submit" style="margin:20px 0;width: 110px;height: 30px;float: right;font-size: 18px;border-radius: 100px;border: none;background:linear-gradient(to right,#ff815cf7
,#ea5c18);color: white;" value="Release"/>
							</form>
						</div>
						
					</div>
					</div>
				</div>
			</div>
        </div>
@stop

@section('javascript')

<script>
function changepage(message,id,page){
	var pageid;
	var choice = id+"_page"+$('#'+id+'+div .choice').val();
	// #choice 改为.choice
	var showtable = $('#'+id+' .showpage');
	pageid = $('#'+id+' .showpage').attr('id');
	// showpage的id改为id_page1
	switch(message)
	{
		case 1:
			showtable.removeClass('showpage');
			$('#'+id+'_page1').addClass('showpage');
			break;
		case 2:
			if(pageid!=(id+'_page1')){
			showtable.removeClass('showpage');
			showtable.prev().addClass('showpage');
		}
			break;
		case 3:
			if(pageid!=$('#'+id).children(':last').attr('id'))
			{
				showtable.removeClass('showpage');
				showtable.next().addClass('showpage');
			}
			break;
		case 4:
			showtable.removeClass('showpage');
			$('#'+id).children(':last').addClass('showpage');
			break;
		case 5:
			var num=$('#'+id+'+div .choice').val();
			if((/^(\+|-)?\d+$/.test(num)) && num>0 && num<=page)
			{
				showtable.removeClass('showpage');
				$("#"+choice).addClass('showpage');
			}
			break;
	}
	pageid = $('#'+id+' .showpage').attr('id');
	pageid=pageid.replace(id+'_','').substring(4);
	$('#'+id+'+div .choice').val(pageid);
}
</script>
<script src="{{asset('static/js/detail/main.js')}}"></script>
<script src="{{asset('static/js/detail/sbol.js')}}"></script>
<script src="{{asset('static/js/detail/jquery.freezeheader.js')}}"></script>
<script src="{{asset('static/js/sbol/html2canvas.min.js')}}"></script>
@stop

