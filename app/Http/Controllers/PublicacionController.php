<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    public function index(Request $request)
    {
        $estado = $request->estado;

        $query = Publicacion::with('user')->withoutTrashed();

        if ($estado) {
            $query->where('estado', $estado);
        }

        $publicaciones = $query->paginate(10);

        return view('publicaciones.index', compact('publicaciones', 'estado'));
    }

    public function create()
    {
        return view('publicaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        Publicacion::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'user_id' => auth()->id(),
        ]);

        return redirect('/publicaciones')->with('success', 'Publicación creada');
    }

    public function edit($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        return view('publicaciones.edit', compact('publicacion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string|min:10',
        ]);

        $publicacion = Publicacion::findOrFail($id);
        $publicacion->update($request->only('titulo', 'contenido'));

        return redirect('/publicaciones')->with('success', 'Publicación actualizada');
    }

    public function destroy($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $publicacion->delete(); // Eliminación lógica
        return redirect('/publicaciones')->with('success', 'Publicación eliminada');
    }

    public function cambiarEstado($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $publicacion->estado = $publicacion->estado == 'publico' ? 'privado' : 'publico';
        $publicacion->save();

        return response()->json(['nuevo_estado' => $publicacion->estado]);
    }
    public function papelera()
    {
        $publicaciones = Publicacion::onlyTrashed()->with('user')->paginate(10);
        return view('publicaciones.trash', compact('publicaciones'));
    }

    public function restaurar($id)
    {
        $publicacion = Publicacion::onlyTrashed()->findOrFail($id);
        $publicacion->restore();
        return redirect()->route('publicaciones.index')->with('success', 'Publicación restaurada');
    }
}
