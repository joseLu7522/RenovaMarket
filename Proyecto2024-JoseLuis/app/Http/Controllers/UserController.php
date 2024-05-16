<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        if (Auth::user() && Auth::user()->id === $user->id) {

            $user->load('userProducts');

            return view('users.show', compact('user'));
        } else {

            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
     if (Auth::user() && Auth::id() === $user->id) {
            return view('users.edit', compact('user'));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SignupRequest $request, User $user)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $imagePath = public_path('storage/usersProfile/' . $user->name .'.png');
        $user->delete();

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        return redirect()->route('home');
    }
}
