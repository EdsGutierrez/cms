<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Models\UserAddress;
use Validator;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //PARA AGREGAR LA DIRECCION PERO PARA QUE NOS SALGA POR DEFECTO Y NO VOLVER A ESCRIBIR
    public function getAddress(){
        return $this->hasMany(UserAddress::class, 'user_id', 'id')->with(['getState', 'getCity']);
    }
    public function getAddressDefault(){
        return $this->hasOne(UserAddress::class, 'user_id', 'id')->where('default', '1')->with(['getState', 'getCity']);
    }
}
