@extends('common.layouts')
@section('style')
		<link rel="stylesheet" href="{{asset('static/css/catalog/catalog.css')}}">
@endsection

@section('content')
		<div class="main-page container">
			<div class="row">
				<div class="part-select  clearfix">
                    <div class="col-xs-4 text-center" style="font-size:20px;line-height:40px;"><a href="{{route('catalog')}}" style="text-decoration:none;color:white">All The Parts by Type</a></div>
					<div class="col-xs-4 text-center" style="background: #61839F;font-size:20px;line-height:40px;"><a href="{{route('catalog2')}}" style="text-decoration:none;color:white">Well Documented Parts</a></div>
					<div class="col-xs-4 text-center" style="font-size:20px;line-height:40px;"><a href="{{route('catalog3')}}" style="text-decoration:none;color:white">Frequently Used Parts</a></div>
				</div>
				<h5>Top 10 Most Documented Parts</h5>
				<div class="table-responsive info-tab div-head">
					<table class="table  table-bordered head-type">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Length</th>
								<th>Created by</th>
								<th>Documentaion</th>
								<th>Type</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K808000">BBa_K808000</a></td>
								<td> araC-Pbad - Arabinose inducible regulatory promoter/repressor unit</td>
								<td>1209</td>
								<td>Valentina Herbring, Sebastian Palluk, Andreas Schmidt</td>
								<td>1028470</td>
								<td>Regulatory</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2607001">BBa_K2607001</a></td>
								<td>HB-EGF/Tar Receptor (HT) Device</td>
								<td>1836</td>
								<td>Andrea Laurentius</td>
								<td>191593</td>
								<td>Composite</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2607000">BBa_K2607000</a></td>
								<td>DiphTox (DT)</td>
								<td>254</td>
								<td>Andrea Laurentius</td>
								<td>183996</td>
								<td>Protein_Domain</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K801060">BBa_K801060</a></td>
								<td>(+)-Limonene synthase 1 with Strep-tag and yeast consensus sequence.</td>
								<td>1708</td>
								<td>Lara Kuntz</td>
								<td>68635</td>
								<td>Coding</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2201004">BBa_K2201004</a></td>
								<td>Nucleotide Transporter <i>Pt</i>NTT2 from <i>Phaeodactylum tricornutum</i></td>
								<td>1728</td>
								<td>Christopher M. Whitford</td>
								<td>66410</td>
								<td>Coding</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K404003">BBa_K404003</a></td>
								<td>[AAV2]-Rep-VP123(ViralBrick-587KO-empty)_p5-TATAless</td>
								<td>4386</td>
								<td>Freiburg Bioware 2010</td>
								<td>62532</td>
								<td>Project</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0062">BBa_R0062</a></td>
								<td>Promoter (luxR &amp; HSL regulated -- lux pR)</td>
								<td>55</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
									Peter Carr</td>
								<td>61847</td>
								<td>Regulatory</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_J04450">BBa_J04450</a></td>
								<td>RFP Coding Device</td>
								<td>1069</td>
								<td>Tamar Odle</td>
								<td>58970</td>
								<td>Reporter</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2310100">BBa_K2310100</a></td>
								<td>LuxAB, emitting luciferase (from X. luminescens)</td>
								<td>2107</td>
								<td>Xuejie Zhang</td>
								<td>54288</td>
								<td>Translational_Unit</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K863005">BBa_K863005</a></td>
								<td>ecol laccase from E. coli with T7 promoter, RBS and His-tag</td>
								<td>1605</td>
								<td>Isabel Huber</td>
								<td>50382</td>
								<td>Coding</td>
								<td>In stock</td>
							</tr>
						</tbody>
					</table>
				</div>
				<h5>Top 10 Most Documented Promoters</h5>
				<div class="table-responsive info-tab div-head">
					<table class="table  table-bordered head-type">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Length</th>
								<th>Created by</th>
								<th>Documentaion</th>
								<th>Type</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K808000">BBa_K808000</a></td>
								<td> araC-Pbad - Arabinose inducible regulatory promoter/repressor unit</td>
								<td>1209</td>
								<td>Valentina Herbring, Sebastian Palluk, Andreas Schmidt</td>
								<td>1028470</td>
								<td>Regulatory</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2607001">BBa_K2607001</a></td>
								<td>HB-EGF/Tar Receptor (HT) Device</td>
								<td>1836</td>
								<td>Andrea Laurentius</td>
								<td>191593</td>
								<td>Composite</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2607000">BBa_K2607000</a></td>
								<td>DiphTox (DT)</td>
								<td>254</td>
								<td>Andrea Laurentius</td>
								<td>183996</td>
								<td>Protein_Domain</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K801060">BBa_K801060</a></td>
								<td>(+)-Limonene synthase 1 with Strep-tag and yeast consensus sequence.</td>
								<td>1708</td>
								<td>Lara Kuntz</td>
								<td>68635</td>
								<td>Coding</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2201004">BBa_K2201004</a></td>
								<td>Nucleotide Transporter <i>Pt</i>NTT2 from <i>Phaeodactylum tricornutum</i></td>
								<td>1728</td>
								<td>Christopher M. Whitford</td>
								<td>66410</td>
								<td>Coding</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K404003">BBa_K404003</a></td>
								<td>[AAV2]-Rep-VP123(ViralBrick-587KO-empty)_p5-TATAless</td>
								<td>4386</td>
								<td>Freiburg Bioware 2010</td>
								<td>62532</td>
								<td>Project</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0062">BBa_R0062</a></td>
								<td>Promoter (luxR &amp; HSL regulated -- lux pR)</td>
								<td>55</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and Peter Carr</td>
								<td>61847</td>
								<td>Regulatory</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_J04450">BBa_J04450</a></td>
								<td>RFP Coding Device</td>
								<td>1069</td>
								<td>Tamar Odle</td>
								<td>58970</td>
								<td>Reporter</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2310100">BBa_K2310100</a></td>
								<td>LuxAB, emitting luciferase (from X. luminescens)</td>
								<td>2107</td>
								<td>Xuejie Zhang</td>
								<td>54288</td>
								<td>Translational_Unit</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K863005">BBa_K863005</a></td>
								<td>ecol laccase from E. coli with T7 promoter, RBS and His-tag</td>
								<td>1605</td>
								<td>Isabel Huber</td>
								<td>50382</td>
								<td>Coding</td>
								<td>In stock</td>
							</tr>
						</tbody>
					</table>
				</div>
				<h5>Top 10 Most Documented Coding Regions</h5>
				<div class="table-responsive info-tab div-head">
					<table class="table  table-bordered head-type">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Length</th>
								<th>Created by</th>
								<th>Documentaion</th>
								<th>Type</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2560010">BBa_K2560010</a></td>
								<td>Phytobrick version of BBa_B0032</td>
								<td>22</td>
								<td>Tobias Hensel</td>
								<td>22448</td>
								<td>RBS</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2560016">BBa_K2560016</a></td>
								<td>Phytobrick version of BBa_B0030</td>
								<td>24</td>
								<td>Tobias Hensel</td>
								<td>21402</td>
								<td>RBS</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2560013">BBa_K2560013</a></td>
								<td>Phytobrick version of BBa_B0031</td>
								<td>23</td>
								<td>Tobias Hensel</td>
								<td>21401</td>
								<td>RBS</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2560008">BBa_K2560008</a></td>
								<td>Phytobrick version of BBa_B0034</td>
								<td>21</td>
								<td>Tobias Hensel</td>
								<td>21379</td>
								<td>RBS</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2560084">BBa_K2560084</a></td>
								<td>Phytobrick version of RBS Dummy</td>
								<td>24</td>
								<td>Tobias Hensel</td>
								<td>21246</td>
								<td>RBS</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0034">BBa_B0034</a></td>
								<td>RBS (Elowitz 1999) -- defines RBS efficiency</td>
								<td>12</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
									Peter Carr IAP, 2003. </td>
								<td>20746</td>
								<td>RBS</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K1442023">BBa_K1442023</a></td>
								<td>EMCV IRES</td>
								<td>625</td>
								<td>Caroline de Cock</td>
								<td>15623</td>
								<td>RBS</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K1442024">BBa_K1442024</a></td>
								<td>NKRF IRES</td>
								<td>667</td>
								<td>Caroline de Cock</td>
								<td>15325</td>
								<td>RBS</td>
								<td>In stock</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2541012">BBa_K2541012</a></td>
								<td>Heat-inducible RNA-based thermosensor-12</td>
								<td>39</td>
								<td>Shuting Zheng</td>
								<td>14102</td>
								<td>RBS</td>
								<td>It's complicated</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2541010">BBa_K2541010</a></td>
								<td>Heat-inducible RNA-based thermosensor-10</td>
								<td>30</td>
								<td>Shuting Zheng</td>
								<td>14099</td>
								<td>RBS</td>
								<td>It's complicated</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
@endsection


@section('javascript')
@endsection
