<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_author', 'filename', 'hash', 'date_upload'
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'id_author');
    }
}
