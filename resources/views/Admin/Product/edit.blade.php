<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('.Components.Admin.head')
<body>
	{{-- INICIO NAV --}}
	<div class="container-fluid contenido">
		@include('.Components.header')
	</div>
	{{-- FIN NAV --}}
	<div class="contenido container" id="contenido-principal">
		<!-- INICIO FORM -->
		<div class="row bg-traslucido bg-margenes" style="background: rgba(48, 207, 163, 0.12)">
			<div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
				<?php //if($errores){ ?>
				<div style="margin-left: 25px; margin-top: 15px; padding-bottom: 20px; background: rgba(48, 207, 163, 0.12)">
					<ul>
						<h1 style="text-align: center">Editar {{ $product->name }}</h1>
						{{-- INICIO FORM--}}
						<form action="/Admin/EditarProducto" method="post" class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" enctype="multipart/form-data">
							@method('PUT')
							@csrf
							<input type="hidden" class="form-control" name="tipo_form" value="modificar">
							<input type="hidden" class="form-control" name="accion" value="modificar">
							<input type="hidden" class="form-control" name="id" value="{{ $product->id }}">
							<input type="hidden" class="form-control" name="company_id" value='1'>

							<!-- NOMBRE -->
							<div class="form-group">
								<label for="inputNombre" class="col-form-label h4">Nombre del producto</label>
								<div>
									{{$product->id}}
									<input type="text" class="form-control" name="name" id="inputNombre" placeholder="Nombre" required value="{{ $product->name }}">

								</div>
							</div>
							<!-- FIN NOMBRE -->
							<!-- EMAIL -->
							<div class="form-group">
								<label for="inputEmail3" class="col-form-label h4">Email</label>
								<div>
									<input type="email" class="form-control" name="mail" id="inputEmail" placeholder="" required value="{{ $product->mail }}" placeholder="ejemplo@correo.com">
								</div>
							</div>
							<!-- FIN EMAIL -->
							<!-- FILE -->
							<div class="form-group">
								<img class="imagen-muestra" src="subidos/productos/{{ $product->cover }}" alt=""><br>
								<label for="" class="col-form-label h4">Foto Portada: </label>
								<input type="file" name="cover" accept=".jpg, .jpeg, .png, .gif"/>
							</div>
							<!-- TELEFONO -->
							<div class="form-group">
								<label for="inputTelefono" class="col-form-label h4">Telefono</label>
								<div>
									<input type="text" class="form-control" name="phone" id="inputTelefono" placeholder="Telefono" value="{{ $product->phone }}">
								</div>
							</div>
							<!-- FIN TELEFONO -->
							<!-- CAPACIDAD -->
							<div class="form-group">
								<label for="inputCapacidad" class="col-form-label h4">Capacidad</label>
								<div>
									<input type="number" class="form-control" name="capacity" id="inputCapacidad" placeholder="Capacidad" required value="{{ $product->capacity }}">
								</div>
							</div>
							<!-- FIN CAPACIDAD -->
							<!-- DESCRIPCION -->
							<div class="form-group">
								<label for="inputDescripcion" class="col-form-label h4">Descripción</label>
								<div>
									<input type="textarea" class="form-control" name="description" id="description" placeholder="Descripcion" required value="{{ $product->description }}">
								</div>
							</div>
							{{-- FIN DESCRIPCION  --}}
							{{-- TIPO DE PRODUCTO  --}}
							<div class="form-group">
								<label for="tipoProducto" class="col-form-label h4">
									Tipo de producto
								</label>
										{{-- {{$product->type}} --}}
								<div>
									<select name="type" id="type">
											<option value="salon" {{ $product->type == 'salon' ? 'selected' : '' }}>
												salon
											</option>
											<option value="servicio" {{ $product->type == 'servicio' ? 'selected' : '' }}>
												servicio
											</option>
									</select>
								</div>
							</div>
							<!-- FIN TIPO DE PRODUCTO -->
							<!-- TIPO DE EVENTO -->
							<div class="form-group">
								<label for="tipoEvento" class="col-form-label h4">Tipo de evento
								</label>

										<div id="tipo_servicios" class='{{ $product->type == 'servicio' ? 'show_select': 'hide_select'}}'>
											@foreach ($tipo_servicios as $product_type)
											<input type="checkbox" name="product_types[]" value="{{ $product_type->id }}" id="{{ $product_type->name }}"
											@if (in_array($product_type->id, $own_product_types))
											{{ 'checked' }}
											@endif/>
											{{-- {{ $product->product_types}} --}}
											<label class="form-check-label" for="{{ $product_type->name }}">{{ $product_type->name }}</label>
											<br>
											@endforeach
										</div>

										<div id="tipo_salones" class='{{ $product->type == 'salon' ? 'show_select': 'hide_select'}}'>
											@foreach ($tipo_salones as $product_type)
											<input type="checkbox" name="product_types[]" value="{{ $product_type->id }}" id="{{ $product_type->name }}"
											@if (in_array($product_type->id, $own_product_types))
											{{ 'checked' }}
											@endif/>
											{{-- {{ $product->product_types}} --}}
											<label class="form-check-label" for="{{ $product_type->name }}">{{ $product_type->name }}</label>
											<br>
											@endforeach
										</div>

							</div>
							<!--  FIN TIPO DE EVENTO  -->
							<!-- RESERVA MINIMA -->
							<div class="form-group">
								<label for="inputReservaMinima" class="col-form-label h4">Reserva minima</label>
								<div>
									<input type="text" class="form-control" name="minimum_reservation" id="inputReservaMinima" placeholder="% reserva minima" required value="{{ $product->minimum_reservation}}">
								</div>
							</div>
							<!-- FIN RESERVA MINIMA -->
							<!-- PRECIO -->
							<div class="form-group">
								<label for="inputPrecio" class="col-form-label h4">Precio</label>
								<div>
									<input type="number" class="form-control" name="price" id="inputPrecio" placeholder="Precio" required value="{{ $product->price}}">
								</div>
							</div>
							<!-- FIN PRECIO -->
							<!-- TIPO DE PRECIO -->
							<div class="form-group">
								<label for="tipoPrecio" class="col-form-label h4">Tipo de precio</label>
								<div>
									<select name="price_type" id="inputPrecio">
										<option value="Por persona" {{ $product->price_type == 'Por persona' ? 'selected' : '' }}>
											Por persona
										</option>
										<option value="Por hora" {{ $product->price_type == 'Por hora' ? 'selected' : '' }}>
											Por hora
										</option>
										<option value="Fijo" {{ $product->price_type == 'Fijo' ? 'selected' : '' }}>
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
							<input type="hidden" class="form-control" name="active" value="0">

									<button type="submit" name="submit" class="col-lg-8 col-md-8 btn" value="edit">Guardar Cambios</button>

                  <button type="submit" name="submit" class="col-lg-8 col-md-8 btn" value="delete">Eliminar Producto</button>
								</div>
							</div>
							<!-- FIN GUARDAR -->
						</form> <!-- FIN FORMULARIO -->
					</div> <!--form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2-->

				</div></div>
				{{-- FOOTER --}}
				<div>
					@include('.Components.footer')
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
