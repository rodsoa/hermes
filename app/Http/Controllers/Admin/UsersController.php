<?php

namespace Hermes\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\User;

class UsersController extends Controller
{
    /**
     * GET /users
     */
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function profile(Request $request) {
        return $request->user();
    }

    /**
     * POST /users
     */
    // TODO: Implementar validações. Validações em classes próprias, ou nos métodos ? 
    public function store(Request $request) {
        $category              = $request->input('category');
        $name                  = $request->input('name');
        $email                 = $request->input('email');
        $password              = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        $status                = true;

        $user = new User();

        $user->category = $category;        
        $user->name     = $name;                  
        $user->email    = $email;                 
        $user->password = bcrypt($password);               
        $user->status   = $status;

        if ($user->save()) {
            return redirect()->route('users.index')->with([
                'msg'    => "Usuário $user->name cadastrado com sucesso",
                'status' => 'success'
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'msg'    => "Ocorreu algum erro, tente novamente",
                'status' => 'error'
            ]);
        }
    }

    public function update(Request $request, $id ) {
        $user = User::findOrFail( $id );
        //dd( $request->all() );
        // verificando se há valor passado para password e se ele é igual a confirmação
        if ( ($request->input('password')) && $request->input('password_confirmation')){
            if ( $request->input('password') === $request->input('password_confirmation') ) {
                $user->password = bcrypt($request->input('password'));
            }
        }

        foreach ( $request->all() as $key => $value ) {
            if ( ($key == '_method') || ($key == '_token') || ($key == 'password') || ($key == 'password_confirmation')) {
                continue;
            } else {
                $user->$key = $value;
            }
        }

        if ($user->save()) {
            return redirect()->route('users.index')->with([
                'msg'    => "Usuário $user->name atualizado com sucesso",
                'status' => 'success'
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'msg'    => "Ocorreu algum erro, tente novamente",
                'status' => 'error'
            ]);
        }
    }

    public function destroy( $id ){
        $user = User::findOrFail( $id );
        if ($user->delete()) {
            return redirect()->route('users.index')->with([
                'msg'    => "Usuário deletado com sucesso",
                'status' => 'success'
            ]);
        } else {
            return redirect()->route('admin.index')->with([
                'msg'    => "Ocorreu algum erro, tente novamente",
                'status' => 'error'
            ]);
        }
    }
}
