<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Display reset password page.
     *
     * @param $token
     * @return Response
     */
    public function index($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Reset password.
     *
     * @param ResetPasswordRequest $request
     * @return Response
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        // Reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')
                ->with([
                    'message' => __($status),
                    'alert' => 'alert-success',
                ])
            : back()->with([
                'status' => __($status),
                'alert' => 'alert-danger',
            ]);
    }

}
