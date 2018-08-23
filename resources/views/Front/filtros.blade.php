
<div class="filtros_arriba">
  <button onclick="mostrar_orden()">
    Orden
  </button>
  <button onclick="mostrar_filtros()">
    Filtros
  </button>
</div>

<div class="list_arriba" id="lista_filtro">
  <form action="" method="post">
  <div class="lista_filtro flex_filtro">
    <div class="form-group fecha_listado">
      <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
      <div class="col-sm-8">
        <input  type="date" class="form-control" id="fecha" placeholder="Fecha" name="Fecha" value="<?php echo $_GET['Fecha'] ?? ''; ?>">
      </div>
    </div>
    </form>


    <div>

      <h4>Tipo de evento</h4>

      <ul>
        @foreach ($tipo_eventos as $value)

          <a href="{{ 'te_'.$value->id }}" >
            <li>{{ $value->name }}</li>
          </a>
        @endforeach

      </ul>
    </div>
    @if ($tipo == 'servicio')
    <div class="">
      <h4>Tipo de salón</h4>
      <ul>
        @foreach ($tipo_salon as $value)
          <a href="{{ 'tsa_'.$value->id }}" >
            <li>{{ $value->name }}</li>
          </a>
        @endforeach

      </ul>
    </div>
    @endif
    @if ($tipo == 'salon')
      <div class=" ">
        <h4>Tipo de servicio</h4>
        <ul>
          @foreach ($tipo_servicio as $value)
            <a href="{{ 'tse_'.$value->id }}" >
              <li>{{ $value->name }}</li>
            </a>
          @endforeach
        </ul>
      </div>
    @endif

  </div>

</div>

<div class="orden_arriba" id="orden_filtro">
  <div class="form-group row">
    <label for="orden_filtro" class="col-form-label col-sm-2 col-md-2 col-lg-2">Ordenar por: </label>
    <select class="form-control col-sm-8 col-md-9 col-lg-8" name="orden">
      <option value=""></option>
      <option value="orden_nombre">Nombre</option>
      <option value="menor_precio">Menor precio</option>
      <option value="mayor_precio">Mayor precio</option>
    </select>
  </div>
</div>

<aside class="list_lateral">

  <h4>Filtros aplicados</h4>
  <ul>
  @forelse ($filtros_aplicados as $key => $value)
    {{-- @if ($key == 'tipo_eventos')
      <h4>{{ 'Tipos de evento' }}</h4>
    @elseif ($key == 'tipo_producto')
        <h4>{{ 'Categoría de Producto' }}</h4>
    @else
      <h4>{{ $key }}</h4>
    @endif --}}
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
        <li>
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
      <button type="sumbit" name="button" class="btn btn-link link_filtros"><span class="fa fa-remove"></span></button>
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
  <h4>Fecha</h4>
  <form action="" method="post">
    <div class="form-group fecha_listado">
      <div class="col-12">
        <input type="date" id="fecha-bg" class="form-control" placeholder="Fecha" name="Fecha" value="<?php echo $_GET['Fecha'] ?? ''; ?>">
      </div>
    </div>
    </form>
    <div>

      <h4>Tipo de Producto</h4>
      <ul>
        @foreach (['salon'=>'Salón','servicio' => 'Servicio'] as $key => $value)
        <li>
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
      <a href="{{ 'te_'.$value->id }}" >
        <li>
            @if (!array_key_exists('tipo_eventos',$filtros_aplicados) || array_key_exists('tipo_eventos',$filtros_aplicados) && ! in_array($value->id,$filtros_aplicados['tipo_eventos']) )
              <form action="/add_filter" method="post">
                @csrf
                <input type="hidden" name="tipo_evento" value="{{ $value->id }}">
                <button type="sumbit" class="btn btn-link link_filtros">{{ $value->name }}</button>
              </form>

            @endif

        </li>
      </a>
    @endforeach
  </ul>

    @if ( $tipo !='servicio')
    <h4>Categoría de Salón</h4>
    <ul>
      @foreach ($tipo_salon as $value)

        @if (!array_key_exists('tipo_producto',$filtros_aplicados) || array_key_exists('tipo_producto',$filtros_aplicados) && ! in_array($value->id,$filtros_aplicados['tipo_producto']) )
          <form action="/add_filter" method="post">
            @csrf
            <input type="hidden" name="tipo_producto" value="{{ $value->id }}">
            <button type="sumbit" class="btn btn-link link_filtros">{{ $value->name }}</button>
          </form>

        @endif
      @endforeach
    </ul>
    @endif
    @if ( $tipo !='salon')
    <h4>Categoría de Servicios</h4>
    <ul>
      @foreach ($tipo_servicio as $value)
        @if (!array_key_exists('tipo_producto',$filtros_aplicados) || array_key_exists('tipo_producto',$filtros_aplicados) && ! in_array($value->id,$filtros_aplicados['tipo_producto']) )
          <form action="/add_filter" method="post">
            @csrf
            <input type="hidden" name="tipo_producto" value="{{ $value->id }}">
            <button type="sumbit" class="btn btn-link link_filtros">{{ $value->name }}</button>
          </form>

        @endif
      @endforeach
    </ul>
    @endif
</aside>
