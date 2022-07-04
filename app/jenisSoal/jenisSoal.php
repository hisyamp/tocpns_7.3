<?php

namespace App\jenisSoal;

use Illuminate\Database\Eloquent\Model;

class jenisSoal extends Model
{
    protected $table = 'jenissoal';
    
    protected $primaryKey = 'id_js';
    protected $guarded = [];
}
