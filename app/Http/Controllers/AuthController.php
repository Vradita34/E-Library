<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() : View
    {
        return view('auth.login');
    }

    public function register() : View
    {
        return view('auth.register');
    }

    public function register_action(Request $request) : RedirectResponse
    {
        $data = $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:3124',
        ]);

        if($request->file('avatar')){
            $avatar = $request->file('avatar')->store('avatars','public');

            User::create([
                'username' => $data['username'],
                'name' =>  $data['name'],
                'email' =>  $data['email'],
                'password' => Hash::make($data['password']),
                'address' =>  $data['address'],
                'avatar' => $avatar,
            ]);
            return redirect()->route('login')->with('success','Create Account succesfully');
        }else{
            User::create([
                'username' => $data['username'],
                'name' =>  $data['name'],
                'email' =>  $data['email'],
                'password' => Hash::make($data['password']),
                'address' =>  $data['address'],
            ]);
            return redirect()->route('login')->with('success','Create Account succesfully');
        }
    }

    public function login_action(Request $request)  : RedirectResponse
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if(Auth::attempt($data)){
            $role = Auth::user()->role;
            switch ($role) {
                case 'admin':
                case 'librarian':
                    return redirect()->route('dashboard')->with('success','login successfully');
                case 'reader':
                    return redirect()->route('homepage')->with('success','login successfully');
                default:
                    return redirect()->route('homepage')->with('error',' undefined role');
            }
        }else{
            return redirect()->back()->with('error','login error');
        }
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Logout Susccessfully');
    }
}
