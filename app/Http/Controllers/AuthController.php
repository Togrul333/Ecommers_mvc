<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'name' => 'required',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        Auth::login($user);
        return redirect()->route('index')->with('success', 'Вы успешно зарегистрировались');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
//        dd($request->post());
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->with('success', '  Nc !! ');
        }
//        $remember_me = $request->has('remember_me')? true : false;
        return redirect()->route('index')->with('success', 'Вы успешно вошли ');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Bay bay !!! ');

    }
}
