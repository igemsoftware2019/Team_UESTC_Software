<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'score';
    public $timestamps = false;
    
    
    public function uni()
    {
        return $this->belongsTo('App\Models\Uni','strid','strid');
    }


}
