<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesanSaran extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'pesan', // Tambahkan kolom 'pesan'
    ];

}
