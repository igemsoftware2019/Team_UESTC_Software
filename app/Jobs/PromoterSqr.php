<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;


class PromoterSqr implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $species;
    protected $input_seq;
    protected $key;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($species,$input_seq,$key)
    {
        //
        $this->species=$species;
        $this->input_seq=$input_seq;
        $this->key=$key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $species = $this->species;
        $input_seq = $this->input_seq;
        $root =$_SERVER['DOCUMENT_ROOT'];
        $len = strlen($input_seq);
        $key = $this->key;
        $key1 = $key.'_1.txt';
        $key2 = $key.'_2.txt';

            if (in_array($species,['Human','Mouse','Arabis']))
            {
                    $choose = 0;
                    $result = exec("python $root/web_prom/Web_Prom.py {$choose} {$species} {$input_seq} {$key} 1>$root/web_prom/file/$key1 2>$root/web_prom/file/$key2 &",$out,$res);
                    // return view('prediction.PromoterWaitPage',[
                    //     'key' => $key,
                    //     'species'=>$species
                    // ]);
       
            }
            else{
                    $choose = 0;
                    $result = exec("python $root/web_prom/Web_Prom.py {$choose} {$species} {$input_seq} {$key} 1>$root/web_prom/file/$key1 2>$root/web_prom/file/$key2 &",$out,$res);
                    // return view('prediction.PromoterWaitPage',[
                    //     'key' => $key,
                    //     'species'=>$species
                    // ]);
                }
    }
}
