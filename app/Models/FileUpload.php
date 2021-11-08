<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'category', 'path'];
}
