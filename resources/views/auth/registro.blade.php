<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('Components.head')

<script type="text/javascript">
    
  function validarFormulario(evento){
    //alert('entro');

    var txtNombre = document.getElementById('first_name').value;
    var txtApellido = document.getElementById('last_name').value;
    var txtEmail = document.getElementById('email').value;
    var txtPass = document.getElementById('password').value;
    var txtPassConfirm = document.getElementById('password_confirm').value;

    /*
    var ckbSelector1 = document.getElementById('respuesta1');
    var ckb1Index = ckbSelector1.selectedIndex;
    var txtSelector1 =  select.options[ckbSelector1].value;

    var ckbSelector2 = document.getElementById('respuesta2');
    var ckb2Index = ckbSelector2.selectedIndex;
    var txtSelector2 =  select.options[ckbSelector2].value;
    */
    var chkTerminos = document.getElementById('chk-terminos');
  
    //Test campo obligatorio
    if(txtNombre == null || txtNombre.length == 0 || /^\s+$/.test(txtNombre)){
     // alert('El campo nombre no puede estar vacío');
      var pNode = document.createElement('P');
      pNode.innerHTML = 'El campo nombre no puede estar vacío';
      document.getElementById('errores').appendChild(pNode);
      document.getElementById('errores').style.display = 'block';
      evento.preventDefault();
      //return false;
    }
    if(txtApellido == null || txtApellido.length == 0 || /^\s+$/.test(txtApellido)){
      //alert('El campo apellido no puede estar vacío');
      var pNode = document.createElement('P');
      pNode.innerHTML = 'El campo apellido no puede estar vacío';
      document.getElementById('errores').appendChild(pNode);
      document.getElementById('errores').style.display = 'block';     
      evento.preventDefault();
      //return false;
    }  
    //Test Pass
    if (txtPass.length < 6) {
      //alert('La contraseña debe constar de al menos 6 carácteres.');
      var pNode = document.createElement('P');
      pNode.innerHTML = 'La contraseña debe constar de al menos 6 carácteres';
      document.getElementById('errores').appendChild(pNode);   
      document.getElementById('errores').style.display = 'block';        
      evento.preventDefault();
      //return false;
    }
    if (txtPass != txtPassConfirm) {
      //alert("Las contraseñas ingresadas no son iguales");
      var pNode = document.createElement('P');
      pNode.innerHTML = 'Las contraseñas ingresadas no son iguales';
      document.getElementById('errores').appendChild(pNode); 
      document.getElementById('errores').style.display = 'block';
      evento.preventDefault();
      //return false;
    }           
    //Test del mail
    if(!(/\S+@\S+\.\S+/.test(txtEmail))){
      //alert('Debe escribir un email válido');
      var pNode = document.createElement('P');
      pNode.innerHTML = 'Debe escribir un email válido';
      document.getElementById('errores').appendChild(pNode);  
      document.getElementById('errores').style.display = 'block';
      evento.preventDefault();
      //return false;
    }
    //Test del checkBox de los términos
    if(!chkTerminos.checked){
      //alert('Debe aceptar los términos y condiciones');
      var pNode = document.createElement('P');
      pNode.innerHTML = 'Debe aceptar los términos y condiciones';
      document.getElementById('errores').appendChild(pNode); 
      document.getElementById('errores').style.display = 'block';        
      evento.preventDefault();
      //return false;
    }
 
    return true;
  }
 
window.onload = function(){
  document.getElementById('boton-submit').addEventListener('click', validarFormulario);
};


</script>

  <body>
    <div class="container-fluid">
      @include('Components.header')
      <div class="contenido container" id="contenido-principal">
            <div class="alert alert-danger" id="errores" style="display: none;">
            </div>

        <h1>Registro</h1>
        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Registro') }}"  class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" enctype="multipart/form-data">
          @csrf
              <div class="form-group">
                  <label for="first_name" class="col-form-label h4">Nombre (*)</label>
                <div>
                  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nombre"  value="{{old('first_name')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="last_name" class="col-form-label h4" >Apellido (*)</label>
                <div>
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellido"  value="{{old('last_name')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-form-label h4">Email (*)</label>
                <div>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email"  value="{{old('email')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="password">Contraseña (*)</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contraseña" >
              </div>
              <div class="form-group">
                 <label for="password_confirm">Confirmar Contraseña (*)</label>
                 <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Vuelva a ingresar la contraseña" >
              </div>
              <div class="form-group">
                  <input type="file" name="avatar" accept=".jpg, .jpeg, .png, gif" id="avatar_us"/>
              </div>
              <div class="form-group">
                 <label class="col-form-label"><strong>Pregunta de recuperación de cuenta (*)</strong></label>
                 <div>
                   <label>¿Nombre de su comida favorita?</label>
                   <select class="form-control col-sm-4" name="respuesta1" style="max-width: 98%;" id="respuesta1">
                   @foreach($options1 as $option1)
                       <option value="{{$option1->id}}"> {{$option1->name}} </option>
                   @endforeach
                   </select>
                 </div>
               </div>
              <div class="form-group">
                 <label class="col-form-label"><strong>Pregunta 2 de recuperación de cuenta (*)</strong></label>
                 <div>
                   <label>¿Nombre de su música favorita?</label>
                   <select class="form-control col-sm-4" name="respuesta2" style="max-width: 98%;" id="respuesta2">
                   @foreach($options2 as $option2)
                       <option value="{{$option2->id}}"> {{$option2->name}} </option>
                   @endforeach
                   </select>
                 </div>
               </div>


              <div class="checkbox text-center">
                <label>
                  <input type="checkbox" id="chk-terminos" name="terms_conditions_date"> Acepto los términos y condiciones
                </label>
              </div>

              <div class="form-group  text-center">
                <div>
                  <button type="submit" class="col-lg-8 col-md-8 btn" id="boton-submit">Registrame</button>
                </div>
              </div>

              <div class="form-group text-center">
                  <button type="button" class="col-lg-8  offset-lg-2 col-md-8 offset-md-2 mx-auto btn btn-link" id="link-forget" style="max-width: 100%;">
                  <a href="/login" id="link-forget">¿Ya tenés usuario? Ingresá</a>
                  </button>
              </div>

        </form>


      </div>
      @include('Components.footer')
    </div>

  </body>
</html>
