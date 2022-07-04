<?php

namespace App\soalCerita;

use Illuminate\Database\Eloquent\Model;

class soalCerita extends Model
{
    protected $table = 'soalcerita';
    
    protected $primaryKey = 'id_soalcerita';
    protected $guarded = [];
    public $timestamps = false;
}
