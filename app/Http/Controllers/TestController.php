<?php
namespace App\Http\Controllers;

use App\Ec_result;
use App\Parts_es;
use App\Parts_recom;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller{
    public function test(){
        return view('sao');
    }
    public function hape(){
        // $url = Storage::url('file/DetailController.php');
        // $a = Storage::delete("file/DetailController.php");
        // $a = Storage::disk('local')->has("public/.gitignore");
        return Storage::disk('s3')->download('file/DetailController.php');
        // return view("sao",["url"=>$url]);
    }
    public function result(Request $request){
        $data = $request->input('igemid');
        $part_use=$request->input('part_use');
        $word_ammount=$request->input('word_ammount');
        $reference_ammount=$request->input('reference_ammount');
        $submit_time=$request->input('submit_time');
        $array = explode(",",$data); 
        array_shift($array);
        $collection = collect();
        foreach($array as $value){
            $weight=Parts_recom::where('igemid','=',$value)->get();
            $score = $part_use*($weight[0]->part_use)+$word_ammount*($weight[0]->word_ammount)+$reference_ammount*($weight[0]->reference_ammount)+$submit_time*($weight[0]->submit_time);
            // $parts= Parts_es::where('igemid','=',$value)->get();
            $arr = [
                'igemid'=>$value,
                'score'=>$score
            ];
            $collection->push($arr);
        }
        $res = $collection->sortByDesc('score');
        dd($res);
    }
}