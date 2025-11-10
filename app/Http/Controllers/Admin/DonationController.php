<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Project;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('project')
            ->latest()
            ->paginate(20);

        $totalAmount = Donation::where('status', 'received')->sum('amount');
        $monthlyCount = Donation::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        $averageDonation = Donation::where('status', 'received')->avg('amount');
        $projects = Project::all();

        return view('admin.donations.index', compact(
            'donations',
            'totalAmount',
            'monthlyCount',
            'averageDonation',
            'projects'
        ));
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')
            ->with('success', 'Don supprimé avec succès');
    }

    public function updateStatus(Request $request, Donation $donation)
    {
        $donation->update(['status' => $request->status]);
        return redirect()->route('admin.donations.index')
            ->with('success', 'Statut du don mis à jour');
    }
}
