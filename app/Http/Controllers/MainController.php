<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\es\Parts_es;
use App\Models\es\Regulondb_es;
use App\Models\es\Unigene_es;
use App\Models\es\Epd_es;
use App\Models\es\Team_es;
use App\Models\Igemepd;
use App\Models\Igemuni;
use App\Models\Parts_recom;
use App\Models\Igem_team;

class MainController extends Controller
{



    public function home(){
        return view('main.MainPage');
    }

    public function search(Request $request){
        if ($request->isMethod('get')){
            return view('search.SearchPage');
        }

    }

    // 主搜索功能
    public function searchafter(Request $request){

        // 测试searchafter的状况
        if ($request->isMethod('get')){
            return view('search.SearchAfterPage');
        }



        if ($request->isMethod('post')){
            $keyword = $request->input('keyword');
            $type = $request->input('type');
            if ($request->session()->has('part_name')) {
                //
                $request->session()->forget('part_name');
            }

            // 用户选择搜索IGEM_ID时
            if($type=='iGEM_ID'|| $type==null){
                $datas1 = Parts_es::search('igemid:*'.$keyword."*")->paginate(1000)->items();
                $datas = collect();
                foreach($datas1 as $obj){
                    $data = Parts_recom::where('part_name','=',$obj->igemid)->get();
                    $datas->push($data);
                }
                $datas=$datas->collapse();
                $count = count($datas);
                $total_page = ceil($count/10);
                $p = 1;

                // 缓存数据到会话
                foreach($datas as $data){
                    $request->session()->push('part_name', $data['part_name']);
                }
                return view('search.SearchAfterPage',[
                    'datas'=>$datas,
                    'count'=>$count,
                    'total_page'=>$total_page,
                    'p'=>$p,
                    "part_use" => 5,
                    "word_amount" => 5,
                    "reference_amount" => 5,
                    "submit_time" => 5,
                    "types"=>'all',
                    "choose"=>'Recommended',
                ]);

            }

            // 用户选择搜索Epd_ID时
            if($type=='Epd_ID'){
                $datas1 = Epd_es::search('epdid:'.$keyword."*")->paginate(1000)->items();
                $datas2 = collect();
                $datas = collect();

                foreach($datas1 as $obj){
                    $data = Igemepd::where('epdid','=',$obj->epdid)->get();
                    $datas2->push($data);
                }
                $datas2=$datas2->collapse();
                foreach($datas2 as $obj){
                    $data = Parts_recom::where('part_name','=',$obj->igemid)->get();
                    $datas->push($data);
                }
                $datas=$datas->collapse();
                $count = count($datas);
                $total_page = ceil($count/10);
                $p = 1;

                // 缓存数据到会话
                foreach($datas as $data){
                    $request->session()->push('part_name', $data['part_name']);
                }

                return view('search.SearchAfterPage',[
                    'datas'=>$datas,
                    'count'=>$count,
                    'total_page'=>$total_page,
                    'p'=>$p,
                    "part_use" => 5,
                    "word_amount" => 5,
                    "reference_amount" => 5,
                    "submit_time" => 5,
                    "types"=>'all',
                    "choose"=>'Recommended',
                ]);
            }


            // 用户选择搜索Uniprot_ID时
            if($type=='UniProt_ID'){
                $datas1 = Unigene_es::search('uniid:'.$keyword."*")->paginate(1000)->items();
                $datas2 = collect();
                $datas = collect();

                foreach($datas1 as $obj){
                    $data = Igemuni::where('uniid','=',$obj->uniid)->get();
                    $datas2->push($data);
                }
                $datas2=$datas2->collapse();
                foreach($datas2 as $obj){
                    $data = Parts_recom::where('part_name','=',$obj->igemid)->get();
                    $datas->push($data);
                }
                $datas=$datas->collapse();
                $count = count($datas);
                $total_page = ceil($count/10);
                $p = 1;

                // 缓存数据到会话
                foreach($datas as $data){
                    $request->session()->push('part_name', $data['part_name']);
                }

                return view('search.SearchAfterPage',[
                    'datas'=>$datas,
                    'count'=>$count,
                    'total_page'=>$total_page,
                    'p'=>$p,
                    "part_use" => 5,
                    "word_amount" => 5,
                    "reference_amount" => 5,
                    "submit_time" => 5,
                    "types"=>'all',
                    "choose"=>'Recommended',
                ]);
            }

            // 用户选择搜索Gene_Name时
            if($type=='Gene_Name'){
                $datas1 = Unigene_es::search('gene_name:'.$keyword."*")->paginate(1000)->items();
                $datas2 = collect();
                $datas = collect();

                foreach($datas1 as $obj){
                    $data = Igemuni::where('uniid','=',$obj->uniid)->get();
                    $datas2->push($data);
                }
                $datas2=$datas2->collapse();
                foreach($datas2 as $obj){
                    $data = Parts_recom::where('part_name','=',$obj->igemid)->get();
                    $datas->push($data);
                }
                $datas=$datas->collapse();

                $count = count($datas);
                $total_page = ceil($count/10);
                $p = 1;

                // 缓存数据到会话
                foreach($datas as $data){
                    $request->session()->push('part_name', $data['part_name']);
                }


                return view('search.SearchAfterPage',[
                    'datas'=>$datas,
                    'count'=>$count,
                    'total_page'=>$total_page,
                    'p'=>$p,
                    "part_use" => 5,
                    "word_amount" => 5,
                    "reference_amount" => 5,
                    "submit_time" => 5,
                    "types"=>'all',
                    "choose"=>'Recommended',
                ]);
            }

            // 用户选择搜索Keyword时
            if($type=='Keyword'){
                $datas1 = Parts_es::search('te:*'.$keyword."*")->paginate(1000)->items();
                $datas = collect();
                foreach($datas1 as $obj){
                    $data = Parts_recom::where('part_name','=',$obj->igemid)->get();
                    $datas->push($data);
                }
                $datas=$datas->collapse();
                $count = count($datas);
                $total_page = ceil($count/10);
                $p = 1;


                // 缓存数据到会话
                foreach($datas as $data){
                    $request->session()->push('part_name', $data['part_name']);
                }

                return view('search.SearchAfterPage',[
                    'datas'=>$datas,
                    'count'=>$count,
                    'total_page'=>$total_page,
                    'p'=>$p,
                    "part_use" => 5,
                    "word_amount" => 5,
                    "reference_amount" => 5,
                    "submit_time" => 5,
                    "types"=>'all',
                    "choose"=>'Recommended',
                ]);
            }


        }




    }

    public function teamsearch(Request $request){
        if ($request->isMethod('post')){
            // dd($request->all());
            if ($request->input('type')=='keyword'){
                $keyword = $request->input('keyword');
                // 获取数据
                $datas1 = Team_es::search('te:*'.$keyword."*")->paginate(10000)->items();
                $datas2 = collect();
                $datas = collect();
                foreach($datas1 as $obj){
                    $teamid= $obj->teamid;
                    $datas2->push($teamid);
                    }
                foreach($datas2 as $obj){
                    $data = Igem_team::where('teamid','=',$obj)->get();
                    $datas->push($data);
                    }
                
                $datas=$datas->collapse();
                $root =$_SERVER['DOCUMENT_ROOT'];
                return view('teamwiki.TeamWikiPage',[
                    'datas'=>$datas,
                    'root'=>$root,
                ]);
            }
            else {
                $name = $request->input('keyword');
                $change=['-'=>' ','_'=>' '];
                $name = strtr($name,$change);
                // dd($name);
                // 获取数据
                $datas1 = Team_es::search('team:*'.$name.'*')->paginate(10000)->items();
                $datas2 = collect();
                $datas = collect();
                foreach($datas1 as $obj){
                    $teamid= $obj->teamid;
                    $datas2->push($teamid);
                    }
                foreach($datas2 as $obj){
                    $data = Igem_team::where('teamid','=',$obj)->get();
                    $datas->push($data);
                    }
                $datas=$datas->collapse();
                $root =$_SERVER['DOCUMENT_ROOT'];
                return view('teamwiki.TeamWikiPage',[
                    'datas'=>$datas,
                    'root'=>$root,
                ]);
                // $user = Auth::user()->name;
            }
        }
    }

    public function prediction(Request $request){
        if ($request->isMethod('get')){
            return view('prediction.PredictionPage');
        }
    }



    public function tools(Request $request){
        if ($request->isMethod('get')){
            return view('tools.ToolsPage');
        }
    }


    public function catalog(Request $request){
        if ($request->isMethod('get')){
            return view('catalog.CatalogPage1');
        }
    }


    public function catalog2(Request $request){
        if ($request->isMethod('get')){
            return view('catalog.CatalogPage2');
        }
    }


    public function catalog3(Request $request){
        if ($request->isMethod('get')){
            return view('catalog.CatalogPage3');
        }
    }


    public function sbol(Request $request){
        if ($request->isMethod('get')){
            return view('sbol.SBOLPage');
        }
    }

    public function download(Request $request){
        if ($request->isMethod('get')){
            return view('download.DownloadPage');
        }
    }

    public function test(Request $request){
        dd('ok');
    }


    public function best(Request $request){
    	// dd($request->all());
        $ids = $request->session()->get('part_name');
        $types = $request->input('type');
        $part_use=$request->input('part_use');
        $word_amount=$request->input('word_amount');
        $reference_amount=$request->input('reference_amount');
        $submit_time=$request->input('submit_time');
        $collection = collect();
        $datas1 = collect();
        $datas = collect();

        // 获得数据
        foreach($ids as $id){
            $weight = Parts_recom::where('part_name','=',$id)->get();
            $score = $part_use*($weight[0]->part_use)+$word_amount*($weight[0]->word_amount)+$reference_amount*($weight[0]->reference_amount)+$submit_time*($weight[0]->submit_time);
            $weight=$weight->toArray();
            $weight[0]['score']=$score;
            $datas1->push($weight);
        }
        $datas1=$datas1->collapse();
        foreach($datas1 as $obj){
            if (in_array($obj['type'],$types)){
                $datas->push($obj);
            }
        }
        $datas = $datas->sortByDesc('score');
        $count = count($datas);
        $total_page = ceil($count/10);
        $p = 1;
        return view('search.SearchAfterPage',[
            'datas'=>$datas,
            'count'=>$count,
            'total_page'=>$total_page,
            'p'=>$p,
            "part_use" => $part_use,
            "word_amount" => $word_amount,
            "reference_amount" => $reference_amount,
            "submit_time" => $submit_time,
            "types"=>$types,
            "choose"=>'Best match',
            ]);
    }

    public function type(Request $request){
        $ids = $request->session()->get('part_name');
        $types = $request->input('type');
        $part_use=$request->input('part_use');
        $word_amount=$request->input('word_amount');
        $reference_amount=$request->input('reference_amount');
        $submit_time=$request->input('submit_time');
        $datas = collect();
        // 获得数据
        foreach($ids as $id){
            $data = Parts_recom::where('part_name','=',$id)->get();
            if (in_array($data[0]->type,$types)){
                $datas->push($data);
            }

        }
        $datas=$datas->collapse();
        $count = count($datas);
        $total_page = ceil($count/10);
        $p = 1;
        return view('search.SearchAfterPage',[
            'datas'=>$datas,
            'count'=>$count,
            'total_page'=>$total_page,
            'p'=>$p,
            "part_use" => $part_use,
            "word_amount" => $word_amount,
            "reference_amount" => $reference_amount,
            "submit_time" => $submit_time,
            "types"=>$types,
            "choose"=>'Best match',
            ]);

    }

    public function recommended(Request $request){
        $ids = $request->session()->get('part_name');
        $datas = collect();
        // 获得数据
        foreach($ids as $id){
            $data = Parts_recom::where('part_name','=',$id)->get();
            $datas->push($data);

        }
        $datas=$datas->collapse();
        $count = count($datas);
        $total_page = ceil($count/10);
        $p = 1;
        return view('search.SearchAfterPage',[
            'datas'=>$datas,
            'count'=>$count,
            'total_page'=>$total_page,
            'p'=>$p,
            "part_use" => 5,
            "word_amount" => 5,
            "reference_amount" => 5,
            "submit_time" => 5,
            "types"=>'all',
            "choose"=>'Recommended',
        ]);
    }



}
