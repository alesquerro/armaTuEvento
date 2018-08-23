<h4>Filtros aplicados</h4>
<ul>
@forelse ($filtros_aplicados as $key => $value)

  <h4>{{ $titulos[$key] }}</h4>

  @foreach ($value as $val)
    <form class="" action="/eliminar_filtro" method="post">
      @csrf
      @if ($key == 'tipo_eventos')
        <input type="hidden" name="tipo-evento" value="{{$val}}">
      @elseif($key == 'tipo_producto')
        <input type="hidden" name="tipo-producto" value="{{$val}}">
      @else
        <input type="hidden" name="{{$key}}" value="{{$val}}">
      @endif
    <li class="filtros_aplicados">
    <button type="sumbit" name="button" class="btn btn-link link_filtros">
    @if ($key == 'tipo_eventos')
      @foreach ($tipo_eventos as $te)
        @if ($te['id'] == $val)
            <span>{{ $te['name']}}</span>
        @endif
      @endforeach
    @elseif($key == 'tipo_producto')
      @foreach ($tipo_productos as $tp)
        @if ($tp['id'] == $val)

            <span>{{ $tp['name']}}</span>
        @endif
      @endforeach
    @else
        <span>{{ $val }}</span>
    @endif
    <span class="fa fa-remove"></span></button>
    </li>
    </form>
  @endforeach
@empty
  No hay filtros aplicados
@endforelse
</ul>
<form class="" action="/limpiar_filtros" method="post">
  @csrf
  <button type="submit" name="button">Limpiar Filtros</button>
</form>
