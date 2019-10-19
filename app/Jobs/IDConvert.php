<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class IDConvert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $F;
    protected $T;
    protected $ID;
    protected $result;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($F,$T,$ID,$result)
    {
        $this->F=$F;
        $this->T=$T;
        $this->ID=$ID;
        $this->result=$result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $F=$this->F;
        $T=$this->T;
        $ID=$this->ID;
        $result=$this->result;
        $root =$_SERVER['DOCUMENT_ROOT'];
        exec("python3 $root/../tools/tools.py {$F} {$T} {$ID} 1>$root/../tools/file/$result 2>&1");
    }
}
