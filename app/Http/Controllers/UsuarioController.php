<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::whereNull('deleted_at')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        Usuario::create($request->all());
        return redirect('/usuarios')->with('success', 'Usuario creado');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());
        return redirect('/usuarios')->with('success', 'Usuario actualizado');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete(); // Eliminación lógica
        return redirect('/usuarios')->with('success', 'Usuario eliminado');
    }
}
