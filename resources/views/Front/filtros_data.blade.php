
{{-- <h4>Fecha</h4>
<form action="" method="post">
  <div class="form-group fecha_listado">
    <div class="col-12">
      <input type="date" id="fecha-bg" class="form-control" placeholder="Fecha" name="Fecha" value="">
    </div>
  </div>
  </form> --}}
  <div>

    <h4>Tipo de Producto</h4>
    <ul>
      @foreach (['salon'=>'Salón','servicio' => 'Servicio'] as $key => $value)
      <li class="filtros_aplicados">
          @if ($tipo != $key)
            <form action="/add_filter" method="post">
              @csrf
              <input type="hidden" name="tipo" value="{{ $key }}">
              <button type="sumbit" class="btn btn-link link_filtros">{{ $value }}</button>
            </form>

          @endif
      </li>
      @endforeach
    </ul>
  </div>
<h4>Tipo de eventos</h4>
<ul>
  @foreach ($tipo_eventos as $value)

      <li class="filtros_aplicados">
          @if (!array_key_exists('tipo_eventos',$filtros_aplicados) || array_key_exists('tipo_eventos',$filtros_aplicados) && ! in_array($value->id,$filtros_aplicados['tipo_eventos']) )
            <form action="/add_filter" method="post">
              @csrf
              <input type="hidden" name="tipo_evento" value="{{ $value->id }}">
              <button type="sumbit" class="btn btn-link link_filtros">{{ $value->name }}</button>
            </form>

          @endif

      </li>

  @endforeach
</ul>

  @if ( $tipo !='servicio')
  <h4>Categoría de Salón</h4>
  <ul>
    @foreach ($tipo_salon as $value)

      @if (!array_key_exists('tipo_producto',$filtros_aplicados) || array_key_exists('tipo_producto',$filtros_aplicados) && ! in_array($value->id,$filtros_aplicados['tipo_producto']) )
        <li class="filtros_aplicados">
        <form action="/add_filter" method="post">
          @csrf
          <input type="hidden" name="tipo_producto" value="{{ $value->id }}">
          <button type="sumbit" class="btn btn-link link_filtros">{{ $value->name }}</button>
        </form>
        </li>
      @endif

    @endforeach
  </ul>
  @endif
  @if ( $tipo !='salon')
  <h4>Categoría de Servicios</h4>
  <ul>
    @foreach ($tipo_servicio as $value)
      @if (!array_key_exists('tipo_producto',$filtros_aplicados) || array_key_exists('tipo_producto',$filtros_aplicados) && ! in_array($value->id,$filtros_aplicados['tipo_producto']) )
        <li class="filtros_aplicados">
        <form action="/add_filter" method="post">
          @csrf
          <input type="hidden" name="tipo_producto" value="{{ $value->id }}">
          <button type="sumbit" class="btn btn-link link_filtros">{{ $value->name }}</button>
        </form>
        </li>
      @endif
    @endforeach
  </ul>
  @endif
