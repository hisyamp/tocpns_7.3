<?php

namespace App\paketTryout;

use Illuminate\Database\Eloquent\Model;

class paketTryout extends Model
{
    protected $table = 'paket_tryout';
    
    protected $primaryKey = 'id_paket_tryout';
    protected $guarded = [];
}
