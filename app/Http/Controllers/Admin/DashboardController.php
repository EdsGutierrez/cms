<?php

//creacion DE CONTROLADOR DE ADMIN
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Models\Product;
class DashboardController extends Controller
{
    //Constructor
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');//PARA SACAR DE NUESTRA PAGINA BANEADO
        $this->middleware('user.Permissions');//PARA SACAR DE NUESTRA PAGINA SI INGRESAS POR URL
        $this->middleware('isadmin');
    }
    //======= LA PARTE DE ADMINISTRADOR========
    public function getDashboard(){
        $users = User::count();    //HACER MULTIPLES CONSULTAS  ESTADISTICAS DE USUARIOS
        //return $users;    //HACER MULTIPLES CONSULTAS
        $products = Product::where('status', '1')->count(); //HACER MULTIPLES CONSULTAS  ESTADISTICAS DE PRODUCTOS
        $data = ['users' => $users, 'products' => $products];    //HACER MULTIPLES CONSULTAS
        return view('admin.dashboard', $data);

    }
}
