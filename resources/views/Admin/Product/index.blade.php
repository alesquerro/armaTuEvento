
<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')
<body>
  <div class="container-fluid contenido">
    <!-- INICIO NAV -->
    @include('Components.header')
    <!-- FIN NAV -->












    <!--Footer-->
    @include('Components.footer')
    <!--/Footer-->
    <script>
      function mostrar_filtros(){
        $("#lista_filtro").toggle(1000);
      }
      function mostrar_orden(){
        $("#orden_filtro").toggle(1000);
      }
      function add_favourites(prod){
        $("#add_favourites_"+prod).submit();
      }
      function remove_favourites(prod){
        $("#remove_favourites_"+prod).submit();
      }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</div>
</body>
</html>
