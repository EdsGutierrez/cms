<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\Config;
use App\Http\Models\Product, App\Http\Models\Favorite, App\Http\Models\Inventory, App\Http\Models\Category, App\Http\Models\Coverage;

class ApiJsController extends Controller
{
    //contructor traido de connectController
    public function __construct()
    {
        $this->middleware('auth')->except(['getProductsSection']);   //que este logeado excepto cuando menos en ==> getProductsSection
    }


    function getProductsSection($section, Request $request)
    {
        $items_x_page = Config::get('mycms.products_per_page'); //moistrar por numero
        $items_x_page_random = Config::get('mycms.products_per_page_random'); //mostar randomico
        switch ($section):
            case 'home':
                $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_page_random);
                break;
            case 'store':
                $products = Product::where('status', 1)->orderBy('id', 'Desc')->paginate($items_x_page);
                break;
            case 'store_category':
                $products = $this->getProductsCategory($request->get('object_id'), $items_x_page);
                break;
            default:
                $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_page_random);
                break;
        endswitch;
        return $products;
    }
    //=== FUNCIO PARA VER LAS SUBCATEGORIAS DE LA PARTE DE LA TIENDA
    public function getProductsCategory($id, $ipp)
    {
        $category = Category::find($id);
        if ($category->parent == "0") :
            $query = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'Desc')->paginate($ipp);
        else :
            $query = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'Desc')->paginate($ipp);
        endif;
        return $query;
    }
    //metodo para agregar a fvoritos 
    function postFavoriteAdd($object, $module, Request $request)
    {
        $query = Favorite::where('user_id', Auth::id())->where('module', $module)->where('object_id', $object)->count();    //para no duplicar doble favorito Coutn=contar la cantidad de usuarios que hay
        if ($query > 0) :
            $data = ['status' => 'error', 'msg' => 'Ya esta en sus favoritos'];
        else :
            $favorite = new Favorite;
            $favorite->user_id = Auth::id();    //si o si este logieado
            $favorite->module = $module;    //metodo post
            $favorite->object_id = $object;
            if ($favorite->save()) :
                $data = ['status' => 'success', 'msg' => 'Se guardo a favoritos'];
            endif;
        endif;
        return response()->json([$data]);
    }

    public function postUserFavorites(Request $request)
    {
        //return response()->json($request->input('objects'));    //solo l alista de objetos con JSON ===> sin e l codigo Html
        $query = Favorite::where('user_id', Auth::id())->where('module', $request->input('module'))->whereIn('object_id', explode(",", $request->input('objects')))->pluck('object_id');
        if (count(collect($query)) > 0) :
            $data = ['status' => 'success', 'count' => count(collect($query)), 'objects' => $query];
        else :
            $data = ['status' => 'success', 'count' => count(collect($query))];
        endif;
        return response()->json($data);
    }

    //= METODO PARA LA RUTA DE AGRAGAR PRECIO DE JS EN LAS VARIANTES
    public function postProductInventoryVariants($id)
    {
        $query = Inventory::find($id);
        return response()->json($query->getVariants);
        //return response()->json(['hola mundo']);
    }

    //PARA CARGAR LAS CIUDADES EN EL SELESCT DE MIS DIRECCIONES
    public function postCoverageCtitiesFromState($state){
        $cities = Coverage::where('ctype', '1')->where('state_id', $state)->get();
        return response()->json($cities);

    }
}
