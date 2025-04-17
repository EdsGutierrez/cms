<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Http\Models\Order;
use App\Mail\OrderSendDetails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Para enviar detalles de la orden vdo=163
    public function getOrderEmailDetails($orderid)
    {
        $order = Order::find($orderid);
        $data = ['order' => $order];
        //Mail::to($order->getUser->email)->send(new OrderSendDetails($data));

        //foreach ($this->getAdminEmails() as $admin):
            //$data = ['order' => $order, 'name' => $admin->name . '' . $admin->lastname];
            Mail::to('edsonpruebassistemas@gmail.com')->send(new OrderSendDetails($data));
        //endforeach;

    }

    //nose qeu VIDEOES PERO IMPLEMENTE EN EL 169
    public function getAdminEmails()
    {
        return DB::table('users')->where('role', '1')->get();
    }

    //vid: 169
    public function getProcessOrder($id){
        $order = ORder::find($id);
        $order->o_number = $this->getOrderNumberGenerate();
        $order->status = '1';
        $order->request_at = date('Y-m-d h:i:s');
        $order->save();
    }

    public function getOrderNumberGenerate()
    {
        $orders = Order::where('status', '>', '0')->count();
        $orderNumber = $orders + 1;
        return $orderNumber;
    }

}
