<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Order;
use Mail;
use App\Mail\AdminNotifyUserOrderStatusChange;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');//PARA SACAR DE NUESTRA PAGINA BANEADO
        $this->middleware('user.Permissions');//PARA SACAR DE NUESTRA PAGINA SI INGRESAS POR URL
        $this->middleware('isadmin');
    }
    public function getList($status, $type)
    {
        if ($status == 'all'):
            //$orders = Order::where('status', '!=', '0')->with(['getUser'])->orderBy('o_number', 'Desc')->paginate(30); //with(['getUser']) para llamar a NOMBRE Y APELLIDO y no desperdiciar mas llamadas a la base de datos
            if ($type == 'all'):
                $orders = Order::where('status', '!=', '0')->with(['getUser'])->orderBy('o_number', 'Desc')->paginate(30); //with(['getUser']) para llamar a NOMBRE Y APELLIDO y no desperdiciar mas llamadas a la base de datos
            else:
                $orders = Order::where('status', '!=', '0')->where('o_type', $type)->with(['getUser'])->orderBy('o_number', 'Desc')->paginate(30);
            endif;
        else:
            if ($type == 'all'):
                $orders = Order::where('status', $status)->with(['getUser'])->orderBy('o_number', 'Desc')->paginate(30);
            else:
                $orders = Order::where('status', $status)->where('o_type', $type)->with(['getUser'])->orderBy('o_number', 'Desc')->paginate(30);
            endif;
        endif;

        $all_ordes = Order::select(['id', 'status'])->get(); //para ver el filtrado de todo sin afectar el paginator 

        $data = ['orders' => $orders, 'all_ordes' => $all_ordes, 'status' => $status, 'type' => $type];
        return view('admin.orders.list', $data);
    }

    //funcion para ver los detalles de la orden en el administrador
    public function getOrder(Order $order)
    {
        $data = ['order' => $order];
        return view('admin.orders.view', $data);
    }


    //POST ORDER UPDATE STATUS Admin.php
    public function postOrderStatusUpdate(Order $order, Request $request)
    {
        if ($request->input('status') == "1" || $request->input('status') == "2" || $order->status == "6" || $order->status == "100"):
            return back();
        else:
            $order->status = $request->input('status');
            if ($request->input('status') == "3" && is_null($order->process_at)):
                $order->process_at = date('Y-m-d h:i:s');
            endif;
            if ($request->input('status') == "4" && is_null($order->send_at)):
                $order->send_at = date('Y-m-d h:i:s');
            endif;
            if ($request->input('status') == "5" && is_null($order->send_at)):
                $order->send_at = date('Y-m-d h:i:s');
            endif;
            if ($request->input('status') == "6" && is_null($order->delivery_at)):
                $order->delivery_at = date('Y-m-d h:i:s');
            endif;
            if ($request->input('status') == "100" && is_null($order->rejected_at)):
                $order->rejected_at = date('Y-m-d h:i:s');
            endif;

            if ($order->save()):
                $user = $order->getUser;
                $data = ['name' => $user->name, 'email' => $user->email, 'status' => $request->input('status'), 'o_number' => $order->o_number];
                Mail::to($user->email)->send(new AdminNotifyUserOrderStatusChange($data));
                return back()->with('message', 'Cambio de estado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }
}
