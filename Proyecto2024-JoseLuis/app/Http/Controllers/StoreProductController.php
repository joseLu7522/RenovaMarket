<?php

namespace App\Http\Controllers;

use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;



class StoreProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storeProducts = StoreProduct::Paginate(20);
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
    public function store(StoreProductRequest $request)
    {
        if (Auth::user()) {
            if (Auth::user()->rol == 'admin') {

                $storeProduct = new StoreProduct();
                $storeProduct->name = $request->input('name');
                $storeProduct->description = $request->input('description');
                $storeProduct->price = $request->input('price', 0);
                $storeProduct->stock = $request->input('stock', 1);
                $storeProduct->category = $request->input('category');

                $storeProduct->image = $request->file('image')->storeAs('public/storeProducts', $storeProduct->name . '.png');


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
    public function update(StoreProductRequest $request, StoreProduct $storeProduct)
    {
        if (Auth::user()) {
            if (Auth::user()->rol == ('admin')) {
                $imagePath = public_path('storage/storeProducts/' . $storeProduct->name . '.png');
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $storeProduct->name = $request->input('name');
                $storeProduct->price = $request->input('price');
                $storeProduct->description = $request->input('description');
                $storeProduct->stock = $request->input('stock');
                $storeProduct->category = $request->input('category');
                $storeProduct->image = $request->file('image')->storeAs('public/storeProducts', $storeProduct->name . '.png');


                $storeProduct->save();

                return redirect()->route('storeProducts.index');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');

        }
    }

/*DESTROY: ELIMINA EL PRODUCTO DE LA TIENDA JUNTO A SU IMAGEN GUARDADA EN STORAGE*/
    public function destroy(StoreProduct $storeProduct)
    {
        if (Auth::user()) {
            if (Auth::user()->rol == ('admin')) {
                $imagePath = public_path('storage/storeProducts/' . $storeProduct->name . '.png');
                $storeProduct->delete();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
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
    public function rate(Request $request, $storeProduct)
    {
        if (Auth::user()) {
            $storeProduct = StoreProduct::find($storeProduct);
            if ($storeProduct) {

                $existingRating = Auth::user()->storeProducts()->where('store_product_id', $storeProduct->id)->first();

                if ($existingRating) {
                    $existingRating->pivot->rating = $request->rating;
                    $existingRating->pivot->save();
                } else {
                    Auth::user()->storeProducts()->attach($storeProduct, ['rating' => $request->rating]);
                }

                return redirect()->route('storeProducts.index');
            }
        }
        return redirect()->route('home');
    }

}
