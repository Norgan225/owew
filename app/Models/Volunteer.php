<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'skills',
        'availability',
        'motivation_fr',
        'motivation_en',
        'status'
    ];

    // Scope pour les demandes en attente
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope pour les bénévoles approuvés
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope pour les demandes rejetées
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Helpers
    public function approve()
    {
        $this->update(['status' => 'approved']);
    }

    public function reject()
    {
        $this->update(['status' => 'rejected']);
    }
}
