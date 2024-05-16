<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProductRequest;


class UserProductController extends Controller
{
    public function index()/*MUESTRA TODOS LOS PRODUCTOS DE USUARIO*/
    {
        if (Auth::user()) {
            $userProducts = UserProduct::all();
            return view('buy_sell.index', compact('userProducts'));
        } else {
            return redirect()->route('home');

        }
    }

    public function create()/*REDIRIJE A LA RUTA PARA CREAR UN PRODUCTO*/
    {
        if (Auth::user()) {
            return view('buy_sell.create');
        } else {
            return redirect()->route('home');

        }
    }

    public function store(UserProductRequest $request)/*GUARDA UN PRODUCTO EN LA BD*/
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

    public function edit(UserProduct $userProduct)/*REDIRIJE A LA RUTA DE EDITAR SI EL USUARIO LOGUEADO ES EL PROPIETARIO DEL PRODUCTO*/
    {
        if (Auth::user() && Auth::id() == $userProduct->user_id) {
            return view('buy_sell.edit', compact('userProduct'));
        } else {
            return redirect()->route('home');

        }
    }

    public function update(Request $request, UserProduct $userProduct)/*ACTUALIZA LOS DATOS DEL PRODUCTO MODIFICADO*/
    {
        if (Auth::user() && Auth::id() == $userProduct->user_id) {

            $imagePath = public_path('storage/userProducts/' . $userProduct->name . '.png');
            if (file_exists($imagePath)) {/*ELIMINA LA IMAGEN PARA LUEGO VOLVERLA A CARGAR*/
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
    }

    public function destroy(UserProduct $userProduct)/*ELIMINA EL PRODUCTO SI ERES ADMIN O EL DUEÑO DEL PRODUCTO*/
    {
        if (Auth::check() && Auth::user()->rol == 'admin' || Auth::user()->id === $userProduct->user_id) {

            $imagePath = public_path('storage/userProducts/' . $userProduct->name . '.png');
            $userProduct->delete();
            if (file_exists($imagePath)) {/*ELIMINA LA IMAGEN DEL STORAGE*/
                unlink($imagePath);
            }
            return redirect()->route('userProducts.index');

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
