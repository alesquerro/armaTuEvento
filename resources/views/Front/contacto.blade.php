<?php

$asunto="";
// include_once('funciones/json.php');
// $salones = obtenerNitems('salones', 1);
// $servicios = obtenerNitems('servicios', 1);
//
// $productos = array_merge($salones, $servicios);
// $producto = false;
// $prod_id = false;
//
// if($_GET && isset($_GET['producto'])){
//   $prod_id = $_GET['producto'];
// }
//
//
// foreach ($productos as $prod) {
//   if( $prod['id'] ==  $prod_id){
//       $producto = $prod;
//   }
// }
//
// $asunto="";
// if(isset($_POST['asunto'])){
//   $_POST['asunto'];
// }else{ if($producto){
//   $asunto=$producto['nombre'];
// }}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')
<body>

<div class="container-fluid">
<!-- INICIO NAV -->
@include('Components.header')
 <!-- FIN NAV -->
 <div class="contenido container" id="contenido-principal">
   <!-- INICIO FORM -->
   <div class="row bg-traslucido bg-margenes">
     <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">

       <h1>Contacto</h1>

                <form action="" method="post" class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" enctype="multipart/form-data">

                  <div class="form-group">
                      <label for="inputNombre" class="col-form-label h4">Nombre (*)</label>
                    <div>
                      <input type="text" class="form-control" name="nombre" id="inputNombre" placeholder="Nombre" required value="<?php echo $usuario['nombre'] ?? '' ; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputApellido" class="col-form-label h4" >Apellido (*)</label>
                    <div>
                      <input type="text" class="form-control" name="apellido" id="inputApellido" placeholder="Apellido" required value="<?php echo $usuario['apellido'] ?? '';?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-form-label h4">Email (*)</label>
                    <div>
                      <input type="email" class="form-control" name="mail" id="inputEmail" placeholder="Email" required value="<?php echo $usuario['mail'] ?? '';  ?>">
                    </div>
                  </div>
                  <div class="form-group">

                    <label for="inputAsunto" class="col-form-label h4">Asunto (*)</label>
                    <div>

                      <input type="text" class="form-control" name="asunto" id="inputAsunto" placeholder="Asunto" required value="{{ $product ? 'Consulta sobre '.$product->name : ''}}" >
                    </div>

                  </div>

                  <div class="form-group">
                    <label for="inputConsulta" class="col-form-label h4">Consulta (*)</label>
                            <textarea class="form-control" id="consulta" name="consulta" placeholder="Ingrese su consulta." rows="7"></textarea>
                  </div>

                        <div class="form-group  text-center">
                            <div>
                                <button type="submit" class="col-lg-8 col-md-8 btn">Enviar</button>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--Footer-->
@include('Components.footer')
<!--/Footer-->
</div>

</body>
</html>
