<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Affiche la liste des messages avec filtre par statut.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        if ($request->has('status') && in_array($request->status, ['new', 'read', 'replied'])) {
            $query->where('status', $request->status);
        }

        $messages = $query->paginate(20);

        // Statistiques pour la vue stylée (optionnel)
        $newCount = ContactMessage::new()->count();
        $readCount = ContactMessage::read()->count();
        $repliedCount = ContactMessage::replied()->count();

        return view('admin.messages.index', compact(
            'messages',
            'newCount',
            'readCount',
            'repliedCount'
        ));
    }

    /**
     * Affiche le détail d'un message.
     */
    public function show(ContactMessage $message)
    {
        if ($message->status === 'new') {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Marque le message comme répondu.
     */
    public function markAsReplied(ContactMessage $message)
    {
        $message->markAsReplied();

        return redirect()->back()
            ->with('success', 'Message marqué comme répondu!');
    }

    /**
     * Supprime le message.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message supprimé!');
    }
}
