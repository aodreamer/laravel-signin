<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationResult extends Model
{
    protected $fillable = ['verification_success', 'verification_failure'];
}
