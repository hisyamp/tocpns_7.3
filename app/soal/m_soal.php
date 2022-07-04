<?php

namespace App\soal;

use Illuminate\Database\Eloquent\Model;

class m_soal extends Model
{
    protected $table = 'soal_skd';
    
    protected $primaryKey = 'id_soal';
    protected $guarded = [];
    public $timestamps = false;

}
