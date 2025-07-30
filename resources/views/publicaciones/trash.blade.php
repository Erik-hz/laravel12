@foreach($publicaciones as $publicacion)
<tr>
  <td>{{ $publicacion->titulo }}</td>
  <td>{{ $publicacion->usuario->nombre ?? 'Sin usuario' }}</td>
  <td>{{ $publicacion->deleted_at ? $publicacion->deleted_at->format('d/m/Y') : 'No eliminado' }}</td>
  <td>
    <form action="{{ route('publicaciones.restaurar', $publicacion->id) }}" method="POST" onsubmit="return confirm('¿Deseas restaurar esta publicación?');">
      @csrf
      <button type="submit" class="btn btn-sm btn-success">Restaurar</button>
    </form>
  </td>
</tr>
@endforeach
