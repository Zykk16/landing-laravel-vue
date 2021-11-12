<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 *
 * @mixin Builder
 */
class CategoriesCases extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'created_at'];

    protected $casts = [
        'created_at' => 'encrypted:Y-m-d H:i:s',
    ];
}
