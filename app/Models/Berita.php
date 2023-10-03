<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'isi',
        'slug',
        'sampul',
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
            return asset('img/berita/' . $this->sampul);
        }
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
}
