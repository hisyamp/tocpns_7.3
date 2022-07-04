<?php

namespace App\submateriSoal;

use Illuminate\Database\Eloquent\Model;

class submateriSoal extends Model
{
    protected $table = 'submateri_soal';
    
    protected $primaryKey = 'id_sms';
    protected $guarded = [];
}
