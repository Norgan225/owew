<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Donation;
use App\Models\ContactMessage;
use App\Models\Volunteer;
use App\Models\Subscriber;
use App\Models\PartnershipRequest;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'active_projects' => Project::active()->count(),
            'total_donations' => Donation::sum('amount') ?? 0,
            'donations_count' => Donation::count(),
            'new_messages' => ContactMessage::whereNull('replied_at')->count(),
            'pending_volunteers' => Volunteer::pending()->count(),
            'total_subscribers' => Subscriber::where('status', 'active')->count(),
            'approved_partnerships' => PartnershipRequest::approved()->count(),
        ];

        $recentDonations = Donation::with('project')
            ->latest()
            ->take(10)
            ->get();

        $topProjects = Project::active()
            ->orderByDesc('raised_amount')
            ->take(5)
            ->get();

        // Optimisation de la requête monthly donations
        $monthlyDonations = Donation::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentDonations',
            'topProjects',
            'monthlyDonations'
        ));
    }
}
