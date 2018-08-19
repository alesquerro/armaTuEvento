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
  <form action="" method="post">
    <div class="form-group fecha_listado">
      <label for="fecha-bg" class="col-3">Fecha</label>
      <div class="col-12">
        <input type="date" id="fecha-bg" class="form-control" placeholder="Fecha" name="Fecha" value="<?php echo $_GET['Fecha'] ?? ''; ?>">
      </div>
    </div>
    </form>

  <h4>Tipo de eventos</h4>
  <ul>
    @foreach ($tipo_eventos as $value)
      <a href="{{ 'te_'.$value->id }}" >
        <li>{{ $value->name }}</li>
      </a>
    @endforeach
  </ul>
    @if ( $tipo !='servicio')
    <h4>Tipo de Salón</h4>
    <ul>
      @foreach ($tipo_salon as $value)
        <a href="{{ 'tsa_'.$value->id }}" >
          <li>{{ $value->name }}</li>
        </a>
      @endforeach
    </ul>
    @endif
    @if ( $tipo !='salon')
    <h4>Tipo de Servicios</h4>
    <ul>
      @foreach ($tipo_servicio as $value)
        <a href="{{ 'tse_'.$value->id }}" >
          <li>{{ $value->name }}</li>
        </a>
      @endforeach
    </ul>
    @endif
</aside>
