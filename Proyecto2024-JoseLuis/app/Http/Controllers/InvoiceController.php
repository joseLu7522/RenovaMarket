<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function generateInvoice(Request $request)
    {
        // Decodificar y deserializar el array JSON de la solicitud
        $cartCollection = json_decode(urldecode($request->input('cartCollection')));

        if ($cartCollection === null) {
            // Manejar el caso en el que $cartCollection es null
            // Por ejemplo, redireccionar a la página anterior con un mensaje de error
            return redirect()->back()->with('error', 'No se encontraron datos del carrito');
        }

        $user = Auth::user();
        $customer = new Buyer([
            'name'          => $user->name,
            'custom_fields' => [
                'email' => $user->email,
            ],
        ]);

        $seller = new Buyer([
            'name'          => 'Renovamarket',
            'custom_fields' => [
                'email' => 'renovaMarket@gmail.com',
                'phone' => '601 29 18 19',
                'address' => 'Carrer els Ports, 8, 46940 Manises, Valencia'
            ],
        ]);

        $items = [];

        foreach ($cartCollection as $item) {
            // Agrega cada producto al invoice
            $items[] = (new InvoiceItem())->title($item->name)->pricePerUnit($item->price)->quantity($item->quantity);
        }

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->taxRate(21)
            ->shipping(6)
            ->addItems($items);

        return $invoice->stream();
    }
}
