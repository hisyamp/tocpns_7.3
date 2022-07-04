<?php

namespace App\Skb;

use Illuminate\Database\Eloquent\Model;

class skb extends Model
{
    protected $table = 'skb';
    
    protected $primaryKey = 'id_skb';
    protected $guarded = [];
}
