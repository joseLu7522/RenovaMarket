<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StoreProduct;



class BasketController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->except(['index']);
    }

    public function cart()
    {/*MUESTRA LA VISTA DE LOS PRODUCTOS GUARDADOS EN EL CARRITO DEL USUARIO AUTENTICADO*/
        $userId = Auth::user();
        $cartCollection = \Cart::session($userId)->getContent();

        return view('basket.index', compact('userId', 'cartCollection'));
    }

    public function remove(Request $request)
    {/*ELIMINA DEL CARRITO LOS PRODUCTOS SELECCIONADOS*/

        \Cart::session(Auth::user())->remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'El articulo ha sido borrado!');
    }

    public function add(Request $request)/*AÑADE UN ARRAY AL CARRITO DE LOS DATOS DEL PRODUCTO AÑADIDO*/
    {

        $product = StoreProduct::find($request->id);

        if ($product && $product->stock > 0 && $product->stock >= $request->quantity) {/*SI HAY STOCK DEL PRODUCTO Y NO SE EXCEDE DE LA CANTIDAD LO AÑADE AL CARRITO*/

            $existingCartItem = \Cart::session(Auth::user())->get($request->id);

            if ($existingCartItem && ($existingCartItem->quantity + $request->quantity) > $product->stock) {
                return redirect()->route('storeProducts.index')->with('error_msg', 'No se puede agregar más cantidad de este producto al carrito.');
            }

            \Cart::session(Auth::user())->add(
                array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'quantity' => $request->quantity,
                    'attributes' => array(
                        'image' => $product->image,
                        'slug' => $product->slug
                    )
                )
            );

            return redirect()->route('storeProducts.index')->with('success_msg', 'El artículo ha sido agregado a su carrito!');
        } else {
            return redirect()->route('storeProducts.index')->with('error_msg', 'El producto no está disponible en stock.');
        }
    }

    public function update(Request $request)/*ACTUALIZA LA CANTIDAD DEL PRODUCTO A COMPRAR SI NO EXCEDE DE LA DISPONIBLE*/
    {

        $product = StoreProduct::find($request->id);

        // Verificar si el producto existe y si hay suficiente stock disponible
        if ($product && $product->stock >= $request->quantity) {/*SI HAY SUFICIENTE STOCK , SE ACTUALIZA EL STOCK A COMPRAR*/

            \Cart::session(Auth::user())->update(
                $request->id,
                array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request->quantity
                    ),
                )
            );
            return redirect()->route('cart.index')->with('success_msg', 'Se ha actualizado el carrito!');
        } else {
            return redirect()->route('cart.index')->with('error_msg', 'La cantidad solicitada excede el stock disponible.');
        }
    }

    public function clear()
    {/*LIMPIA EL CARRITO COMPLETO Y SIMULA LA COMPRA DE LOS PRODUCTOS*/

        \Cart::session(Auth::user())->clear();

        if (request()->headers->get('referer') === route('cart.index')) {/*SI LA SOLICITUD VIENE DEL BOTON DE VACIAR LA CESTA , LA VACIA SI NO SIMULA LA COMPRA Y REDIRIJE AL INICIO*/
            return redirect()->route('cart.index')->with('success_msg', 'El carrito ha sido borrado con éxito!');
        } else {
            return redirect()->route('home');

        }
    }

}
