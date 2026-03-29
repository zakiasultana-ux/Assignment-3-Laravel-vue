<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (! Auth::attempt($credentials)) {
            throw new UnauthorizedException('Incorrect login details');
        }

        /**
         * Regenerate the session to prevent "session fixation"
         * @link https://owasp.org/www-community/attacks/Session_fixation
         */
        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();
        $user->tokens()->whereName('login_token')->delete();
        $token = $user->createToken('login_token', ['*']);

        return ['token' => $token->plainTextToken];
    }

    public function me()
    {
        return Auth::user();
    }
}
