<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = "order";
    protected $fillable = [
        'invoive', 'id_barang', 'qty', 'total', 'status',
    ];
}
