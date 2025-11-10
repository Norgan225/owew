<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use Illuminate\Http\Request;

class PartnershipRequestController extends Controller
{
    public function index()
    {
        $status = request('status');

        $requests = PartnershipRequest::query()
            ->when($status, function($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(20);

        $counts = [
            'all' => PartnershipRequest::count(),
            'pending' => PartnershipRequest::pending()->count(),
            'reviewed' => PartnershipRequest::reviewed()->count(),
            'approved' => PartnershipRequest::approved()->count(),
            'rejected' => PartnershipRequest::rejected()->count(),
        ];

        return view('admin.partnerships.index', compact('requests', 'counts', 'status'));
    }

    public function show(PartnershipRequest $partnershipRequest)
    {
        return view('admin.partnerships.show', compact('partnershipRequest'));
    }

    public function updateStatus(Request $request, PartnershipRequest $partnershipRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $partnershipRequest->update([
            'status' => $request->status,
            'reviewed_at' => now(),
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }

    public function destroy(PartnershipRequest $partnershipRequest)
    {
        $partnershipRequest->delete();

        return redirect()->route('admin.partnerships.index')
            ->with('success', 'La demande de partenariat a été supprimée.');
    }
}
