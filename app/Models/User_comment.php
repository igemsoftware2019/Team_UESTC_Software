<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_comment extends Model
{
    protected $table = 'user_comment';
    protected $fillable = ['name','comment','created_at','updated_at','igemid'];
}
