<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('/Components/Admin/head')
  <body>
    <div class="container-fluid contenido">
    @include('/Components/header')

    <main>

      <header>

        <div>

          <h1>Panel de administración</h1>
          <a href="/Admin/nuevoProducto" class=" btn btn-lg btn-success" role="button">Crear Producto</a>
          </div>
        <div id="header-container">

          <div>

            <ul>
              <li><a href="/Admin/listar_usuarios"  class="listado-panel">Modificar Usuarios</a></li>
              <li><a href="/Admin/listar_productos"  class="listado-panel">Modificar Productos</a></li>
              <li><a href="/Admin/nuevoProducto"  class="listado-panel">Nuevo Producto</a></li>
              <li><a href="/Admin/reservas"  class="listado-panel">Reservas</a></li>
            </ul>

          </div>

          <div>

             <ul>
              <li><a href="#"  class="listado-panel">Hoy</a></li>
              <li><a href="#"  class="listado-panel">7 días</a></li>
              <li><a href="#"  class="listado-panel">14 días</a></li>
              <li><a href="#"  class="listado-panel">●●●</a></li>
            </ul>

          </div>

        </div>

      </header>

      <section>

        <div class="section-container">

          <div>

            <h2>34,083<br>
            <span class="stats"><strong>Total acumulado en pesos</strong> (14 días)</span>
            </h2>

            <p>Fechas especiales: aprovechá una gran oportunidad de venta. Podrás conseguir más de <span id="green">9.487 más de visitas</span> en un mes.</p>



          </div>

          <div id="bar-chart-one"></div>

        </div>

        <div class="section-container">

          <div>

            <h2>213<br>
            <span class="stats"><strong>Total de ventas concretadas</strong> (14 días)</span>
            </h2>

            <p>Automatizar los procesos manuales, un paso clave para progresar. <span id="green">452 más de visitas</span> en un mes.</p>



          </div>

          <div id="bar-chart-two"></div>

        </div>

      </section>

    </main>

    @include('/Components/footer')
    </div>
  </body>
</html>
