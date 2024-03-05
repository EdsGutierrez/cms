<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;

//traer el modelo=========
use App\Http\Models\Category;
//use Validator, Str;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class CategoriesController extends Controller
{
    //Constructor
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status'); //PARA SACAR DE NUESTRA PAGINA BANEADO
        $this->middleware('user.Permissions'); //PARA SACAR DE NUESTRA PAGINA SI INGRESAS POR URL
        $this->middleware('isadmin');
    }

    //El metodo getHome
    public function getHome($module)
    {
        $cats = Category::where('module', $module)->where('parent', '0')->orderBy('order', 'Asc')->get();
        $data = ['cats' => $cats, 'module' => $module];
        return view('admin.categories.home', $data);
    }
    //========================================================
    //categorias
    public function postCategoryAdd(Request $request, $module)
    {
        $rules = [
            'name' => 'required',
            'icon' => 'required',

        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoría',
            'icon.required' => 'Se requiere de un ícono para la categoría',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else :
            //===de producto controller ADDpostCategory
            $path = '/' . date('Y-m-d');
            $fileExt = trim($request->file('icon')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
            $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;
            //===

            $c = new Category;
            $c->module = $module;   //$request->input('module'); 
            $c->parent = $request->input('parent');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->file_path = date('Y-m-d');
            $c->icono = $filename;
            if ($c->save()) :
                if ($request->hasFile('icon')) :
                    $fl = $request->icon->storeAs($path, $filename, 'uploads');
                endif;
                return back()->with('message', 'Icono guardado con éxito')->with('typealert', 'success');
            endif;
        endif;
    }
    //===================================================
    public function getCategoryEdit($id)
    {
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    //FUNXION MODIFICAR CATEGORIA
    public function postCategoryEdit(Request $request, $id)
    {
        $rules = [
            'name' => 'required',

        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoría',
        ];

        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else :
            $c = Category::find($id);
            //$c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name')); //tener cuidado al momento de editar
            if ($request->hasFile('icon')) :
                $actual_icon = $c->icono;
                $actual_file_path = $c->file_path;
                $path = '/' . date('Y-m-d');
                $fileExt = trim($request->file('icon')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
                $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;
                $fl = $request->icon->storeAs($path, $filename, 'uploads');
                $c->file_path = date('Y-m-d');
                $c->icono = $filename;
                if (!is_null($actual_icon)) :
                    unlink($upload_path . '/' . $actual_file_path . '/' . $actual_icon);
                endif;
            endif;
            $c->order = $request->input('order');
            if ($c->save()) :
                return back()->with('message', 'Se modificó con éxito')->with('typealert', 'success');
            endif;
        endif;
    }


    //funcion para eliminar
    public function getCategoryDelete($id)
    {
        $c = Category::find($id);
        if ($c->delete()) :
            return back()->with('message', 'Se Eliminó con éxito')->with('typealert', 'success');
        endif;
    }

    //Editar subcategorias getSubcategories 
    public function getSubsCategories($id)
    {
        $cat = Category::findOrFail($id);
        //return $cat->getSubcategories; 
        $data = ['category' => $cat];
        return view('admin.categories.subs_categories', $data);
    }
}
