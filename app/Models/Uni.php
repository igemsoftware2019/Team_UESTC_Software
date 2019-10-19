<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uni extends Model
{
    protected $table = 'uni';
    public $timestamps = false;


    public function igemuni()
    {
        return $this->blongsTo('App\Models\Igemuni','uniid','uniid');
    }

    public function score(){
        return $this->belongsTo('App\Models\Score','strid','strid');
    }
}
