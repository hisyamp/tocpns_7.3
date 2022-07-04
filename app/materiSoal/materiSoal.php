<?php

namespace App\materiSoal;

use Illuminate\Database\Eloquent\Model;

class materiSoal extends Model
{
    protected $table = 'materi_soal';
    
    protected $primaryKey = 'id_ms';
    protected $guarded = [];
}
