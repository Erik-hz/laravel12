@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Crear Publicación</h2>
    </div>
    <div class="card-body">

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('publicaciones.store') }}" method="POST" novalidate>
            @csrf

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input 
                    type="text" 
                    name="titulo" 
                    id="titulo" 
                    class="form-control @error('titulo') is-invalid @enderror" 
                    value="{{ old('titulo') }}" 
                    placeholder="Ingrese el título de la publicación"
                    required
                >
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido:</label>
                <textarea 
                    name="contenido" 
                    id="contenido" 
                    class="form-control @error('contenido') is-invalid @enderror" 
                    rows="5" 
                    placeholder="Escribe el contenido aquí..."
                    required
                >{{ old('contenido') }}</textarea>
                @error('contenido')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('publicaciones.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>
</div>
@endsection
