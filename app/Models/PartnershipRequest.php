<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_name',
        'sector',
        'contact_name',
        'contact_position',
        'email',
        'phone',
        'partnership_types',
        'estimated_budget',
        'message',
        'status',
        'reviewed_at',
        'admin_notes'
    ];

    protected $casts = [
        'partnership_types' => 'array',
        'reviewed_at' => 'datetime',
    ];

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Helpers
    public function markAsReviewed()
    {
        $this->update([
            'status' => 'reviewed',
            'reviewed_at' => now()
        ]);
    }

    public function markAsApproved($notes = null)
    {
        $this->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'admin_notes' => $notes
        ]);
    }

    public function markAsRejected($notes = null)
    {
        $this->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'admin_notes' => $notes
        ]);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge bg-warning">En attente</span>',
            'reviewed' => '<span class="badge bg-info">Examiné</span>',
            'approved' => '<span class="badge bg-success">Approuvé</span>',
            'rejected' => '<span class="badge bg-danger">Rejeté</span>',
            default => '<span class="badge bg-secondary">Inconnu</span>',
        };
    }
}
