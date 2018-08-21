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
							{{-- <li class="modificar"> --}}
								<div class="card">
									<div class="card-body">
										<form action="Product/{{$product->id}}" method="post">
                      @csrf
											<img class="card-img-top" style="max-width: 10em"  src="/subidos/productos/{{$product->cover}}" alt="{{$product->name}}">
											<input type="hidden" name="producto" value="{{$product->id}}">
                      <div class="form-group  text-center">
                        <div>
                          <button type="submit" class="col-lg-8 col-md-8 btn">Editar {{$product->name}}</button>
                        </div>
                      </div>
											{{-- <button type="submit" value="Editar {{$product->name}}" class="col-lg-8 col-md-8 btn"> --}}
										</form>
									</div>
								</div>	
							{{-- </li>  --}}
						</div>
						@endforeach
					{{-- </ul> --}}
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
