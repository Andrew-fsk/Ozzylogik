<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'logo',
        'site',
        'phone',
        'email',
        'legal_address',
        'rating'
    ];

    protected $casts = [
        'logo' => 'array'
    ];
}
