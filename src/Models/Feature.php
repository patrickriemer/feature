<?php

namespace PatrickRiemer\Feature\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feature extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'code',
        'name'
    ];

    public function usages(): HasMany
    {
        return $this->hasMany(FeatureUsage::class);
    }
}