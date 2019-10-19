<?php

namespace App\Models\es;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Regulondb_es extends Model
{
    use Searchable;
    protected $table = 'regulondb_es';
    protected $primaryKey = 'promotername';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    // 覆盖Scout中的主键
    public function getScoutKey()
    {
        return $this->promotername;
    }
}
