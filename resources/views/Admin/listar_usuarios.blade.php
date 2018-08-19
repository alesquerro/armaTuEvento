

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
          <div class="container-fluid  todo text-center">
           <div class="mt-5 mb-3 container" >
             <ul>
               @foreach($users as $user)
               
                 <li class="modificar">
                 <p class="mr-5 mt-2 mb-3">{{$user->first_name}}</p>
                   <form action="/Admin/modificar_usuario/{{$user->id}}" method="post"> 
                     <input type="hidden" name="usuario" value="{{$user->id}}">
                     <input type="submit" name="" value="Modificar usuario {{$user->first_name}}" class="btn moficar_item">
                   </form>
                 </li>
               @endforeach   
             </ul>
           </div>
          <button type="" class="btn btn-success mb-5 float-rigth">Traer más</button>

           </div>

      </header>
    </main>

    @include('/Components/footer')
    </div>
  </body>
</html>
