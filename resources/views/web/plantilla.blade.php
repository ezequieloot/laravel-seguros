<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>@yield('titulo') - {{ env('APP_NAME') }}</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/css/estilos.css')}}" rel="stylesheet">
 

  <!-- Template Main CSS File -->
  <link href="{{ asset('/web/assets/css/style.css') }}" rel="stylesheet">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <link href="{{ asset('css/normalize.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('js/sb-admin.min.js') }}"></script>
  <script src="{{ asset('js/jquery.validate.js') }}"></script>
  <script src="{{ asset('js/localization/messages_es.js') }}"></script>
  <script src="{{ asset('js/funciones_generales.js') }}"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}"></script>
  @yield('scripts')
</head>
<body>
  
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>Broker</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="/">Inicio</a></li>
          <li><a class="nav-link scrollto" href="/nosotros">Nosotros</a></li>
          <li><a class="nav-link scrollto" href="/servicios">Servicios</a></li>
          <li><a class="nav-link scrollto" href="/contacto">Contacto</a></li>
          <li>
            @if(Session::get('usuario_id') && Session::get('usuario_id') > 0)
              <a class="getstarted scrollto" href="/mis-productos">
                Mis seguros
                </a>
              @else
              <a class="getstarted scrollto" href="/login">
                Mis seguros</a>
            </li>
            @endif
            @if(Session::get('usuario_id') && Session::get('usuario_id') > 0)
            <li>
              <a class="nav-link scrollto" href="/logout">
                Cerrar sesión</a>
            </li>
            @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">
  @yield('contenido');
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="/" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span>Broker</span>
            </a>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter" style="font-size: 30px;"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook" style="font-size: 30px;"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram" style="font-size: 30px;"><i class="bi bi-instagram bx bxl-instagram"></i></a>
              <a href="#" class="linkedin" style="font-size: 30px;"><i class="bi bi-linkedin bx bxl-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Visitá</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Inicio</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Notros</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Servicios</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Nuestros Servicios</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Seguro automotor</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Integral de consorcio/hogar </a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">ART</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Seguros de Vida</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Seguros de caución</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Seguros profesionales por mala praxis</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Seguros de salud</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contacto</h4>
            <p>
              Calle tucumán 840 <br>
              Buenos Aires, BA<br>
              Argentina <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Broker</span></strong>. Todos Los Derechos Reservados
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>


  <!-- Template Main JS File -->
  <script src=" {{asset('assets/js/main.js')}}"></script>

</body>
</html>