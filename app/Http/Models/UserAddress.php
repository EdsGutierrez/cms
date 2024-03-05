<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   //uso de eliminado suabe

class UserAddress extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'user_address';
    protected $hidden = ['created_at', 'updated_at'];

    public function getState(){
        return $this->hasOne(Coverage::class, 'id', 'state_id');
    }
    public function getCity(){
        return $this->hasOne(Coverage::class, 'id', 'city_id');
    }
}
