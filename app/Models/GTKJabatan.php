<?php

namespace App\Models;

use App\Models\GTK;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GTKJabatan extends Model
{
    use HasFactory;
    protected $table = 'gtk_jabatan';

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
        
        static::created(function ($gtk_jabatan) {
            $gtk_jabatan->slug = $gtk_jabatan->generateSlug($gtk_jabatan->nama);
            $gtk_jabatan->save();
        });

        static::saving(function ($gtk_jabatan) {
            $gtk_jabatan->slug = $gtk_jabatan->generateSlug($gtk_jabatan->nama);
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
     * Get all of the GTK for the Jabatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function GTK(): HasMany
    {
        return $this->hasMany(GTK::class);
    }
}
