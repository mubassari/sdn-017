<?php

namespace App\Models;

use App\Models\Artikel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';

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

    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($post) {
            $post->slug = $post->generateSlug($post->nama);
            $post->save();
        });

        static::saving(function ($post) {
            $post->slug = $post->generateSlug($post->nama);
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
     * Get all of the Artikel for the Kategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Artikel(): HasMany
    {
        return $this->hasMany(Artikel::class);
    }
}
