@extends("web.plantilla")
@section('contenido')
<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Somos un broker decicado al mundo de los seguros dispuestos a dar los mejores servicios</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Somos un equipo experto en el sector de los seguros</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="nosotros" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>CONOCENOS</span>
                <i class="bi bi-arrow-right"></i>
              </a>
              <a href="/admin" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>DASHBOARD ADMIN</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/broker.svg" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

    <!-- ======= Counts Section ======= -->
    <!--
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-headset" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hours Of Support</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-people" style="color: #bb0852;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hard Workers</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> End Counts Section -->

    <!-- ======= Features Section ======= -->
    <!-- End Features Section -->

   

    <!-- ======= F.A.Q Section ======= -->
    
    <section id="faq" class="faq">

      <div class="container py-3" data-aos="fade-up">

        <header class="section-header">
          <h2>F.A.Q</h2>
          <p>Preguntas frecuentes</p>
        </header>

        <div class="row">
          <div class="col-lg-6">
            <!-- F.A.Q List 1-->
            <div class="accordion accordion-flush" id="faqlist1">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    ¿Qué es un broker de seguros?
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Un broker de seguros es una empresa que actúa como intermediario de varias compañías aseguradoras, sin estar vinculado en exclusiva a ninguna de ellas, comercializando contratos de seguro a sus clientes.                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?
                  </button>
                </h2>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    ¿Qué es una póliza de seguro?
                  </button>
                </h2>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    La póliza de seguro es un contrato entre un Asegurado y una compañía de seguros, donde establece los derechos y obligaciones de ambas partes, en relación al seguro contratado.
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-6">

            <!-- F.A.Q List 2-->
            <div class="accordion accordion-flush" id="faqlist2">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
                    Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                  </button>
                </h2>
                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
                    Tempus quam pellentesque nec nam aliquam sem et tortor consequat?
                  </button>
                </h2>
                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3">
                    Varius vel pharetra vel turpis nunc eget lorem dolor?
                  </button>
                </h2>
                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section>
  <!-- End F.A.Q Section -->

    <!-- ======= Portfolio Section ======= -->
    <!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    <!-- End Testimonials Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">

      <div class="container py-3" data-aos="fade-up">

        <header class="section-header">
          <h2>Colaboradores</h2>
          <p>Estas son algunas de las empresas con las que trabajamos</p>
        </header>

        <div class="clients-slider swiper-container">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/asociart.png" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/bbva.png" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/experta.png" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/libra.jpg" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/mapfre.png" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/sura.png" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/allianz.png" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/sancor.svg" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/sura.png" style="width: 150px;" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/Zurich.png" style="width: 150px;" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

    </section><!-- End Clients Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    <!-- End Recent Blog Posts Section -->
@endsection
