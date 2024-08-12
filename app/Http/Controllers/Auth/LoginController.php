<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the user is an admin
            if ($user->IsAdmin !== 1) {
                // Log the user out and redirect back with an error message
                Auth::logout();
                return Redirect::back()->withErrors(['error' => 'You do not have admin access.']);
            }

            // Redirect to calendar on successful login if admin
            return Redirect::to('calendar');
        }

        // Redirect back with an error message if authentication fails
        return Redirect::back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return Redirect::to('login');
    }
}
