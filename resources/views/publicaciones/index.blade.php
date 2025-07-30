@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Publicaciones</h2>
    <a href="{{ route('publicaciones.create') }}" class="btn btn-success">Crear nueva</a>
</div>

{{-- Filtro por estado --}}
<form method="GET" action="{{ route('publicaciones.index') }}" class="mb-3">
    <select name="estado" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
        <option value="">-- Todos los estados --</option>
        <option value="publico" {{ $estado == 'publico' ? 'selected' : '' }}>Público</option>
        <option value="privado" {{ $estado == 'privado' ? 'selected' : '' }}>Privado</option>
        <option value="borrador" {{ $estado == 'borrador' ? 'selected' : '' }}>Borrador</option>
    </select>
</form>

<table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Fecha creación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($publicaciones as $publicacion)
        <tr>
            <td>{{ $publicacion->titulo }}</td>
            <td>{{ $publicacion->user->name ?? 'Sin autor' }}</td>
            <td>{{ $publicacion->created_at->format('d/m/Y') }}</td>
            <td>
                <button class="btn btn-sm {{ $publicacion->estado == 'publico' ? 'btn-success' : 'btn-secondary' }} cambiar-estado" data-id="{{ $publicacion->id }}">
                    {{ $publicacion->estado == 'publico' ? '🟢 Público' : '🔒 Privado' }}
                </button>
            </td>
            <td>
                <a href="{{ route('publicaciones.edit', $publicacion->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('publicaciones.destroy', $publicacion->id) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Seguro que deseas eliminar esta publicación?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No hay publicaciones para mostrar.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Paginación --}}
<div>
    {{ $publicaciones->links() }}
</div>

@endsection

@section('scripts')
<script>
document.querySelectorAll('.cambiar-estado').forEach(function(btn) {
    btn.addEventListener('click', function() {
        let id = this.dataset.id;
        const button = this;
        fetch(`/publicaciones/${id}/estado`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.nuevo_estado === 'publico') {
                button.textContent = '🟢 Público';
                button.classList.remove('btn-secondary');
                button.classList.add('btn-success');
            } else {
                button.textContent = '🔒 Privado';
                button.classList.remove('btn-success');
                button.classList.add('btn-secondary');
            }
        })
        .catch(err => {
            alert('Error al cambiar el estado.');
            console.error(err);
        });
    });
});
</script>
@endsection
