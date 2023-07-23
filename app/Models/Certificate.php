<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'p12_name', 'pass', 'last_modified'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
