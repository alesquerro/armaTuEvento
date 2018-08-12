<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')
  <body>
  <div class="container-fluid">
@include('Components.header')
   <div class="contenido container" id="contenido-principal">
      <!-- INICIO FORM -->
    <div class="row bg-traslucido bg-margenes">
      <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">

            @if (count($errors))

                <div class="alert alert-danger">
                  @foreach( $errors->all() as $error)
                        <p>  {{$error}}</p>
                  @endforeach
                </div>
            @endif

      <h1>Registración</h1>

  <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}"  class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" enctype="multipart/form-data">
    @csrf

    
        <div class="form-group">
            <label for="inputNombre" class="col-form-label h4">Nombre (*)</label>
          <div>
            <input type="text" class="form-control" name="first_name" id="inputNombre" placeholder="Nombre" required value="{{old('first_name')}}">
          </div>
        </div>
        <div class="form-group">
          <label for="inputApellido" class="col-form-label h4" >Apellido (*)</label>
          <div>
            <input type="text" class="form-control" name="last_name" id="inputApellido" placeholder="Apellido" required value="{{old('last_name')}}">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAlias" class="col-form-label h4">Alias (*)</label>
          <div>
            <input type="text" class="form-control" name="alias" id="inputAlias" placeholder="Alias" required value="{{old('alias')}}">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label h4">Email (*)</label>
          <div>
            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required value="{{old('email')}}">
          </div>
        </div>
        <div class="form-group">
          <label for="contrasena">Contraseña (*)</label>
          <input type="password" class="form-control" id="contrasena" name="password" placeholder="Ingrese contraseña" required>
        </div>
        <div class="form-group">
           <label for="contrasena-confirm">Confirmar Contraseña (*)</label>
           <input type="password" class="form-control" id="contrasena-confirm" name="password_confirm" placeholder="Vuelva a ingresar la contraseña" required>
        </div>
        <div class="form-group">
            <input type="file" name="avatar" accept=".jpg, .jpeg, .png, gif"/>
        </div>
       <div class="form-group">
          <label class="col-form-label"><strong>Pregunta de recuperación de cuenta (*)</strong></label>
          <div>
            <label>¿Nombre de su comida favorita?</label>
            <select class="form-control col-sm-4" name="respuesta1" style="max-width: 98%;">
            @foreach($options1 as $key => $value)
                <option value="{{$key}}"> {{$value}} </option>
            @endforeach
            </select>
          </div>
        </div>
       <div class="form-group">
          <label class="col-form-label"><strong>Pregunta 2 de recuperación de cuenta (*)</strong></label>
          <div>
            <label>¿Nombre de su música favorita?</label>
            <select class="form-control col-sm-4" name="respuesta1" style="max-width: 98%;">
            @foreach($options2 as $key => $value)
                <option value="{{$key}}"> {{$value}} </option>
            @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <!--label for="inputDireccion" class="col-form-label h4">Dirección</label-->
          <div>
            <input type="hidden" class="form-control" id="inputDireccion" name="direccion" placeholder="Dirección">
            <input type="hidden" class="form-control" id="inputDireccion" name="active" value="1">
          </div>
        </div>

          <div class="form-group col-md-6 " style="padding: 0px;">
              <label for="Localidad" class="col-form-label h4">Localidad</label>
              <select class="form-control col-sm-4" name="localidad" id="Localidad" style="max-width: 98%;">
            @foreach($optionsLocal as $key => $value)
                <option value="{{$key}}"> {{$value}} </option>
            @endforeach
              </select>
          </div>

          <div class="form-group col-md-6" style="padding: 0px;">
            <label for="Barrio" class="col-form-label h4">Barrio</label>
            <select class="form-control  col-sm-4" name="barrio" id="Barrio" style="max-width: 98%;">
            @foreach($optionsNeigh as $key => $value)
                <option value="{{$key}}"> {{$value}} </option>
            @endforeach
            </select>
          </div>
        </div-->
        <div class="checkbox text-center">
          <label>
            <input type="checkbox" id="chk-terminos" name="terms_conditions_date"> Acepto los términos y condiciones
          </label>
        </div>

        <div class="form-group  text-center">
          <div>
            <button type="submit" class="col-lg-8 col-md-8 btn">Registrame</button>
          </div>
        </div>

        <div class="form-group text-center">
            <button type="button" class="col-lg-8  offset-lg-2 col-md-8 offset-md-2 mx-auto btn btn-link" id="link-forget" style="max-width: 100%;">
            <a href="/login" id="link-forget">¿Ya tenés usuario? Ingresá</a>
            </button>
        </div>

      </div>
      </form>
    </div><!-- form-group-->
  </div><!-- row-->
</div><!-- container-->

@include('Components.footer')

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  </body>
</html>


