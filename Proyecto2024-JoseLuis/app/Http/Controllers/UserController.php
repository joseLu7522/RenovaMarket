<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DatabaseStorageModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{

    public function show(User $user)/*MUESTRA EL PERFIL DEL USUARIO Y TODOS SUS PRODUCTOS*/
    {

        if (Auth::user() && Auth::user()->id === $user->id) {

            $user->load('userProducts');

            return view('users.show', compact('user'));
        } else {

            return redirect()->route('home');
        }
    }


    public function edit(User $user)/*REDIRIGE AL FORMULARIO DE EDITAR PERFIL*/
    {
        if (Auth::user() && Auth::id() === $user->id) {
            return view('users.edit', compact('user'));
        } else {
            return redirect()->route('home');
        }
    }


    public function update(SignupRequest $request, User $user)/*GUARDA LOS DATOS DEL FORMULARIO DE EDICION Y ACTUALIZA LOS DATOS*/
    {
        if (Auth::user() && Auth::id() === $user->id) {
            $imagePath = public_path('storage/usersProfile/' . $user->name . '.png');
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->birthday = $request->birthday;
            $user->password = Hash::make($request->password);

            $user->profile_photo = $request->file('image')->storeAs('public/usersProfile', $user->name . '.png');

            $user->save();
            return redirect()->route('users.show', $user->id);
        } else {
            return redirect()->route('home');
        }
    }


    public function destroy(User $user)/*ELIMINA LA CUENTA DEL USUARIO Y TODO LO RELACIONADO CON EL USUARIO*/
    {

        if (Auth::user() && Auth::id() === $user->id) {

            Storage::deleteDirectory("public/userProducts/{$user->name}");

            $imagePath = public_path('storage/usersProfile/' . $user->name . '.png');
            $user->delete();



            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }

}

