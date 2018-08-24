<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('Components.head')
  <body>
    <div class="container-fluid">
      @include('Components.header')
      <div class="contenido container" id="contenido-principal">
        @if (count($errors))

            <div class="alert alert-danger">
              @foreach( $errors->all() as $error)
                    <p>  {{$error}}</p>
              @endforeach
            </div>
        @endif
        <h1>Editar perfil</h1>
        <form method="POST" action="/perfil"  class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                  <label for="inputNombre" class="col-form-label h4">Nombre (*)</label>
                <div>
                  <input type="text" class="form-control" name="first_name" id="inputNombre" placeholder="Nombre" required value="{{Auth::user()->first_name}}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputApellido" class="col-form-label h4" >Apellido (*)</label>
                <div>
                  <input type="text" class="form-control" name="last_name" id="inputApellido" placeholder="Apellido" required value=" {{Auth::user()->last_name}}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-form-label h4">Email (*)</label>
                <div>
                  <input type="email" class="form-control" name="" id="inputEmail" placeholder="Email" required value="{{Auth::user()->email}}" readonly>
                </div>
              </div>
              {{-- <div class="form-group">
                <label for="contrasena">Contraseña (*)</label>
                <input type="password" class="form-control" id="contrasena" name="password" placeholder="Ingrese contraseña" required>
              </div>
              <div class="form-group">
                 <label for="contrasena-confirm">Confirmar Contraseña (*)</label>
                 <input type="password" class="form-control" id="contrasena-confirm" name="password_confirm" placeholder="Vuelva a ingresar la contraseña" required>
              </div> --}}
              <div class="form-group">
                  <input type="file" name="avatar" accept=".jpg, .jpeg, .png, gif"/>
              </div>
              {{-- <div class="form-group">
                 <label class="col-form-label"><strong>Pregunta de recuperación de cuenta (*)</strong></label>
                 <div>
                   <label>¿Nombre de su comida favorita?</label>
                   <select class="form-control col-sm-4" name="respuesta1" style="max-width: 98%;">
                   @foreach($options1 as $option1)
                       <option value="{{$option1->id}}"> {{$option1->name}} </option>
                   @endforeach
                   </select>
                 </div>
               </div> --}}
              {{-- <div class="form-group">
                 <label class="col-form-label"><strong>Pregunta 2 de recuperación de cuenta (*)</strong></label>
                 <div>
                   <label>¿Nombre de su música favorita?</label>
                   <select class="form-control col-sm-4" name="respuesta2" style="max-width: 98%;">
                   @foreach($options2 as $option2)
                       <option value="{{$option2->id}}"> {{$option2->name}} </option>
                   @endforeach
                   </select>
                 </div>
               </div> --}}


              {{-- <div class="checkbox text-center">
                <label>
                  <input type="checkbox" id="chk-terminos" name="terms_conditions_date"> Acepto los términos y condiciones
                </label>
              </div> --}}

              <div class="form-group  text-center">
                <div>
                  <button type="submit" class="col-lg-8 col-md-8 btn">Modificar</button>
                </div>
              </div>

              <div class="form-group text-center">
                  <button type="button" class="col-lg-8  offset-lg-2 col-md-8 offset-md-2 mx-auto btn btn-link" id="link-forget" style="max-width: 100%;">
                  <a href="/olvidoContrasena" id="link-forget">Modificá contraseña</a>
                  </button>
              </div>

        </form>


      </div>
      @include('Components.footer')
    </div>
  </body>
</html>
