@extends('web.plantilla')
@section('contenido')
    <section id="contact" class="contact m-t">

        <div class="container" data-aos="fade-up">
  
          <header class="section-header">
            <h2>Contacto</h2>
            <p>Contáctanos</p>
          </header>
  
          <div class="row gy-4">
  
            <div class="col-lg-6">
  
              <div class="row gy-4">
                <div class="col-md-6">
                  <div class="info-box">
                    <i class="bi bi-geo-alt"></i>
                    <h3>Domicílio</h3>
                    <p>Calle Tucuman 840<br>Buenos Aires ,Argentina</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box">
                    <i class="bi bi-telephone"></i>
                    <h3>Teléfono</h3>
                    <p>+1 5589 55488 55</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box">
                    <i class="bi bi-envelope"></i>
                    <h3>Email</h3>
                    <p>info@example.com<br>contact@example.com</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box">
                    <i class="bi bi-clock"></i>
                    <h3>Atención</h3>
                    <p>Lunes - Viernes <br>9:00AM - 05:00PM</p>
                  </div>
                </div>
              </div>
  
            </div>
  
            <div class="col-lg-6">
              <form action="" method="POST" class="php-email-form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <div class="row gy-4">
  
                  <div class="col-md-6">
                    <input type="text" name="txtNombre" class="form-control" placeholder="Nombre" required>
                  </div>
  
                  <div class="col-md-6 ">
                    <input type="email" class="form-control" name="txtCorreo" placeholder="Correo" required>
                  </div>
  
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="txtAsunto" placeholder="Asunto" required>
                  </div>
  
                  <div class="col-md-12">
                    <textarea class="form-control" name="txtMensaje" rows="6" placeholder="Mensaje" required></textarea>
                  </div>
  
                  <div class="col-md-12 text-center">
                    <div class="loading">Carga de mensaje</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Tu mensaje ha sido recibído.Gracias!</div>
  
                    <button type="submit">Enviar Mensaje</button>
                  </div>
  
                </div>
              </form>
  
            </div>
  
          </div>
  
        </div>
  
      </section><!-- End Contact Section -->

@endsection 