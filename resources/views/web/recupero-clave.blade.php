@extends('web.plantilla')
@section('contenido')
<section id="recupero" class="contact m-t">

  <div class="container" data-aos="fade-up">

    <header class="section-header">
      <p>Recuperar mi contraseña</p>
    </header>

    <div class="row gy-4">
      <div class=" col-12 col-sm-6 offset-sm-3">
      <form action="" method="POST" class="form">
        <div class="row gy-4">
          <div class="col-12 form-group">
            <label for="txtUsuario" class="form-label">Usuario</label>
            <input type="text" name="txtUsuario" id="txtUsuario" class="form-control">
          </div>
          <div class="col-12 form-group">
          <label for="txtDocumento" class="form-label">Documento</label>
            <input type="text" name="txtDocumento" id="txtDocumento" class="form-control">
          </div>
          <div class="col-12 form-group">
          <label for="txtDocumento" class="form-label">Correo</label>
            <input type="text" name="txtCorreo" id="txtCorreo" class="form-control">
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-login-web">Enviar</button>
          </div>
        </div>
      </form>
      </div>
    </div>

  </div>

</section><!-- End Contact Section -->
@endsection