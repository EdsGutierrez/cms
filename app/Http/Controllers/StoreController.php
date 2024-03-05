<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Category;
use App\Http\Models\Product;

class StoreController extends Controller
{
    public function getStore()
    {
        $categories = Category::where('module', '0')->where('parent', '0')->orderBy('order', 'Asc')->get();
        $data = ['categories' => $categories];
        return view('store', $data);
    }

    //metodo par ver las categoriasd e hHome
    public function getCategory($id, $slug)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('module', '0')->where('parent', $id)->orderBy('order', 'Asc')->get();
        $data = ['categories' => $categories, 'category' => $category];
        return view('category', $data);
    }

    //Metodo para hacer una busqueda ===> Vienend e la ruta web.php
    public function postSearch(Request $request)
    {
        //return $request->all();
        $products = Product::where('status', 1)->where('name', 'LIKE', '%' . $request->input('search_query') . '%')->orderBy('id', 'Asc')->get();
        $data = ['query' => $request->input('search_query'), 'products' => $products];
        return view('search', $data);
    }
}
