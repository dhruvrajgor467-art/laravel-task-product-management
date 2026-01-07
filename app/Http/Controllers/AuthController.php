<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(RegisterRequest $request)
    {
        // Only validated data
        // $data = $request->validated();

        // dd($data);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registered successfully');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($validated)){
            
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Login successfully');
        }

        throw ValidationException::withMessages([
            'credantials'=>'Sorry, Incorrect credantials'
        ]);



    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
