<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Category, App\Http\Models\Product, App\Http\Models\PGallery, App\Http\Models\Inventory, App\Http\Models\Variant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

use Image;

class ProductController extends Controller
{
    //Constructor
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status'); //PARA SACAR DE NUESTRA PAGINA BANEADO
        $this->middleware('user.Permissions'); //PARA SACAR DE NUESTRA PAGINA SI INGRESAS POR URL
        $this->middleware('isadmin');
    }

    public function getHome($status)
    {
        switch ($status) {
            case '0':
                $products = Product::with(['cat', 'getSubcategory', 'getPrice'])->where('status', '0')->orderBy('id', 'desc')->paginate(25);
                break;
            case '1':
                $products = Product::with(['cat', 'getSubcategory', 'getPrice'])->where('status', '1')->orderBy('id', 'desc')->paginate(25);
                break;
            case 'all':
                $products = Product::with(['cat', 'getSubcategory', 'getPrice'])->orderBy('id', 'desc')->paginate(25);
                break;
            case 'trash':
                $products = Product::with(['cat', 'getSubcategory', 'getPrice'])->onlyTrashed()->orderBy('id', 'desc')->paginate(25);
                break;
        }
        //return $products;
        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }

    public function getProductAdd()
    {
        //creando cconsulta para agregar productos
        $cats = Category::where('module', '0')->where('parent', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];

        return view('admin.products.add', $data);
    }

    //CONTROLADOR DE ADD PRODCUTOS
    public function postProductAdd(Request $request)
    {
        $rules = [
            'name' => 'required',
            'img' => 'required',
            //'price' => 'required',
            'content' => 'required'

        ];
        $messages = [
            'name.required' => 'El nombre del producto es requerido',
            'img.required' => 'Selecciona una imagen destacada',
            'img.image' => 'El archivo no es una imagen',
            //'price.required' => 'Ingrese el precio del producto',
            'content.required' => 'Ingrese una descripsion del prodcuto'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else :
            $path = '/' . date('Y-m-d');   //nombre del forder la fecha 2021-02-14
            $fileExt = trim($request->file('img')->getClientOriginalExtension());  //extraccion de la extension del archivo
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;     //generar un uevo nombre para guardar
            //return $filename;
            $file_file = $upload_path . '/' . $path . '/' . $filename; //archivo final
            //return $file_file;
            //---------
            $product = new Product;
            $product->status = '0';
            $product->code = e($request->input('code'));    //codigo para codigo del inventario
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->subcategory_id = $request->input('subcategory');
            $product->file_path = date('Y-m-d');    //agregando despues
            $product->image = $filename;
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            if ($product->save()) :
                if ($request->hasFile('img')) :
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file); //luego para visulalizar miniaturas
                    $img->fit(256, 256, function ($constraint) {  //toma el punto central y recorta 256px a cada lado
                        //$img->resize(256, 256, function($constraint){   //va cortar la imagen
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/t_' . $filename);
                endif;
                return redirect('/admin/product/' . $product->id . 'edit')->with('message', 'Guardado con éxito')->with('typealert', 'success');
            endif;
        endif;
    }
    //funcion para editar productos
    public function getProductEdit($id)
    {
        $p = Product::findOrFail($id);  //buscamos el producto
        $cats = Category::where('module', '0')->where('parent', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'p' => $p];
        return view('admin.products.edit', $data);
    }

    //======================================================================
    //============PARA EDITAR EL PRODUCTO DESDE HOME
    public function postProductEdit($id, Request $request)
    {
        $rules = [
            'name' => 'required',
            //'img' => 'required',
            //'price' => 'required',
            'content' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre del product es required',

            'img.image' => 'El archivo no es una imagen',
            //'price.required' => 'Ingrese el precio del producto',
            'content.required' => 'Ingrese una descripsion del prodcuto'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else :
            /*$path = '/' . date('Y-m-d');   //nombre del folder la fecha 2021-02-14
            $fileExt = trim($request->file('img')->getClientOriginalExtension());  //extraccion de la extension del archivo
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;     //generar un uevo nombre para guardar
            //return $filename;
            $file_file = $upload_path . '/' . $path . '/' . $filename; //archivo final
            //return $file_file;
            */

            //---------
            $product = Product::findOrFail($id);
            //para eliminar el archivo y no acumularse en la BdD
            //imgprepath =  ipp
            $ipp = $product->file_path;
            $ip = $product->image; //$ip = imagen previo

            $product->status = $request->input('status');
            $product->code = e($request->input('code'));    //codigo para codigo del inventario
            $product->name = e($request->input('name'));
            //$product->slug = Str::slug($request->input('name'));  //NO MODIFICAR ERROR 404 NO RECOMENDABLE MODFICAR
            $product->category_id = $request->input('category');
            $product->subcategory_id = $request->input('subcategory');

            //HACER UN CONDICIONAL solo funciona si solo queremos cambiar la immgaen
            if ($request->hasFile('img')) :
                $path = '/' . date('Y-m-d');   //nombre del forder la fecha 2021-02-14
                $fileExt = trim($request->file('img')->getClientOriginalExtension());  //extraccion de la extension del archivo
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

                $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;     //generar un uevo nombre para guardar
                //return $filename;
                $file_file = $upload_path . '/' . $path . '/' . $filename; //archivo final
                //return $file_file;
                $product->file_path = date('Y-m-d');    //agregando despues
                $product->image = $filename;
            endif;
            //$product->price = $request->input('price');
            //$product->inventory = e($request->input('inventory'));  //codigo para codigo del inventario
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->discount_until_date = $request->input('discount_until_date');
            $product->content = e($request->input('content'));

            if ($product->save()) :
                $this->getUpdateMinPrice($product->id);
                if ($request->hasFile('img')) :
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file); //luego para visulalizar miniaturas
                    $img->fit(256, 256, function ($constraint) {  //toma el punto central y recorta 256px a cada lado
                        //$img->resize(256, 256, function($constraint){   //va cortar la imagen
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/t_' . $filename);

                    //para eliminar por completo la imagen previa
                    unlink($upload_path . '/' . $ipp . '/' . $ip);
                    unlink($upload_path . '/' . $ipp . '/t_' . $ip);
                endif;
                return back()->with('message', 'Actualizado con éxito')->with('typealert', 'success');
            endif;
        endif;
    }

    //========FUNCION PARA EDITAR DESDE HOME
    //y llamammos al modelo direccion arriba
    public function postProductGalleryAdd($id, Request $request)
    {
        $rules = [
            'file_image' => 'required'
        ];
        $messages = [
            'file_image.required' => 'Selecciona una imagen'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else :
            if ($request->hasFile('file_image')) :
                $path = '/' . date('Y-m-d');   //nombre del forder la fecha 2021-02-14
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());  //extraccion de la extension del archivo
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));

                $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;
                $file_file = $upload_path . '/' . $path . '/' . $filename; //archivo final

                $g = new PGallery;
                $g->product_id = $id;
                $g->file_path = date('Y-m-d');
                $g->file_name = $filename;

                if ($g->save()) :
                    if ($request->hasFile('file_image')) :
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                        $img = Image::make($file_file); //luego para visulalizar miniaturas
                        $img->fit(512, 512, function ($constraint) {
                            $constraint->upsize();
                        });
                        $img->save($upload_path . '/' . $path . '/t_' . $filename);
                    endif;
                    return back()->with('message', 'Imagen subida con éxito')->with('typealert', 'success');
                endif;
            endif;
        endif;
    }

    public function getProductGalleryDelete($id, $gid)
    {
        $g = PGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');

        if ($g->product_id != $id) {
            return back()->with('message', 'La imagen no se pudo eliminar')->with('typealert', 'danger');
        } else {
            if ($g->delete()) :
                unlink($upload_path . '/' . $path . '/' . $file);
                unlink($upload_path . '/' . $path . '/t_' . $file);
                return back()->with('message', 'La imagen fue eliminada con éxito')->with('typealert', 'success');
            endif;
        }
    }
    public function postProductSearch(Request $request)
    {
        $rules = [
            'search' => 'required'
        ];
        $messages = [
            'search.required' => 'El campo consulta es requerido'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return redirect('/admin/products/1')->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else :
            switch ($request->input('filter')):
                case '0':
                    $products = Product::with(['cat'])->where('name', 'LIKE', '%' . $request->input('search') . '%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $products = Product::with(['cat'])->where('code', $request->input('search'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;
            $data = ['products' => $products];
            return view('admin.products.search', $data);
        endif;
    }

    //==FUNCION PARA ELIMINAR PRODUCTOS
    public function getProductDelete($id)
    {
        $p = Product::findOrFail($id);
        if ($p->delete()) :
            return back()->with('message', 'Producto fue enviado a la papelera de reciclage')->with('typealert', 'success');
        endif;
    }


    public function getProductRestore($id)
    {
        //$p = Product::findOrFail($id);
        $p = Product::onlyTrashed()->where('id', $id)->first();
        //$p->restore();
        //dd($p);
        //$p->deleted_at = null;
        if ($p->restore()) :
            return redirect('/admin/product/' . $p->id . '/edit')->with('message', 'Este producto se restauró con éxito')->with('typealert', 'success');
        endif;
    }


    //==========mETODO DE INVENARIO
    public function getProductInventory($id)
    {
        $product = Product::findOrFail($id);
        $data = ['product' => $product];
        return view('admin.products.inventory', $data);
    }

    //============inventario de catidad que hay
    public function postProductInventory($id, Request $request)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre del inventario es requerido',
            'price.required' => 'Ingrese el precio del inventario'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else :
            $inventory = new Inventory;
            $inventory->product_id = $id;
            $inventory->name = e($request->input('name'));
            $inventory->quantity = $request->input('inventory');
            $inventory->price = $request->input('price');
            $inventory->limited = $request->input('limited');
            $inventory->minimum = $request->input('minimum');
            if ($inventory->save()) :
                $this->getUpdateMinPrice($inventory->product_id);
                return back()->with('message', 'Guardado con éxito')->with('typealert', 'success');
            endif;
        endif;

    }

    //=============== OTRO METODO DE INVENTARIO
    public function getProductInventoryEdit ($id)
    {
        $inventory = Inventory::findOrFail($id);
        //$product = Product::findOrFail($inventory->product_id);
        $data = ['inventory' => $inventory];
        return view('admin.products.inventory_edit', $data);
    }
    //============ METODO POST PARA GUARDAR LOS DATOS DEL EDITAR INVENTARIO
    public function postProductInventoryEdit($id, Request $request)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre del inventario es requerido',
            'price.required' => 'Ingrese el precio del inventario'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else :
            //$inventory = new Inventory; //no crear nueva instacia
            $inventory = Inventory::find($id);  //solo buscar con el identificador ID
            //$inventory->product_id = $id;
            $inventory->name = e($request->input('name'));
            $inventory->quantity = $request->input('inventory');
            $inventory->price = $request->input('price');
            $inventory->limited = $request->input('limited');
            $inventory->minimum = $request->input('minimum');
            if ($inventory->save()) :
                $this->getUpdateMinPrice($inventory->product_id);
                return back()->with('message', 'Guardado con éxito')->with('typealert', 'success');
            endif;
        endif;
    }

    //===================   EILIMINAR DATOS DEL INVENTARIO
    public function getProductInventoryDeleted($id)
    {
        $inventory = Inventory::findOrFail($id);
        if ($inventory->delete()) :
            $this->getUpdateMinPrice($inventory->product_id);
            return back()->with('message', 'Inventario eliminado')->with('typealert', 'success');
        endif;
    }

    //METODO PARA ADD
    public function postProductInventoryVariantAdd($id , Request $request)
    {
        $rules = [
            'name' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre de la variante es requerido'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else :
            $inventory = Inventory::findOrFail($id);  //solo buscar con el identificador ID

            $variant = new Variant;
            $variant->product_id = $inventory->product_id;
            $variant->inventory_id = $id;
            $variant->name = e($request->input('name'));
            if ($variant->save()) :
                return back()->with('message', 'Guardado con éxito')->with('typealert', 'success');
            endif;
        endif;
    }

    // ELIMINAR SOFT DELETES  PARA LS VARIANES DE PRODUCTOS
    public function getProductInventoryVariantDeleted($id)
    {
        $variant = Variant::findOrFail($id);
        if ($variant->delete()) :
            return back()->with('message', 'Variante eliminado')->with('typealert', 'success');
        endif;
    }

    //METDODO PARA
    public function getUpdateMinPrice($id)
    {
        $product = Product::find($id);
        $price = $product->getPrice->min('price');

        $product->price = $price;
        $product->save();
    }
}
