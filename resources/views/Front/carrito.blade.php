<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Carrito cambiar</title>
  </head>
  <body>
    <h1>Carrito cambiar</h1>
    @forelse ($carrito as $product)
      {{ $product }}
    @empty
      <p>No hay nada en el carrito</p>
    @endforelse
  </body>
</html>
