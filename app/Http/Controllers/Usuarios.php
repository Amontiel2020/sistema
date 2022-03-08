<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Usuario;
use \App\User;
use \App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use \App\TipoUsuario;


class Usuarios extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //  $request->user()->authorizeRoles(['admin','Professor']);
        $lista = collect();
        $user_id = Auth::user()->id;
        $usuarioAutenticado=User::find($user_id);

        // $all = User::paginate(15);
        $all = User::all();

        if ($usuarioAutenticado->hasRole("Admin")) {
           // $lista = User::paginate(15);
           $lista = $all;

        } else {
            foreach ($all as $usuario) {
                if ($usuario->hasRole("Professor")) {
                    $lista->push($usuario);
                }
            }
        }



        return view('Usuarios.index', compact('lista'));
    }


    public function inserir()
    {
        $roles = Role::all();
        return view('Usuarios.inserir', compact('roles'));
    }

    public function store(Request $request)
    {

        $active = "Não";
        if (isset($request->active)) {
            $active = "Sim";
        }

        $user = User::create(
            [
                'name' => $request['name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'user' => $request['user'],
                'password' => bcrypt($request['password']),
                'active' => $active,
                'address' => $request['address']
            ]
        );
        $role = Role::where('id', $request['type'])->first();
        $user->roles()->attach($role);
        $user->save();

        return redirect()->route('listarUsuarios');
    }


    public function editar($id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::all();
        $userRole = "";
        foreach ($user->roles()->get() as $role) {
            $userRole = $role->name;
        }

        return view('Usuarios.editar', compact('user', 'userRole', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::all();

        foreach ($roles as $role) {
            if ($user->hasRole($role->name)) {
                $user->roles()->detach($role);
            }
        }

        $ids = $request['type'];

        // $user->roles()->delete();





        foreach ($ids as $id) {
            $role = Role::where('id', $id)->first();

            if (!$user->hasRole($role->name)) {
                $user->roles()->attach($role);
            }
        }



        $name = $request->name;
        $last_name = $request->last_name;
        $email = $request->email;
        $usuario = $request->user;
        //$password=$request->password;
        $type = $request->type;
        $active = $request->active;
        $address = $request->address;

        $user->name = $name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->user = $usuario;
        //$user->type=$type;
        $user->active = $active;
        $user->address = $address;


        $user->save();
        return redirect()->route('listarUsuarios');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->route('listarUsuarios');
    }

    public function perfil()
    {
        $usuario = Auth::user();
        return view('Usuarios.perfil', compact('usuario'));
    }

    public function update_perfil(Request $request)
    {
        $usuario_id = Auth::user()->id;

        $usuario = User::find($usuario_id);
        $usuario->name = $request->nome;
        $usuario->last_name = $request->apelido;
        $usuario->email = $request->email;

        $usuario->save();

        return redirect()->route('perfil');
    }
    public function showChangePassword()
    {

        return view('Usuarios.update_password');
    }

    public function update_password(Request $request)
    {
        $usuario_id = Auth::user()->id;

        if (!Hash::check($request->password_old, Auth::user()->password)) {
            return redirect()->route('showChangePassword'); //->withErrors(['password' => 'Senha atual está incorreta'])->withInput();
        }

        $usuario = User::find($usuario_id);
        $password = bcrypt($request->password); //criptografa password
        $usuario->password = $password;
        $usuario->save();
        return redirect()->route('perfil'); //->withErrors(['password' => 'Senha atual está incorreta'])->withInput();


    }

    public function update_passwordFromAdmin(Request $request)
    {
        $usuario_id = $request->id;

        $usuario = User::find($usuario_id);
        $novaPasse = bcrypt($request->novaPasse); //criptografa password
        $usuario->password = $novaPasse;
        $usuario->save();
        return redirect()->route('listarUsuarios'); //->withErrors(['password' => 'Senha atual está incorreta'])->withInput();


    }

    public function usuariosProfessores()
    {
        $lista = collect();

        $all = User::all();

        foreach ($all as $usuario) {
            if ($usuario->hasRole("Professor")) {
                $lista->push($usuario);
            }
        }
        return view("Usuarios.usariosProfessores", compact("lista"));
    }
}
