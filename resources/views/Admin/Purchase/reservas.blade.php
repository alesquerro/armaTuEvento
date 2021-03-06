<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('Components.Admin.head')
  <body>
    @include('Components.header')
    <div class="contenido container" id="contenido-principal">

      <h1 class="tituloh1carrito">Reservas</h1>
      <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" >
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="seleccionados-tab" data-toggle="tab" href="#seleccionados" role="tab" aria-controls="seleccionados" aria-selected="true">{{ $title }}</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active text-center" id="seleccionados" role="tabpanel" aria-labelledby="seleccionados-tab">
          @if (! $reservas)
            <h1 class="carrito_vacio text-center mt-5 mb-5" >No hay reservas pendientes</h1>
          @else
            @if (Session::has('message'))
              <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="form-group text-center botones-reservas">
              <form action="/Admin/reservas" method="get">
              <button type="submit" class="btn btn-lg {{ $type == 'pendientes' ? 'btn-primary': 'btn-secondary' }} btn-sm" id="volver">Ver reservas Pendientes</button>
              </form>
              <form action="/Admin/reservas_confirmadas" method="get">
              <button type="submit" class="btn btn-lg {{ $type == 'aceptadas' ? 'btn-primary': 'btn-secondary' }} btn-sm" id="volver">Ver reservas Aceptadas</button>
              </form>
              <form action="/Admin/reservas_anuladas" method="get">
              <button type="submit" class="btn btn-lg {{ $type == 'anuladas' ? 'btn-primary': 'btn-secondary' }} btn-sm" id="volver">Ver reservas Anuladas</button>
              </form>
            </div>
            @foreach ($reservas as $reserva)
              <div style="border: 1px solid grey;border-radius: 10px;margin-top:10px;">
                <p>
                  {{ 'ID reserva: '.$reserva->id }}
                </p>
              <p>
                {{ 'Fecha compra: '.$reserva->purchase_date }}
              </p>
              <p>{{ 'Usuario: ('. $reserva->user->id .') '.$reserva->user->first_name. ' - '.$reserva->user->email }}</p>
              <p><strong>{{ 'Fecha reserva: '.$reserva->event_date }}</strong></p>
                  <table class="table table-bordered tabla-reservas">
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
              <p class="texto_color"><strong >{{ 'Estado de la reserva: '. $reserva->state }}</strong></p>
              @if ($type == 'pendientes')

                <div class="reservas-admin">
                  <form action="/Admin/reserva_admin/{{$reserva->id}}" method="post" class="botones-admin">
                  @csrf
                  <input type="hidden" name="tipo" value="aceptar">

                  <button type="submit" name="button"><span class="fa fa-check"></span>Aceptar</button>
                  </form>
                  <form action="/Admin/reserva_admin/{{$reserva->id}}" method="post" class="botones-admin">
                  @csrf
                  <input type="hidden" name="tipo" value="rechazar">
                  <button type="submit" name="button" ><span class="fa fa-remove"></span>Rechazar</button>
                  </form>

                </div>
                @endif
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
    <div class="form-group  text-center">
      <div>
        <a class="btn btn-lg btn-secondary btn-sm" id="volver" href="/Admin/dashboard">Volver</a>
      </div>
    </div>
  </div>
    @include('Components.footer')
  </body>
</html>
