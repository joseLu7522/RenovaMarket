<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProductRequest;


class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()) {
            $userProducts = UserProduct::all();
            return view('buy_sell.index', compact('userProducts'));
        } else {
            return redirect()->route('home');

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()) {
            return view('buy_sell.create');
        } else {
            return redirect()->route('home');

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserProductRequest $request)
    {
        if (Auth::user()) {

                $userProduct = new UserProduct();
                $userProduct->name = $request->input('name');
                $userProduct->description = $request->input('description');
                $userProduct->price = $request->input('price', 0);
                $userProduct->category = $request->input('category');
                $userProduct->user_id = Auth::user()->id;

                $userProduct->image = $request->file('image')->storeAs('public/userProducts', $userProduct->name . '.png');


                $userProduct->save();

                return redirect()->route('userProducts.index');

        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProduct $userProduct)
    {
        //
    }

    public function edit(UserProduct $userProduct)
    {
        if (Auth::user()) {
            if ( Auth::id() == $userProduct->user_id) {
                return view('buy_sell.edit', compact('userProduct'));
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProduct $userProduct)
    {
        if (Auth::user()) {
            if ( Auth::id() == $userProduct->user_id) {
                $imagePath = public_path('storage/userProducts/' . $userProduct->name . '.png');
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $userProduct->name = $request->input('name');
                $userProduct->price = $request->input('price');
                $userProduct->description = $request->input('description');
                $userProduct->category = $request->input('category');

                $userProduct->image = $request->file('image')->storeAs('public/userProducts', $userProduct->name . '.png');

                $userProduct->save();

                return redirect()->route('userProducts.index');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProduct $userProduct)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->rol == 'admin' || $user->id === $userProduct->user_id) {
                $imagePath = public_path('storage/userProducts/' . $userProduct->name . '.png');
                $userProduct->delete();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                return redirect()->route('userProducts.index');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function filterByCategory($category)
    {

        $userProducts = UserProduct::where('category', $category)->get();
        return view('buy_sell.index', compact('userProducts'));
    }
}
