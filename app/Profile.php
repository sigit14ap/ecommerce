<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $table = "profile";
    protected $fillable = [
        'jenis_alamat', 'nama', 'telepon', 'kota', 'kecamatan', 'kelurahan', 'kode_pos', 'alamat',
    ];
}
