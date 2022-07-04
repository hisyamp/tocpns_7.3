<?php

namespace App\hasilUjian;

use Illuminate\Database\Eloquent\Model;

class hasilUjian extends Model
{
    protected $table = 'hasil_ujian';
    
    protected $primaryKey = 'id_hu';
    protected $guarded = [];
}
