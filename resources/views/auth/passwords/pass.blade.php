<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')

<body>
  <div class="container-fluid">
    @include('Components.header')
    <div class="contenido container">
      <!-- INICIO FORM -->
      <form method="post" action="/cambiarPass" class="bg-traslucido bg-margenes">
        @csrf
        <input type="hidden" name="email" value="{{ $usuario->email }}">
        <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
          <p class="h1">Cambiar Contraseña</p>

            @if (count($errors))

                <div class="alert alert-danger">
                  @foreach( $errors->all() as $error)
                        <p>  {{$error}}</p>
                  @endforeach
                </div>
            @endif
          <label for="password" class="col-form-label h4">Ingrese nueva contraseña</label>
          <div>
            <input type="password" class="form-control" name="password" id="password" placeholder="password" required >
          </div>
          <label for="password" class="col-form-label h4">Confirme nueva contraseña</label>
          <div>
            <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="password" required >
          </div>

      <div class="form-group  text-center">
        <div>
          <button type="submit" class="col-lg-8 col-md-8 btn">Continuar</button>
        </div>
      </div>

      </form>
    </div><!-- form-group-->
  </div><!-- row-->
</div><!-- container-->
<!--Footer-->
@include('Components.footer')
</body>
