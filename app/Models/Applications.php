<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applications extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'phone', 'email', 'category', 'message'
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'category'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime:d.m.y',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'category'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(ApplicationCategories::class, 'category');
    }
}
