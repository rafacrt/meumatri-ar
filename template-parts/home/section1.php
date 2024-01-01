<?php $claim1 = get_template_directory_uri().'/assets/images/claim1.png'; ?>
<?php $claim2 = get_template_directory_uri().'/assets/images/claim2.png'; ?>
<?php $next = get_template_directory_uri().'/assets/images/next.png'; ?>
<?php $prev = get_template_directory_uri().'/assets/images/prev.png'; ?>
<section>
    <style>
        .swiper.mySwiper{padding: 30px 0 !important;}
        .swiper-slide img {
            margin: 24px 0;
        }
    </style>
    <div class="container" id="sectionDoisSlider">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <div class="row align-items-baseline justify-content-center px-3">
            <div class="col-md-4 col-12 ">
                <h2 class="titulo_section d-block d-sm-none mt-3">A melhor <br> experiência para <br> conectar noivos <br> e convidados</h2>
                <h2 class="titulo_section d-none d-sm-block">A melhor <br> experiência para <br> conectar noivos <br> e convidados</h2>
            </div>
            <div class="col-md-6 col-12">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide py-3">
                            <div class="">
                                <img src="<?php echo $claim1; ?>" alt="MeuMatri Icons" width="48px" height="48px">
                                <h4 class="titulo_section_slider w-lg-100 w-75">
                                    Layouts sofisticados, modernos e customizáveis
                                </h4>
                                <p class="titulo_section_description">
                                    Tenha um site de casamento elegante e prático
                                    para seus
                                    convidados
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide py-3">
                            <div class="">
                            <img src="<?php echo $claim2; ?>" alt="MeuMatri Icons" width="48px" height="48px">
                            <h4 class="titulo_section_slider w-lg-100 w-75">
                                Todas as informações centralizadas em um só lugar
                            </h4>
                            <p class="titulo_section_description">
                                Adicione dicas de hotéis, salões de beleza,
                                restaurantes e
                                ofereça a melhor experiência aos seus convidados
                            </p>
                            </div>
                        </div>
                        <div class="swiper-slide py-3">
                            <img src="<?php echo $claim1; ?>" alt="MeuMatri Icons" width="48px" height="48px">
                            <h4 class="titulo_section_slider w-lg-100 w-75">
                                Monte o site do seu casamento sem custos
                            </h4>
                            <p class="titulo_section_description">
                                No Meu Matri não existe sequer uma cobrança de
                                plano. Seu site de casamento é 100% gratuito
                            </p>
                        </div>
                        <div class="swiper-slide py-3">
                            <img src="<?php echo $claim2; ?>" alt="MeuMatri Icons" width="48px" height="48px">
                            <h4 class="titulo_section_slider w-lg-100 w-75">
                                Viva um momento especial como vocês merecem
                            </h4>
                            <p class="titulo_section_description">
                                Tecnologia, praticidade e elegância para lhes
                                oferecer a
                                melhor experiência
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 setaSlider">
                        <a class="swiper-button-prev" data-slide="prev"></a>
                        <a class="swiper-button-next" data-slide="next"></a>
                    </div>
                </div>
            </div>
        </div>
</section>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 20,
      centeredSlides: false,
      autoplay: {
        delay: 5500,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        380: {
          slidesPerView: 1,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        },
    });
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>