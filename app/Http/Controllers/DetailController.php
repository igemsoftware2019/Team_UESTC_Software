<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Biogrid_interaction;
use App\Models\Biogrid_type;
use App\Models\Cite;
use App\Models\Crystallization;
use App\Models\Ecs;
use App\Models\Engineering;
use App\Models\Synonyms;
use App\Models\Parts;
use App\Models\Parts_seq_features;
use App\Models\Igemuni;
use App\Models\Uni;
use App\Models\Uni_db1;
use App\Models\Uni_recommendedname;
use App\Models\Uni_comment;
use App\Models\Uni_feature;
use App\Models\Uni_publications;
use App\Models\Unikegg;
use App\Models\Go;
use App\Models\Ic50value;
use App\Models\Igem_group1;
use App\Models\Igem_pa;
use App\Models\Igem_team;
use App\Models\Igem_to_team;
use App\Models\Igem_tw;
use App\Models\Inhibitors;
use App\Models\Unistr;
use App\Models\Stringa;
use App\Models\Interact;
use App\Models\Kegg1;
use App\Models\Kegg1_ko;
use App\Models\Kegg1_module;
use App\Models\Kegg2;
use App\Models\Kegg2_pathway;
use App\Models\Kegg3;
use App\Models\Kegg3_pathway;
use App\Models\Kegg_reference;
use App\Models\Kmvalue;
use App\Models\Localization;
use App\Models\Metalsions;
use App\Models\Molecularweight;
use App\Models\Organicsolventstability;
use App\Models\Oxidationstability;
use App\Models\Pathway;
use App\Models\Phoptimum;
use App\Models\Phstability;
use App\Models\Pivalue;
use App\Models\Purification;
use App\Models\Reaction;
use App\Models\Recommendedname;
use App\Models\Reference;
use App\Models\Refs;
use App\Models\Sourcetissue;
use App\Models\Specificactivity;
use App\Models\Storagestability;
use App\Models\Substratesproducts;
use App\Models\Temperatureoptimum;
use App\Models\Temperaturerange;
use App\Models\Temperaturestability;
use App\Models\User_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class DetailController extends Controller{

    public function result(Request $request){
        //设置igemid

        $igemid=$request->route('igemid');
        // 获取SBOL所需要的数据
        $sbol_part = parts::where('part_name','=',$igemid)
        ->select('part_id','sequence','short_desc','description','creation_date','part_name')
        ->get();
        $sbol_features = parts_seq_features::where('part_id','=',$sbol_part[0]->part_id)
        ->select('part_id','feature_id','feature_type','start_pos','end_pos','label','reverse')
        ->get();

        // 获取评论
        $igem = Parts::where('part_name','=',$igemid)->get();
        $igem_len = $igem[0]->sequence_length;
        $comments = User_comment::where('igemid','=',$igemid)->get();
        if($comments->isNotempty()){
          $count_cm=count($comments);
          $l=1;
          $pages_cm=ceil($count_cm/3);
        }
        else{
          $pages_cm=NULL;
          $l=0;
          $count_cm=NULL;
        }
        $part_id = $igem[0]->part_id;
        $parts_features = Parts_seq_features::where('part_id','=',$part_id)->get();
        
        //other
        $others = Igem_to_team::where('igemid','=',$igemid)->get();
        if($others->isNotempty()){
          $teamid = $others[0]->teamid;
          $other_ids = Igem_to_team::where('teamid','=',$teamid)->get();
          $teams = Igem_team::where('teamid','=',$teamid)->get();
          $team = $teams[0]->year."_".$teams[0]->team;
        }
        else{
          $other_ids = NULL;
          $team = NULL;
        }

        //twin
        $twins = Igem_tw::where('igemid','=',$igemid)->get();
        if($twins->isNotempty()){
          $twin = $twins[0]->twins;
          $tw_array = explode(";",$twin);
          $tw_num = $twins[0]->num;
        }
        else{
          $tw_array = null;
          $tw_num = 0;
        }
        $Igem_group = Igem_group1::where('igemid','=',$igemid)->get();
        //parameters
        $Igem_pa = Igem_pa::where('igemid','=',$igemid)->get();
        $Igem_pa = $Igem_pa->unique("name","value");

        //catalog
        $catalogs = $igem[0]->categories; 
        $catalog_array = explode("//",$catalogs);

        $unichars = array('ID'=>'uniid','Name'=>'name','Gene'=>'gene_name','Organism'=>'organism');

        $uniids = Igemuni::where('igemid','=',$igemid)->get();//取uniid
            if($uniids->isNotEmpty()){
                $flag=1;//存在uniid
                if(empty($request->route('uniid')))
                {
                $uniid = $uniids[0]->uniid;//取首个uniid
                }
                else{
                    $uniid=$request->route('uniid');
                }
                $uni_num = $uniids->count();
                $color_array = ['#f1f9bf','#a6deed'];
                $z=0;
                //取Uni信息
                $Uni = Uni::where('uniid','=',$uniid)->get();
                if($Uni->isNotempty()){
                  $seq_len = strlen($Uni[0]->sequence);
                  $genename=$Uni[0]->gene_name;
                }
                else{
                  $seq_len=NULL;
                  $genename=NULL;
                }
                $fullname = Uni_recommendedname::where('uniid','=',$uniid)->get();
                $uni_comments = Uni_comment::where('uniid','=',$uniid)->get();
                
               
        
                //Feature部分
                $uni_features = Uni_feature::where('uniid','=',$uniid)->get();

                //Cross Reference部分
                $uni_cross = Uni_db1::where('uniid','=',$uniid)->get();
        
                //Publication部分
                $uni_publications = Uni_publications::where('uniid','=',$uniid)->get();
              
                $i=0;$j=0;//计数变量
                
                $m=0;$n=0;//kegg3_reference计数变量
                $u=0;$v=0;//kegg1_reference计数变量

                $x=0;$y=0;//brenda_reference计数变量
                //Kegg部分
                $keggids = Unikegg::where('uniid','=',$uniid)->get();
                if($keggids->isNotEmpty()){
                    $kegg_flag=1;//存在uniid和keggid
                    $keggid = $keggids[0]->keggid;

                    $kegg1 = Kegg1::where('keggid','=',$keggid)->get();

                    $kegg1_module= Kegg1_module::where('keggid','=',$keggid)->get();

                    $kegg1_reference = Kegg_reference::where('kke','=',$keggid)->get();

                    //ko
                    $koids = Kegg1_ko::where('keggid','=',$keggid)->get();
                    if($koids->isNotEmpty()){
                        $ko_flag=1;
                        $koid = $koids[0]->koid;
                        
                        $kegg2 = Kegg2::where('koid','=',$koid)->get();

                        $kegg2_pathways = Kegg2_pathway::where('koid','=',$koid)->get();
                    }
                    else{
                        $ko_flag=0;
                        $kegg2 = NULL;
                        $kegg2_pathways=NULL;
                    }
                //EC部分
                $ecs = Ecs::where('id','=',$keggid)->get();
                $organism = array();
                    if($ecs->isNotEmpty()){
                        $ec_flag=1;
                        $ecn = $ecs[0]->ecnumber;

                        //enzyme
                        $Recommendedname = Recommendedname::where('ecnumber','=',$ecn)->get();
                        $Reaction = Reaction::where('ecnumber','=',$ecn)->get();
                        $Reaction = $Reaction->unique('reaction');//去重
                  //Brenda
                  $Synonyms = Synonyms::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Synonyms->pluck('organism')->toArray());

                  $Temperatureoptimum = Temperatureoptimum::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Temperatureoptimum->pluck('organism')->toArray());

                  $Temperaturerange = Temperaturerange::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Temperaturerange->pluck('organism')->toArray());
                                      
                  $Temperaturestability = Temperaturestability::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Temperaturestability->pluck('organism')->toArray());

                  $Phoptimum = Phoptimum::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Phoptimum->pluck('organism')->toArray());

                  $Phstability = Phstability::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Phstability->pluck('organism')->toArray());

                  $Molecularweight = Molecularweight::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Molecularweight->pluck('organism')->toArray());

                  $Pivalue = Pivalue::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Pivalue->pluck('organism')->toArray());

                  $Engineering = Engineering::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Engineering->pluck('organism')->toArray());

                  $Application = Application::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Application->pluck('organism')->toArray());

                  $Specificactivity = Specificactivity::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Specificactivity->pluck('organism')->toArray());

                  $Sourcetissue = Sourcetissue::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Sourcetissue->pluck('organism')->toArray());
                  

                  $Crystal = Crystallization::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Crystal->pluck('organism')->toArray());

                  $Purification = Purification::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Purification->pluck('organism')->toArray());

                  $Storagestability = Storagestability::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Storagestability->pluck('organism')->toArray());

                  $Oxidationstability = Oxidationstability::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Oxidationstability->pluck('organism')->toArray());

                  $Organicsolventstability = Organicsolventstability::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Organicsolventstability->pluck('organism')->toArray());


                  $Localization = Localization::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Localization->pluck('organism')->toArray());

                  $Kmvalue = Kmvalue::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Kmvalue->pluck('organism')->toArray());

                  $Metalsions = Metalsions::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Metalsions->pluck('organism')->toArray());

                  $Ic50value = Ic50value::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Ic50value->pluck('organism')->toArray());

                  $Pathway = Pathway::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Pathway->pluck('organism')->toArray());

                  $Inhibitors = Inhibitors::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Inhibitors->pluck('organism')->toArray());

                  $Substratesproducts = Substratesproducts::where('ecnumber','=',$ecn)->get();
                  $organism = array_merge($organism,$Substratesproducts->pluck('organism')->toArray());

                  $organism = array_unique($organism);
                  sort($organism);

                    $References = Reference::where('ecnumber','=',$ecn)->get();

                    //ExplorEnz
                    $Cites = Cite::where('ec_num','=',$ecn)->get();
                    $Refs=array();
                      foreach($Cites as $Cite){
                        $cite_key = $Cite->cite_key;
                        $ref = Refs::where('cite_key','=',$cite_key)->get();
                        $ref->toArray();
                        array_push($Refs,$ref);
                    }
                    $a=0;$b=0;

                    $kegg3 = Kegg3::where('ecnumber','=',$ecn)->get();
                    if($kegg3->isNotempty()){
                        $kegg3_pathways = Kegg3_pathway::where('ecnumber','=',$ecn)->get();
                        $kegg3_references = Kegg_reference::where('kke','=',$ecn)->get();
                      }
                     else{
                       $kegg3=NULL;
                       $kegg3_pathways=NULL;
                       $kegg3_references=NULL;
                     }
                    }
                    else{
                        $ec_flag=0;
                        $ecn=NULL;
                        $Recommendedname=NULL;
                        $Reaction=NULL;
                        $kegg3=NULL;
                        $kegg3_pathways=NULL;
                        $kegg3_references=NULL;
                        $Crystal = NULL;
                        $Purification = NULL;
                        $Storagestability = NULL;
                        $Organicsolventstability=NULL;
                        $Oxidationstability=NULL;
                        $Localization = NULL;
                        $Kmvalue = NULL;
                        $Metalsions = NULL;
                        $Ic50value = NULL;
                        $Pathway = NULL;
                        $Inhibitors = NULL;
                        $Substratesproducts = NULL;
                        $Synonyms = NULL;
                        $Temperatureoptimum = NULL;
                        $Temperaturerange = NULL;
                        $Temperaturestability = NULL;
                        $Phoptimum = NULL;
                        $Phstability = NULL;
                        $Molecularweight = NULL;
                        $Pivalue = NULL;
                        $Engineering = NULL;
                        $Application = NULL;
                        $Specificactivity = NULL;
                        $Sourcetissue = NULL;
                        $References = NULL;
                        $Refs=NULL;
                        $a=0;$b=0;
                    }
                }
                else
                {
                    $kegg_flag=0;//存在uniid，无keggid
                }
                

                //Go部分
                $Gos = Go::where('uniid','=',$uniid)->get();
                if($Gos->isNotempty()){
                  $count=count($Gos);
                  $p=1;
                  $pages=ceil($count/5);
                }
                else{
                  $pages=NULL;
                  $p=0;
                  $count=NULL;
                }
                //取strid
                $strids = Unistr::where('uniid','=',$uniid)->get();
                if($strids->isNotEmpty()){
                    $str_flag=1;
                    $strid = $strids[0]->strid;
                    //string
            //     $datas1 = Igemuni::where('igemid', '=', $igemid)->get();
            //     $datas2 = collect();

            // foreach ($datas1 as $obj) {
            //     $datas2=$datas2->concat($obj->uni()->get());

            // }
            $datas2=$Uni;

            $data=collect();
            //生成主节点
           $datas3 = collect();
            foreach ($datas2 as $obj) {
                if($obj->namea){
                  $Stringa = Stringa::where('strid','=',$obj->strid)->get();
                  if($Stringa->isNotempty()){
                  $datamain = collect([
                    "data"=>[
                      "id"=> $obj->strid,
                      "igemid"=>$igemid,
                      "name"=> $obj->namea,
                      "score"=> 0.7,
                      "information"=> $Stringa[0]->annotation,
                      "query"=>true,
                      "gene"=>true,
                      "group"=>"center"
                    ],
                    "group"=>"nodes",
                    "removed"=>false,
                    "selected"=>false,
                    "selectable"=>true,
                    "locked"=>false,
                    "grabbed"=>false,
                    "grabbable"=>true,
                ]);
                  }
                else{
                  $datamain = collect([
                    "data"=>[
                      "id"=> $obj->strid,
                      "igemid"=>$igemid,
                      "name"=> $obj->namea,
                      "score"=> 0.7,
                      "information"=> NULL,
                      "query"=>true,
                      "gene"=>true,
                      "group"=>"center"
                    ],
                    "group"=>"nodes",
                    "removed"=>false,
                    "selected"=>false,
                    "selectable"=>true,
                    "locked"=>false,
                    "grabbed"=>false,
                    "grabbable"=>true,
                ]);
                }
                $data=$data->push($datamain);
                }

                $datas3=$datas3->concat($obj->score()->get());
            }


            //生成除了主节点以外的节点
            foreach ($datas3 as $obj) {
                $Stringa = Stringa::where('strid','=',$obj->idb)->get();
                // 得到子节点对应的igemid
                $str_datas=array();
                $str_data="";
                $str_unistrs = Unistr::where('strid','=',$obj->idb)->get();
                foreach($str_unistrs as $obj2){
                  $str_igem = Igemuni::where('uniid','=',$obj2->uniid)->get();
                  foreach($str_igem as $obj1){
                    if (!in_array($obj1->igemid,$str_datas)){
                      $str_datas[]=$obj1->igemid;
                      $str_data=$str_data."<br/>".$obj1->igemid;
                  }
                }
              }
                if($Stringa->isNotempty()){
                $dataobj=collect([
                    "data"=>[
                      "id"=> $obj->idb,
                      "igemid"=> $str_data,
                      "name"=> $obj->nameb,
                      "score"=> 0.3,
                      "information"=> $Stringa[0]->annotation,
                      "query"=>true,
                      "gene"=>true,
                      "group"=>"other",
                    ],
                    "group"=>"nodes",
                    "removed"=>false,
                    "selected"=>false,
                    "selectable"=>true,
                    "locked"=>false,
                    "grabbed"=>false,
                    "grabbable"=>true,
                ]);
                }
                else{
                  $dataobj=collect([
                    "data"=>[
                      "id"=> $obj->idb,
                      "igemid"=> $str_data,
                      "name"=> $obj->nameb,
                      "score"=> 0.3,
                      "information"=> NULL,
                      "query"=>true,
                      "gene"=>true,
                      "group"=>"other",
                    ],
                    "group"=>"nodes",
                    "removed"=>false,
                    "selected"=>false,
                    "selectable"=>true,
                    "locked"=>false,
                    "grabbed"=>false,
                    "grabbable"=>true,
                ]);
                }
                $data =$data->push($dataobj);
                $edgedatas=collect();
                $edgedatas = $edgedatas->concat([
                    'nscore',
                    'fscore',
                    'pscore',
                    'ascore',
                    'escore',
                    'dscore',
                    'tscore']);
                foreach($edgedatas as $edgedata){
                    if($obj->$edgedata!=0){
                        $edgeobj =collect([
                            "data"=>[
                              "source"=>$obj->strid,
                              "target"=>$obj->idb,
                              "weight"=>0.106598906,
                              "group"=>$edgedata,
                              "networkId"=>903,
                              "networkGroupId"=>22,
                              "intn"=>true,
                              "rIntnId"=>361,
                              "score"=>$obj->score,
                              "nscore"=>$obj->nscore,
                              "fscore"=>$obj->fscore,
                              "pscore"=>$obj->pscore,
                              "ascore"=>$obj->ascore,
                              "escore"=>$obj->escore,
                              "dscore"=>$obj->dscore,
                              "tscore"=>$obj->tscore
                            ],
                            "position"=>"",
                            "group"=>"edges",
                            "removed"=>false,
                            "selected"=>false,
                            "selectable"=>true,
                            "locked"=>false,
                            "grabbed"=>false,
                            "grabbable"=>true,
                            "classes"=>""
                        ]);
                        $data =$data->push($edgeobj);
                    }
                }
            }


            //测试输出数据格式
            // return view('uploads.uploads',[
            //     'datas'=>$datas3,
            //     'data'=>$data,
            //   ]);

              //定义样式
            $style=collect([
                [
                    "selector"=>"core",
                    "style"=>[
                      "selection-box-color"=>"#AAD8FF",
                      "selection-box-border-color"=>"#8BB0D0",
                      "selection-box-opacity"=>"0.5"
                    ]
                ], [
                    "selector"=> "node",
                    "style"=>[
                      "width"=>"mapData(score, 0, 0.006769776522008331, 20, 60)",
                      "height"=>"mapData(score, 0, 0.006769776522008331, 20, 60)",
                      "content"=>"data(name)",
                      "font-size"=>"18px",
                      "text-valign"=>"center",
                      "text-halign"=>"center",
                 
                      "text-outline-color"=>"#555",
                      "text-outline-width"=>"2px",
                      "color"=>"#fff",
                      "overlay-padding"=>"6px",
                      "z-index"=>"10"
                    ]
                    ],[
                    "selector"=>"node[group=\"center\"]",
                    "style"=>[
                      "background-color"=>"#6d7ce8",
                    ]
                    ],[
                    "selector"=>"node[group=\"other\"]",
                    "style"=>[
                      "background-color"=>"#c8e0ff",
                    ]
                    ],[
                    "selector"=>"node[?attr]",
                    "style"=>[
                      "shape"=>"rectangle",
                      "background-color"=>"#aaa",
                      "text-outline-color"=>"#aaa",
                      "width"=>"16px",
                      "height"=>"16px",
                      "font-size"=>"6px",
                      "z-index"=>"1"
                    ]
                    ], [
                    "selector"=>"node[?query]",
                    "style"=>[
                      "background-clip"=>"none",
                      "background-fit"=>"contain"
                    ]
                    ], [
                    "selector"=>"node:selected",
                    "style"=>[
                      "border-width"=>"6px",
                      "border-color"=>"#AAD8FF",
                      "border-opacity"=>"0.5",
                      "background-color"=>"#6495ed",
                      "text-outline-color"=>"#77828C"
                    ]
                  ], [
                    "selector"=>"edge",
                    "style"=>[
                      "curve-style"=>"haystack",
                      "haystack-radius"=>"0.5",
                      "opacity"=>"0.4",
                      "line-color"=>"black",
                      "width"=>"mapData(weight, 0, 1, 1, 8)",
                      "overlay-padding"=>"3px"
                    ]
                    ], [
                    "selector"=>"node.unhighlighted",
                    "style"=>[
                      "opacity"=>"0.2"
                    ]
                    ], [
                    "selector"=>"edge.unhighlighted",
                    "style"=>[
                      "opacity"=>"0.05"
                    ]
                    ], [
                    "selector"=>".highlighted",
                    "style"=>[
                      "z-index"=>"999999"
                    ]
                    ], [
                    "selector"=>"node.highlighted",
                    "style"=>[
                      "border-width"=>"6px",
                      "border-color"=>"#AAD8FF",
                      "border-opacity"=>"0.5",
                      "background-color"=>"#394855",
                      "text-outline-color"=>"#394855"
                    ]
                    ], [
                    "selector"=>"edge.filtered",
                    "style"=>[
                      "opacity"=>"0"
                    ]
                    ],[
                    "selector"=>"edge[group=\"score\"]",
                    "style"=>[
                      "line-color"=>"#d0b7d5"
                    ]
                    ],[
                    "selector"=>"edge[group=\"nscore\"]",
                    "style"=>[
                      "line-color"=>"#a0b3dc"
                    ]
                    ],[
                    "selector"=>"edge[group=\"fscore\"]",
                    "style"=>[
                      "line-color"=>"#90e190"
                    ]
                    ],[
                    "selector"=>"edge[group=\"pscore\"]",
                    "style"=>[
                      "line-color"=>"#9bd8de"
                    ]
                    ],[
                    "selector"=>"edge[group=\"ascore\"]",
                    "style"=>[
                      "line-color"=>"yellow"
                    ]
                    ],[
                    "selector"=>"edge[group=\"escore\"]",
                    "style"=>[
                      "line-color"=>"#f6c384"
                    ]
                    ], [
                    "selector"=>"edge[group=\"dscore\"]",
                    "style"=>[
                      "line-color"=>"#dad4a2"
                    ]
                    ],[
                    "selector"=>"edge[group=\"tscore\"]",
                    "style"=>[
                      "line-color"=>"#D0D0D0"
                    ]
            ], ]);
                    //interaction
                    $interactions = Interact::where('strid','=',$strid)->get();
                }
                else{
                    $str_flag=0;
                }
                //Biogrid
                $Biogrid_interaction = Biogrid_interaction::where('genname','=',$genename)->get();
                $Biogrid_type = collect();
                $biotype = $Biogrid_interaction->pluck('experimental_system')->toArray();
                $biotype = array_unique($biotype);
                foreach($biotype as $value){
                  $type = $value;
                  $explain = Biogrid_type::where('Type_n','=',$type)->get();
                  $Biogrid_type->push($explain); 
                }
                $g=1;$e=1;//计数变量
                if($kegg_flag==1 && $str_flag==1){
                return view('detail.DetailPage',[
                    'flag'=>$flag,
                    'kegg_flag'=>$kegg_flag,
                    'str_flag'=>$str_flag,
                    'ko_flag'=>$ko_flag,
                    'ec_flag'=>$ec_flag,
                    'igemid'=>$igemid,
                    'igem'=>$igem,
                    'igem_len'=>$igem_len,
                    'count_cm'=>$count_cm,
                    'l'=>$l,
                    'pages_cm'=>$pages_cm,
                    'other_ids'=>$other_ids,
                    'team'=>$team,
                    'tw_array'=>$tw_array,
                    'tw_num'=>$tw_num,
                    'parts_features'=>$parts_features,
                    'Igem_group'=>$Igem_group,
                    'Igem_pa'=>$Igem_pa,
                    'catalog_array'=>$catalog_array,
                    'uniids'=>$uniids,
                    'uniid'=>$uniid,
                    'uni'=>$Uni,
                    'uni_num'=>$uni_num,
                    'color_array'=>$color_array,
                    'z'=>$z,
                    'seq_len'=>$seq_len,
                    'unichars'=>$unichars,
                    'fullname'=>$fullname,
                    'uni_comments'=>$uni_comments,
                    'uni_cross'=>$uni_cross,
                    'uni_features'=>$uni_features,
                    'uni_publications'=>$uni_publications,
                    'i'=>$i,
                    'j'=>$j,
                    'kegg1'=>$kegg1,
                    'kegg1_module'=>$kegg1_module,
                    'kegg1_reference'=>$kegg1_reference,
                    'u'=>$u,'v'=>$v,
                    'kegg2'=>$kegg2,
                    'kegg2_pathways'=>$kegg2_pathways,
                    'ecn'=>$ecn,
                    'Recommendedname'=>$Recommendedname,
                    'Reaction'=>$Reaction,
                    'Synonyms'=>$Synonyms,
                    'Temperatureoptimum'=>$Temperatureoptimum,
                    'Temperaturerange'=>$Temperaturerange,
                    'Temperaturestability'=>$Temperaturestability,
                    'Phoptimum'=>$Phoptimum,
                    'Phstability'=>$Phstability,
                    'Molecularweight'=>$Molecularweight,
                    'Pivalue'=>$Pivalue,
                    'Engineering'=>$Engineering,
                    'Application'=>$Application,
                    'Specificactivity'=>$Specificactivity,
                    'Sourcetissue'=>$Sourcetissue,
                    'Crystal'=>$Crystal,
                    'Purification'=>$Purification,
                    'Storagestability'=>$Storagestability,
                    'Oxidationstability'=>$Oxidationstability,
                    'Organicsolventstability'=>$Organicsolventstability,
                    'Localization'=>$Localization,
                    'Kmvalue'=>$Kmvalue,
                    'Metalsions'=>$Metalsions,
                    'Ic50value'=>$Ic50value,
                    'Pathway'=>$Pathway,
                    'Inhibitors'=>$Inhibitors,
                    'Substratesproducts'=>$Substratesproducts,
                    'organism'=>$organism,
                    'References'=>$References,
                    'x'=>$x,
                    'y'=>$y,
                    'Refs'=>$Refs,
                    'a'=>$a,
                    'b'=>$b,
                    'kegg3'=>$kegg3,
                    'kegg3_pathways'=>$kegg3_pathways,
                    'kegg3_references'=>$kegg3_references,
                    'm'=>$m,
                    'n'=>$n,
                    'Gos'=>$Gos,
                    'count'=>$count,
                    'pages'=>$pages,
                    'p'=>$p,
                    'strids'=>$strids,
                    'data'=>$data,
                    'style'=>$style,
                    'interactions'=>$interactions,
                    'genename'=>$genename,
                    'Biogrid_interaction'=>$Biogrid_interaction,
                    'Biogrid_type'=>$Biogrid_type,
                    'g'=>$g,
                    'e'=>$e,
                    'comments'=>$comments,
                    'sbol_part'=>$sbol_part,
                    'sbol_features'=>$sbol_features,
                    ]);
                }
                elseif($kegg_flag==1 && $str_flag==0){
                    return view('detail.DetailPage',[
                        'flag'=>$flag,
                        'kegg_flag'=>$kegg_flag,
                        'str_flag'=>$str_flag,
                        'ko_flag'=>$ko_flag,
                        'ec_flag'=>$ec_flag,
                        'igemid'=>$igemid,
                        'igem'=>$igem,
                        'igem_len'=>$igem_len,
                        'count_cm'=>$count_cm,
                        'l'=>$l,
                        'pages_cm'=>$pages_cm,
                        'other_ids'=>$other_ids,
                        'team'=>$team,
                        'tw_array'=>$tw_array,
                        'tw_num'=>$tw_num,
                        'parts_features'=>$parts_features,
                        'Igem_group'=>$Igem_group,
                        'Igem_pa'=>$Igem_pa,
                        'catalog_array'=>$catalog_array,
                        'uni'=>$Uni,
                        'uniids'=>$uniids,
                        'uniid'=>$uniid,
                        'uni_num'=>$uni_num,
                        'color_array'=>$color_array,
                        'z'=>$z,
                        'seq_len'=>$seq_len,
                        'unichars'=>$unichars,
                        'fullname'=>$fullname,
                        'str_flag'=>$str_flag, 'uni_comments'=>$uni_comments,
                        'uni_cross'=>$uni_cross,
                        'uni_features'=>$uni_features,
                        'uni_publications'=>$uni_publications,
                        'i'=>$i,
                        'j'=>$j,
                        'kegg1'=>$kegg1,
                        'kegg1_module'=>$kegg1_module,
                        'kegg1_reference'=>$kegg1_reference,
                        'u'=>$u,'v'=>$v,
                        'kegg2'=>$kegg2,
                        'kegg2_pathways'=>$kegg2_pathways,
                        'ecn'=>$ecn,
                        'Recommendedname'=>$Recommendedname,
                        'Reaction'=>$Reaction,
                        'Synonyms'=>$Synonyms,
                        'Temperatureoptimum'=>$Temperatureoptimum,
                        'Temperaturerange'=>$Temperaturerange,
                        'Temperaturestability'=>$Temperaturestability,
                        'Phoptimum'=>$Phoptimum,
                        'Phstability'=>$Phstability,
                        'Molecularweight'=>$Molecularweight,
                        'Pivalue'=>$Pivalue,
                        'Engineering'=>$Engineering,
                        'Application'=>$Application,
                        'Specificactivity'=>$Specificactivity,
                        'Sourcetissue'=>$Sourcetissue,
                        'Crystal'=>$Crystal,
                        'Purification'=>$Purification,
                        'Storagestability'=>$Storagestability,
                        'Oxidationstability'=>$Oxidationstability,
                        'Organicsolventstability'=>$Organicsolventstability,
                        'Localization'=>$Localization,
                        'Kmvalue'=>$Kmvalue,
                        'Metalsions'=>$Metalsions,
                        'Ic50value'=>$Ic50value,
                        'Pathway'=>$Pathway,
                        'Inhibitors'=>$Inhibitors,
                        'Substratesproducts'=>$Substratesproducts,
                        'organism'=>$organism,
                        'References'=>$References,
                        'x'=>$x,
                        'y'=>$y,
                        'Refs'=>$Refs,
                        'a'=>$a,
                        'b'=>$b,
                        'kegg3'=>$kegg3,
                        'kegg3_pathways'=>$kegg3_pathways,
                        'kegg3_references'=>$kegg3_references,
                        'm'=>$m,
                        'n'=>$n,
                        'Gos'=>$Gos,
                        'count'=>$count,
                        'pages'=>$pages,
                        'p'=>$p,
                        'genename'=>$genename,
                        'Biogrid_interaction'=>$Biogrid_interaction,
                        'Biogrid_type'=>$Biogrid_type,
                        'g'=>$g,
                        'e'=>$e,
                        'comments'=>$comments,
                        'sbol_part'=>$sbol_part,
                        'sbol_features'=>$sbol_features,
                        ]);
                }
                elseif($kegg_flag==0 && $str_flag==1){
                    return view('detail.DetailPage',[
                        'flag'=>$flag,
                        'kegg_flag'=>$kegg_flag,
                        'str_flag'=>$str_flag,
                        'igemid'=>$igemid,
                        'igem'=>$igem,
                        'igem_len'=>$igem_len,
                        'count_cm'=>$count_cm,
                        'l'=>$l,
                        'pages_cm'=>$pages_cm,
                        'other_ids'=>$other_ids,
                        'team'=>$team,
                        'tw_array'=>$tw_array,
                        'tw_num'=>$tw_num,
                        'parts_features'=>$parts_features,
                        'Igem_group'=>$Igem_group,
                        'Igem_pa'=>$Igem_pa,
                        'catalog_array'=>$catalog_array,
                        'uni'=>$Uni,
                        'uniids'=>$uniids,
                        'uniid'=>$uniid,
                        'uni_num'=>$uni_num,
                        'color_array'=>$color_array,
                        'z'=>$z,
                        'seq_len'=>$seq_len,
                        'unichars'=>$unichars,
                        'fullname'=>$fullname,
                        'uni_comments'=>$uni_comments,
                        'uni_cross'=>$uni_cross,
                        'uni_features'=>$uni_features,
                        'uni_publications'=>$uni_publications,
                        'i'=>$i,
                        'j'=>$j,
                        'Gos'=>$Gos,
                        'count'=>$count,
                        'pages'=>$pages,
                        'p'=>$p,
                        'strids'=>$strids,
                        'data'=>$data,
                        'style'=>$style,
                        'interactions'=>$interactions,
                        'genename'=>$genename,
                        'Biogrid_interaction'=>$Biogrid_interaction,
                        'Biogrid_type'=>$Biogrid_type,
                        'g'=>$g,
                        'e'=>$e,
                        'comments'=>$comments,
                        'sbol_part'=>$sbol_part,
                        'sbol_features'=>$sbol_features,
                        ]);
                }
                elseif($kegg_flag==0 && $str_flag==0){
                    return view('detail.DetailPage',[
                        'flag'=>$flag,
                        'kegg_flag'=>$kegg_flag,
                        'str_flag'=>$str_flag,
                        'igemid'=>$igemid,
                        'igem'=>$igem,
                        'igem_len'=>$igem_len,
                        'count_cm'=>$count_cm,
                        'l'=>$l,
                        'pages_cm'=>$pages_cm,
                        'other_ids'=>$other_ids,
                        'team'=>$team,
                        'tw_array'=>$tw_array,
                        'tw_num'=>$tw_num,
                        'parts_features'=>$parts_features,
                        'Igem_group'=>$Igem_group,
                        'Igem_pa'=>$Igem_pa,
                        'catalog_array'=>$catalog_array,
                        'uni'=>$Uni,
                        'uniids'=>$uniids,
                        'uniid'=>$uniid,
                        'uni_num'=>$uni_num,
                        'color_array'=>$color_array,
                        'z'=>$z,
                        'seq_len'=>$seq_len,
                        'unichars'=>$unichars,
                        'fullname'=>$fullname,
                        'uni_comments'=>$uni_comments,
                        'uni_cross'=>$uni_cross,
                        'uni_features'=>$uni_features,
                        'uni_publications'=>$uni_publications,
                        'i'=>$i,
                        'j'=>$j,
                        'Gos'=>$Gos,
                        'count'=>$count,
                        'pages'=>$pages,
                        'p'=>$p,
                        'genename'=>$genename,
                        'Biogrid_interaction'=>$Biogrid_interaction,
                        'Biogrid_type'=>$Biogrid_type,
                        'g'=>$g,
                        'e'=>$e,
                        'comments'=>$comments,
                        'sbol_part'=>$sbol_part,
                        'sbol_features'=>$sbol_features,
                        ]);
                }
            }
            else{
                $flag=0;
                $str_flag=0;
                $pages=NULL;
                $p=0;
                $count=NULL;
                $uni_num=0;
                //无uniid
                return view('detail.DetailPage',[
                    'flag'=>$flag,
                    'str_flag'=>$str_flag,
                    'igemid'=>$igemid,
                    'igem'=>$igem,
                    'igem_len'=>$igem_len,
                    'count_cm'=>$count_cm,
                    'l'=>$l,
                    'pages_cm'=>$pages_cm,
                    'other_ids'=>$other_ids,
                    'team'=>$team,
                    'tw_array'=>$tw_array,
                    'tw_num'=>$tw_num,
                    'parts_features'=>$parts_features,
                    'Igem_group'=>$Igem_group,
                    'Igem_pa'=>$Igem_pa,
                    'uni_num'=>$uni_num,
                    'catalog_array'=>$catalog_array,
                    'count'=>$count,
                    'pages'=>$pages,
                    'p'=>$p,
                    'comments'=>$comments,
                    'sbol_part'=>$sbol_part,
                    'sbol_features'=>$sbol_features,
                ]);
            }
        } 
 }