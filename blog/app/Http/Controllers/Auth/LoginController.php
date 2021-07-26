<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Check login.
     *
     * @param LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        // Get checkbox Remember me
        $remember_me = $request->has('rememberMe') ? true : false;
        // Check user exists?
        if (Auth::attempt($request->only(['email', 'password'], $remember_me))) {
            // Reset session id
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return redirect()
            ->back()
            ->withInput()
            ->with([
                'message' => __('auth.login_no_user'),
                'alert' => 'alert-danger',
            ]);
    }

    /**
     * Log out.
     *
     * @return Response
     */
    public function signOut() {
        // Destroy Session
        Session::flush();
        // Logout
        Auth::logout();

        return redirect()->route('login');
    }
}
