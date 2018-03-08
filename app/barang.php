<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    public $table = "barang";
    protected $fillable = [
        'id_user', 'nama', 'id_kategori', 'deskripsi', 'stok', 'harga', 'foto1', 'foto2', 'foto3'
    ];
}
