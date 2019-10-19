@extends('common.layouts')
@section('style')
		<link rel="stylesheet" href="{{asset('static/css/tools/style.css')}}">
@endsection

@section('content')
<div class="main-page">
	<div class="container two" id="main" style="display: block;">

			<div class="row" style= "display: flex;
justify-content: center;">

				<div class="sousuo">

					<div class="col-lg-4  col-lg-offset-6 col-md-4 col-md-offset-5">

						<a class="content_1" href="javascript:;"></a>
						<a class="content_2" href="javascript:;"></a>


						<div class=" signin ">
							<!-- <div class="signin-head"><img src="images/test/head_120.png" alt="" class="img-circle"></div> -->
							<h1>Search</h1>
							<form class="form-signin" role="form" method="post" action="{{route('blast_api')}}">
								@csrf
								<h3>Sequence:</h3>
								<textarea class="form-control" rows="3" name="query_web"></textarea>
								<h5>Example: biosensor</h5>
								<select class="form-control" name="type">
									<option selected="yes"></option>
									<option value='blastx'>blastx</option>
									<option value='blastp'>blastp</option>
									<option value='blastn'>blastn</option>
									<option value='tblastn'>tblastn</option>
									<option value='tblastx'>tblastx</option>
								</select>
								<button class="btn btn-lg btn-block" type="submit" style="background:#fff;border:1px solid #d3d3d3;margin-bottom: 20px; font-weight: 600; color: #f27d5c;bottom-color:orange; width: 60%; margin:0 auto ;margin-top:30px;">Blast</button>
							</form>

						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="container two" id="main4" style="display: none;">
			<div class="row" style= "display: flex;justify-content: center;">
				<div class="sousuo">
					<div class="col-lg-4  col-lg-offset-6 col-md-4 col-md-offset-5">
						<a class="content_1" href="javascript:;"></a>
						<a class="content_2" href="javascript:;"></a>
						<div class=" signin ">
							<h1>Search</h1>
							<form class="form-signin" role="form" method="post" action="{{route('tools_process')}}">
								@csrf
								<h3>ID:</h3>
								<textarea class="form-control" rows="1" name="ID"></textarea>
								<h5>From:</h5>
								<select class="form-control" name="from">
									<option selected="yes"></option>
									<optgroup label="---Uniprot---"></optgroup>
									<option value='UniProtKB AC/ID'>UniProtKB AC/ID</option>
									<option value='UniProtKB AC'>UniProtKB AC</option>
									<option value='UniProtKB ID'>UniProtKB ID</option>
									<option value='UniParc'>UniParc</option>
									<option value='UniRef50'>UniRef50</option>
									<option value='UniRef90'>UniRef90</option>
									<option value='UniRef100'>UniRef100</option>
									<option value='Gene name'>Gene name</option>
									<option value='CRC64'>CRC64</option>
									<optgroup label="---Sequence databases---"></optgroup>
									<option value='EMBL/GenBank/DDBJ'>EMBL/GenBank/DDBJ</option>
									<option value='EMBL/GenBank/DDBJ CDS'>EMBL/GenBank/DDBJ CDS</option>
									<option value='Entrez Gene (GeneID)'>Entrez Gene (GeneID)</option>
									<option value='GI number'>GI number</option>
									<option value='PIR'>PIR</option>
									<option value='RefSeq Nucleotide'>RefSeq Nucleotide</option>
									<option value='RefSeq Protein'>RefSeq Protein</option>
									<optgroup label="---3D structure databases---"></optgroup>
									<option value='PDB'>PDB</option>
									<optgroup label="---Protein-protein interaction databases---"></optgroup>
									<option value='BioGrid'>BioGrid</option>
									<option value='ComplexPortal'>ComplexPortal</option>
									<option value='DIP'>DIP</option>
									<option value='STRING'>STRING</option>
									<optgroup label="---Chemistry---"></optgroup>
									<option value='ChEMBL'>ChEMBL</option>
									<option value='DrugBank'>DrugBank</option>
									<option value='GuidetoPHARMACOLOGY'>GuidetoPHARMACOLOGY</option>
									<option value='SwissLipids'>SwissLipids</option>
									<optgroup label="---Protein family/group databases---"></optgroup>
									<option value='Allergome'>Allergome</option>
									<option value='ESTHER'>ESTHER</option>
									<option value='MEROPS'>MEROPS</option>
									<option value='mycoCLAP'>mycoCLAP</option>
									<option value='PeroxiBase'>PeroxiBase</option>
									<option value='REBASE'>REBASE</option>
									<option value='TCDB'>TCDB</option>
									<optgroup label="---PTM databases---"></optgroup>
									<option value='GlyConnect'>GlyConnect</option>
									<optgroup label="---Polymorphism and mutation databases---"></optgroup>
									<option value='BioMuta'>BioMuta</option>
									<option value='DMDM'>DMDM</option>
									<optgroup label="---2D gel databases---"></optgroup>
									<option value='World-2DPAGE'>World-2DPAGE</option>
									<optgroup label="---Proteomic databases---"></optgroup>
									<option value='CPTAC'>CPTAC</option>
									<option value='ProteomicsDB'>ProteomicsDB</option>
									<optgroup label="---Protocols and materials databases---"></optgroup>
									<option value='DNASU'>DNASU</option>
									<optgroup label="---Genome annotation databases---"></optgroup>
									<option value='Ensembl'>Ensembl</option>
									<option value='Ensembl Protein'>Ensembl Protein</option>
									<option value='Ensembl Transcript'>Ensembl Transcript</option>
									<option value='Ensembl Genomes'>Ensembl Genomes</option>
									<option value='Ensembl Genomes Protein'>Ensembl Genomes Protein</option>
									<option value='Ensembl Genomes Transcript'>Ensembl Genomes Transcript</option>
									<option value='GeneDB'>GeneDB</option>
									<option value='GeneID (Entrez Gene)'>GeneID (Entrez Gene)</option>
									<option value='KEGG'>KEGG</option>
									<option value='PATRIC'>PATRIC</option>
									<option value='UCSC'>UCSC</option>
									<option value='VectorBase'>VectorBase</option>
									<option value='WBParaSite'>WBParaSite</option>
									<optgroup label="---Organism-specific databases---"></optgroup>
									<option value='ArachnoServer'>ArachnoServer</option>
									<option value='Araport'>Araport</option>
									<option value='CCDS'>CCDS</option>
									<option value='CGD'>CGD</option>
									<option value='ConoServer'>ConoServer</option>
									<option value='dictyBase'>dictyBase</option>
									<option value='EchoBASE'>EchoBASE</option>
									<option value='EcoGene'>EcoGene</option>
									<option value='euHCVdb'>euHCVdb</option>
									<option value='EuPathDB'>EuPathDB</option>
									<option value='FlyBase'>FlyBase</option>
									<option value='GeneCards'>GeneCards</option>
									<option value='GeneReviews'>GeneReviews</option>
									<option value='HGNC'>HGNC</option>
									<option value='HPA'>HPA</option>
									<option value='LegioList'>LegioList</option>
									<option value='Leproma'>Leproma</option>
									<option value='MaizeGDB'>MaizeGDB</option>
									<option value='MGI'>MGI</option>
									<option value='MIM'>MIM</option>
									<option value='neXtProt'>neXtProt</option>
									<option value='Orphanet'>Orphanet</option>
									<option value='PharmGKB'>PharmGKB</option>
									<option value='PomBase'>PomBase</option>
									<option value='PseudoCAP'>PseudoCAP</option>
									<option value='RGD'>RGD</option>
									<option value='SGD'>SGD</option>
									<option value='TubercuList'>TubercuList</option>
									<option value='VGNC'>VGNC</option>
									<option value='WormBase'>WormBase</option>
									<option value='WormBase Protein'>WormBase Protein</option>
									<option value='WormBase Transcript'>WormBase Transcript</option>
									<option value='Xenbase'>Xenbase</option>
									<option value='ZFIN'>ZFIN</option>
									<optgroup label="---Phylogenomic databases---"></optgroup>
									<option value='eggNOG'>eggNOG</option>
									<option value='GeneTree'>GeneTree</option>
									<option value='KO'>KO</option>
									<option value='OMA'>OMA</option>
									<option value='OrthoDB'>OrthoDB</option>
									<option value='TreeFam'>TreeFam</option>
									<optgroup label="---Enzyme and pathway databases---"></optgroup>
									<option value='BioCyc'>BioCyc</option>
									<option value='Reactome'>Reactome</option>
									<option value='UniPathway'>UniPathway</option>
									<optgroup label="---Gene expression databases---"></optgroup>
									<option value='CollecTF'>CollecTF</option>
									<optgroup label="---Family and domain databases---"></optgroup>
									<option value='DisProt'>DisProt</option>
									<optgroup label="---Other---"></optgroup>
									<option value='ChiTaRS'>ChiTaRS</option>
									<option value='GeneWiki'>GeneWiki</option>
									<option value='GenomeRNAi'>GenomeRNAi</option>
								</select>
								<h5>To:</h5>
								<select class="form-control" name="to">
									<option selected="yes"></option>
									<optgroup label="---Uniprot---"></optgroup>
									<option value='UniProtKB AC'>UniProtKB AC</option>
									<option value='UniProtKB ID'>UniProtKB ID</option>
									<option value='UniParc'>UniParc</option>
									<option value='UniRef50'>UniRef50</option>
									<option value='UniRef90'>UniRef90</option>
									<option value='UniRef100'>UniRef100</option>
									<option value='Gene name'>Gene name</option>
									<option value='CRC64'>CRC64</option>
									<optgroup label="---Sequence databases---"></optgroup>
									<option value='EMBL/GenBank/DDBJ'>EMBL/GenBank/DDBJ</option>
									<option value='EMBL/GenBank/DDBJ CDS'>EMBL/GenBank/DDBJ CDS</option>
									<option value='Entrez Gene (GeneID)'>Entrez Gene (GeneID)</option>
									<option value='GI number'>GI number</option>
									<option value='PIR'>PIR</option>
									<option value='RefSeq Nucleotide'>RefSeq Nucleotide</option>
									<option value='RefSeq Protein'>RefSeq Protein</option>
									<optgroup label="---3D structure databases---"></optgroup>
									<option value='PDB'>PDB</option>
									<optgroup label="---Protein-protein interaction databases---"></optgroup>
									<option value='BioGrid'>BioGrid</option>
									<option value='ComplexPortal'>ComplexPortal</option>
									<option value='DIP'>DIP</option>
									<option value='STRING'>STRING</option>
									<optgroup label="---Chemistry---"></optgroup>
									<option value='ChEMBL'>ChEMBL</option>
									<option value='DrugBank'>DrugBank</option>
									<option value='GuidetoPHARMACOLOGY'>GuidetoPHARMACOLOGY</option>
									<option value='SwissLipids'>SwissLipids</option>
									<optgroup label="---Protein family/group databases---"></optgroup>
									<option value='Allergome'>Allergome</option>
									<option value='ESTHER'>ESTHER</option>
									<option value='MEROPS'>MEROPS</option>
									<option value='mycoCLAP'>mycoCLAP</option>
									<option value='PeroxiBase'>PeroxiBase</option>
									<option value='REBASE'>REBASE</option>
									<option value='TCDB'>TCDB</option>
									<optgroup label="---PTM databases---"></optgroup>
									<option value='GlyConnect'>GlyConnect</option>
									<optgroup label="---Polymorphism and mutation databases---"></optgroup>
									<option value='BioMuta'>BioMuta</option>
									<option value='DMDM'>DMDM</option>
									<optgroup label="---2D gel databases---"></optgroup>
									<option value='World-2DPAGE'>World-2DPAGE</option>
									<optgroup label="---Proteomic databases---"></optgroup>
									<option value='CPTAC'>CPTAC</option>
									<option value='ProteomicsDB'>ProteomicsDB</option>
									<optgroup label="---Protocols and materials databases---"></optgroup>
									<option value='DNASU'>DNASU</option>
									<optgroup label="---Genome annotation databases---"></optgroup>
									<option value='Ensembl'>Ensembl</option>
									<option value='Ensembl Protein'>Ensembl Protein</option>
									<option value='Ensembl Transcript'>Ensembl Transcript</option>
									<option value='Ensembl Genomes'>Ensembl Genomes</option>
									<option value='Ensembl Genomes Protein'>Ensembl Genomes Protein</option>
									<option value='Ensembl Genomes Transcript'>Ensembl Genomes Transcript</option>
									<option value='GeneDB'>GeneDB</option>
									<option value='GeneID (Entrez Gene)'>GeneID (Entrez Gene)</option>
									<option value='KEGG'>KEGG</option>
									<option value='PATRIC'>PATRIC</option>
									<option value='UCSC'>UCSC</option>
									<option value='VectorBase'>VectorBase</option>
									<option value='WBParaSite'>WBParaSite</option>
									<optgroup label="---Organism-specific databases---"></optgroup>
									<option value='ArachnoServer'>ArachnoServer</option>
									<option value='Araport'>Araport</option>
									<option value='CCDS'>CCDS</option>
									<option value='CGD'>CGD</option>
									<option value='ConoServer'>ConoServer</option>
									<option value='dictyBase'>dictyBase</option>
									<option value='EchoBASE'>EchoBASE</option>
									<option value='EcoGene'>EcoGene</option>
									<option value='euHCVdb'>euHCVdb</option>
									<option value='EuPathDB'>EuPathDB</option>
									<option value='FlyBase'>FlyBase</option>
									<option value='GeneCards'>GeneCards</option>
									<option value='GeneReviews'>GeneReviews</option>
									<option value='HGNC'>HGNC</option>
									<option value='HPA'>HPA</option>
									<option value='LegioList'>LegioList</option>
									<option value='Leproma'>Leproma</option>
									<option value='MaizeGDB'>MaizeGDB</option>
									<option value='MGI'>MGI</option>
									<option value='MIM'>MIM</option>
									<option value='neXtProt'>neXtProt</option>
									<option value='Orphanet'>Orphanet</option>
									<option value='PharmGKB'>PharmGKB</option>
									<option value='PomBase'>PomBase</option>
									<option value='PseudoCAP'>PseudoCAP</option>
									<option value='RGD'>RGD</option>
									<option value='SGD'>SGD</option>
									<option value='TubercuList'>TubercuList</option>
									<option value='VGNC'>VGNC</option>
									<option value='WormBase'>WormBase</option>
									<option value='WormBase Protein'>WormBase Protein</option>
									<option value='WormBase Transcript'>WormBase Transcript</option>
									<option value='Xenbase'>Xenbase</option>
									<option value='ZFIN'>ZFIN</option>
									<optgroup label="---Phylogenomic databases---"></optgroup>
									<option value='eggNOG'>eggNOG</option>
									<option value='GeneTree'>GeneTree</option>
									<option value='KO'>KO</option>
									<option value='OMA'>OMA</option>
									<option value='OrthoDB'>OrthoDB</option>
									<option value='TreeFam'>TreeFam</option>
									<optgroup label="---Enzyme and pathway databases---"></optgroup>
									<option value='BioCyc'>BioCyc</option>
									<option value='Reactome'>Reactome</option>
									<option value='UniPathway'>UniPathway</option>
									<optgroup label="---Gene expression databases---"></optgroup>
									<option value='CollecTF'>CollecTF</option>
									<optgroup label="---Family and domain databases---"></optgroup>
									<option value='DisProt'>DisProt</option>
									<optgroup label="---Other---"></optgroup>
									<option value='ChiTaRS'>ChiTaRS</option>
									<option value='GeneWiki'>GeneWiki</option>
									<option value='GenomeRNAi'>GenomeRNAi</option>
								</select>
								<button class="btn btn-lg btn-block" type="submit" style="background:#fff;border:1px solid #d3d3d3;margin-bottom: 20px; font-weight: 600; color: #f27d5c;bottom-color:orange; width: 60%; margin:0 auto ;margin-top:30px;">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>

@endsection

@section('javascript')
		<script src="{{asset('static/js/tools/main.js')}}"></script>
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
@endsection
