<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
<<<<<<< HEAD
use Illuminate\View\View;
=======
use Inertia\Inertia;
use Inertia\Response;
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
<<<<<<< HEAD
    public function create(): View
    {
        return view('auth.forgot-password');
=======
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
<<<<<<< HEAD
            'email' => ['required', 'email'],
=======
            'email' => 'required|email',
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

<<<<<<< HEAD
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
=======
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
    }
}
