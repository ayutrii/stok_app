<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    //
    protected $table = 'pelanggans';
    protected $fillable  = [
        'nama_pelanggan',
        'telp',
        'Jenis_kelamin',
        'alamat', 
        'kota',
        'provinsi',
    ];
}
