<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
class AuthenticateController extends Controller
{
    /**
     * Returns the login page of the website.
     *
     * This method is used to display the login form to users.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.login');
    }
    /**
     * Handles the authentication of users.
     *
     * This method is used to authenticate users based on the provided credentials.
     * If the authentication is successful, the user is redirected to the admin index page.
     * If the authentication fails, the user is redirected back to the login form with an error message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse{
        $request->validate([
            'email' => 'required|email|min:2|max:255',
            'password' => 'required|min:2|max:255',
        ]);
        // Attempt to authenticate the user based on the provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // If the authentication is successful, regenerate the session and redirect the user
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }
        // If the authentication fails, redirect the user back to the login form with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    /**
     * Destroys an authenticated session.
     *
     * This method is used to log users out of the application. It invalidates the user's session and
     * regenerates a new session token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse{
        // Log the user out of the application
        Auth::logout();
        // Invalidate the user's session
        $request->session()->invalidate();
        // Regenerate a new session token to prevent session fixation attacks
        $request->session()->regenerateToken();
        // Redirect the user back to the login form
        return redirect()->route('admin.login');
    }
}
