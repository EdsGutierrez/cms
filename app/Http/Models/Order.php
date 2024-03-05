<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'orders';
    protected $hidden = ['created_at', 'updated_at'];

    public function getItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id')->whereNull('discount_until_date')->orWhere(function ($query) {
            $query->where('discount_until_date', '>=', date('Y-m-d'));
        })->with(['getProduct']);
    }

    //Funcion para retirnar la direccion del la orden del ususario para el correo electrónico
    function getUserAddress()
    {
        return $this->hasOne(UserAddress::class, 'id', 'user_address_id');
    }

    public function getSubTotal()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id')->whereNull('discount_until_date')->orWhere(function ($query) {
            $query->where('discount_until_date', '>=', date('Y-m-d'));
        })->sum('total');
    }

    //Para los detalles de la orden
    public function getUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
