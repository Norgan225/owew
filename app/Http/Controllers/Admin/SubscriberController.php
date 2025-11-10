<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(20);

        // Stats
        $totalSubscribers = Subscriber::count();
        $activeCount = Subscriber::active()->count();
        $unsubscribedCount = Subscriber::unsubscribed()->count();
        $monthlyCount = Subscriber::whereMonth('subscribed_at', date('m'))
            ->whereYear('subscribed_at', date('Y'))
            ->count();

        // Data pour le graphique (12 derniers mois)
        $monthlySubscriptions = $this->getMonthlySubscriptions();

        return view('admin.subscribers.index', compact(
            'subscribers',
            'totalSubscribers',
            'activeCount',
            'unsubscribedCount',
            'monthlyCount',
            'monthlySubscriptions'
        ));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Abonné supprimé avec succès!');
    }

    public function unsubscribe(Subscriber $subscriber)
    {
        $subscriber->unsubscribe();

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Abonné désabonné avec succès!');
    }

    public function resubscribe(Subscriber $subscriber)
    {
        $subscriber->resubscribe();

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Abonné réabonné avec succès!');
    }

    public function export()
    {
        $subscribers = Subscriber::active()->get();

        $filename = 'subscribers_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($subscribers) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, ['Email', 'Statut', 'Date d\'inscription']);

            // Data
            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->email,
                    $subscriber->status,
                    $subscriber->subscribed_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function sendNewsletter(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $subscribers = Subscriber::active()->get();

        // TODO: Implémenter l'envoi d'emails
        // foreach ($subscribers as $subscriber) {
        //     Mail::to($subscriber->email)->send(new Newsletter($validated));
        // }

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Newsletter envoyée à ' . $subscribers->count() . ' abonné(s)!');
    }

    private function getMonthlySubscriptions()
    {
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M Y');

            $count = Subscriber::whereYear('subscribed_at', $date->year)
                ->whereMonth('subscribed_at', $date->month)
                ->count();

            $data[] = $count;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
