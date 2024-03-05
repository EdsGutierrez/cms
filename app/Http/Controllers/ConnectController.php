<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use Hash;
use Illuminate\Support\Facades\Validator;
//use App\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserSendRecover;
use Illuminate\Support\Facades\Mail;

class ConnectController extends Controller
{
    //============= SOLO LOS QUE STAN LOGUEADOS PUEDEEN ACCESDER PROEUE TIENEN ACCESO
    //si oi si tiene que ser un usuario
    public function __construct()
    {
        $this->middleware('guest')->except(['getLogout']);
    }
    //============================================
    public function getLogin()
    {
        return view('connect.login');
    }
    public function postLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
        $messages = [
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es invalido.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' =>
                'La contraseña por lo menos debe tener 8 caracteres.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()
                ->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else:
            if (
                Auth::attempt(
                    [
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                    ],
                    true
                )
            ):
                if (Auth::user()->status == '100'):
                    return redirect('/logout');
                else:
                    return redirect('/');
                endif;
            else:
                return back()
                    ->with(
                        'message',
                        'Correo electrónico o contraseña incorecto'
                    )
                    ->with('typealert', 'danger');
            endif;
        endif;
    }
    //conectaando al Registrar usuario
    public function getRegister()
    {
        return view('connect.register');
    }
    //pasando datos por el metodo POST
    public function postRegister(Request $request)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password',
        ];

        $messages = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Su apellido es requerido.',
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es invalido.',
            'email.unique' =>
                'Ya existe un usuario registrado con este correo electrónico.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' =>
                'La contraseña por lo menos debe tener 8 caracteres.',
            'cpassword.required' => 'Es necesario confirmar la contraseña.',
            'cpassword.min' =>
                'La confirmación de la contraseña por lo menos debe tener 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()
                ->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else:
            $user = new User();
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));

            if ($user->save()):
                return redirect('/login')
                    ->with(
                        'message',
                        'Su usuario se creo con éxito, Ahora puede iniciar sesión'
                    )
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    //cerrar sesion
    public function getLogout()
    {
        $status = Auth::user()->status;
        Auth::logout();

        if ($status == '100'):
            return redirect('/login')
                ->with('message', 'Usted fue suspendido')
                ->with('typealert', 'danger');
        else:
            return redirect('/');
        endif;
    }

    //=PARA RECUPERAR CUENTA
    public function getRecover()
    {
        return view('connect.recover');
    }

    //DENTRO DE RECUPERAR CONTRASEÑA MANDAR UN CORREO
    public function postRecover(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];

        $messages = [
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es invalido.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()
                ->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
            //codigo generado
            //return view('emails.user_password_recover', $data);
        else:
            $user = User::where('email', $request->input('email'))->count();
            if ($user == '1'):
                $user = User::where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'code' => $code,
                ];
                $u = User::find($user->id);
                $u->password_code = $code;
                if ($u->save()):
                    Mail::to($user->email)->send(new UserSendRecover($data));
                    //Mail::to('edsonpruebassistemas@gmail.com')->send(new UserSendRecover($data));
                    return redirect('/reset?email=' . $user->email)
                        ->with(
                            'message',
                            'Ingrese el código que le hemos enviado a su correo electrónico.'
                        )
                        ->with('typealert', 'danger');
                endif;
            else:
                return back()
                    ->with('message', 'Este correo electronico no existe.')
                    ->with('typealert', 'success');
            endif;
        endif;
        //return count([$user]);
    }
    public function getReset(Request $request)
    {
        $data = ['email' => $request->get('email')];
        return view('connect.reset', $data);
    }
}
