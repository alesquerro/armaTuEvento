<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('/Components/Admin/head')
<body>
	{{-- INICIO NAV --}}
	<div class="container-fluid contenido">
		@include('/Components/header')
	</div>
	{{-- FIN NAV --}}
	<div class="contenido container" id="contenido-principal">
		<!-- INICIO FORM -->
		<div class="row bg-traslucido bg-margenes" style="background: rgba(48, 207, 163, 0.12)">
			<div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">

				<div style="margin-left: 25px; margin-top: 15px; padding-bottom: 20px; background: rgba(48, 207, 163, 0.12)">
					<ul>
						<h1 style="text-align: center">Crear producto</h1>
						{{-- INICIO FORM--}}
						<form action="/Admin/Product" method="post" class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" enctype="multipart/form-data">
							@method('PUT')
							@csrf
							<input type="hidden" class="form-control" name="tipo_form" value="modificar">

							<input type="hidden" class="form-control" name="accion" value="modificar">
							{{-- <input type="hidden" class="form-control" name="id" value="{{ old('id') }}"> --}}
							<input type="hidden" class="form-control" name="company_id" value='1'>
							<!-- NOMBRE -->
							<div class="form-group">
								<label for="inputNombre" class="col-form-label h4">Nombre del producto</label>
								<div>
									<input type="text" class="form-control" name="name" id="inputNombre" placeholder="Nombre" required value="{{ old('name') }}">
								</div>
							</div>
							<!-- FIN NOMBRE -->
							<!-- EMAIL -->
							<div class="form-group">
								<label for="inputEmail3" class="col-form-label h4">Email</label>
								<div>
									<input type="email" class="form-control" name="mail" id="inputEmail" placeholder="ejemplo@mail.com" required value="{{ old('mail') }}">
								</div>
							</div>
							<!-- FIN EMAIL -->
							<!-- FILE -->

							<!-- TELEFONO -->
							<div class="form-group">
								<label for="inputTelefono" class="col-form-label h4">Telefono</label>
								<div>
									<input type="text" class="form-control" name="phone" id="inputTelefono" placeholder="Telefono" value="{{ old('phone') }}">
								</div>
							</div>
							<!-- FIN TELEFONO -->
							<!-- CAPACIDAD -->
							<div class="form-group">
								<label for="inputCapacidad" class="col-form-label h4">Capacidad</label>
								<div>
									<input type="number" class="form-control" name="capacity" id="inputCapacidad" placeholder="Capacidad" required value="{{ old('capacity') }}">
								</div>
							</div>
							<!-- FIN CAPACIDAD -->
							<!-- DESCRIPCION -->
							<div class="form-group">
								<label for="inputDescripcion" class="col-form-label h4">Descripción</label>
								<div>
									<input type="textarea" class="form-control" name="description" id="description" placeholder="Descripcion" required value="{{ old('description') }}">
								</div>
							</div>
							{{-- FIN DESCRIPCION  --}}
							{{-- TIPO DE PRODUCTO  --}}
							<div class="form-group">
								<label for="tipoProducto" class="col-form-label h4" >Tipo de producto
								</label>
								<div>
									<select name="type" id="type">
										<option value="salon" selected>salon</option>
										<option value="servicio">servicio</option>
									</select>
								</div>
							</div>
							<!-- FIN TIPO DE PRODUCTO -->
							<!-- TIPO DE EVENTO -->
							<div class="form-group">
								<label  class="col-form-label h4"><strong>Categoría de producto</strong>
								</label>

										<div id="tipo_servicios" class='hide_select'>
											@foreach ($tipo_servicios as $product_type)
											<input type="checkbox" name="product_types[]" value="{{ $product_type->id }}" id="{{ $product_type->name }}"

											{{-- {{ $product->product_types}} --}}
											<label class="form-check-label" for="{{ $product_type->name }}">{{ $product_type->name }}</label>
											<br>
											@endforeach
										</div>

										<div id="tipo_salones" class='show_select'>
											@foreach ($tipo_salones as $product_type)
											<input type="checkbox" name="product_types[]" value="{{ $product_type->id }}" id="{{ $product_type->name }}"

											{{-- {{ $product->product_types}} --}}
											<label class="form-check-label" for="{{ $product_type->name }}">{{ $product_type->name }}</label>
											<br>
											@endforeach
										</div>
								<label class="col-form-label h4"><strong>Tipos de eventos</strong>
								</label>
								<div id="tipo_eventos" >
									@foreach ($event_types as $event_type)
									<input type="checkbox" name="event_types[]" value="{{ $event_type->id }}" id="{{ $event_type->name }}">
									<label class="form-check-label" for="{{ $event_type->name }}">{{ $event_type->name }}</label>
									<br>
									@endforeach
								</div>

							</div>
							<!--  FIN TIPO DE EVENTO  -->
							<!-- RESERVA MINIMA -->
							<div class="form-group">
								<label for="inputReservaMinima" class="col-form-label h4">Reserva minima</label>
								<div>
									<input type="text" class="form-control" name="minimum_reservation" id="inputReservaMinima" placeholder="% reserva minima" required value="{{ old('minimum_reservation')}}">
								</div>
							</div>
							<!-- FIN RESERVA MINIMA -->
							<!-- PRECIO -->
							<div class="form-group">
								<label for="inputPrecio" class="col-form-label h4">Precio</label>
								<div>
									<input type="number" class="form-control" name="price" id="inputPrecio" placeholder="Precio" required value="{{ old('price')}}">
								</div>
							</div>
							<!-- FIN PRECIO -->
							<!-- TIPO DE PRECIO -->
							<div class="form-group">
								<label for="tipoPrecio" class="col-form-label h4">Tipo de precio</label>
								<div>
									<select name="price_type" id="inputPrecio">
										<option value="Por persona">
											Por persona
										</option>
										<option value="Por hora">
											Por hora
										</option>
										<option value="Fijo" >
											Fijo
										</option>
									</select>
									{{-- <input type="text" class="form-control" name="price_type" id="inputPrecio" placeholder="Precio" required value="{{ $product->price_type}}"> --}}
								</div>
							</div>
							<!-- FIN TIPO DE PRECIO  -->
							<!-- GUARDAR -->

							<div class="form-group  text-center">
								<div>
									<button type="submit" class="col-lg-8 col-md-8 btn">Guardar Cambios</button>
								</div>
							</div>
							<!-- FIN GUARDAR -->
						</form> <!-- FIN FORMULARIO -->
					</div> <!--form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2-->

				</div></div>
				{{-- FOOTER --}}
				<div>
					@include('/Components/footer')
				</div>

				{{-- FIN FOOTER --}}
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	 $(document).ready(
		 function(){
			 $('#type').on('change', function() {

					if(this.value == 'salon'){
							$('#tipo_salones').attr('class','show_select');
							$('#tipo_servicios').attr('class','hide_select');

					}
					else{
							$('#tipo_servicios').attr('class','show_select');
							$('#tipo_salones').attr('class','hide_select');
							$('#tipo_salones').prop('selectedIndex',0);
					}
				});
		 }
	 );

</script>
</body>
</html>
