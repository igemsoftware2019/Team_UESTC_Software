<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class BlastController extends Controller
{
        // Blast功能
        public function result(Request $request){

            $query = $request->input('query');
            $evalue = $request->input('evalue');
            if($evalue==''){
                $evalue='0.0001';
            }
            // echo $query;
            // echo '<br><br/>';
            // echo $evalue;
            // echo '<br><br/>';
            // echo __File__;
            // echo '<br><br/>';
            // echo $_SERVER['DOCUMENT_ROOT'];
            // echo '<br><br/>';
            // echo $_SERVER['SCRIPT_FILENAME'];
            $root =$_SERVER['DOCUMENT_ROOT'];
            $seqFile = md5(uniqid(rand())) . ".nt";
            $blastResult = $seqFile . ".tabular";//转换文件格式
            file_put_contents("$root/../blast/bin/blastseq/$seqFile", $query);//序列写入文件
            passthru("$root/../blast/bin/blastn -query $root/../blast/bin/blastseq/$seqFile -evalue 0.0001 -db $root/../blast/bin/blast_db -outfmt 6 -out $root/../blast/bin/blastseq/$blastResult",$output);//执行blast
            $blast = fopen("$root/../blast/bin/blastseq/$blastResult", "r");//读取结果文件
            $datas = collect();

            if (filesize("$root/../blast/bin/blastseq/$blastResult")!=0){//
                while ($line = fgets($blast)) {
                    $line_array = explode("\t", $line);
                    if(strpos($line_array[10],'e')==false){
                        $ex='0.0';
                    }
                    else{
                        $e_arr1 = explode('e',$line_array[10]);
                        $ex = round($e_arr1[0]).'e'.round($e_arr1[1]);//site
                    }
                    $array =collect([
                        'igemid'=>$line_array[1],
                        'identity'=>$line_array[2],
                        'align_len'=>$line_array[3],
                        'site'=>$line_array[8]."--".$line_array[9],
                        'bitscore'=>str_replace(array("\n"),"",$line_array[11]),
                        'ex'=>$ex
                    ]);
                    $datas->push($array);
                }
                $datas = $datas->sortByDesc('identity');
                // return view('result',[$collection]);
            }
                //删除文件，避免存储过多
            fclose($blast);
            unlink("$root/../blast/bin/blastseq/$seqFile");
            unlink("$root/../blast/bin/blastseq/$blastResult");
            // $datas=$datas->collapse();
            $total_page = count($datas);
            $count = count($datas);
            $total_page = ceil($count/10);
            $p = 1;
            // dd($datas);
            return view('search.SearchBlastPage',[
                'datas'=>$datas,
                'count'=>$count,
                'total_page'=>$total_page,
                'p'=>$p,
                'choose'=>'Blast',
            ]);

        }
}
