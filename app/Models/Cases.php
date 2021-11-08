<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cases extends Model
{
    protected $fillable = [
        'category_id',
        'image',
        'title',
        'goal',
        'geography',
        'placement_format',
        'gender',
        'age',
        'income',
        'interest',
        'thematic_resources',
        'shows',
        'clicks',
        'ctr',
        'vtr',
        'cpv',
        'coverage',
        'refusals',
        'depth',
        'duration_session',
        'objectives',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoriesCases::class);
    }
}
