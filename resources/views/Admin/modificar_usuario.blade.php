

<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('/Components/Admin/head')
  <body>
    <div class="container-fluid contenido">
    @include('/Components/header')

    <main>

      <header>

        <div>

          <h1>Administración de usuarios</h1>
          
        </div>
         <div class="container-fluid  todo">
     <div class="mt-5 container" >
       <ul>
           <li class="modificar">
             <form action="/Admin/modificar_usuario/{id}" method="post">
             @csrf

               <input type="hidden" name="id" value="{{$user->id}}">
               <input type="hidden" name="accion" value="modificar">
               <div class="form-group">
                   <label for="inputNombre" class="col-form-label h4">Nombre</label>
                 <div>
                   <input type="texto" name="first_name" id="inputNombre" value="{{$user->first_name}}" readonly >                </div>
               </div>
               <div class="form-group">
                   <label for="inputApellido" class="col-form-label h4">Apellido</label>
                 <div>
                   <input type="texto" id="inputApellido" name="last_name" value="{{$user->last_name}}" readonly >
                 </div>
               </div>
               <div class="form-group">
                   <label for="inputMail" class="col-form-label h4">Mail</label>
                 <div>
                   <input type="texto" id="inputMail" name="email" value="{{$user->email}}" readonly >
                 </div>
               </div>
               <div class="form-group">
                <label for="inputActivo" class="col-form-label h4">Activo</label>
                 <div>
                   <input type="checkbox" name="active" value="1" 
                   @if($user->active) 
                    checked 
                   @endif 
                   >
                 </div>
               </div>
               <div class="form-group">
                <label for="inputAdmin" class="col-form-label h4">Admin</label>
                 <div>
                   <input type="checkbox" name="admin" value="1" 
                   @if($user->admin) 
                    checked 
                   @endif 
                   
                   >
                 </div>
               </div>
               <input type="submit" name="updateo" value="Modificar" class="btn btn-success moficar_item">
             </form>
           </li>
              <a href="/Admin/listar_usuarios" class="btn btn-success">Volver a la lista</a>
       </ul>
     </div>

      </header>
    </main>

    @include('/Components/footer')
    </div>
  </body>
</html>
