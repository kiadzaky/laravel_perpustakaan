<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Siswa extends Model
{
public $table = "siswa";
    protected $fillable = [
        'id_siswa','nis', 'nama', 'alamat', 'no_telepon'
    ];
}
