<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserRole extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'user_role';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}
