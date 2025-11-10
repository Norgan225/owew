<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_fr',
        'name_en',
        'slug',
        'description_fr',
        'description_en'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name_fr);
            }
        });
    }

    // Relations
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    // Helpers
    public function getPostCountAttribute()
    {
        return $this->blogPosts()->published()->count();
    }
}
