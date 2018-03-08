<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class kategori extends Model
{
	public $table = "kategori";
    protected $fillable = [
        'nama_kat', 'bagian',
    ];
}
