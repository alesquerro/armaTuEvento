<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('Components.head')
  <body>
    @include('Components.header')
    <div class="contenido container" id="contenido-principal">
      @if ($errores)
        <div class="alert alert-danger">
          <ul style="margin-top: 35px;">
            @foreach ($iterable as $key => $value)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" >
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="seleccionados-tab" data-toggle="tab" href="#seleccionados" role="tab" aria-controls="seleccionados" aria-selected="true">Seleccionados</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active text-center" id="seleccionados" role="tabpanel" aria-labelledby="seleccionados-tab">
          @forelse ($carrito as $posicion => $producto)
              <table class="table-striped tabla-carrito">

                <?php $productosSumar[]= (float) $producto->precio; ?>
              <form  action="" method="post" id="sacar_producto_{{ $posicion }}">
                <tr>
                  <td>{{ $producto->name }}</td>
                  <td>$ {{ $producto->price }}</td>
                  <td><button class="btn btn-sm btn-danger carrito_boton"  onclick="sacar_producto({{ $posicion }})"><span class="fa fa-trash"></span></button></td>
                </tr>
                <input type="hidden" name="sacar_producto" value="{{ $posicion }}">
              </form>
            </table>


            <h3> Total: </h3>

          @empty
            <h2 class="titulos-carrito text-center mt-5 mb-5" > <?php echo "Tu carrito está vacío"; ?> </h2>
            <h2 class="bajada-carrito" > <?php echo "¿No sabés qué seleccionar? ¡Miles de salones y servicios te esperan!"; ?> </h2>
          @endforelse
        </div>

      </div>
    </div><div class="form-group  text-center">
      <div>
        <a tabindex="0" class="btn btn-lg btn-info btn-sm" role="button" onclick="solicitar_reserva()">Solicitar Reserva</a>
        <a class="btn btn-lg btn-secondary btn-sm" id="volver" href="/listado">Ver más productos</a>
      </div>
    </div>
    <div class="form-group  text-center">
      <form  action="" method="post" id="vaciar_carrito">
        <input type="hidden" name="vaciar" value="1">
        <button class="btn btn-sm btn-danger"  onclick="vaciar_carrito()">vaciar carrito</button>
      </form>

    </div>
    <script type="text/javascript">
      function vaciar_carrito(){
        $( "#vaciar_carrito" ).submit();
      }
      function sacar_producto(id){
        $( "#sacar_producto_"+id ).submit();
      }
      function solicitar_reserva(){
        $( "#guardar_carrito").submit();
      }
    </script>
  </div>

    @include('Components.footer')

  </body>
</html>
