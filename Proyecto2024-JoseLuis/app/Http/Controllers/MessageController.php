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

        $userProduct = UserProduct::findOrFail($request->user_product_id);

        if (auth()->id() == $userProduct->user_id) {/*SI EL USUARIO REGISTRADO ES EL PROPIETARIO ASIGNA COMO RECEPTOR AL ULTIMO REMITENTE QUE NO SEA EL REGISTRADO*/

            $lastSender = Message::where('user_product_id', $request->user_product_id)
                ->where('sender_id', '!=', auth()->id())
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastSender) {/*SI HAY UN ULTIMO REMITENTE SE ASIGNA COMO RECEPTOR*/
                $messageReceiverId = $lastSender->sender_id;
            } else {/*ASIGNA AL PROPIETARIO COMO RECEPTOR*/
                $messageReceiverId = $userProduct->user_id;
            }
        } else {
            $messageReceiverId = $userProduct->user_id;
        }

        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $messageReceiverId;
        $message->user_product_id = $request->user_product_id;
        $message->content = $request->input('content');
        $message->save();

        return redirect()->route('messages.show', $userProduct);
    }

    public function show($productId)
    {
        $userId = auth()->id();

        /*OBTIENE TODOSLOS MENSAJES ASOCIADOS AL PRODUCTO Y AL USUARIO*/
        $messages = Message::where('user_product_id', $productId)
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at')
            ->get();

        /*AL ENTRAR A LA RUTA DE SHOW MARCA COMO LEIDOS LOS MENSAJES*/
        Message::where('user_product_id', $productId)
            ->where('receiver_id', $userId)
            ->where('read', false)
            ->update(['read' => true]);

        $product = UserProduct::findOrFail($productId);

        return view('messages.show', compact('messages', 'product'));
    }


}
