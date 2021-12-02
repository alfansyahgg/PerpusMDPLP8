<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        if(Auth::check()){ return redirect()->back(); }

        $validateData = $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ]
            );
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect('/');
        }

        return redirect('login')->withError('Gagal untuk login');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('login');
    }
}
