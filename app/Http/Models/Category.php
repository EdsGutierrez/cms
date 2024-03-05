<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;   //uso de eliminado suabe

class Category extends Model
{
    //use HasFactory;
    use HasFactory;
    use SoftDeletes;    //usando detedes

    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $hidden = ['created_at', 'updated_at'];


    //funcion para las categorias
    public function getSubcategories()
    {
        return $this->hasMany(Category::class, 'parent', 'id');
    }
    //relacion de categoria padre e hija
    public function getParent()
    {
        return $this->hasOne(Category::class, 'id', 'parent');
    }

}
