<?php

namespace App\Http\Controllers;

use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;

class StoreProductController extends Controller
{
    public function index()/*MUESTRA TODOS LOS PRODUCTOS DE LA TIENDA PAGINADOS A CUALQUIER USUARIO*/
    {
        $storeProducts = StoreProduct::paginate(40);
        return view('online_store.index', compact('storeProducts'));
    }


    public function create()/*DEVUELVE LA VISTA PARA CREAR UN PRODUCTO SOLO SI ERES ADMIN*/
    {
        if (Auth::user() && Auth::user()->rol == 'admin') {
            return view('online_store.create');

        } else {
            return redirect()->route('home');

        }
    }

    public function store(StoreProductRequest $request)/*RECIBE LOS DATOS DEL FORMULARIO Y CREA UN PRODUCTO NUEVO*/
    {
        if (Auth::user() && Auth::user()->rol == 'admin') {

            $storeProduct = new StoreProduct();
            $storeProduct->name = ucfirst(mb_strtolower($request->input('name')));
            $storeProduct->description = ucfirst(mb_strtolower($request->input('description')));
            $storeProduct->price = $request->input('price', 0);
            $storeProduct->stock = $request->input('stock', 1);
            $storeProduct->category = $request->input('category');

            $storeProduct->image = $request->file('image')->storeAs('public/storeProducts', $storeProduct->name . '.png');

            $storeProduct->save();

            return redirect()->route('storeProducts.index');

        } else {
            return redirect()->route('home');
        }
    }

    public function edit(StoreProduct $storeProduct)/*REDIRIJE AL FORMULARIO PARA EDITAR UN PRODUCTO*/
    {
        if (Auth::user() && Auth::user()->rol == ('admin')) {
            return view('Online_store.edit', compact('storeProduct'));

        } else {
            return redirect()->route('home');

        }
    }

    public function update(StoreProductRequest $request, StoreProduct $storeProduct)/*RECIBE LOS DATOS DEL FORMULARIO DE EDITAR Y GUARDA LOS CAMBIOS*/
    {
        if (Auth::user() && Auth::user()->rol == ('admin')) {

            $imagePath = public_path('storage/storeProducts/' . $storeProduct->name . '.png');
            if (file_exists($imagePath)) {/*ELIMINA LA IMAGEN ANTIGUA PARA AGREGAR LA NUEVA*/
                unlink($imagePath);
            }
            $storeProduct->name = ucfirst(mb_strtolower($request->input('name')));
            $storeProduct->price = $request->input('price');
            $storeProduct->description = ucfirst(mb_strtolower($request->input('description')));
            $storeProduct->stock = $request->input('stock');
            $storeProduct->category = $request->input('category');
            $storeProduct->image = $request->file('image')->storeAs('public/storeProducts', $storeProduct->name . '.png');

            $storeProduct->save();

            return redirect()->route('storeProducts.index');

        } else {
            return redirect()->route('home');

        }
    }

    public function destroy(StoreProduct $storeProduct) /*ELIMINA EL PRODUCTO DE LA TIENDA JUNTO A SU IMAGEN GUARDADA EN STORAGE*/
    {
        if (Auth::user() && Auth::user()->rol == ('admin')) {

            $imagePath = public_path('storage/storeProducts/' . $storeProduct->name . '.png');
            $storeProduct->delete();
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            return redirect()->route('storeProducts.index');

        } else {
            return redirect()->route('home');
        }
    }

    public function filterAndSort(Request $request)/*FUNCION QUE FILTRA LOS PRODUCTOS POR NOMBRE Y CATEGORIA Y LOS ORDENA*/
    {
        $query = StoreProduct::query();

        if ($request->has('category') && $request->category != 'Todas las categorías') {
            $selectedCategory = $request->category;
            $query->where('category', $request->category);/*SACA LA CATEGORIA SELECCIONADA*/
        } else {
            $selectedCategory = null;
        }


        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {/*FILTRA EL NOMBRE Y LA DESCRIPCION SEGUN LO QUE RECIBA POR EL BUSCADOR*/
                $q->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($request->has('sort')) {/*ORDENA POR PRECIO O DE MAYOR A MENOR O DE MENOR A MAYOR*/
            if ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            }
        }
        $storeProducts = $query->paginate(40);
        return view('online_store.index', compact('storeProducts', 'selectedCategory'));
    }
    public function rate(Request $request, $storeProduct)/*FUNCION QUE GESTIONA LA VALORACION DE LOS PRODUCTOS*/
    {
        if (Auth::user()) {
            $storeProduct = StoreProduct::find($storeProduct);
            if ($storeProduct) {

                $existingRating = Auth::user()->storeProducts()->where('store_product_id', $storeProduct->id)->first();/*VERIFICA SI YA HAY UNA VALORACION*/

                if ($existingRating) {/*SI EXISTE LA ACTUALIZA SI NO , LA AÑADE*/
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
