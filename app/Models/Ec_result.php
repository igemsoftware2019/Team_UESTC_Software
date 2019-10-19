<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ec_result extends Model
{
    protected $table = 'ec_result';
    public $timestamps = false;
    protected $fillable = ['key','sequence','ecnumber','score'];
}
