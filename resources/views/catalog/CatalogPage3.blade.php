@extends('common.layouts')
@section('style')
		<link rel="stylesheet" href="{{asset('static/css/catalog/catalog.css')}}">
@endsection

@section('content')
<div class="main-page container">
			<div class="row">
				<div class="part-select  clearfix">
                    <div class="col-xs-4 text-center" style="font-size:20px;line-height:40px;"><a href="{{route('catalog')}}" style="text-decoration:none;color:white">All The Parts by Type</a></div>
					<div class="col-xs-4 text-center" style="font-size:20px;line-height:40px;"><a href="{{route('catalog2')}}" style="text-decoration:none;color:white">Well Documented Parts</a></div>
					<div class="col-xs-4 text-center" style="background: #61839F;font-size:20px;line-height:40px;"><a href="{{route('catalog3')}}" style="text-decoration:none;color:white">Frequently Used Parts</a></div>
				</div>
				<h5>Top 10 Most Used Parts on the Registry</h5>
				<div class="table-responsive info-tab div-head">
					<table class="table  table-bordered head-type">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Length</th>
								<th>Created by</th>
								<th>Uses</th>
								<th>Status</th>
								<th>Doc</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0034">BBa_B0034</a></td>
								<td>RBS (Elowitz 1999) -- defines RBS efficiency</td>
								<td>12</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
									Peter Carr IAP, 2003. </td>
								<td>4940</td>
								<td>In stock</td>
								<td>20746</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0015">BBa_B0015</a></td>
								<td>double terminator (B0010-B0012)</td>
								<td>129</td>
								<td>Reshma Shetty</td>
								<td>4306</td>
								<td>In stock</td>
								<td>11115</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0040">BBa_R0040</a></td>
								<td>TetR repressible promoter</td>
								<td>54</td>
								<td> June Rhee, Connie Tao, Ty Thomson, Louis Waldman</td>
								<td>1051</td>
								<td>In stock</td>
								<td>19575</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0010">BBa_B0010</a></td>
								<td>T1 from E. coli rrnB</td>
								<td>80</td>
								<td>Randy Rettberg</td>
								<td>956</td>
								<td>In stock</td>
								<td>10156</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0012">BBa_B0012</a></td>
								<td>TE from coliphageT7</td>
								<td>41</td>
								<td>Reshma Shetty</td>
								<td>913</td>
								<td>In stock</td>
								<td>4154</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0030">BBa_B0030</a></td>
								<td>RBS.1 (strong) -- modified from R. Weiss</td>
								<td>15</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
									Peter Carr IAP, 2003. </td>
								<td>905</td>
								<td>In stock</td>
								<td>11741</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0032">BBa_B0032</a></td>
								<td>RBS.3 (medium) -- derivative of BBa_0030</td>
								<td>13</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
									Peter Carr IAP, 2003. </td>
								<td>859</td>
								<td>In stock</td>
								<td>10737</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E0040">BBa_E0040</a></td>
								<td> green fluorescent protein derived from jellyfish Aequeora victoria wild-type GFP (SwissProt:
									P42212</td>
								<td>720</td>
								<td>jcbraff</td>
								<td>818</td>
								<td>In stock</td>
								<td>22388</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0010">BBa_R0010</a></td>
								<td>promoter (lacI regulated)</td>
								<td>200</td>
								<td>nbsp;</td>
								<td>780</td>
								<td>In stock</td>
								<td>26325</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_J23100">BBa_J23100</a></td>
								<td>constitutive promoter family member</td>
								<td>35</td>
								<td>John Anderson</td>
								<td>657</td>
								<td>In stock</td>
								<td>45510</td>
							</tr>
						</tbody>
					</table>
				</div>
				<h5>Top 10 Most Used Coding Region Parts</h5>
				<div class="table-responsive info-tab div-head">
					<table class="table  table-bordered head-type">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Length</th>
								<th>Created by</th>
								<th>Uses</th>
								<th>Status</th>
								<th>Doc
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E0040">BBa_E0040</a></td>
								<td> green fluorescent protein derived from jellyfish Aequeora victoria wild-type GFP (SwissProt:
									P42212</td>
								<td>720</td>
								<td>jcbraff</td>
								<td>818</td>
								<td>In stock</td>
								<td>22388</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E1010">BBa_E1010</a></td>
								<td> **highly** engineered mutant of red fluorescent protein from Discosoma striata (coral)</td>
								<td>706</td>
								<td>Drew Endy</td>
								<td>501</td>
								<td>In stock</td>
								<td>29881</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0040">BBa_C0040</a></td>
								<td>tetracycline repressor from transposon Tn10 (+LVA)</td>
								<td>685</td>
								<td>June Rhee, Connie Tao, Ty Thomson, Louis Waldman.</td>
								<td>305</td>
								<td>In stock</td>
								<td>12575</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0051">BBa_C0051</a></td>
								<td>cI repressor from E. coli phage lambda (+LVA) </td>
								<td>775</td>
								<td>Vinay S Mahajan, Brian Chow, Peter Carr, Voichita Marinescu and Alexander D.
									Wissner-Gross</td>
								<td>277</td>
								<td>In stock</td>
								<td>7093</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0012">BBa_C0012</a></td>
								<td>lacI repressor from E. coli (+LVA)</td>
								<td>1153</td>
								<td>Grace Kenney, Daniel Shen, Neelaksh Varshney, Samantha Sutton</td>
								<td>257</td>
								<td>In stock</td>
								<td>16456</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0062">BBa_C0062</a></td>
								<td>luxR repressor/activator, (no LVA?)</td>
								<td>781</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
									Peter Carr</td>
								<td>236</td>
								<td>In stock</td>
								<td>33812</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0061">BBa_C0061</a></td>
								<td>autoinducer synthetase for AHL</td>
								<td>643</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
									Peter Carr</td>
								<td>209</td>
								<td>In stock</td>
								<td>11645</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E0030">BBa_E0030</a></td>
								<td>enhanced yellow fluorescent protein derived from A. victoria GFP</td>
								<td>723</td>
								<td>Caitlin Conboy and Jennifer Braff</td>
								<td>131</td>
								<td>In stock</td>
								<td>8152</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E0020">BBa_E0020</a></td>
								<td>engineered cyan fluorescent protein derived from A. victoria GFP </td>
								<td>723</td>
								<td>Caitlin Conboy and Jennifer Braff</td>
								<td>87</td>
								<td>In stock</td>
								<td>7381</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K592009">BBa_K592009</a></td>
								<td>amilCP, blue chromoprotein</td>
								<td>669</td>
								<td>Lei Sun</td>
								<td>80</td>
								<td>In stock</td>
								<td>33534</td>
							</tr>
						</tbody>
					</table>
				</div>
				<h5>Top 10 Most Used Promoters</h5>
				<div class="table-responsive info-tab div-head">
					<table class="table  table-bordered head-type">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Length</th>
								<th>Created by</th>
								<th>Uses</th>
								<th>Status</th>
								<th>Doc
								</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0040">BBa_R0040</a></td>
								<td>TetR repressible promoter</td>
								<td>54</td>
								<td> June Rhee, Connie Tao, Ty Thomson, Louis Waldman</td>
								<td>1051</td>
								<td>In stock</td>
								<td>19575</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0010">BBa_R0010</a></td>
								<td>promoter (lacI regulated)</td>
								<td>200</td>
								<td>&nbsp;</td>
								<td>780</td>
								<td>In stock</td>
								<td>26325</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_J23100">BBa_J23100</a></td>
								<td>constitutive promoter family member</td>
								<td>35</td>
								<td>John Anderson</td>
								<td>657</td>
								<td>In stock</td>
								<td>45510</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0011">BBa_R0011</a></td>
								<td>Promoter (lacI regulated, lambda pL hybrid)</td>
								<td>55</td>
								<td>Neelaksh Varshney, Grace Kenney, Daniel Shen, Samantha Sutton</td>
								<td>584</td>
								<td>In stock</td>
								<td>15961</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_I0500">BBa_I0500</a></td>
								<td>Inducible pBad/araC promoter</td>
								<td>1210</td>
								<td>Sri Kosuri</td>
								<td>429</td>
								<td>In stock</td>
								<td>41577</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0062">BBa_R0062</a></td>
								<td>Promoter (luxR &amp; HSL regulated -- lux pR)</td>
								<td>55</td>
								<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
									Peter Carr</td>
								<td>362</td>
								<td>In stock</td>
								<td>61847</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_J23119">BBa_J23119</a></td>
								<td>constitutive promoter family member</td>
								<td>35</td>
								<td>John Anderson</td>
								<td>360</td>
								<td>In stock</td>
								<td>18080</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_J23101">BBa_J23101</a></td>
								<td>constitutive promoter family member</td>
								<td>35</td>
								<td>John Anderson</td>
								<td>291</td>
								<td>In stock</td>
								<td>40168</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_R0051">BBa_R0051</a></td>
								<td>promoter (lambda cI regulated)</td>
								<td>49</td>
								<td>Vinay S Mahajan, Brian Chow, Peter Carr, Voichita Marinescu and Alexander D.
									Wissner-Gross</td>
								<td>275</td>
								<td>In stock</td>
								<td>9224</td>
							</tr>
							<tr>
								<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_J23106">BBa_J23106</a></td>
								<td>constitutive promoter family member</td>
								<td>35</td>
								<td>John Anderson</td>
								<td>224</td>
								<td>In stock</td>
								<td>34926</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<h5>Top 10 Most Used Ribosome Binding Sites</h5>
			<div class="table-responsive info-tab div-head">
				<table class="table  table-bordered head-type">
					<thead>
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Length</th>
							<th>Created by</th>
							<th>Uses</th>
							<th>Status</th>
							<th>Doc
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E0040">BBa_E0040</a></td>
							<td> green fluorescent protein derived from jellyfish Aequeora victoria wild-type GFP (SwissProt:
								P42212</td>
							<td>720</td>
							<td>jcbraff</td>
							<td>818</td>
							<td>In stock</td>
							<td>22388</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E1010">BBa_E1010</a></td>
							<td> **highly** engineered mutant of red fluorescent protein from Discosoma striata (coral)</td>
							<td>706</td>
							<td>Drew Endy</td>
							<td>501</td>
							<td>In stock</td>
							<td>29881</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0040">BBa_C0040</a></td>
							<td>tetracycline repressor from transposon Tn10 (+LVA)</td>
							<td>685</td>
							<td>June Rhee, Connie Tao, Ty Thomson, Louis Waldman.</td>
							<td>305</td>
							<td>In stock</td>
							<td>12575</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0051">BBa_C0051</a></td>
							<td>cI repressor from E. coli phage lambda (+LVA) </td>
							<td>775</td>
							<td>Vinay S Mahajan, Brian Chow, Peter Carr, Voichita Marinescu and Alexander D.
								Wissner-Gross</td>
							<td>277</td>
							<td>In stock</td>
							<td>7093</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0012">BBa_C0012</a></td>
							<td>lacI repressor from E. coli (+LVA)</td>
							<td>1153</td>
							<td>Grace Kenney, Daniel Shen, Neelaksh Varshney, Samantha Sutton</td>
							<td>257</td>
							<td>In stock</td>
							<td>16456</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0062">BBa_C0062</a></td>
							<td>luxR repressor/activator, (no LVA?)</td>
							<td>781</td>
							<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
								Peter Carr</td>
							<td>236</td>
							<td>In stock</td>
							<td>33812</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_C0061">BBa_C0061</a></td>
							<td>autoinducer synthetase for AHL</td>
							<td>643</td>
							<td>Vinay S Mahajan, Voichita D. Marinescu, Brian Chow, Alexander D Wissner-Gross and
								Peter Carr</td>
							<td>209</td>
							<td>In stock</td>
							<td>11645</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E0030">BBa_E0030</a></td>
							<td>enhanced yellow fluorescent protein derived from A. victoria GFP</td>
							<td>723</td>
							<td>Caitlin Conboy and Jennifer Braff</td>
							<td>131</td>
							<td>In stock</td>
							<td>8152</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_E0020">BBa_E0020</a></td>
							<td>engineered cyan fluorescent protein derived from A. victoria GFP </td>
							<td>723</td>
							<td>Caitlin Conboy and Jennifer Braff</td>
							<td>87</td>
							<td>In stock</td>
							<td>7381</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K592009">BBa_K592009</a></td>
							<td>amilCP, blue chromoprotein</td>
							<td>669</td>
							<td>Lei Sun</td>
							<td>80</td>
							<td>In stock</td>
							<td>33534</td>
						</tr>
					</tbody>
				</table>
			</div>
			<h5>Top 10 Most Used Terminators</h5>
			<div class="table-responsive info-tab div-head">
				<table class="table  table-bordered head-type">
					<thead>
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Length</th>
							<th>Created by</th>
							<th>Uses</th>
							<th>Status</th>
							<th>Doc</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0015">BBa_B0015</a></td>
							<td>double terminator (B0010-B0012)</td>
							<td>129</td>
							<td>Reshma Shetty</td>
							<td>4306</td>
							<td>In stock</td>
							<td>11115</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0010">BBa_B0010</a></td>
							<td>T1 from E. coli rrnB</td>
							<td>80</td>
							<td>Randy Rettberg</td>
							<td>956</td>
							<td>In stock</td>
							<td>10156</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0012">BBa_B0012</a></td>
							<td>TE from coliphageT7</td>
							<td>41</td>
							<td>Reshma Shetty</td>
							<td>913</td>
							<td>In stock</td>
							<td>4154</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0014">BBa_B0014</a></td>
							<td>double terminator (B0012-B0011)</td>
							<td>95</td>
							<td>Reshma Shetty</td>
							<td>357</td>
							<td>In stock</td>
							<td>4662</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B1006">BBa_B1006</a></td>
							<td>Terminator (artificial, large,&nbsp;%T~&gt;90)</td>
							<td>39</td>
							<td>Haiyao Huang</td>
							<td>207</td>
							<td>In stock</td>
							<td>1859</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0025">BBa_B0025</a></td>
							<td>double terminator (B0015), reversed</td>
							<td>129</td>
							<td>Caitlin Conboy</td>
							<td>99</td>
							<td>In stock</td>
							<td>4033</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_B0011">BBa_B0011</a></td>
							<td>LuxICDABEG (+/-)</td>
							<td>46</td>
							<td>Reshma Shetty</td>
							<td>88</td>
							<td>In stock</td>
							<td>4374</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K731721">BBa_K731721</a></td>
							<td>T7 terminator</td>
							<td>48</td>
							<td>Giacomo Giacomelli, Anna Depetris</td>
							<td>75</td>
							<td>In stock</td>
							<td>8059</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_J63002">BBa_J63002</a></td>
							<td>ADH1 terminator from S. cerevisiae</td>
							<td>225</td>
							<td>Caroline Ajo-Franklin</td>
							<td>66</td>
							<td>It's complicated</td>
							<td>3321</td>
						</tr>
						<tr>
							<td><a href="http://parts.igem.org/wiki/index.php?title=Part:BBa_K2486006">BBa_K2486006</a></td>
							<td>ECK120029600 - Escherichia coli K-12 terminator</td>
							<td>90</td>
							<td>Cau� Westmann and Gabriel Lencioni Lovate</td>
							<td>60</td>
							<td>Not in stock</td>
							<td>2080</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
@endsection

@section('javascript')
@endsection
