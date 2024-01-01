<?php $logo = 'https://meumatri.com/wp-content/uploads/2023/09/logo.png'; ?>
<?php $hero_banner_template = get_template_directory_uri().'/assets/images/hero-banner-template.png'; ?>
<?php $base_url = home_url(); ?>

<style>

.navbar.single-menu {
  background-color: #1C2A28;
  padding: 24px 10px;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<nav class="navbar navbar-expand-lg navbar-light single-menu">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $base_url; ?>"><img src="<?php echo $logo; ?>" alt="Logo MeuMatri"></a>
        <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
           <i class="fa fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse menu-principal-home" id="navbarNav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-principal-home',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav ml-auto %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
        </div>
        <div class="collapse navbar-collapse menu-btn-home" id="navbarNav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-btn-home',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav ml-auto %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
        </div>
    </div>
</nav>




<script>
jQuery(document).ready(function($) {
    // Função para alternar a ordem dos menus
    function toggleMenus() {
        if (window.innerWidth < 768) {
            // Se a largura da janela for menor que 768 pixels, troque a ordem dos menus
            $('#menu-principal-home').hide();
            $('#menu-btn-home').show();
        } else {
            // Caso contrário, restaure a ordem original
            $('#menu-btn-home').hide();
            $('#menu-principal-home').show();
        }
    }

    // Chame a função para inicializar os menus com base na largura da janela atual
    toggleMenus();

    // Adicione um evento de redimensionamento da janela para verificar e alternar os menus quando a tela for redimensionada
    $(window).on('resize', toggleMenus);

    // Adicione um evento de clique ao botão do menu
    $('.navbar-toggler').click(function() {
        // Verifique se a largura da janela é menor que 768 pixels (ou o valor desejado para dispositivos móveis)
        if (window.innerWidth < 768) {
            // Adicione ou remova a classe 'show-menu' no corpo da página
            $('body').toggleClass('show-menu');
            
            if ($('body').hasClass('show-menu')) {
                // Menu está aberto
                applyMobileMenuStyles();
            } else {
                // Menu está fechado
                restoreOriginalStyles();
            }
        }
    });

    // Função para aplicar os estilos do menu mobile
    function applyMobileMenuStyles() {
        $('.hero-banner').css({
            'background-color': '#112320'
        });

        $('.navbar-brand').hide();

        $('.nav-button-login, .nav-button-home').hide();
        
        $('.hero-banner').css({
            'background-image': 'none'
        });
        
        $('.text-hero').css({
            'display': 'none'
        });
        
        $('.navbar-nav li.nav-item').css({
            'display': 'block',
            'margin-right': '0',
        });
        
        $('.navbar-nav li.nav-item a.nav-link').css({
            'color': 'white',
            'text-decoration': 'none',
            'padding-bottom': '5px',
            'padding': '20px'
        });
        $('#menu-item-99').css({
            'border-bottom': '1px solid white'
        });
        $('.navbar-nav li.nav-item:last-child a.nav-link').css({
            'border-bottom': '1px solid white'
        });

        $('#menu-item-99').removeClass('nav-button-home');
        $('span').removeClass('btn-home-black');
        $('#menu-item-99').addClass('nav-button-home-new');
        $('#menu-item-100').removeClass('nav-button-login');
        $('#menu-item-99').addClass('nav-button-login-new');

        $('.nav-button-login-new').css({
            'color': '#A1C337',
            'font-family': 'Tomato Grotesk',
            'font-size': '20px',
            'font-weight': '700',
            'line-height': '28px',
            'letter-spacing': '0.04em',
            'text-align': 'left',
        });

        $('span').css({
            'color': '#A1C337',
        });
            
    }

    // Função para restaurar os estilos originais
    function restoreOriginalStyles() {
        $('body').css({
            'background-color': '' 
        });

        $('.hero-banner').css({
            'background-image': 'url(\'https://meumatri.com/wp-content/uploads/2023/09/ThaiseRenan_Cerimonia-308-1.png\')'
        });

        $('.text-hero').css({
            'display': 'block'
        });

        $('.navbar-nav li.nav-item').css({
            'display': 'inline',
            'margin-right': '15px'
        });

        $('.navbar-nav li.nav-item a.nav-link').css({
            'color': 'white',
            'text-decoration': 'none',
            'border-bottom': '1px solid white',
            'padding-bottom': '5px'
        });
        $('.navbar-brand').show();
    }
});

</script>

