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
    protected $casts = [
        'created_at' => 'datetime:d.m.y',
    ];

    /**
     * @return BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(ApplicationCategories::class, 'category');
    }
}
