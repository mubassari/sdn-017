<?php

namespace App\Models;

use App\Models\Gambar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class GambarArtikel extends Model
{
    use HasFactory;
    protected $table = 'gambar_artikel';

    protected $fillable = [
        'gambar_id',
        'artikel_id',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    /**
     * Get the Gambar that owns the GambarArtikel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Gambar(): BelongsTo
    {
        return $this->belongsTo(Gambar::class);
    }
}
