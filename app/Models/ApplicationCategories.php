<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string name
 */
class ApplicationCategories extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
