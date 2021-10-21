<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    public $table = "peminjaman";
    protected $fillable = [
        'id_peminjaman','id_siswa','id_buku', 'tgl_peminjaman', 'tgl_pengembalian',
    ];
}
