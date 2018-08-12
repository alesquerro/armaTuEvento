
<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('Components.head')
<body>
  <div class="container-fluid contenido">
    <!-- INICIO NAV -->
    @include('Components.header')
    <!-- FIN NAV -->

   <main class="container">
        <h1>Movies</h1>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Género</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->productType }}</td>
                        <td>
                            <a class="btn btn-primary" href="#"><span class="fa fa-edit"></span></a>
                            <a class="btn btn-danger" href="#"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </main>

    <!--Footer-->

    @include('Components.footer')

    <!--/Footer-->
  </div>



</body>
</html>