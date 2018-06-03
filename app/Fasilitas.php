<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

     protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'merek' => 'string',
        'model' => 'string',
    ];

    public $fillable = [
        'nama','merek','model'
    ];
}
