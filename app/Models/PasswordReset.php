<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    /*
    The properties that as mass assigned
    */

    protected $fillable = [
        'user_id', 'reset_code'
    ];
}