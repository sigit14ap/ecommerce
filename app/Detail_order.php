<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_order extends Model
{
    public $table = "detail_order";
    protected $fillable = [
        'invoive','detail_total', 'status',
    ];
}
