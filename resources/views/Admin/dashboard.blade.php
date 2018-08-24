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
              <li><a href="/Admin/deleteProducts"  class="listado-panel">Eliminar Productos</a></li>
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

      <section class="mt-5 pb-5">

        <div class="section-container">

          <div>

            <h2>34,083<br>
            <span class="stats"><strong>Total acumulado en pesos</strong> (14 días)</span>
            </h2>

            <p>Fechas especiales: aprovechá una gran oportunidad de venta. Podrás conseguir más de <span id="green">9.487 más de visitas</span> en un mes.</p>



          </div>

          <div id="bar-chart-one"></div>

        </div>

        <div class="section-container mb-5 mt-5 pt-5">

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

     <script type="text/javascript">

      var chart;
      var chartData = [  
        ['Salones',534],
        ['Servicios' ,32],
        ['Catering' ,34],
        ['Amoblamiento',45],
        ['Cotillon' , 7],
     ];
      var chart2;
        var chartData2 = [  
          ['Salones', 434],
          ['Servicios' , 532],
          ['Catering' , 734],
          ['Amoblamiento',455],
          ['Cotillon' , 723],
        ];

    $(document).ready(function(){

      addChart();

    });


    addChart = function(){
      chart = c3.generate({
        bindto: '#bar-chart-one',
        data: {
          type: 'bar',
          columns: chartData,      
        }

      });
      chart2 = c3.generate({
        bindto: '#bar-chart-two',
        data: {
          type: 'bar',
          columns: chartData2,      
        }

      });
    }

    </script>
  </body>
</html>
