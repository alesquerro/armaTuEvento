
<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')
<body>
  <div class="container-fluid contenido">
    <!-- INICIO NAV -->
    @include('Components.header')
    <!-- FIN NAV -->

    <div class="listado contenido">
      @include('Front.filtros',['tipo_eventos' => $tipo_eventos,'tipo_salon'=>$tipo_salon, 'tipo_servicio'=>$tipo_servicio, 'tipo' => $tipo,'filtros_aplicados' =>$filtros_aplicados])

      <main class="list_prod">
        <div class="row card_row">

          @forelse ($productos as $producto)
            <div class="col-sm-12 col-md-6 col-lg-4 card_margin">
              <div class="card mb-4 box-shadow" id="prod{{$producto->id}}">
                <div class="img_thumb">
                  <img class="card-img-top" src="/storage/{{ $producto->cover }}" alt="Foto producto">
                </div>
                <div class="card-body" id="prod{{$producto->name}}">
                  <p class="h4">{{ $producto->name }}</p>
                  <p class="card-text">{{ $producto->description }}</p>
                  <p class="card-text">Consultar disponibilidad y precio</p>
                  <div class="corazon card-body">

                    @if (Auth::check() && in_array($producto->id,$favoritos) )
                      <form id="remove_favourites_{{$producto->id}}" action="/remove_favourites/{{$producto->id}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $producto->id }}">
                      </form>
                      <a href="#" onclick="remove_favourites({{$producto->id}})">
                        <span class="fa fa-heart" style="font-size:24px;color:#B21917"></span>
                      </a>
                      @else
                      <form id="add_favourites_{{$producto->id}}" action="/add_favourites/{{$producto->id}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $producto->id }}">
                      </form>
                      <a href="#" onclick="add_favourites({{$producto->id}})" >
                        <span class="fa fa-heart-o" style="font-size:24px;color:#B21917"></span>
                      </a>
                    @endif
                    <a href="#" id="likes">
                      <span class="fa fa-share-alt  ml-3 mr-3 mb-3" style="font-size:24px;color:#B21917"></span>
                    </a>
                    <form  action="/carrito/{{ $producto->id }}" method="post" id="agregar_carrito_{{ $producto->id }}">
                      @csrf
                      <input type="hidden" name="id" value="{{ $producto->id }}">
                      <input type="hidden" name="producto" value="{{ $producto->name }}">
                      <input type="hidden" name="precio" value="{{ $producto->price }}">
                      <button onclick="agregar_carrito({{ $producto->id }})" class="btn btn-link btn-link-custom">
                        <span class="fa fa-shopping-cart" style="font-size:24px;color:#B21917"></span>
                      </button>
                    </form>

                  </div><!-- <div class="d-flex justify-content align-items-left"> -->
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a class="btn btn-sm btn-outline-secondary" href="/producto/{{ $producto->id }}">Ver</a>
                        <a class="btn btn-sm btn-outline-secondary" href="/contacto/{{ $producto->id }}">Consultar</a>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

          @empty

            No hay productos que coincidan con todos los filtros seleccionados
          @endforelse

          </div>
          <div class="paginas">
            {{ $productos->links() }}
          </div>

        </div>
      </main>

    </div>

    <!-- FIN CONTENIDO GENERICO -->

    <!--Footer-->

    @include('Components.footer')

    <!--/Footer-->

    <script>


      function add_favourites(prod){
        $("#add_favourites_"+prod).submit();
      }
      function remove_favourites(prod){
        $("#remove_favourites_"+prod).submit();
      }

    </script>

</div>
</body>
</html>
