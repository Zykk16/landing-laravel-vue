<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 *
 * @mixin Builder
 */
class CasesStatus extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'created_at'];

    /**
     * @var bool
     */
    public $timestamps = false;
}