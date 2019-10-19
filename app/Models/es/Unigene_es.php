<?php

namespace App\Models\es;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Unigene_es extends Model
{
    use Searchable;
    protected $table = 'unigene_es';
    protected $primaryKey = 'uniid';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    // 覆盖Scout中的主键
    public function getScoutKey()
    {
        return $this->uniid;
    }
}
