<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')
<body>
  <div class="container-fluid contenido">
    <!-- INICIO NAV -->
    @include('Components.header')
    <!-- FIN NAV -->




    <!-- INICIO CAROUSEL -->
    <div class="container-fluid">
      <div id="carouselExampleIndicators" class="carousel slide contenido" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active imagen_carousel">
            <img class="d-block w-100" src="imagenes/7.jpg" alt="First slide">
          </div>
          <div class="carousel-item imagen_carousel">
            <img class="d-block w-100" src="imagenes/6.jpg" alt="Second slide">
          </div>
          <div class="carousel-item imagen_carousel">
            <img class="d-block w-100" src="imagenes/9.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <!-- FIN CAROUSEL -->

      <!-- BUSCADOR -->

      <section class="section-index-buttons">
        <form method="get" class="contenedor_form" action="listado.php" enctype="multipart/form-data">
          <p class="h3">Buscá salon y/o servicios para tu evento</p>
          <div class="form-group row">
            <label for="fecha" class="col-form-label col-sm-2 col-md-2 col-lg-2">Fecha</label>
            <input type="date" class="form-control col-sm-4 col-md-4 col-lg-4" id="fecha" placeholder="Fecha" name="Fecha">
            <div class="form-check form-check-inline col-sm-5 col-md-5 col-lg-2">
              <input class="form-check-input" type="checkbox" id="buscar_salon" name="tipo[]" value="salon" checked>
              <label class="form-check-label" for="buscar_salon">Salón</label>
              <input class="form-check-input" type="checkbox" id="buscar_servicio" name="tipo[]" value="servicios" checked>
              <label class="form-check-label" for="buscar_servicio">Servicios</label>
            </div>
          </div>

          <div class="form-group row">
            <label for="tipoEvento" class="col-form-label col-sm-2 col-md-2 col-lg-2">Evento</label>
            <select class="form-control col-sm-8 col-md-9 col-lg-8" id="tipoEvento" name="tipoEvento">
              <option>
              </option>
              <pre>
                @foreach ($tipoEventos as $tipoEvento)
              </pre>
              <option value="{{ key($tipoEvento) }}">{{ $tipoEvento[$id] }}</option>
              @endforeach
            </select>
          </div>
          <div class="contenedor_boton">
            <input type="submit" class="button-meeting-room" id="Buscar" value="Buscar">
          </input>
        </div>
      </form>
    </section>


    <section style="padding: 5rem; padding-bottom: 1rem;">
      <!-- NUEVO INICIO CONTENIDO -->
      <p class="h4" style="margin-top: 50px; font-size: 40px; ">Conocé nuestros salones</p>
      <div class="row card_row">

        <?php foreach ($salones as $salon) {
          ?>
          <div class="col-sm-12 col-md-4 col-lg-4 card_margin">
            <div class="card mb-4 box-shadow">
              <div class="img_thumb">
                <img class="card-img-top" src="subidos/productos/<?php echo $salon->getPortada(); ?>"  alt="Salón 1">
              </div>
              <div class="card-body">
                <p class="h4" id="nombre_salon" name="nombre_salon">
                  <?php echo $salon->getNombre(); ?></p>
                  <p class="card-text"><?php echo $salon->getDescripcion();  ?></p>
                  <p class="card-text">Consultar disponibilidad y precio</p>
                </div>
                <div class="corazon" style="justify-content: flex-end; padding: 15px;">

                  <a href="#" id="likes">
                    <i class="fa fa-heart" style="font-size:24px;color:#B21917"></i>
                  </a>
              <!-- ARMAR BUSQUEDA EN FAVORITOS DINAMICO
              <?php if(in_array($salon->getId(), $favoritos)){ ?>

              <a href="#" id="likes">
                <i class="fa fa-heart" style="font-size:24px;color:#B21917"></i>
              </a>

              <?php }else{ ?>

              <a href="#" id="likes">
                <i class="fa fa-heart-o" style="font-size:24px;color:#B21917"></i>
              </a>
              <?php } ?>
            -->
            <form  action="agregar_producto.php" method="post" id="agregar_carrito_<?php echo $salon->getId(); ?>">
              <input type="hidden" name="id" value="<?php echo $salon->getId(); ?>">
              <input type="hidden" name="producto" value="<?php echo $salon->getNombre(); ?>">
              <input type="hidden" name="precio" value="<?php echo $salon->getPrecio(); ?>">
              <button onclick="agregar_carrito(<?php echo $salon->getId(); ?>)" class="btn btn-link btn-link-custom">
                <i class="fa fa-shopping-cart" style="font-size:24px;color:#B21917"></i>
              </button>
            </form>
            <a href="#" id="likes">
              <i class="fa fa-share-alt  ml-3 mr-3 mb-3" style="font-size:24px;color:#B21917"></i>
            </a>


            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a class="btn btn-sm btn-outline-secondary" href="producto.php?id=<?php echo $salon->getId();  ?>">Ver</a>
                <a class="btn btn-sm btn-outline-secondary" href="contacto.php?producto=<?php echo $salon->getId(); ?>"  onclick="agregar_carrito(<?php echo $salon->getId(); ?>)">Consultar</a>
              </div>
            </div>

          </div>
        </div><!-- card -->
      </div> <!-- col -->
      <?php } ?>
    </div> <!-- row -->
  </section>


  <section style="padding: 5rem; padding-bottom: 1rem;">
    <!-- NUEVO INICIO CONTENIDO -->
    <p class="h4" style="margin-top: 50px; font-size: 40px; ">Conocé nuestros servicios</p>
    <div class="row card_row">

      <?php foreach ($servicios as $servicio) {
        ?>
        <div class="col-sm-12 col-md-4 col-lg-4 card_margin">
          <div class="card mb-4 box-shadow">
            <div class="img_thumb">
              <img class="card-img-top" src="subidos/productos/<?php echo $servicio->getPortada(); ?>"  alt="Foto Servicio">
            </div>
            <div class="card-body">
              <p class="h4" id="nombre_salon" name="nombre_salon">
                <?php echo $servicio->getNombre(); ?></p>
                <p class="card-text"><?php echo $servicio->getDescripcion();  ?></p>
                <p class="card-text">Consultar disponibilidad y precio</p>
              </div>
              <div class="corazon" style="justify-content: flex-end; padding: 15px;">

                <a href="#" id="likes">
                  <i class="fa fa-heart" style="font-size:24px;color:#B21917"></i>
                </a>
              <!-- ARMAR BUSQUEDA EN FAVORITOS DINAMICO
              <?php if(in_array($servicio->getId(), $favoritos)){ ?>

              <a href="#" id="likes">
                <i class="fa fa-heart" style="font-size:24px;color:#B21917"></i>
              </a>

              <?php }else{ ?>

              <a href="#" id="likes">
                <i class="fa fa-heart-o" style="font-size:24px;color:#B21917"></i>
              </a>
              <?php } ?>
            -->
            <a href="#" id="likes">
              <i class="fa fa-share-alt  ml-3 mr-3 mb-3" style="font-size:24px;color:#B21917"></i>
            </a>
            <form  action="agregar_producto.php" method="post" id="agregar_carrito_<?php //traer salon id ?>">
              <input type="hidden" name="id" value="<?php echo $servicio->getId(); ?>">
              <input type="hidden" name="producto" value="<?php echo $servicio->getNombre(); ?>">
              <input type="hidden" name="precio" value="<?php echo $servicio->getPrecio(); ?>">
                <!--<button onclick="agregar_carrito(<?php echo $servicio->getId(); ?>)" class="btn btn-link btn-link-custom">
                  <i class="fa fa-shopping-cart" style="font-size:24px;color:#B21917"></i>
                </button>
                input type="submit" name="" value="carrito"-->
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a class="btn btn-sm btn-outline-secondary" href="producto.php?id=<?php echo $servicio->getId();  ?>">Ver</a>
                    <a class="btn btn-sm btn-outline-secondary" href="contacto.php?producto=<?php echo $servicio->getId(); ?>"  onclick="agregar_carrito(<?php //echo servicio id ?>)">Consultar</a>
                  </div>
                </div>
              </form>
            </div>

          </div><!-- card -->
        </div> <!-- col -->
        <?php } ?>
      </div> <!-- row -->
    </section>


    <!-- FIN CONTENIDO GENERICO -->





    <!--Footer-->

    @include('Components.footer')

    <!--/Footer-->
  </div>



</body>
</html>





