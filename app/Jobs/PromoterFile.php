<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PromoterFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $species;
    protected $key;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($species,$key)
    {
        //
        $this->species=$species;
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
        $key = $this->key;
        $key1 = $key.'_1.txt';
        $key2 = $key.'_2.txt';
        $root =$_SERVER['DOCUMENT_ROOT'];
      
        $choose = 1;
        $result = exec("python $root/web_prom/Web_Prom.py {$choose} {$species} {$key} 1>$root/web_prom/file/$key1 2>$root/web_prom/file/$key2 &",$out,$res);

    }
}
