<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'title_fr',
        'title_en',
        'description_fr',
        'description_en',
        'image_path',
        'media_type',
        'video_url',
        'thumbnail_path',
        'category',
        'order',
        'is_published',
        'is_featured'
    ];

    protected $casts = [
        'order' => 'integer',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeImages($query)
    {
        return $query->where('media_type', 'image');
    }

    public function scopeVideos($query)
    {
        return $query->where('media_type', 'video');
    }

    // Helpers
    public function isVideo()
    {
        return $this->media_type === 'video';
    }

    public function isImage()
    {
        return $this->media_type === 'image';
    }

    public function getMediaUrl()
    {
        if ($this->isVideo()) {
            return $this->video_url;
        }
        return asset('storage/' . $this->image_path);
    }

    public function getThumbnail()
    {
        if ($this->thumbnail_path) {
            return asset('storage/' . $this->thumbnail_path);
        }
        if ($this->isImage()) {
            return asset('storage/' . $this->image_path);
        }
        // Thumbnail par défaut pour vidéos
        return asset('images/video-placeholder.jpg');
    }
}
