<?php

namespace App\detailPaket;

use Illuminate\Database\Eloquent\Model;

class detailPaket extends Model
{
    protected $table = 'detail_paket';
    
    protected $primaryKey = 'id_detail_paket';
    protected $guarded = [];
}
