<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Siswa extends Model
{
public $table = "siswa";
    protected $fillable = [
        'nis', 'nama', 'alamat', 'no_telepon'
    ];
}
