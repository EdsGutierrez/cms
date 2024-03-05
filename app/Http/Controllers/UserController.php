<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Image, Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use PhpParser\Node\Stmt\If_;
use App\Http\Models\Coverage;
use App\Http\Models\UserAddress;

class UserController extends Controller
{
    //Controlador todas las acciones del usuario
    //Pass, Avatar, PEdidos
    public function __construct()
    {
        $this->middleware('auth'); //auth: Obligatorio que estee conectado y registrado
    }
    public function getAccountEdit()
    {
        //============para cambiar el año de nacimiento
        $birthday = is_null(Auth::user()->birthday)
            ? [null, null, null]
            : explode('-', Auth::user()->birthday); //clase explore de fechas que "-" gion separa de un caracter
        $data = ['birthday' => $birthday];
        //============para cambiar el año de nacimiento

        return view('user.account_edit', $data);
    }

    //metododo para cambiar la imagen del avatar
    public function postAccountAvatar(Request $request)
    {
        $rules = [
            'avatar' => 'required',
        ];
        $messages = [
            'avatar.required' => 'Seleccione una imagen',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()):
            return back()
                ->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput(); //guardar archivos perosnales //extraccion de la extension del archivo //archivo final //aa = actual avatar //luego para visulalizar miniaturas
        else:
            if ($request->hasFile('avatar')):
                $path = '/' . Auth::id();
                $fileExt = trim(
                    $request->file('avatar')->getClientOriginalExtension()
                );
                $upload_path = Config::get(
                    'filesystems.disks.uploads_user.root'
                );
                $name = Str::slug(
                    str_replace(
                        $fileExt,
                        '',
                        $request->file('avatar')->getClientOriginalName()
                    )
                );

                $filename = rand(1, 999) . '_' . $name . '.' . $fileExt;
                $file_file = $upload_path . '/' . $path . '/' . $filename;

                $u = User::find(Auth::id());
                $aa = $u->avatar;
                $u->avatar = $filename;

                if ($u->save()):
                    if ($request->hasFile('avatar')):
                        $fl = $request->avatar->storeAs(
                            $path,
                            $filename,
                            'uploads_user'
                        );
                        $img = Image::make($file_file);
                        $img->fit(256, 256, function ($constraint) {
                            $constraint->upsize();
                        });
                        $img->save(
                            $upload_path . '/' . $path . '/av_' . $filename
                        );
                    endif;
                    if ($aa):
                        unlink($upload_path . '/' . $path . '/' . $aa);
                        unlink($upload_path . '/' . $path . '/av_' . $aa);
                    endif;
                    return back()
                        ->with('message', 'Avatar Actualizada con éxito')
                        ->with('typealert', 'success');
                endif;
            endif;
        endif;
    }

    //Controlador para cambiar contraseña del usuario
    public function postAccountPassword(Request $request)
    {
        $rules = [
            'apassword' => 'required|min:8', //a pasw = actual pass
            'password' => 'required|min:8', //nuewvo pass
            'cpassword' => 'required|min:8|same:password', //c pass = conf pass
        ];
        $messages = [
            'apassword.required' => 'Escriba su contraseña actual',
            'apassword.min' =>
                'La contraseña actual debe de tener al menos 8 caracteres',

            'password.required' => 'Escriba su nueva contraseña actual',
            'password.min' =>
                'Su nueva contraseña actual debe de tener al menos 8 caracteres',

            'cpassword.required' => 'Confirme su nueva contraseña',
            'cpassword.min' =>
                'La confirmación de la nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.same' => 'Las contraseñas no coinciden',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()):
            return back()
                ->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
            //return 'pass';
        else:
            $u = User::find(Auth::id());
            if (Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));
                if ($u->save()):
                    return back()
                        ->with(
                            'message',
                            'Su contraseña se actualizó con éxito'
                        )
                        ->with('typealert', 'success');
                endif;
            else:
                return back()
                    ->with('message', 'Su contraseña actual es errónea')
                    ->with('typealert', 'danger');
            endif;
        endif;
    }

    //Funcion para editar l ainformacion del usuario
    public function postAccountInfo(Request $request)
    {
        $rules = [
            'name' => 'required', //a pasw = actual pass
            'lastname' => 'required', //nuewvo pass
            'phone' => 'required|min:8',
            'year' => 'required',
            'day' => 'required',
        ];
        $messages = [
            'name.required' => 'Su nombre es requerido',
            'lastname.required' => 'Su apellido es requerido',
            'phone.required' => 'Su número telefónico es requerido',
            'phone.min' =>
                'El número telefónico debe tener como minimo 8 dígitos',
            'year.required' => 'El año de nacimiento es requerido',
            'day.required' => 'Su día de nacimiento es requerido',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()):
            return back()
                ->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else:
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->birthday = date(
                'Y-m-d',
                strtotime(
                    $request->input('year') .
                        '-' .
                        $request->input('month') .
                        '-' .
                        $request->input('day')
                )
            );
            $u->gender = e($request->input('gender'));
            if ($u->save()):
                return back()
                    ->with('message', 'Su información se actualizó con éxito')
                    ->with('typealert', 'success');
            endif;
        endif;
    }
    public function getAccountAddress()
    {
        $states = Coverage::where('ctype', '0')->pluck('name', 'id');
        $data = ['states' => $states];
        return view('user.account_address', $data);
    }

    public function postAccountAddressAdd(Request $request)
    {
        //return count(collect(Auth::user()->getAdrress));
        $rules = [
            'name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'add1' => 'required',
            'add2' => 'required',
            'add3' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre es requerido de la dirección',
            'state.required' => 'Seleccione un estado / departamento',
            'city.required' => 'Seleccione una ciudad',
            'add1.required' =>
                'Ingrese el nombre de su barrio, colonia o recidencial',
            'add2.required' => 'Ingrese su calle, avenida / bloque',
            'add3.required' => 'Ingrese el numero de su casa / departamento',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()):
            return back()
                ->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else:
            $address = new UserAddress();
            $address->name = e($request->input('name'));
            $address->user_id = Auth::id();
            $address->state_id = $request->input('state');
            $address->city_id = $request->input('city');
            $info = [
                'add1' => e($request->input('add1')),
                'add2' => e($request->input('add2')),
                'add3' => e($request->input('add3')),
                'add4' => e($request->input('add4')),
            ];
            $address->addr_info = json_encode($info);
            if (count(collect(Auth::user()->getAddress)) == '0'):
                $address->default = '1';
            endif;
            if ($address->save()):
                return back()
                    ->with('message', 'La dirección fué guardada con éxito')
                    ->with('typealert', 'success');
            endif;
        endif;
    }
    //Para modificar a la direccion principal
    public function getAccountAddressSetDefault(UserAddress $address)
    {
        //return $address;
        if (Auth::id() != $address->user_id):
            return back()
                ->with('message', 'No puedes entrar esta dirección de entrega')
                ->with('typealert', 'danger');
            // Remove default  prev address

            // New default Address
        else:
            $default = Auth::user()->getAddressDefault->id;
            $default = UserAddress::find(Auth::user()->getAddressDefault->id);
            $default->default = '0';
            $default->save();

            $address->default = '1';
            if ($address->save()):
                return back()
                    ->with(
                        'message',
                        'La dirección se asignó como principal de entrega con éxito'
                    )
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    //eliminar direeciones de entregas
    public function getAccountAddressDelete(UserAddress $address)
    {
        if (Auth::id() != $address->user_id):
            return back()
                ->with(
                    'message',
                    'No tienes permisos para eliminar esta dirección'
                )
                ->with('typealert', 'danger');
        else:
            if ($address->default == '0'):
                if ($address->delete()):
                    return back()
                        ->with('message', 'La dirección se eliminó con éxito')
                        ->with('typealert', 'success');
                endif;
            else:
                return back()
                    ->with(
                        'message',
                        'No se puede eliminar una dirección de entrega'
                    )
                    ->with('typealert', 'success');
            endif;
        endif;
    }
}
