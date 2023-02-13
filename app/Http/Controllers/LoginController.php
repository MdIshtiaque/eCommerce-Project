<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.pages.Auth.login');
    }

    public function login_val(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|min:5|string'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials, $request->filled('remember')))
        {
            //$request->session()->put('user',$request->email);
            //info('check',[$request->session()]);
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }
        return redirect('admin/login')->with('success', 'Login detailes are not valid');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
