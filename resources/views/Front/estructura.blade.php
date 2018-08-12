<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('Components.head')
  <body>

    <div class="container-fluid">
      @include('Components.header')

      @yield('contenido');

    </div>
    @include('Components.footer')
  </body>
</html>
