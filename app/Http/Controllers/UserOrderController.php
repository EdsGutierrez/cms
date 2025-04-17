<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Order;
use Auth;

class UserOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //auth: Obligatorio que estee conectado y registrado
    }

    public function getHistory()
    {
        return view('user.orders_history');     //nos manda a la carpeta de VIEWS - USER  y crear un archivo (orders_history)
    }

    //Detalles del historial de compras
    public function getOrder(Order $order)
    {
        if ($order->status == "0" || $order->user_id != Auth::id()):
            return redirect('/');   //para errores de interpretacion o forzzar entrar a la orden
        else:
            $data = ['order' => $order];
            return view('user.order_details', $data);
        endif;
    }
}
