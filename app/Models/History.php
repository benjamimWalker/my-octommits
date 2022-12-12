<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'repository_id',
        'date',
        'commits'
    ];
}
