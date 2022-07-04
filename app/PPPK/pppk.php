<?php

namespace App\PPPK;

use Illuminate\Database\Eloquent\Model;

class pppk extends Model
{
    protected $table = 'pppk';
    
    protected $primaryKey = 'id_pppk';
    protected $guarded = [];
}
