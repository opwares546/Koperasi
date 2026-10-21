<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
<<<<<<< HEAD
=======
use Illuminate\Contracts\Auth\MustVerifyEmail;
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
<<<<<<< HEAD
use Illuminate\View\View;
=======
use Inertia\Inertia;
use Inertia\Response;
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
<<<<<<< HEAD
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
=======
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

<<<<<<< HEAD
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
=======
        return Redirect::route('profile.edit');
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
<<<<<<< HEAD
        $request->validateWithBag('userDeletion', [
=======
        $request->validate([
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
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
