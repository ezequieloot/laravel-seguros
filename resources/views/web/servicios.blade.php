@extends("web.plantilla")
@section('contenido')
<main>

  <section id="services" class="services">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h1 style="color: #012970;">Servicios</h1>
      </header>

      <div class="row gy-4">
    @for($i = 0; $i < count($array_seguros); $i++) 
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="service-box blue">
        
              <i class="{{$array_seguros[$i]->icono}} icon"></i>
              <h2>{{$array_seguros[$i]->nombre}}</h2>
              <p>{{$array_seguros[$i]->descripcion}}</p>
             <!-- <a href="/seguro/{{$array_seguros[$i]->idseguro}}" class="read-more"><span>Leer mas</span> <i class="bi bi-arrow-right"></i></a>
        -->
          </div>
        </div>
    @endfor
      </div>
    </div>

  </section><!-- End Services Section -->

  <!-- ======= Pricing Section ======= -->
   <!--  <section id="pricing" class="pricing">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h2>Descuentos</h2>
        <p>Solicita cotización y ve los decuentos según tu auto</p>
      </header>

      <div class="row gy-4" data-aos="fade-left">

        <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
          <div class="box">
            <h3 style="color: #07d5c0;">Plan Gratuito</h3>
            <div class="price"><sup></sup>10<span> / %</span></div>
            <img src="assets/img/pricing-free.png" class="img-fluid" alt="">
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li class="na">Pharetra massa</li>
              <li class="na">Massa ultricies mi</li>
            </ul>
            <a href="/contacto" class="btn-buy">Comprar Ahora</a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="box">
            <span class="featured">Presentado</span>
            <h3 style="color: #65c600;">Plan Inicial</h3>
            <div class="price"><sup></sup>20<span> / %</span></div>
            <img src="assets/img/pricing-starter.png" class="img-fluid" alt="">
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li>Pharetra massa</li>
              <li class="na">Massa ultricies mi</li>
            </ul>
            <a href="/contacto" class="btn-buy">Comprar Ahora</a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
          <div class="box">
            <h3 style="color: #ff901c;">Plan de negocios</h3>
            <div class="price"><sup></sup>35<span> / %</span></div>
            <img src="assets/img/pricing-business.png" class="img-fluid" alt="">
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li>Pharetra massa</li>
              <li>Massa ultricies mi</li>
            </ul>
            <a href="/contacto" class="btn-buy">Comprar Ahora</a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
          <div class="box">
            <h3 style="color: #ff0071;">Plan Definitivo</h3>
            <div class="price"><sup></sup>48<span> / %</span></div>
            <img src="assets/img/pricing-ultimate.png" class="img-fluid" alt="">
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li>Pharetra massa</li>
              <li>Massa ultricies mi</li>
            </ul>
            <a href="/contacto" class="btn-buy">Comprar Ahora</a>
          </div>
        </div>

      </div>

    </div>

  </section> End Pricing Section -->
 
</main><!-- End #main -->

@endsection