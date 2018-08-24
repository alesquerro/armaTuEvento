<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')

<body>
  <div class="container-fluid">
    @include('Components.header')
    <div class="contenido container">
      @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
      @endif
      <!-- INICIO FORM -->
      <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reseteo de Password') }}" class="bg-traslucido bg-margenes">
        @csrf

        <div class="form-group col-lg-8 offset-lg-2 col-md-8 offset-md-2">
          <p class="h1">Recuperar cuenta</p>
            @if (count($errors))

                <div class="alert alert-danger">
                  @foreach( $errors->all() as $error)
                        <p>  {{$error}}</p>
                  @endforeach
                </div>
            @endif
          <label for="inputEmail3" class="col-form-label h4">Email</label>
          <div>
            <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" required >
          </div>
          <div class="form-group">
            <div>
              <label>¿Nombre de su comida favorita?</label>
              <select class="form-control col-sm-4" name="respuesta1" style="max-width: 98%;">
                   @foreach($options1 as $option1)
                       <option value="{{$option1->id}}"> {{$option1->name}} </option>
                   @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <div>
              <label>¿Nombre de su música favorita?</label>
              <select class="form-control col-sm-4" name="respuesta2" style="max-width: 98%;">
                   @foreach($options2 as $option2)
                       <option value="{{$option2->id}}"> {{$option2->name}} </option>
                   @endforeach
              </select>
            </div>
          </div>
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
