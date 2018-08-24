

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
             <ul id="lista_us">
               @foreach($users as $user)
                 <li class="modificar">
                    <p class="mr-5 mt-2 mb-3">{{$user->first_name}}</p>
                    <form action="/Admin/modificar_usuario/{{$user->id}}" method="get" >
                      @csrf
                       <input type="hidden" name="usuario" value="{{$user->id}}">
                       <input type="submit" name="" value="Modificar usuario {{$user->first_name}}" class="btn moficar_item">
                     </form>
                 </li>
               @endforeach
             </ul>
           </div>
          <button id="boton" class="btn btn-success mb-5 float-rigth">Traer más</button>

       </div>
    </header>
  </main>

@include('/Components/footer')
</div>

<script>
    $(document).ready(function(){
      $('#boton').click(function(){
        $.ajax({url: "http://127.0.0.1:8000/api/users",
        success: function(result){
          console.log(result);

          var usuarios = result.filter(function(usuario){
            return usuario.id > 5;
          });

          usuarios.forEach(function(user, index){

            var liNode = document.createElement('LI');
            var pNode = document.createElement('P');
            pNode.innerHTML = user.first_name;
            var formNode = document.createElement('FORM');
            var input1Node = document.createElement('INPUT');
            var input2Node = document.createElement('INPUT');

            input1Node.setAttribute('value', user.id);
            input1Node.setAttribute('type', 'hidden');
            input2Node.setAttribute('value', 'Modificar usuario '+ user.first_name);
            input2Node.setAttribute('type', 'submit');

            var li = document.getElementById('lista_us').appendChild(liNode);
            li.appendChild(pNode);

            var form = li.appendChild(formNode);
            form.appendChild(input1Node);
            form.appendChild(input2Node);

            li.style.listStyle = 'none';
            li.style.display = 'flex';
            li.style.marginBottom = '10px';
            input2Node.classList.add('btn', 'moficar_item');
            pNode.classList.add('mr-5', 'mt-2', 'mb-3');
            form.setAttribute('action', '/Admin/modificar_usuario/'+user.id);
            form.setAttribute('method', 'post');
          });
        },
        error: function(error){
          console.log(error);
        }});
      });

    });

    </script>
  </body>
</html>
