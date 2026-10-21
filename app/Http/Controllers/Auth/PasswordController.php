<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
<<<<<<< HEAD
        $validated = $request->validateWithBag('updatePassword', [
=======
        $validated = $request->validate([
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

<<<<<<< HEAD
        return back()->with('status', 'password-updated');
=======
        return back();
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
    }
}
