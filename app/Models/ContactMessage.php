<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'replied_at'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    // Scope pour les nouveaux messages
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    // Scope pour les messages lus
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    // Scope pour les messages non archivés
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'archived');
    }

    // Scope pour les messages répondus
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    // Helpers
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    public function markAsReplied()
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now()
        ]);
    }
}
