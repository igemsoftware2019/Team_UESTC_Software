<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    protected $table = 'parts';
    protected $primaryKey = 'part_name';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;



}
