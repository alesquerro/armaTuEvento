

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
             <form action="/Admin/listar_usuarios" method="post">
             @csrf
               <input type="hidden" name="usuario" value="{{$user->id}}">
               <input type="hidden" name="accion" value="modificar">
               <div class="form-group">
                   <label for="inputNombre" class="col-form-label h4">Nombre</label>
                 <div>
                   <input type="texto" name="nombre" id="inputNombre" value="{{$user->first_name}}" readonly >                </div>
               </div>
               <div class="form-group">
                   <label for="inputApellido" class="col-form-label h4">Apellido</label>
                 <div>
                   <input type="texto" id="inputApellido" name="apellido" value="{{$user->last_name}}" readonly >
                 </div>
               </div>
               <div class="form-group">
                   <label for="inputMail" class="col-form-label h4">Mail</label>
                 <div>
                   <input type="texto" id="inputMail" name="mail" value="{{$user->email}}" readonly >
                 </div>
               </div>
               <div class="form-group">
                <label for="inputActivo" class="col-form-label h4">Activo</label>
                 <div>
                   <input type="checkbox" name="activo" value="1" checked>
                 </div>
               </div>
               <div class="form-group">
                <label for="inputAdmin" class="col-form-label h4">Admin</label>
                 <div>
                   <input type="checkbox" name="admin" value="1" >
                 </div>
               </div>
               <input type="submit" name="" value="Modificar" class="btn btn-success moficar_item">
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
