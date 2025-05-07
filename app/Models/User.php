<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Boot method to handle user_id generation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $lastUser = DB::table('users')->orderBy('id', 'desc')->first();
            $lastId = $lastUser ? intval(substr($lastUser->user_id, 1)) : 0;
            $newId = $lastId + 1;
            $user->user_id = 'u' . str_pad($newId, 5, '0', STR_PAD_LEFT);
        });
    }
}
