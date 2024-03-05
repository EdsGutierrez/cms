<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;


class SliderController extends Controller
{
    //constructor de Sliders
    public function __construct()
    {
        $this->middleware('auth');  //si esta autenticacion del ususario
        $this->middleware('user.status'); // el usuario autenticado no esta baneado
        $this->middleware('user.Permissions'); //Si tiene los permisos
        $this->middleware('isadmin');   //Si es administrador
    }
    public function getHome()
    {
        $sliders = Slider::orderBy('sorder', 'Asc')->get();
        $data = ['sliders' => $sliders];
        return view('admin.slider.home', $data);
    }

    //Metodo para el controlador Slider
    public function postSliderAdd(Request $request)
    {
        //return $request->all();
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'content' => 'required',
            'sorder' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre del slider es requerido',
            'img.required' => 'Seleccione una imagen para el slider',
            'content.required' => 'El contenido es requerido',
            'sorder.required' => 'Es necesario definir un orden de aparición'

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else :
            $path = '/' . date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;

            $slider = new Slider;
            $slider->user_id = Auth::id();
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->file_path = date('Y-m-d');
            $slider->file_name = $filename;
            $slider->content = e($request->input('content'));
            $slider->sorder = e($request->input('sorder'));

            if ($slider->save()) :
                if ($request->hasFile('img')) :
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                endif;
                return back()->with('message', 'Imagen guardado con éxito')->with('typealert', 'success');
            endif;

        endif;
    }
    public function getSliderEdit($id)
    {
        $slider = Slider::findOrFail($id);
        $data = ['slider' => $slider];
        return view('admin.slider.edit', $data);
    }
    public function postSliderEdit(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'content' => 'required',
            'sorder' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre del slider es requerido',
            'content.required' => 'El contenido es requerido',
            'sorder.required' => 'Es necesario definir un orden de aparición'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else :
            $slider = Slider::find($id);
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->content = e($request->input('content'));
            $slider->sorder = e($request->input('sorder'));

            if ($slider->save()) :
                return back()->with('message', 'Imagen guardado con éxito')->with('typealert', 'success');
            endif;
        endif;
    }
    public function postSliderDelete($id)
    {
        //$slider = Slider::find($id);
        $slider = Slider::findOrFail($id);
        if ($slider->delete()) :
            return back()->with('message', 'El slider fue eliminado con éxito')->with('typealert', 'success');
        endif;
    }
} 
