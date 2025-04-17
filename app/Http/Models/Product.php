<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;    //usando detedes

    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $hidden = ['created_at', 'updated_at'];

    //tener una relacion de uno a uno
    public function cat(){
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }

    //funcio  para obtener la sybcategoria de cada producto
    public function getSubcategory ()
    {
        return $this->hasOne(Category::class, 'id', 'subcategory_id');
    }

    //galeria de imagenes:: una relacion de uno a muchos
    //porque un producto puede tener muchas imagenes
    public function getGallery(){
        return $this->hasMany(PGallery::class, 'product_id', 'id');



        //o tambien asi lo podemos hacer una relacion y laravel entenderia
        //return $this->hasMany(PGallery::class);
    }

    // PARA TRAER LA VISUALIZACION DE LA CANTIDAD DE INVENTARIO DE PRODUCTos
    // para poer traer l acantidada de inventario lista
    public function getInventory ()
    {
        return $this->hasMany(Inventory::class, 'product_id', 'id')->orderBy('price', 'Asc');
    }

    //video 114
    //RElacion uno  a Muchos
    public function getPrice()
    {
        return $this->hasMany(Inventory::class, 'product_id', 'id')->orderBy('price', 'Asc');
    }
}

