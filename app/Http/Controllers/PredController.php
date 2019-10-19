<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\PromoterSqr;
use App\Jobs\PromoterFile;
use App\Jobs\ECSqr;
use App\Jobs\ECFile;
use App\Models\Index_a;
use App\Models\Index_b;
use App\Models\Final_result_a;
use App\Models\Final_result_b;
use App\Models\Ec_result;

class PredController extends Controller
{
    // 实现prediction的功能块


    // EC功能
    public function ec_sqr(Request $request)
    {
        if($request->isMethod('post')){

            $query = $request->input('query');//query要求非空
            // dd($query);
            $key = md5(uniqid(rand()));
            $target = $key.".fasta";
            ECSqr::dispatch($query,$target);
            return view('prediction.ECPredWaitPage',[
                'key'=>$key,
                'query'=>$query
            ]);
        }


    }

    public function ec_file(Request $request){
        if($request->isMethod('POST')){
            $file = $request->file("file");
            $key = md5(uniqid(rand()));
            $target = $key.".fasta";
            $oriname = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $type = $file->getClientMimeType();
            $realPath = $file->getRealPath();
            $file->getClientSize();
    
    
        
            // $bool = Storage::disk('public')->put($target,file_get_contents($realPath));
            // $root =$_SERVER['DOCUMENT_ROOT'];
            $query=file_get_contents($realPath);
            $line_array = explode("\n",$query);
            array_shift($line_array);
            $query = implode("\n",$line_array);
            // dd($query);
            // 推送到队列异列
            ECSqr::dispatch($query,$target);
            // Storage::disk('public')->delete($target);
            return view('prediction.ECPredWaitPage',[
                'key' => $key,
                'query'=>$query
            ]);
        }
    }

    public function ec_okey(Request $request)
    {
        $key = $request->input('key');
        $datas = Ec_result::where('key','=',$key)->get();
        if ($datas->isNotEmpty()){
            return view('prediction.ECPredResultPage', [
                'datas'=>$datas
            ]);
        }
    }

    public function ec_wait(Request $request)
    {
        if ($request->ajax()) {
            $key = $request->input('key');
            $query=$request->input('query');
            $target = $key.".fasta";
            $result = $target . ".tsv";
            $err= $target.".txt";
            $root =$_SERVER['DOCUMENT_ROOT'];//$root是/www/igemblog
            // 判断进程
            if(filesize("$root/ecpred/$err")!=0)
            {
                   $response=2;//错误情况
                   $url="";
                   unlink("$root/ecpred/$target");
                   unlink("$root/ecpred/$result");
                   unlink("$root/ecpred/$err");
            }
            else{
               if(filesize("$root/ecpred/$result")>=200){
                   $response=1;//正确预测
                   $url=route('ec_okey');//正确预测后将去往结果页面的url传往等待页面
                   $data = file_get_contents("$root/ecpred/$result");
                   $line = explode("\n",$data);
                   if(count($line)==6){
                    $line_array = explode("\t", $line[3]);
                   }
                   else{
                     $line_array = explode("\t",$line[2]);
                     if($line_array[1]=="no Prediction"){
                         $line_array[]=null;
                     }
                   }
                   $ecresult = Ec_result::create([
                       'key'=>$key,
                       'sequence'=>$query,
                       'ecnumber'=>$line_array[1],
                       'score'=>$line_array[2]
                   ]);
                   unlink("$root/ecpred/$target");
                   unlink("$root/ecpred/$result");
                   unlink("$root/ecpred/$err");
               }
               else{
                   $response=0;//预测尚未完成
                   $url="";
               }
            }

            // 回传给视图层的ajax数据
            return [
                'key'=>$key,
                'url'=>$url,
                'response'=>$response
            ];
        }
    }







    // 以下实现启动子预测

    //输入框处理
    public function promoter_sqr(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $species = $request->input('species');
            $input_seq = $request->input('query');
            $key = date("YmdHis");
            // 推送到队列异步执行
            PromoterSqr::dispatch($species,$input_seq,$key);
            return view('prediction.PromoterWaitPage',[
                'key' => $key,
                'species'=>$species
            ]);

                
            }
    }

    //文件上传
    public function promoter_file(Request $request)
    {
        if($request->isMethod('POST')){
            $file = $request->file("file");
            $species = $request->input('species');
            $key = date("YmdHis");
            $oriname = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $type = $file->getClientMimeType();
            $realPath = $file->getRealPath();
            $file->getClientSize();
    
    
            $filename = $key."."."$ext";
        
            $bool = Storage::disk('public')->put($filename,file_get_contents($realPath));
            // 推送到队列异步执行
            PromoterFile::dispatch($species,$key);
            return view('prediction.PromoterWaitPage',[
                'key' => $key,
                'species'=>$species
            ]);
        }  

    }



    //输出页面  
    public function promoter_okey(Request $request)
    { 
        $key = $request->input('key');
        // dd($key);
        $judge = 0;
        $viewer_1 = Index_a::where('key_a' ,'=', $key)
                            ->get()
                            ->toArray();//转化成数组,便于判断！！
        $viewer_2 = Index_b::where('key_a' ,'=', $key)
                            ->get()
                            ->toArray();//转化成数组,便于判断！！
                            
        if (!($viewer_1)&&(!$viewer_2))
        {
            return view('prediction.PromoterResultPage',[
                'judge' =>$judge
            ]);
        }
        elseif($viewer_1)
        {
            $viewr = Index_a::where('key_a' ,'=', $key)
                            ->get();
                        
            $optim = Final_result_a::where('key_a','=',$key)
                            ->get();
            
            $len = count($optim);
            $judge = 1;
            return view('prediction.PromoterResultPage',[
                'key' => $key,
                'viewr' => $viewr,
                'optim' => $optim,
                'judge' => $judge,
                'len' => $len
            ]);
        }
        elseif($viewer_2)
        {
            $viewr = Index_b::where('key_a' ,'=', $key)
                            ->get();
                        
            $optim = Final_result_b::where('key_a','=',$key)
                            ->get();
            
            $len = count($optim);
            $judge = 2;
            return view('prediction.PromoterResultPage',[
                'key' => $key,
                'viewr' => $viewr,
                'optim' => $optim,
                'judge' => $judge,
                'len' => $len
            ]);
        }
           
    }






    // 等待功能
    public function promoter_wait(Request $request){
        if ($request->ajax()) {
            $key = $request->input('key');//结果文件的文件名，用此变量读取结果文件
            $species = $request->input('species');//报错文件的文件名,用此文件读取错误信息
            // 判断进程
            if (in_array($species,['Human','Mouse','Arabis'])){
                $data = Index_a::where('key_a','=',$key)->get();
            }
            else{
                $data = Index_b::where('key_a','=',$key)->get();
            }


            if($data->isNotEmpty()){
                $response=1;
                $url=route('promoter_okey');
                $key1 = $key.'_1.txt';
                $key2 = $key.'_2.txt';
                $root =$_SERVER['DOCUMENT_ROOT'];
                unlink("$root/web_prom/file/$key1");
                unlink("$root/web_prom/file/$key2");
                Storage::disk('public')->delete($key.'.fasta');
            }
            else{
                $response=0;
                $url="";
            }
            return [
                'key'=>$key,
                'species'=>$species,
                'response'=>$response,
                'url'=>$url
            ];
        }
    }




}

