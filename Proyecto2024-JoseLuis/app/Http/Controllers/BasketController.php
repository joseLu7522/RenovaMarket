<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basketItems = Basket::all();
        return view('basket.index', compact('basketItems'));
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
     /*   $product = StoreProduct::findOrFail($request->product_id);

        $basketItem = Basket::where('storeProduct_id', $product->id)->first();

        if ($basketItem) {
            $basketItem->quantity += 1;
            $basketItem->total_price += $product->price;
            $basketItem->save();
        } else {
            $basketItem = new Basket;
            $basketItem->storeProduct_id = $product->id;
            $basketItem->name = $product->name;
            $basketItem->price = $product->price;
            $basketItem->description = $product->description;
            $basketItem->image = $product->image;
            $basketItem->quantity = 1;
            $basketItem->total_price = $product->price;
            $basketItem->save();
        }

        return redirect()->route('basket.index');*/
    }


    /**
     * Display the specified resource.
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Basket $basket)
    {
        //
    }
}
