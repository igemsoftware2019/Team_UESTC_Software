<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ECSqr implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $query;
    protected $target;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($query,$target)
    {
        //
        $this->query=$query;
        $this->target=$target;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $query = $this->query;
        $target=$this->target;
        // 以下功能需要调试
        $root =$_SERVER['DOCUMENT_ROOT'];
        // $root变量在服务器上等同于“/www/igemblog”
        $result = $target . ".tsv";
        $err= $target.".txt";
        file_put_contents("$root/ecpred/$target", ">$target"."\n".$query);//生成fasta文件
        passthru("java -jar /home/igem/yhy/ECPred/ECPred.jar weighted $root/ecpred/$target /home/igem/yhy/ECPred/ /home/igem/yhy/ECPred/temp/ 1>$root/ecpred/$result 2>$root/ecpred/$err &", $output);//执行
    }
}
