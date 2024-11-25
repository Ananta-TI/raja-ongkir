<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita'; // nama tabel yang digunakan
    public $timestamps = false; // menonaktifkan timestaps

    protected $filltable = [
        'judul',
        'isi_berita',
        'gambar'
    ];
}
