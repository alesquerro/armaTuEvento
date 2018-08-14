<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('Components.head')
  <body>
    @include('Components.header')
    <div class="contenido container" id="contenido-principal">

      <h1 class="tituloh1carrito">Mis compras y reservas</h1>
      <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" >
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="seleccionados-tab" data-toggle="tab" href="#seleccionados" role="tab" aria-controls="seleccionados" aria-selected="true">Reservas</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active text-center" id="seleccionados" role="tabpanel" aria-labelledby="seleccionados-tab">
          @if (! $reservas)
            <h1 class="carrito_vacio text-center mt-5 mb-5" >No tenés reservas</h1>
            <h2 class="bajada-carrito" >¿No sabés qué reservar? ¡Miles de salones y servicios te esperan!</h2>

          @else
            @foreach ($reservas as $reserva)
              <div style="border: 1px solid grey;border-radius: 10px;margin-top:10px;">
              <p>{{ 'Fecha compra: '.$reserva->purchase_date }}</p>
              <p><strong>{{ 'Fecha compra: '.$reserva->event_date }}</strong></p>
                  <table class="table-bordered tabla-reservas">
                    <thead >
                      <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                      </tr>
                    </thead>
                    @foreach ($reserva->product_purchases as $item1)
                      <tr>
                        <td>{{ $item1->description }}</td>
                        <td>{{ $item1->price }}</td>
                      </tr>
                    @endforeach
                  </table>
              <p>{{ 'Precio Final $: '.$reserva->total_amount }}</p>
              <p><strong>{{ 'Saldo a pagar $: '.$reserva->remainder }}</strong></p>
              <p class="texto_color"><strong >{{ 'Estado de la reserva: En Espera' }}</strong></p>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
    <div class="form-group  text-center">
      <div>
        <a class="btn btn-lg btn-secondary btn-sm" id="volver" href="/listado">Ver más productos</a>
      </div>
    </div>
  </div>
    @include('Components.footer')
  </body>
</html>
