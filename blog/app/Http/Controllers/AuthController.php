<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use \App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    /**
     * Get view login
     * @return view login
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Method post in view login
     * @param Request $request
     * @return view
     */
    public function login(Request $request)
    {
        // Validate value input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:60',
        ]);

        // Get checkbox Remember me
        $remember_me = $request->has('rememberMe') ? true : false;

        // Check user exists?
        if (Auth::attempt($credentials, $remember_me)) {
            // Reset session id
            $request->session()->regenerate();
            // Redirect view home
            return redirect()->route('home');
        }

        // Redirect view login and message error
        return redirect()
            ->back()
            ->withInput()
            ->with([
                'message' => __('auth.login_no_user'),
                'alert' => 'alert-danger',
            ]);
    }

    /**
     * Get view register
     * @return view register
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Method post in view register
     * @param Request $request
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        // Insert User
        $data = $request->all();
        $check = $this->create($data);

        // Redirect view login and message success
        return redirect()
            ->route('login')
            ->with([
                'message' => __('auth.register_success'),
                'alert' => 'alert-success',
            ]);
    }

    /**
     * Insert User to DB
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Get view reset password
     * @return view reset password
     */
    public function resetPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Logout
     * @return view login
     */
    public function signOut() {
        // Destroy Session
        Session::flush();
        // Logout
        Auth::logout();
        // Redirect view login
        return redirect()->route('login');
    }
}
