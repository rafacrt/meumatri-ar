<?php $logo = 'https://meumatri.com/wp-content/uploads/2023/09/logo.png'; ?>
<?php $hero_banner_template = get_template_directory_uri() . '/assets/images/hero-banner-template.png'; ?>
<?php $base_url = get_home_url(); ?>
<!-- Menu transparente -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<style>
    @media (max-width: 768px) {
        .navbar {
            display: none;
        }
    }

    @media (min-width: 769px) {
        #mobile-menu-button,
        #logo,
        #mobile-menu {
            display: none !important;
        }
    }

    #mobile-menu {
        display: none;
        background-color: #112320;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 999;
        padding: 20px;
    }

    #mobile-menu ul {
        margin-top: 20px;
    }

    #mobile-menu a {
        display: block;
        padding: 10px 0;
        color: white;
        text-decoration: none;

    }

    #mobile-menu a:hover {
        background-color: #1f2a34;
    }

    #mobile-menu-button {
        display: block;
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
        color: white;
    }

    #close-button {
        position: absolute;
        top: 20px;
        left: 20px;
        cursor: pointer;
        color: white;
        border: 1px solid white;
        padding: 5px;
        border-radius: 7px;
    }

    #logo {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        cursor: pointer;
        color: white;
    }

    /* Estilos para o menu do WordPress no menu mobile */
    #wp-mobile-menu {
        padding: 0;
    }

    .border-menu {
        border-top: 1px solid white;
        border-bottom: 1px solid white;
        margin-top: 70px;
    }

    .border-menu-2 {
        border-bottom: 1px solid white;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light transparent-menu">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $base_url ?>"><img src="<?php echo $logo; ?>" alt="MeuMatri Logo"></a>
        <div class="collapse navbar-collapse menu-principal-home" id="navbarNav">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-principal-home',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="%1$s" class="navbar-nav ml-auto %2$s">%3$s</ul>',
                    'depth' => 2,
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                )
            );
            ?>
        </div>
        <?php if (is_user_logged_in()) : ?>
            <div class="collapse navbar-collapse menu-btn-home" id="navbarNav">
                <ul id="menu-menu-botoes-home" class="navbar-nav ml-auto ">
                    <li id="menu-item-2052"
                        class="nav-button-home menu-item nav-item nav-item-2052">
                        <a href="/painel" class="nav-link ">
                            <span class="btn-home-black"><i class="fa fa-gifts"></i> Painel</span>
                        </a>
                    </li>

                </ul>
            </div>
        <?php else: ?>
            <div class="collapse navbar-collapse menu-btn-home" id="navbarNav">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-btn-home',
                        'container' => false,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav ml-auto %2$s">%3$s</ul>',
                        'depth' => 2,
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    )
                );
                ?>
            </div>
        <?php endif; ?>
    </div>
</nav>


<?php if (is_home()): ?>
    <!-- Banner herói -->
    <header class="hero-banner">
        <!-- Overlay preto com transparência -->
        <div class="overlay"></div>
        <div class="container d-lg-none d-md-block">
            <div class="row">
                <div class="col-md-6" style="margin-top:300px;">
                    <h1 class="text-hero">Crie seu site <br> de casamento <br> grátis em poucos <br> cliques</h1>
                    <a href="templates"
                       class="btn btn-primary nav-button-home pt-2 btn-home-black"><strong>comece agora</strong></a>
                </div>
            </div>
        </div>
        <div class="container d-none d-sm-block">
            <div class="row">
                <div class="col-md-6 align-text-hero">
                    <h1 class="text-hero">Crie seu site <br> de casamento <br> grátis em poucos <br> cliques</h1>
                    <a href="templates"
                       class="btn btn-primary nav-button-home pt-2 btn-home-black"><strong>comece agora</strong></a>
                </div>
            </div>
        </div>
    </header>
<?php else: ?>
    <!-- Banner herói -->
    <header class="hero-banner-template">
        <!-- Overlay preto com transparência -->
        <div class="overlay-template"></div>
        <div class="container d-lg-none d-md-block">
            <div class="row">
                <div class="col-12 align-text-hero-template-mobile" style="margin-top:100px;">
                    <h1 class="text-hero-template-mobile ">Escolha um template e comece <br> a criar o seu site de
                        casamento
                    </h1>
                </div>
                <div class="col-12 align-text-hero-template-mobile">
                    <a href="/templates"
                       class="btn btn-primary nav-button-home-template pt-2 btn-home-black mt-2"><strong>Escolher
                            Template</strong></a>
                </div>
                <div class="col-12 align-text-hero-template-img-mobile">
                    <img width="" class="mt-5 img-fluid" src="<?php echo $hero_banner_template; ?>" alt="Banner Meu Matri">
                </div>
            </div>
        </div>
        <div class="container d-none d-sm-block">
            <div class="row">
                <div class="col-md-6 align-text-hero-template" style="margin-top:250px;">
                    <h1 class="text-hero-template">Escolha um template e comece <br> a criar o seu site de casamento
                    </h1>
                    <a href="/templates"
                       class="btn btn-primary nav-button-home-template pt-2 btn-home-black"><strong>Escolher
                            Template</strong></a>
                </div>
                <div class="col-md-6 align-text-hero-template-img" style="margin-top:100px;">
                    <img class="mt-5" src="<?php echo $hero_banner_template; ?>" alt="Banner Meu Matri">
                </div>
            </div>
        </div>
    </header>
<?php endif ?>
<div id="mobile-menu-button">
    <i class="fas fa-bars"></i>
</div>

<div id="logo">
    <a href="<?php echo $base_url ?>">
        <img 
        src="<?php echo $logo; ?>" 
        alt="Logo" 
        width="140"
        >
    </a>
</div>

<div id="mobile-menu">
    <div id="close-button">
        <i class="fas fa-times"></i>
    </div>
    <div class="border-menu">
        <ul id="wp-mobile-menu">
            <li class="menu-login"><a href="/templates"><span style="color:#A1C337;">Criar site grátis</span></a></li>
            <li class="menu-login"><a href="/login">Entrar</a></li>
        </ul>
    </div>
    <div class="border-menu-2">
        <ul id="wp-mobile-menu">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-principal-home',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '%3$s',
                    'depth' => 2,
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                )
            );
            ?>
    </div>
    </ul>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Abrir o menu mobile
    $("#mobile-menu-button").click(function () {
        $("#mobile-menu").show();
        $("#logo").hide();
    });

    // Fechar o menu mobile
    $("#close-button").click(function () {
        $("#mobile-menu").hide();
        $("#logo").show();
    });
</script>