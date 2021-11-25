<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer id
 * @property integer category_id
 * @property integer status_id
 * @property string image
 * @property string title
 * @property string goal
 * @property string geography
 * @property string placement_format
 * @property string period
 * @property string gender
 * @property string age
 * @property string income
 * @property string interest
 * @property string shows
 * @property string clicks
 * @property string ctr
 * @property string vtr
 * @property string cpv
 * @property string coverage
 * @property string refusals
 * @property string depth
 * @property string duration_session
 * @property string objectives
 *
 * @mixin Builder
 */
class Cases extends Model
{
    use Sluggable;

    protected $fillable = [
        'category_id',
        'status_id',
        'slug',
        'image',
        'title',
        'goal',
        'geography',
        'placement_format',
        'period',
        'gender',
        'age',
        'income',
        'interest',
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
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'encrypted:Y-m-d H:i:s',
        'updated_at' => 'encrypted:Y-m-d H:i:s'
    ];

//    public function getRouteKeyName()
//    {
//        return "slug";
//    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoriesCases::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
