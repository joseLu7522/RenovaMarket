<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{

    public function index()/*MUESTRA TODOS LOS CHATS DEL USUARIO AUTENTICADO*/
    {
        if (Auth::user()) {
            /*OBTIENE TODOS LOS MENSAJES RELACIONADOS CON EL USUARIO AUTENTICADO BIEN SEA EL REMITENTE O EL RECEPTOR Y LOS ORDENA*/
            $messages = Message::with('user_product')
                ->where('sender_id', auth()->id())
                ->orWhere('receiver_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();

            $chats = collect([]);/*ALMACENA LOS CHATS*/
            $uniqueProducts = collect([]);/*ALMACENA LOS IDS DE LOS PRODUCTOS*/

            foreach ($messages as $message) {

                $productId = $message->user_product_id;
                /*SI AUN NO SE A ABIERTO UN CHAT DEL PRODUCTO , SE ALMACENA PARA CREAR EL CHAT CON ESE PRODUCTO*/
                if (!$uniqueProducts->contains($productId)) {
                    $chats->push($message);
                    $uniqueProducts->push($productId);
                }
            }

            return view('messages.index', compact('chats'));

        } else {
            return redirect()->route('home');

        }
    }

    public function create()/*REDIRIJE A LA VISTA DE CREAR EL MENSAJE*/
    {
        if (Auth::user()) {
            return view('messages.create');
        } else {
            return redirect()->route('home');

        }
    }


    public function store(Request $request)/*ALMACENA LOS MENSAJES ENVIADOS*/
    {
        // Obtener el producto asociado al mensaje
        $userProduct = UserProduct::findOrFail($request->user_product_id);

        // Obtener el ID del usuario registrado
        $userId = auth()->id();

        // Verificar si el usuario registrado es el propietario del producto
        if ($userId == $userProduct->user_id) {
            // Si es el propietario, asignar como receptor al último remitente que no sea el usuario registrado
            $lastSender = Message::where('user_product_id', $request->user_product_id)
                ->where('sender_id', '!=', $userId)
                ->orderBy('created_at', 'desc')
                ->first();

            // Si se encuentra un último remitente, asignarlo como receptor
            if ($lastSender) {
                $messageReceiverId = $lastSender->sender_id;
            } else {
                // Si no se encuentra ningún remitente anterior, asignar al propietario del producto como receptor
                $messageReceiverId = $userProduct->user_id;
            }
        } else {
            // Si el usuario registrado no es el propietario, asignar al propietario del producto como receptor
            $messageReceiverId = $userProduct->user_id;
        }

        // Crear un nuevo mensaje
        $message = new Message();
        $message->sender_id = $userId; // Usuario registrado como remitente
        $message->receiver_id = $messageReceiverId; // Asignar al receptor calculado
        $message->user_product_id = $request->user_product_id;
        $message->content = $request->input('content');
        $message->save();

        // Redireccionar de vuelta a la vista de mensajes del producto
        return redirect()->route('messages.show', $userProduct);
    }




    /**
     * Display the specified resource.
     */
    public function show($productId)
    {

        // Obtener todos los mensajes asociados al producto y al usuario registrado
        $userId = auth()->id();
        $messages = Message::where('user_product_id', $productId)
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at')
            ->get();

        // Obtener información del producto
        $product = UserProduct::findOrFail($productId);

        return view('messages.show', compact('messages', 'product'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }


}
