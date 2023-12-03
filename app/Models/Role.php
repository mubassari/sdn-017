<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Role extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'role';

    protected $fillable = [
        'nama',
        'slug',
    ];

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}
