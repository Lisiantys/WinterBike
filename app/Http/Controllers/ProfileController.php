<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
    * Récupère les utilisateurs du site. "Pannel Admin"
    */
    public function manage(Request $request)
    {
        $roles = Role::all();
        
        $search = $request->input('search');
        $selectedRole = $request->input('role_id');
        $bannedStatus = $request->input('is_banned');
        $users = User::with('role')->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%');
        })->when($selectedRole, function ($query, $selectedRole) {
            return $query->where('role_id', $selectedRole);
        })
        ->when($bannedStatus == 'banned', function ($query) {
            return $query->where('is_banned', 1);
        })
        ->when($bannedStatus == 'not_banned', function ($query) {
            return $query->where('is_banned', 0);
        })
        ->paginate(15);
    
        return view('profile.manage', compact('users', 'roles'));
    }
    
    /**
    * Met à jour un rôle
    */
    public function updateRole(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->role_id = $validatedData['role_id'];
        $user->save();
        return redirect()->route('profile.manage')->withSuccess('Le rôle de l\'utilisateur a été mis à jour.');
    }

    /**
    * Bloque un utilisateur du site
    */
    public function banUser(User $user)
    {
        $user->update(['is_banned' => 1]);
        return redirect()->route('profile.manage')->withSuccess("L'utilisateur a été bloqué.");
    }

    /**
    * Débloque un utilisateur du site
    */
    public function unbanUser(User $user)
    {
        $user->update(['is_banned' => 0]);
        return redirect()->route('profile.manage')->withSuccess("L'utilisateur a été débloqué.");
    }

    /**
    * Affiche le profil d'un utilisateur
    */
    public function show(User $user)
    {

        // Récupérer les commentaires de l'utilisateur
        $commentsCount = $user->comments()->count();

        // Récupérer les événements créés par l'utilisateur qui sont validés
        $eventsCount = $user->events()->where('is_validated', 1)->count();

        // Supposons que vous avez une relation 'favorites' dans votre modèle User
        $favoritesCount = $user->favoritedEvents()->count();

        // Récupérer les commentaires de l'utilisateur
        $comments = $user->comments()->orderBy('created_at', 'desc')->paginate(5);
     
        // Récupérer les événements créés par l'utilisateur qui sont validés
        $events = $user->events()->where('is_validated', 1)->orderBy('created_at', 'desc')->paginate(5);
     
        // Retourner la vue de profil avec les données
        return view('profile.show', compact('user', 'comments', 'events','favoritesCount', 'eventsCount', 'commentsCount'));
    }
    
    /**
     * Affiche la page de modification d'un profil utilisateur
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Met à jour le profil d'un utilisateur
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user(); //

        // Filtrer l'image_path des données validées
        $validatedData = $request->validated();
        unset($validatedData['image_path']);
       
        $user->fill($validatedData);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
            if ($request->hasFile('image_path')) {

            // Stocker la nouvelle image et récupérer son chemin
            $newImagePath = $request->file('image_path')->store('users', 'public');

            // Vérifier si l'image actuelle n'est pas l'image par défaut
            if ($user->image_path !== 'users/default_user_image.png') {
                // Supprimer l'ancienne image du stockage
                Storage::disk('public')->delete($user->image_path);               
            }
            // Mettre à jour le chemin de l'image pour l'utilisateur
            $user->image_path = $newImagePath;
        }
                
        // Enregistrer les modifications de l'utilisateur
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Supprime le compte de l'utilisateur
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Récupérer les événements de l'utilisateur
        $events = $user->events;

        foreach ($events as $event) {
            // Supprimer la photo associée à l'événement
            if($event->image_path) {
                $filePath = $event->image_path;
                if(Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                } 
            }
            // Supprimer l'événement
            $event->delete();
        }

        // Supprimer la photo associée à l'utilisateur
        if($user->image_path && $user->image_path != 'users/default_user_image.png') {
            $filePath = $user->image_path;
            if(Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            } 
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
