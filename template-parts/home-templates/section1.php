<?php $templateFloral = get_template_directory_uri().'/assets/images/templates/floral.gif'; ?>
<?php $templateClassico = get_template_directory_uri().'/assets/images/templates/classico.gif'; ?>
<?php $templateLinho = get_template_directory_uri().'/assets/images/templates/linho.gif'; ?>
<?php $templateJardim = get_template_directory_uri().'/assets/images/templates/jardim.gif'; ?>
<?php $templateModernLight = get_template_directory_uri().'/assets/images/templates/modernoLight.gif'; ?>
<?php $templateClassicoDark = get_template_directory_uri().'/assets/images/templates/classicoDark.gif'; ?>
<?php $templateNatureza = get_template_directory_uri().'/assets/images/templates/natureza.gif'; ?>
<?php $templateTonsPasteis = get_template_directory_uri().'/assets/images/templates/tonsPasteis.gif'; ?>

<?php $next = get_template_directory_uri().'/assets/images/next.png'; ?>
<?php $prev = get_template_directory_uri().'/assets/images/prev.png'; ?>
<section>
  <style>
    .mySwiperTemplates .swiper-slide img{
      border-radius: 24px;
    }
    .templateSelectButton {
      position: relative;
      bottom: 70px;
      padding: 16px;
      border-radius: 100px;
      background: #fff;
      color: #000;
      font-size: 18px;
      font-weight: 700;
    }
    .templateSelectButton:hover {text-decoration: none;color: #000;}
  </style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <div class="container" id="templatesSectionDois">
        <div class="row">
            <div class="col-md-4" id="layouts-1">
                <h2 class="titulo_section_mobile_1 d-block d-sm-none mb-5">Layouts <br> modernos e customizáveis</h2>
                <p class="d-block d-sm-none titulo_section_description_mobile mt-5">Escolha um dos nossos templates, monte sua lista de presentes e edite o conteúdo do site do seu casamento para compartilhar com seus convidados.</p>
                <h2 class="titulo_section_mobile d-none d-sm-block">Layouts <br> modernos e customizáveis</h2>
                <p class="d-none d-sm-block titulo_section_description mt-5">Escolha um dos nossos templates, monte sua lista de presentes e edite o conteúdo do site do seu casamento para compartilhar com seus convidados.</p>
            </div>
            <div class="col-md-7 mb-5">
                <div class="swiper mySwiperTemplates">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide py-3 text-center">
                          <img 
                          src="<?php echo $templateFloral ?>" 
                          alt="Template Floral - Meu Matri"
                          class="img-fluid"
                          />
                          <a href="#" class="templateSelectButton">Selecionar Template</a>                  
                        </div>
                        <div class="swiper-slide py-3 text-center">
                            <img 
                            src="<?php echo $templateClassico ?>" 
                            alt="Template Clássico - Meu Matri"
                            class="img-fluid"
                            />
                            <a href="https://meumatri.com/templates/classico/" class="templateSelectButton">Selecionar Template</a>                  
                        </div>
                        <div class="swiper-slide py-3 text-center">
                            <img 
                            src="<?php echo $templateLinho ?>" 
                            alt="Template Linho - Meu Matri"
                            class="img-fluid"
                            />
                            <a href="#" class="templateSelectButton">Selecionar Template</a>                  
                        </div>
                        <div class="swiper-slide py-3 text-center">
                            <img 
                            src="<?php echo $templateJardim ?>" 
                            alt="Template Jardim - Meu Matri"
                            class="img-fluid"
                            />
                            <a href="https://meumatri.com/templates/jardim/" class="templateSelectButton">Selecionar Template</a>
                        </div>
                        <div class="swiper-slide py-3 text-center">
                            <img 
                            src="<?php echo $templateModernLight ?>" 
                            alt="Template Moderno Light - Meu Matri"
                            class="img-fluid"
                            />
                            <a href="#" class="templateSelectButton">Selecionar Template</a>
                        </div>
                        <div class="swiper-slide py-3 text-center">
                            <img 
                            src="<?php echo $templateClassicoDark ?>" 
                            alt="Template Moderno Light - Meu Matri"
                            class="img-fluid"
                            />
                            <a href="#" class="templateSelectButton">Selecionar Template</a>
                        </div>
                        <div class="swiper-slide py-3 text-center">
                            <img 
                            src="<?php echo $templateNatureza ?>" 
                            alt="Template Natureza - Meu Matri"
                            class="img-fluid"
                            />
                            <a href="https://meumatri.com/templates/natureza/" class="templateSelectButton">Selecionar Template</a>
                        </div>
                        <div class="swiper-slide py-3 text-center">
                            <img 
                            src="<?php echo $templateTonsPasteis ?>" 
                            alt="Template Tons Pasteis - Meu Matri"
                            class="img-fluid"
                            />
                            <a href="https://meumatri.com/templates/moderno/" class="templateSelectButton">Selecionar Template</a>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 setaSlider mt-5">
                        <a class="swiper-button-prev" data-slide="prev"></a>
                        <a class="swiper-button-next" data-slide="next"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiperTemplates", {
      slidesPerView: 1,
      spaceBetween: 20,
      centeredSlides: false,
      autoplay: {
        delay: 6000,
        disableOnInteraction: true,
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
            </div>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>