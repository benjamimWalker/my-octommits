<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nickname',
        'email',
        'avatar',
        'github_id',
        'github_token',
        'github_refresh_token'
    ];

    protected $hidden = [
        'github_token',
        'github_refresh_token',
        'remember_token'
    ];

    protected $appends = [
        'github-url'
    ];

    public function githubUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => 'https://github.com/' . $this->nickname
        );
    }
}
