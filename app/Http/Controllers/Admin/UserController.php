<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //Constructor
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status'); //PARA SACAR DE NUESTRA PAGINA BANEADO
        $this->middleware('user.Permissions'); //PARA SACAR DE NUESTRA PAGINA SI INGRESAS POR URL
        $this->middleware('isadmin');
    }
    
    public function getUsers($status)
    {
        if ($status == 'all') :
            $users = User::orderBy('id', 'Desc')->paginate(30); //get();    //paginate(1);
        else :
            $users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(30); //get();
        endif;
        $data = ['users' => $users];
        return view('admin.users.home', $data);
    }
    public function getUserView($id)
    {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_view', $data);
    }

    //para suspender a un ususario
    public function getUserBanned($id)
    {
        $u = User::findOrFail($id);
        if ($u->status == "100") :
            $u->status = "1";
            $msg = "Ususario activo nuevamente.";
        else :
            $u->status = "100";
            $msg = "Ususario suspendido con éxito.";
        endif;

        if ($u->save()) :
            return back()->with('message', $msg)->with('typealert', 'success');
        endif;
    }

    //====PERSIMOSS
    public function getUserPermissions($id)
    {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_permissions', $data);
    }
    //BOTON DE GUARDAR PERSISOS
    public function postUserPermissions(Request $request, $id)
    {
        //return $request->except('_token');    //exceptuando _token
        $u = User::findOrFail($id);
        //ELIMINADO VARIOS CODIFOS  Y REMPLAZAAR CON EL SGUTE METDODO DE OBTENER OERMISOS=============================================eliminado varios codigos
        $u->permissions = $request->except('_token');
        if ($u->save()) :
            return back()->with('message', 'Los permisos del usuario fueron actualizados con éxito')->with('typealert', 'success');
        endif;
    }
    //METODO PARA EDITAR USUARIO DESDE EL PANEL DE EDITAR v58
    public function postUserEdit(Request $request, $id)
    {
        $u = User::findOrFail($id);
        $u->role = $request->input('user_type');
        if ($request->input('user_type') == "1") :
            if (is_null($u->permissions)) :
                $permissions = [
                    'dashboard' => true
                ];
                $permissions = json_encode($permissions);
                $u->permissions = $permissions;
            endif;
        else :
            $u->permissions = null;
        endif;
        if ($u->save()) :
            if ($request->input('user_type') == "1") :
                return redirect('/admin/user/' . $u->id . '/permissions')->with('message', 'El rango del usuario se actualizó con exito')->with('typealert', 'success');
            else :
                return back()->with('message', 'El rango del usuario se actualizó con exito')->with('typealert', 'success');
            endif;
        endif;
    }

    
    
    
}
