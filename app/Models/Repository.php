<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repository extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'full_name'
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
