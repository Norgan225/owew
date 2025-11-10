<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withCount('blogPosts')
            ->latest()
            ->paginate(20);

        // Statistiques pour les cards
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $editorCount = User::where('role', 'editor')->count();
        $viewerCount = User::where('role', 'viewer')->count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'adminCount',
            'editorCount',
            'viewerCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,editor,viewer',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('blogPosts');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,editor,viewer',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Ne pas modifier le mot de passe s'il est vide
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Gérer l'upload d'avatar
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar s'il existe
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Empêcher la suppression de son propre compte
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte!');
        }

        // Supprimer l'avatar s'il existe
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès!');
    }

    /**
     * Bulk delete users
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id'
        ]);

        // Exclure l'utilisateur connecté
        $ids = array_diff($validated['ids'], [auth()->id()]);

        // Supprimer les avatars
        $users = User::whereIn('id', $ids)->get();
        foreach ($users as $user) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        // Supprimer les utilisateurs
        User::whereIn('id', $ids)->delete();

        return redirect()->route('admin.users.index')
            ->with('success', count($ids) . ' utilisateur(s) supprimé(s) avec succès!');
    }

    /**
     * Change role for multiple users
     */
    public function bulkChangeRole(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id',
            'role' => 'required|in:admin,editor,viewer'
        ]);

        // Exclure l'utilisateur connecté
        $ids = array_diff($validated['ids'], [auth()->id()]);

        User::whereIn('id', $ids)->update(['role' => $validated['role']]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Rôle mis à jour pour ' . count($ids) . ' utilisateur(s)!');
    }
}
