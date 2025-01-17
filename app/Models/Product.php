<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [];

    protected $hidden = [];

    protected $casts = [];

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
