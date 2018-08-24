<?php
//
// require_once('funciones/autenticacion.blade.php');
// require_once('funciones/usuarios.blade.php');

$usuario = false;
// if(isset($_SESSION['usuario']) && $_SESSION['usuario']){
//     $usuario = $_SESSION['usuario'];
//     $avatar = get_avatar($usuario);
// }else{
//   //si existe la cookie, que inicie sesión
//   if (isset($_COOKIE['usuario'])) {
//       $usuario = buscarUsuario('id', $_COOKIE['usuario']);
//       $avatar = get_avatar($usuario);
//       if ($usuario){
//         unset($usuario['contrasena']);
//         $_SESSION['usuario'] = $usuario;
//       }
//   }
// }

?>

<nav class="navigation bg-header">
  <div class="logo">
    <a class="navbar-brand"  href="/">
      <img id="logo" src="/imagenes/logo_completo.svg">
    </a>
  </div>
  <div class="ingreso-busquedas">
    <form action="/listado" method="post" id="buscar_lg">
      @csrf
      <div class="input-group buscador">
        <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" name="texto">
        <button class="btn" type="submit" onclick="buscar_lg()">
          <img class="buscador_img" src="/imagenes/search.png" alt="">
        </button>
      </div>
    </form>
  </div>
  <ul class="navbar menu_lista">
      @if (! Auth::check())

    <li class="">
      <a class="" href="/login">Ingresar</a>
    </li>
    <li class="">
      <a class="" href="/registro">Registrarme</a>
    </li>
        @else
  <div class="header_usuario">


  @if (Auth::user()->avatar == null)
      <div class="avatar">
        <img src="/imagenes/default_avatar.png" alt="">
      </div>
  @else
      <div class="avatar">
        @if (Auth::user()->avatar)
          <img src="/storage/{{Auth::user()->avatar}}" alt="">
        @else
          <img src="/imagenes/default_avatar.png" alt="">
        @endif

      </div>
  @endif

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->email }}</a>
      <div class="dropdown-menu">
        <a class="" href="/perfil">Mi cuenta</a><br>
        <a class="" href="/mis_compras">Mis reservas</a><br>
        @if (Auth::user()->admin)
         <a class="" href="/Admin/dashboard">Administrar</a><br>
       @endif
        <a class="" href="/logout">Cerrar sesión</a>
      </div>
    </div>
  </li>
  @endif

    <li class="">
      <a class="" href="/FAQs">FAQs</a>
    </li>
    <li class="">
      <a class="" href="/contacto">Contacto</a>
    </li>
    <li class="">
      <a class="" href="/carrito"><img id="carrito" src="/imagenes/w-shop.png"></a>
    </li>
  </ul>
</nav>

<script>

function mostrar_menu_sm(){

  $("#menu_lista-sm").toggle(500);
}
function mostrar_menu_md(){

  $("#menu_lista-md").toggle(500);
}
</script>
<nav class="navigation-sm bg-header">
  <div class="nav_linea">
    <div class="logo">
      <a class=""  href="/">
        <img id="logo" src="/imagenes/logo_completo.svg">
      </a>
    </div>
    <div class="boton_menu">
      <button class="navbar-toggler" type="button" onclick="mostrar_menu_sm()">
        <!--span class="fas fa-align-justify"></span-->
        <i class="fa fa-bars" aria-hidden="true" style="font-size:36px"></i>
      </button>
    </div>
  </div>
  <div class="ingreso-busquedas">
    <form action="/listado" method="post" id="buscar_sm">
      @csrf
      <div class="input-group buscador">
        <input class="form-control" type="search" placeholder="Buscar" name="texto">
        <button class="btn" type="submit" onclick="buscar_sm()">
          <img class="buscador_img" src="/imagenes/search.png" alt="">
        </button>
      </div>
    </form>
  </div>
  <ul class="menu_lista-sm" id="menu_lista-sm">
    @if (! Auth::check())

      <li class="">
        <a class="" href="/login">Ingresar</a>
      </li>
      <li class="">
        <a class="" href="/registro">Registrarme</a>
      </li>
    @else
      <div class="">
        @if (Auth::user()->avatar == null)
          <div class="avatar">
            <img src="/imagenes/default_avatar.png" alt="">
          </div>
        @else
          <div class="avatar">
            <img src="/storage/{{Auth::user()->avatar}}" alt="">
          </div>
        @endif
      <li class="">{{ Auth::user()->email }}</li> <br>
      <li class="">
        <a class="" href="perfil">Mi cuenta</a>
      </li>
      <li>
        <a class="" href="mis_compras">Mis reservas</a>
      </li>
      @if (Auth::user()->admin)
        <li>
          <a class="" href="/Admin/dashboard">Administrar</a>
        </li>
      @endif
      <li>
        <a class="" href="/logout">Cerrar sesión</a>
      </li>
    </div>
    @endif
  <li class="">
    <a class="" href="/FAQs">FAQs</a>
  </li>
  <li class="">
    <a class="" href="/contacto">Contacto</a>
  </li>
  <li class="">
    <a class="" href="/carrito"><img id="carrito" src="/imagenes/w-shop.png"></a>
  </li>
  </ul>
</nav>

<nav class="navigation-md bg-header">
  <div class="nav_linea">
    <div class="logo">
      <a class=""  href="/">
        <img id="logo" src="/imagenes/logo_completo.svg">
      </a>
    </div>
    <div class="ingreso-busquedas-md">
      <form action="/listado" method="post" id="buscar_md">
        @csrf
        <div class="input-group buscador">
          <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" name="texto">
          <button class="btn" type="submit" onclick="buscar_md()">
            <img class="buscador_img" src="/imagenes/search.png" alt="">
          </button>
        </div>
      </form>
    </div>
    <div class="boton_menu">
      <button class="navbar-toggler" type="button" onclick="mostrar_menu_md()"> <!--data-toggle="collapse" data-target="#menu_lista" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation"-->
        <!--span class="fas fa-align-justify"></span-->
        <i class="fa fa-bars" aria-hidden="true" style="font-size:36px"></i>
      </button>
    </div>
  </div>
  <ul class="menu_lista-md" id="menu_lista-md">
      @if (! Auth::check())

        <li class="">
          <a class="" href="/login">Ingresar</a>
        </li>
        <li class="">
          <a class="" href="/registro">Registrarme</a>
        </li>
      @else
      <div class="">
        @if (Auth::user()->avatar == null)
            <div class="avatar">
              <img src="/imagenes/default_avatar.png" alt="">
            </div>
        @else
            <div class="avatar">
              <img src="/storage/{{Auth::user()->avatar}}" alt="">
            </div>
        @endif
        <li class="">{{ Auth::user()->email }}</li> <br>
        <li class="">
          <a class="" href="perfil">Mi cuenta</a>
        </li>
        <li>
          <a class="" href="mis_compras">Mis reservas</a>
        </li>
        @if (Auth::user()->admin)
          <li>
            <a class="" href="/Admin/dashboard">Administrar</a>
          </li>
        @endif
        <li>
          <a class="" href="/logout">Cerrar sesión</a>
        </li>
      </div>
  @endif
    <li class="">
      <a class="" href="/FAQs">FAQs</a>
    </li>
    <li class="">
      <a class="" href="/contacto">Contacto</a>
    </li>
    <li class="">
      <a class="" href="/carrito"><img id="carrito" src="/imagenes/w-shop.png"></a>
    </li>
  </ul>
</nav>
<script type="text/javascript">
  function buscar_lg(){
    $( "#buscar_lg" ).submit();
  }
  function buscar_sm(){
    $( "#buscar_sm" ).submit();
  }
  function buscar_md(){
    $( "#buscar_md" ).submit();
  }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
