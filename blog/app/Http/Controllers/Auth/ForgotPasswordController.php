<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Display reset password page.
     *
     * @return Response
     */
    public function index()
    {
        return view('auth.forgot-password');
    }

    /**
     * Validate data and send token to mail.
     *
     * @param Request $request
     * @return Response
     */
    public function forgotPassword(Request $request)
    {
        // Validate data
        $request->validate(['email' => 'required|email']);
        // Send link to mail
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with([
                'status' => __($status),
                'alert' => 'alert-success',
            ])
            : back()->with([
                'status' => __($status),
                'alert' => 'alert-danger',
            ]);
    }

}
