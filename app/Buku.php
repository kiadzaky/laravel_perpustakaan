<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    public $table = "buku";
    protected $fillable = [
        'id_buku','judul_buku','penerbit','tahun_terbit'
    ];
}
