<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'category', 'message'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.y',
    ];
}
