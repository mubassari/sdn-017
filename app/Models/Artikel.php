<?php

namespace App\Models;

use App\Models\ArtikelKategori;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'isi',
        'slug',
        'user_id',
        'artikel_kategori_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function getPathSampulAttribute()
    {
        $imgSrc = 'storage/public/images/default.png';

        $pattern = '/<img[^>]+src=["\']([^"\']+)["\']/';
        if (preg_match($pattern, $this->isi, $matches)) {
            // Check if a match was found
            $imgSrc = $matches[1]; // Extract the src attribute
        }
        // Set the extracted src as the value of $this->isi
        return $imgSrc;
    }

    public function getIsiWithPathAttribute()
    {
        $content = $this->isi;
        preg_match_all('/<img[^>]+src="([^">]+)"(?:[^>]+id="([^">]+)")?/', $content, $matches, PREG_SET_ORDER);
        foreach ($matches as $key => $imageTag) {
            $src  = $matches[$key][1];
            $uuid  = $matches[$key][2];
            $content = str_replace($matches[$key][0], '<img src="' . URL::asset($src) . '" id="' . $uuid . '"', $content);
        }
        return $content;
    }

    public function getWaktuAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->isoFormat('dddd, DD MMMM YYYY');
    }

    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($post) {
            $post->slug = $post->generateSlug($post->judul);
            $post->save();
        });

        static::saving(function ($post) {
            $post->slug = $post->generateSlug($post->judul);
        });
    }

    private function generateSlug($judul)
    {
        if (static::whereSlug($slug = Str::slug($judul))->exists()) {
            $max = static::whereJudul($judul)->latest('id')->skip(1)->value('slug');
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
     * Get the ArtikelKategori that owns the Artikel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ArtikelKategori(): BelongsTo
    {
        return $this->belongsTo(ArtikelKategori::class);
    }
}
