<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Http\Models\Order;
use App\Mail\OrderSendDetails;
use Illuminate\Support\Facades\Mail;
class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Para enviar detalles de la orden vdo=163
    public function getOrderEmailDetails($orderid)
    {
        $order = Order::find($orderid);
        $data = ['order' => $order];
        //Mail::to($order->getUser->email)->send(new OrderSendDetails($data));
        Mail::to('edsonpruebassistemas@gmail.com')->send(new OrderSendDetails($data));
        //return view('emails.order_details', $data);
        //return $orderid;
    }

}
