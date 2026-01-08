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
    // public function home()
    // {
    //     return view('home');
    // }

    public function showRegister()
    {
        return view('customer.register');
    }

    public function showLogin()
    {
        return view('customer.login');
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

        return redirect()->route('customer.dashboard')->with('success', 'Registered successfully');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if(Auth::guard('customer')->attempt($validated)){
            
            $request->session()->regenerate();

            return redirect()->route('customer.dashboard')->with('success', 'Login successfully');
        }

        throw ValidationException::withMessages([
            'credantials'=>'Sorry, Incorrect credantials'
        ]);



    }

    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        if (Auth::guard('admin')->attempt(
            array_merge(
                $request->only('email', 'password'),
                ['role' => 'admin']
            )
        )) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid Admin credentials']);
    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect()->route('show.login');
    // }
    
    // public function logout($guard)
    // {
    //     Auth::guard($guard)->logout();
    //     return redirect('/');
    // }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
