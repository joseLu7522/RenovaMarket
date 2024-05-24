<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\Auth;
use App\Models\StoreProduct;
use App\Models\Purchase;
class InvoiceController extends Controller
{

    public function completePurchase(Request $request)
    {
        $cartCollection = json_decode(urldecode($request->input('cartCollection')));

        if (empty($cartCollection)) {
            return redirect()->back()->with('error_msg', 'No se encontraron datos del carrito o el carrito está vacío');
        }

        $total = 0;
        foreach ($cartCollection as $item) {
            $product = StoreProduct::find($item->id);
            if ($product && $product->stock >= $item->quantity) {
                $product->stock -= $item->quantity;
                $product->save();
                $total += $item->price * $item->quantity;
            } else {
                return redirect()->back()->with('error_msg', 'Stock insuficiente para el producto: ' . $item->name);
            }
        }

        // Guardar los datos de la compra en la base de datos
        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'purchase_data' => $cartCollection,
            'total' => $total,
        ]);

        // Guardar los datos del carrito en la sesión
        session(['cartCollection' => $cartCollection]);

        // Redirigir a la página de inicio y establecer una variable de sesión para la factura
        return redirect()->route('home')->with('success_purchase', 'Se ha realizado la compra con éxito!');
    }


    public function generateInvoice(Request $request)
    {
        $cartCollection = session('cartCollection');

        if (empty($cartCollection)) {
            return redirect()->back()->with('error_msg', 'No se encontraron datos del carrito o el carrito está vacío');
        }

        $user = Auth::user();
        $customer = new Buyer([
            'name' => $user->name,
            'custom_fields' => [
                'email' => $user->email,
            ],
        ]);

        $seller = new Buyer([
            'name' => 'Renovamarket',
            'custom_fields' => [
                'email' => 'renovaMarket@gmail.com',
                'phone' => '601 29 18 19',
                'address' => 'Carrer els Ports, 8, 46940 Manises, Valencia'
            ],
        ]);

        $items = [];
        foreach ($cartCollection as $item) {
            $items[] = (new InvoiceItem())->title($item->name)->pricePerUnit($item->price)->quantity($item->quantity);
        }

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->addItems($items)
            ->save('public');

        session()->forget('cartCollection');

        \Cart::session(Auth::user())->clear();

        return $invoice->stream();
    }
}
