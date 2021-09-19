@extends('web.plantilla')
@section('contenido')
    <section id="login" class="login m-t">

  <div class="container" data-aos="fade-up">

    <header class="section-header">
      <h2>Ver mis seguros</h2>
      <p>Ingresá</p>
    </header>

    <div class="row gy-4">
      <div class=" col-12 col-sm-6 offset-sm-3">
      <form action="" method="POST" class="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <?php
          if (isset($msg)) {
              echo '<div id = "msg"></div>';
              echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
          }
          ?>
        <div class="row gy-4">
          <div class="col-12 form-group">
            <label for="txtUsuario" class="form-label">Usuario</label>
            <input type="text" name="txtUsuario" id="txtUsuario" class="form-control">
          </div>
          <div class="col-12 form-group">
          <label for="txtClave" class="form-label">Contraseña</label>
            <input type="password" name="txtClave" id="txtClave" class="form-control">
          </div>
          <div class="col-12 text-center">
            <a href="/recupero">Olvidé mi contraseña</a>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-login-web">Enviar</button>
          </div>
        </div>
                    
      </section><!-- End Contact Section -->

@endsection