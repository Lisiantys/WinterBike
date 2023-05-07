<?php

namespace App\Http\Controllers;

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
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
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
            if ($user->image_path !== 'users/default_user_image.jpg') {
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
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
