<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Igemuni extends Model
{
    protected $table = 'igemuni';
    public $timestamps = false;

    public function Uni()
    {
        return $this->belongsTo('App\Models\Uni','uniid','uniid');
    }

}
