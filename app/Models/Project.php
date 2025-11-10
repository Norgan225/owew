<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_fr',
        'title_en',
        'slug',
        'description_fr',
        'description_en',
        'image',
        'goal_amount',
        'raised_amount',
        'status',
        'start_date',
        'end_date',
        'featured'
    ];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'featured' => 'boolean',
    ];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title_fr);
            }
        });
    }

    // Relations
    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // Accessors & Helpers
    public function getProgressPercentageAttribute()
    {
        if ($this->goal_amount == 0) return 0;
        return min(100, ($this->raised_amount / $this->goal_amount) * 100);
    }

    public function isCompleted()
    {
        return $this->raised_amount >= $this->goal_amount;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
    public function getMainImageAttribute()
    {
        // renvoie la première image (order = 0)
        return $this->images()->where('order', 0)->first() ?? $this->images()->first();
    }
}
