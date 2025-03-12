<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AuthController extends Controller
{
    // ...existing code...

    public function resendVerificationEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            Mail::to($user->email)->send(new VerificationMail($user));
            return response()->json(['message' => 'Verification email resent.']);
        }

        return response()->json(['message' => 'User not found or already verified.'], 404);
    }

    // ...existing code...
}