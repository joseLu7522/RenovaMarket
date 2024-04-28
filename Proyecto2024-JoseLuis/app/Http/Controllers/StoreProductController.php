<?php

namespace App\Http\Controllers;

use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StoreProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storeProducts = StoreProduct::all();
        return view('online_store.index', compact('storeProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()) {
            if (Auth::user()->rol == 'admin') {
                return view('online_store.create');

            } else {
                return redirect()->route('home');

            }
        } else {
            return redirect()->route('home');

        }
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
    public function show(StoreProduct $storeProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreProduct $storeProduct)
    {
        if (Auth::user()) {
            if (Auth::user()->rol == ('admin')) {
                return view('Online_store.edit', compact('storeProduct'));
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
    public function update(Request $request, StoreProduct $storeProduct)
    {
        if (Auth::user()) {
            if (Auth::user()->rol == ('admin')) {
                $storeProduct->name = $request->input('name');
                $storeProduct->price = $request->input('price');
                $storeProduct->description = $request->input('description');
                $storeProduct->stock = $request->input('stock');
                $storeProduct->category = $request->input('category');

                /*FALTA GUARDAR LA IMAGEN*/

                $storeProduct->save();

                return redirect()->route('storeProducts.index');
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
    public function destroy(StoreProduct $storeProduct)
    {
        if (Auth::user()) {
            if (Auth::user()->rol == ('admin')) {
                $storeProduct->delete();
                return redirect()->route('storeProducts.index');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function filterByCategory($category)
    {

        $storeProducts = StoreProduct::where('category', $category)->get();
        return view('online_store.index', compact('storeProducts'));
    }
}
