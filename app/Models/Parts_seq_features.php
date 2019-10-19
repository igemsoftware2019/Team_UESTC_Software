<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parts_seq_features extends Model
{
    protected $table = 'parts_seq_features';
    public $timestamps = false;


    // 定义表间关系
    public function parts()
    {
        return $this->belongsTo('App\Models\Parts','part_id','part_id');
    }
}
