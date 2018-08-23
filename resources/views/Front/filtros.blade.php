
<div class="filtros_arriba">
  <button onclick="mostrar_orden()">
    Mostrar filtros
  </button>
  <button onclick="mostrar_filtros()">
    Aplicar filtros
  </button>
</div>

<div class="list_arriba" id="lista_filtro">
  <div class="lista_filtro" id="orden_filtro">
    @include('Front.filtros_aplicados',['tipo_eventos' => $tipo_eventos,'tipo_salon'=>$tipo_salon, 'tipo_servicio'=>$tipo_servicio, 'tipo' => $tipo,'filtros_aplicados' =>$filtros_aplicados])
    {{-- <div class="form-group row">
      <label for="orden_filtro" class="col-form-label col-sm-2 col-md-2 col-lg-2">Ordenar por: </label>
      <select class="form-control col-sm-8 col-md-9 col-lg-8" name="orden">
        <option value=""></option>
        <option value="orden_nombre">Nombre</option>
        <option value="menor_precio">Menor precio</option>
        <option value="mayor_precio">Mayor precio</option>
      </select>
    </div> --}}
  </div>
  <div class="lista_filtro flex_filtro" >

    @include('Front.filtros_data',['tipo_eventos' => $tipo_eventos,'tipo_salon'=>$tipo_salon, 'tipo_servicio'=>$tipo_servicio, 'tipo' => $tipo,'filtros_aplicados' =>$filtros_aplicados])
  </div>

</div>



<aside class="list_lateral">
  @include('Front.filtros_aplicados',['tipo_eventos' => $tipo_eventos,'tipo_salon'=>$tipo_salon, 'tipo_servicio'=>$tipo_servicio, 'tipo' => $tipo,'filtros_aplicados' =>$filtros_aplicados])
  @include('Front.filtros_data',['tipo_eventos' => $tipo_eventos,'tipo_salon'=>$tipo_salon, 'tipo_servicio'=>$tipo_servicio, 'tipo' => $tipo,'filtros_aplicados' =>$filtros_aplicados])
</aside>
<script>
function mostrar_filtros(){
  $("#lista_filtro").toggle(1000);
}
function mostrar_orden(){

  $("#orden_filtro").toggle(1000);
}
</script>
