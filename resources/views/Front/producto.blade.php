
<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('Components.head')
  <body>
    <div class="container-fluid contenido todo">
    <!--header.html -->
    @include('Components.header')

    <div class="form-group  text-center">
      <div class="volver">
        <a class="btn btn-sm btn-danger volver" id="volver" href="<?php echo $pagina_anterior; ?>">Volver</a>
      </div>
    </div>
    <div class="contenido_thumbnail">
      <div class="row card_row">
        <div class="col-sm-12 col-md-4 col-lg-4 card_margin"><!-- Bloque Izquierdo -->
          <div class="card-body">
            <p class="h4"> {{ $producto->nombre }}</p>
            <!-- INICIO CAROUSEL -->
           <div class="img_thumb">
             <div id="carouselExampleIndicators" class="carousel slide carrusel" data-ride="carousel">
               <ol class="carousel-indicators">
                 <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                 <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                 <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>

               </ol>
               <div class="carousel-inner">
                 <div class="carousel-item active ">
                   <img class="d-block w-100" src="/subidos/productos/{{ $producto->cover }}" alt="First slide">
                 </div>
                 @foreach ($producto->photos as $key => $photo)
                   @if ($key == 0)
                     continue;
                   @endif

                 <div class="carousel-item ">
                   <img class="d-block w-100" src="subidos/productos/{{ $photo }}" alt="First slide">
                 </div>

               @endforeach
               </div>
               <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="sr-only">Anterior</span>
               </a>
               <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="sr-only">Siguiente</span>
               </a>
             </div>
           </div>
           <!-- FIN CARROUSEL -->
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 card_margin"> <!-- bloque derecho -->
          <div class="card-body"> <!-- placeholder espacio -->
          </div>
          <p class="h4 card_margin caracteristicas"> Precio $: {{ $producto->price }} {{ $producto->price_type }} -
            Reserva mínima $: {{ $producto->minimum_reservation }} </p>
          <p class="card-text">{{ $producto->description }}</p><!-- Descripcion salon -->

            <div class="corazon card-body">
              <p class="card-text"> <!-- botones favorito y compartir -->
                <div class="d-flex justify-content align-items-left">

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
                    <i class="fa fa-share-alt  ml-3 mr-3 mb-3" style="font-size:24px;color:#B21917"></i>
                  </a>
                  <!--a href="#" id="shopping-cart">
                    <i class="fa fa-shopping-cart" style="font-size:24px;color:#B21917"></i>
                  </a-->
                </p>
              </div><!-- <div class="d-flex justify-content align-items-left"> -->
                <div class="btn-group">
                  <a class="btn btn-sm btn-outline-secondary"  href="contacto/{{ $producto->id }}">Consultar</a>
                  <!--<a class="btn btn-sm btn-outline-secondary"  href="carrito.php?producto=<?php //echo $producto['id'];  ?>">Agregar a carrito</a>-->
                  <a class="btn btn-sm btn-outline-secondary"  onclick="agregar_carrito()"><span class="fa fa-shopping-cart" style="font-size:24px;color:#B21917"></span><span class="carrito_boton">Agregar a carrito</span></a>
                </div><!-- <div class="btn-group"> -->
                </div><!-- <div class="corazon"> -->
                  <div class="card-body select">
                    <?php
                    $servicios = [];
                    if($servicios){
                    foreach ($servicios as $servicio) {

                    } { ?>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="servicios_adicionales[]" class="custom-control-input" id="<?php echo $servicio->getId(); ?>">
                        <label class="custom-control-label" for="<?php echo $servicio->getNombre(); ?>"><?php echo $servicio->getNombre(); ?></label>
                      </div>
                    <?php }
                  }?>
                  </div><!-- <div class="btn-group"> -->
                  </div><!-- <div class="col-sm-12 col-md-6 col-lg-6 card_margin"> -->
                  </div><!-- <div class="row card_row"> -->
                  </div><!-- <div class="contenido_thumbnail"> -->

                <form  action="/carrito/{{ $producto->id }}" method="post" id="agregar_carrito">
                  @csrf
                  <input type="hidden" name="id" value="{{ $producto->id }}">
                  <input type="hidden" name="producto" value="{{ $producto->nombre }}">
                  <input type="hidden" name="precio" value="{{ $producto->precio }}">
                </form>
                <!--Footer-->
                @include('Components.footer')
                <!--Footer-->
                  <script type="text/javascript">
                    function agregar_carrito(){
                      $( "#agregar_carrito" ).submit();
                    }
                    function add_favourites(prod){
                      $("#add_favourites_"+prod).submit();
                    }
                    function remove_favourites(prod){
                      $("#remove_favourites_"+prod).submit();
                    }
                  </script>
    </div><!-- FIN CONTAINER BOOTSTRAP -->

  </body>
</html>
