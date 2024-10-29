<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;


class controllerUsuarios extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view("USUARIOS.verUsuarios", compact("usuarios"));
    }


    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
    
        return redirect()->route('verUsuarios')->with('success', 'Usuario eliminado exitosamente.');
    }
    

}
