<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display register page.
     *
     * @return Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Validate data and insert user.
     *
     * @param RegisterRequest $request
     * @return Response
     */
    public function register(RegisterRequest $request)
    {
        // Insert User
        $data = $request->all();
        $this->create($data);

        return redirect()
            ->route('login')
            ->with([
                'message' => __('auth.register_success'),
                'alert' => 'alert-success',
            ]);
    }

    /**
     * Insert user.
     *
     * @param array
     * @return Response
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
