<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = '13_blog'; // nama tabel yang digunakan
    public $timestamps = false; // menonaktifkan timestaps

    protected $filltable = [
        '13_judul',
        '13_kategori',
        '13_status',
        '13_artikel',
        '13_gambar',
    ];
}
