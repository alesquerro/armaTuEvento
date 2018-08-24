<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('/Components/Admin/head')
<body>
  <div class="container-fluid contenido">
    @include('/Components/header')
    <!-- FIN NAV -->



    <div class="container-fluid  todo" >
     <div class="contenido_listar_productos container">
      <h1>Productos </h1>
      <div class="row">
       {{-- <ul> --}}
        @foreach ($products as $product)
        <div class="col-sm-6">




<div class="row">
  <div class="col-sm-6">
         {{-- <li class="modificar"> --}}
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" style="width: 18rem;" src="{{ URL::to('storage/' . $product->cover)}}" alt="{{$product->name}}">
            <div class="card-body">
              {{-- <div class="form-group  text-center"> --}}
                <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text">{{ $product->description }}</p>
              </div>
              <div class="card-body">

                <form action="/Admin/Product" method="post">
                  @csrf
                  <input type="hidden" name="producto" value="{{$product->id}}">

                  <button type="submit" name="submit" class="col-lg-8 col-md-8 btn" value="edit">Editar </button>
                  {{-- <button type="submit" name="submit" class="col-lg-8 col-md-8 btn" value="delete">Eliminar</button> --}}
                </div>
                         {{-- <button type="submit" value="edit" class="col-lg-8 col-md-8 btn">Editar {{$product->name}}</button>
                        </div>
                        <div>
                          <button type="submit" value="delete" class="col-lg-8 col-md-8 btn">Eliminar {{$product->name}}</button>
                        </div> --}}
                      </div>

                    </form>
                  </div>
                </div>
              {{-- </li>  --}}
            </div>
            @endforeach
          {{-- </ul> --}}
        </div>
      </div>
      </div>
      </div>

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
