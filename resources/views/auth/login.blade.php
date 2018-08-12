<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')
<body>

<div class="container-fluid">
@include('Components.header')

<div class="contenido container">

   <!-- INICIO FORM -->
 <form method="POST" action="{{ route('login') }}" class="bg-traslucido bg-margenes" aria-label="{{ __('Login') }}">
    @csrf

        <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
          <p class="h1">Ingresar</p>
            @if (count($errors))

                <div class="alert alert-danger">
                  @foreach( $errors->all() as $error)
                        <p>  {{$error}}</p>
                  @endforeach
                </div>
            @endif
          <label for="exampleInputEmail1" class="col-form-label h4">Email</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="ejemplo@mail.com"
                required value="{{old('email')}}">
        </div>
        <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
          <label for="exampleInputPassword1" class="col-form-label h4">Contraseña</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" required>
        </div>
        <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
          <div class="form-check form-check-inline ">
            <input type="checkbox" name="recordarme"
                   class="form-check-input" id="recordar_usuario"
                   <?php  echo isset($_POST['recordarme']) ? 'checked': ''; ?> >
            <label class="form-check-label" for="recordar_usuario">Recordarme</label>
          </div>
        </div>
        <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
            <button type="submit" class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 btn">Enviar</button>
        </div>
        <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
            <button type="button" class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 btn btn-link" id="link-forget"><a href="/olvidoContrasena" id="link-forget">Olvidé mi contraseña</a></button>
        </div>
        <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
            <button type="button" class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 btn btn-link" id="link-forget"><a href="/registro" id="link-forget">Si no tenés usuario: ¡Registrate!</a></button>
        </div>
      </form>
      <!--  FIN FORM -->
</div>

@include('Components.footer')


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

</body>
</html>


