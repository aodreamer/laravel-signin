<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_author', 'filename', 'hash', 'date_upload', 'labels', 'download_count'
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'id_author');
    }

    public function labels()
    {
        return $this->belongsTo(DocumentLabel::class, 'labels');
    }
    public function incrementDownloadCount()
{
    $this->attributes['download_count'] = $this->attributes['download_count'] + 1;
    $this->save();
}
}
