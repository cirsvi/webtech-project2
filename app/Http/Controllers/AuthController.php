<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
class AuthController extends Controller
{
    //Display login form:
    public function login(): View{
        return view(
            'auth.login',
            [
                'title' => 'Log in'
            ]
        );
    }

    //Authenticate user:
    public function authenticate(Request $request): RedirectResponse{
        $credentials = $request->only('name', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/paintings');
        }
        return back()->withErrors([
           'name' => 'Failed to authenticate',
        ]);
    }

    // End user session:
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}

class ArtistController extends Controller implements HasMiddleware{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
}


