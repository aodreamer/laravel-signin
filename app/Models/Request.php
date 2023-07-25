<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    // Nama tabel yang sesuai di database
    protected $table = 'requests';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'user_id',
        'reason',
        'status',
    ];
}
