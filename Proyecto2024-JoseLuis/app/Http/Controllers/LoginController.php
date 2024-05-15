<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signupForm()/*SI NO ESTAS AUTENTICADO REDIRIJE A EL FORMULARIO DE REGISTRARSE */
    {
        if (Auth::user()) {
            return redirect()->route('home');
        } else {
            return view('auth.signup');
        }
    }

    public function signup(SignupRequest $request)/*RECIBE LOS DATOS DEL FORMULARIO Y LOS GUARDA EN USER */
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->email_verified_at = $request->input('email_verified_at');
        $user->birthday = $request->input('birthday');
        $user->password = Hash::make($request->input('password'));
        $user->profile_photo = $request->file('profile_photo')->storeAs('public/usersProfile', $user->name . '.png');
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }
    public function loginForm()/*REDIRIGE A LA VISTA DE INICIO DE SESION */
    {
        if (Auth::viaRemember()) {
            return redirect()->route('home');
        } else if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }
    public function login(Request $request)/*SE HACE LA LOGICA PARA PODER AUTENTICARSE Y RECORDAR LOGIN */
    {
        $credentials = $request->only('name', 'password');
        $rememberLogin = ($request->get('remember')) ? true : false;
        if (Auth::guard('web')->attempt($credentials, $rememberLogin)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            $error = 'Error al acceder a la aplicación';
            return view('auth.login', compact('error'));
        }
    }

    public function logout(Request $request)/*CIERRA SESION */
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

}
