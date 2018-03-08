<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    public $table = "wilayah";
    protected $fillable = [
        'city_id', 'province_id', 'city_name', 'province', 'type', 'postal_code',
    ];
}
