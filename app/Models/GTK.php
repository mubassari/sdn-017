<?php

namespace App\Models;

use App\Models\GTKJabatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class GTK extends Model
{
    use HasFactory;
    protected $table = 'gtk';

    protected $fillable = [
        'nama',
        'nip',
        'foto',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'slug',
        'status',
        'gtk_jabatan_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function getPathSampulAttribute()
    {
        if ($this->sampul) {
            return Storage::url('public/gambar/gtk/' . $this->sampul);
        }
    }

    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($gtk) {
            $gtk->slug = $gtk->generateSlug($gtk->nama);
            $gtk->save();
        });

        static::saving(function ($gtk) {
            $gtk->slug = $gtk->generateSlug($gtk->nama);
        });
    }

    private function generateSlug($nama)
    {
        if (static::whereSlug($slug = Str::slug($nama))->exists()) {
            $max = static::whereNama($nama)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    /**
     * Get the GTKJabatan that owns the GTK
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function GTKJabatan(): BelongsTo
    {
        return $this->belongsTo(GTKJabatan::class, 'gtk_jabatan_id', 'id');
    }
}
