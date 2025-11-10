<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $query = Volunteer::latest();

        if ($request->has('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $volunteers = $query->paginate(20);

        // Stats pour la vue stylée (optionnel)
        $pendingCount = Volunteer::pending()->count();
        $approvedCount = Volunteer::approved()->count();
        $rejectedCount = Volunteer::rejected()->count();

        return view('admin.volunteers.index', compact(
            'volunteers',
            'pendingCount',
            'approvedCount',
            'rejectedCount'
        ));
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function approve(Volunteer $volunteer)
    {
        $volunteer->approve();

        return redirect()->back()
            ->with('success', 'Candidature approuvée!');
    }

    public function reject(Volunteer $volunteer)
    {
        $volunteer->reject();

        return redirect()->back()
            ->with('success', 'Candidature rejetée!');
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Candidature supprimée!');
    }
}
