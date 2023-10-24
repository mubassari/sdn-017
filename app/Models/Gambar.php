<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;
    protected $table = 'gambar';
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'ext'
    ];

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
