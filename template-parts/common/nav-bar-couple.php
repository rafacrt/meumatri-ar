<?php $base_url = get_home_url(); ?>
<?php $logo = 'https://meumatri.com/wp-content/uploads/2023/09/logo.png'; ?>
<?php $logoPreto = get_template_directory_uri() . '/assets/images/logo_preto.png'; ?>
<?php $hero_banner_template = get_template_directory_uri() . '/assets/images/hero-banner-template.png'; ?>
<!-- Menu transparente -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    @media (max-width: 768px) {
        .navbar {
            display: none;
        }
    }

    @media (min-width: 769px) {
        .mobile-menu-logged {
            display: none !important;
        }
    }

    #mobile-menu {
        display: none;
        background-color: #1C2A28;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 999;
        padding: 20px;
    }

    #mobile-menu-aberto-logado {
        display: none;
        background-color: #FFF;
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

    #mobile-menu-aberto-logado ul {
        margin-top: 15px;
        float: left;
        margin-left: -10px;
    }

    #mobile-menu-aberto-logado li {
        list-style: none;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    #mobile-menu-aberto-logado a {
        padding-left: 10px;
        display: block;
        padding: 10px 0;
        color: black;
        text-decoration: none;
        font-family: Poligon;
        font-size: 16px;
        font-weight: 600;
        line-height: 24px;
        letter-spacing: 0em;
        text-align: left;
    }

    #mobile-menu-aberto-logado a img {
        margin-right: 15px !important;
    }

    #mobile-menu-aberto-logado li:hover {
        background-color: #D9D9D94D;
        width: 100%;
        padding: 5px;
    }

    #mobile-menu-button {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        cursor: pointer;
        color: white;
        margin-top: 8px;
    }

    #mobile-menu-button-aberto-logado {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        cursor: pointer;
        color: white;
        margin-top: 8px;
    }

    #inicio-aberto-logado {
        display: block;
        position: absolute;
        top: 13px;
        left: 60px;
        cursor: pointer;
        color: white;
        margin-top: 8px;
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

    #close-button-aberto-logado {
        position: absolute;
        top: 40px;
        right: 20px;
        cursor: pointer;
        color: black;
        padding: 5px;
    }

    #logo {
        display: block;
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
        color: white;
    }

    /* Estilos para o menu do WordPress no menu mobile */
    #wp-mobile-menu {
        padding: 0;
    }

    /* Estilos para o menu do WordPress no menu mobile */
    #wp-mobile-menu-aberto-logado {
        padding: 0;
        border-bottom: 1px solid #CCC;
        width: 100%;
        padding-bottom: 40px;
    }

    .border-menu {
        border-top: 1px solid white;
        border-bottom: 1px solid white;
        margin-top: 70px;
    }

    .border-menu-2 {
        border-bottom: 1px solid white;
    }

    @media (min-width: 769px) {
        #mobile-menu-button {
            display: none;
            /* Mostra o botão do menu mobile */
        }

        #logo {
            display: none;
            /* Mostra o logotipo na versão mobile */
        }

        #mobile-menu {
            display: none;
            /* Mostra o menu mobile */
        }
    }

    .user-avatar {
        margin-right: 10px;
        float: left;
        border-radius: 50%;
        /* Adiciona bordas arredondadas */
        overflow: hidden;
        /* Certifica-se de que a imagem esteja completamente visível */
        width: 64px;
        /* Largura da imagem (ajuste conforme necessário) */
        height: 64px;
        /* Altura da imagem (ajuste conforme necessário) */
    }


    .user-details {
        flex-grow: 1;
        overflow: hidden;
        /* Evita que o conteúdo se desloque muito para a direita */
        float: left;
    }

    .user-name {
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-family: Inter;
        font-size: 14px;
        font-weight: 600;
        text-align: left;

    }

    .user-email {
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        float: left;
        font-family: Inter;
        font-size: 14px;
        font-weight: 400;
    }

    .logout-button {
        text-decoration: none;
        color: #000;
        float: right;
        padding: 5px 10px;
        background-color: #FFF;
        border-radius: 5px;
    }

    .menu-desk-logado {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: flex-end;
        margin-top: 15px !important;
        margin-left: 77px;
    }

    .menu-desk-logado ul {
        margin-right: 5px;
    }

    .menu-desk-logado img {
        display: none;
    }

    .menu-desk-logado a {
        text-decoration: none;
        color: #FFF;
        padding: 5px 10px;
        font-size: 14px;
    }
</style>
<?php if (is_user_logged_in()): ?>
        <?php
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $user_avatar = get_avatar($current_user->ID, 64);
            $user_id = $current_user->ID;
            $active_blog = get_active_blog_for_user($user_id);
            $site_url = get_site_url($active_blog->blog_id);
        ?>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="<? echo $logo; ?>" alt=""></a>
                <div class="collapse navbar-collapse menu-principal-home" id="navbarNav">
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home" style="margin-left:20px; list-style: none; "><a href="/painel" style="color:white; text-decoration:none;">Início</a></li>
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-logado-mobile',
                            'container' => false,
                            'menu_class' => 'menu-desk-logado',
                            )
                        );
                        ?>
                 <a style="margin-left:96px;" class="logout-button" href="<?php echo wp_logout_url(); ?>">
                        <img src="https://meumatri.com/wp-content/uploads/2023/10/Icon_menu_logout.png" /> Sair
                    </a>
                </div>

            </div>
        </nav>
        <div class="mobile-menu-logged"
            style="background-color:#1C2A28 !important; border:1px solid black; width:100%; height:80px;">

            <div id="mobile-menu-button-aberto-logado">
                <i class="fas fa-bars"></i>
            </div>

            <div id="inicio-aberto-logado">
                <a href="/painel" style="color:white; text-decoration:none;font-size:22px;">Início</a>
            </div>

            <div id="logo">
                <img src="<?php echo $logo; ?>" alt="Logo" width="140">
            </div>

            <?php if (is_page_template('template-classic.php') || is_page_template('template-modern.php') || is_page_template('template-nature.php') || is_page_template('template-flores.php')): ?>
                <a class="btn btn-primary salvar-info-template"
                    style="background-color:#a4ad88;color:#FFF; margin-top:18px; margin-left:95px; font-size:20px; text-decoration:none; cursor:pointer; font-weight: 600; padding-top:12px;">Salvar</a>
            <?php endif; ?>

            <div id="mobile-menu-aberto-logado">
                <div id="close-button-aberto-logado">
                    <i class="fas fa-times"></i>
                </div>

                <img src="<?php echo $logoPreto; ?>" alt="Logo" width="140" style="margin-top:20px;">
                <div class="border-menu-2">
                    <ul id="wp-mobile-menu-aberto-logado">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home" style="margin-left:20px; "><a href="<?php echo esc_url($site_url); ?>"><img src="https://meumatri.com/wp-content/uploads/2023/10/Icon_menu_home-1.png"> Meu Site</a></li>

                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-2055" style="margin-left:20px; margin-bottom:-12px;"><a href="<?php echo esc_url($site_url); ?>"><img src="https://meumatri.com/wp-content/uploads/2023/10/Icon_menu_edit_lista_presente.png"> Editar seções do site</a></li>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-logado-mobile',
                                'container' => false,
                                'menu_class' => 'menu',
                            )
                        );
                        ?>
                    </ul>
                </div>


                <div class="menu-footer">
                    <div class="user-avatar">
                        <?php echo $user_avatar; ?>
                    </div>
                    <div class="user-details">
                        <p class="user-name">
                            <?php echo $current_user->display_name; ?>
                        </p>
                        <p class="user-email">
                            <?php echo $current_user->user_email; ?>
                        </p>
                    </div>
                    <a class="logout-button" href="<?php echo wp_logout_url(); ?>">
                        <img src="https://meumatri.com/wp-content/uploads/2023/10/Icon_menu_logout.png" /> Sair
                    </a>
                </div>

            <?php } ?>
        </div>


    </div>
<?php else: ?>
    <nav class="navbar navbar-expand-lg" style="background-color:#1C2A28; padding:50px;">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $base_url ?>"><img src="<?php echo $logo; ?>" alt=""></a>
            <div class="collapse navbar-collapse menu-principal-home justify-content-end" id="navbarNav">
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
            <?php if (is_page_template('template-classic.php') || is_page_template('template-modern.php') || is_page_template('template-nature.php') || is_page_template('template-flores.php')): ?>
                <div class="collapse navbar-collapse menu-btn-home" id="navbarNav">
                    <a class="btn btn-primary salvar-info-template"
                        style="background-color:#a4ad88;color:#FFF; margin-top:0px; float:right; font-size:20px; text-decoration:none; cursor:pointer; font-weight: 600; padding-top:12px;">Salvar</a>
                </div>
            <?php else: ?>
                <div class="collapse navbar-collapse menu-btn-home justify-content-end" id="navbarNav">
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
                <?php endif; ?>
            </div>

        </div>
    </nav>
    <div class="mobile-menu-logged"
        style="background-color:#1C2A28 !important; border:1px solid black; width:100%; height:80px;">

        <div id="mobile-menu-button">
            <i class="fas fa-bars"></i>
        </div>

        <div id="logo">
            <img src="<?php echo $logo; ?>" alt="Logo" width="140">
        </div>

        <?php if (is_page_template('template-classic.php') || is_page_template('template-modern.php') || is_page_template('template-nature.php') || is_page_template('template-flores.php')): ?>
            <a class="btn btn-primary salvar-info-template"
                style="background-color:#a4ad88;color:#FFF; margin-top:18px; margin-left:95px; font-size:20px; text-decoration:none; cursor:pointer; font-weight: 600; padding-top:12px;">Salvar</a>
        <?php endif; ?>

        <div id="mobile-menu">
            <div id="close-button">
                <i class="fas fa-times"></i>
            </div>
            <div class="border-menu">
                <ul id="wp-mobile-menu">
                    <li class="menu-login"><a href=""><span style="color:#A1C337;">Criar site grátis</span></a></li>
                    <li class="menu-login"><a href="">Entrar</a></li>
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
    </div>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Abrir o menu mobile
    $("#mobile-menu-button").click(function () {
        $("#mobile-menu").show();
        $("#mobile-menu-aberto-logado").show();
        $("#logo").hide();
    });

    // Abrir o menu mobile
    $("#mobile-menu-button-aberto-logado").click(function () {
        $("#mobile-menu").show();
        $("#mobile-menu-aberto-logado").show();
    });

    // Fechar o menu mobile
    $("#close-button").click(function () {
        $("#mobile-menu").hide();
        $("#mobile-menu-aberto-logado").hide();
        $("#logo").show();
    });

    $("#close-button-aberto-logado").click(function () {
        $("#mobile-menu").hide();
        $("#mobile-menu-aberto-logado").hide();
        $("#logo").show();
    });
</script>
<script>
    function saveBannerInfo() {
        // Recupere os valores dos campos que deseja salvar
        var titleBanner = jQuery('#meu-elemento1').text();
        var date = jQuery('#meu-elemento2').text();

        // Armazene os valores no localStorage
        localStorage.setItem('titleBanner', titleBanner);
        localStorage.setItem('dateBanner', date);
    }

    function saveSectionInfo() {
        var descriptionInfo = $('#meu-elemento3').text();
        var imageInfo = $('#imgOfDesc').attr('src');

        // Armazene as informações no armazenamento local
        localStorage.setItem('section_description', descriptionInfo);
        localStorage.setItem('section_image', imageInfo);
    }

    function saveTheCoupleInfo() {
        var titleCouple = $('#meu-elemento8').text();
        var descriptionCouple = $('#meu-elemento9').text();
        var imagesSlideCouple = [];


        // Armazene as informações no armazenamento local
        localStorage.setItem('title_couple', titleCouple);
        localStorage.setItem('description_couple', descriptionCouple);
        localStorage.setItem('images_couple', JSON.stringify(imagesSlideCouple));
    }

    function saveCeremonyInfo() {
        var titleCeremony = $('#meu-elemento4').text();
        var descriptionCeremony = $('#meu-elemento5').text();
        var imageCeremony = $('#imgOfCeremony').attr('src');

        // Armazene as informações no armazenamento local
        localStorage.setItem('title_ceremony', titleCeremony);
        localStorage.setItem('description_ceremony', descriptionCeremony);
        localStorage.setItem('image_ceremony', imageCeremony);
    }

    function saveTipsInfo() {
        var titleTips = $('#meu-elemento6').text();
        var descriptionTips = $('#meu-elemento7').text();

        // Armazene as informações no armazenamento local
        localStorage.setItem('title_tips', titleTips);
        localStorage.setItem('description_tips', descriptionTips);
    }

    function saveTemplate() {
        var currentTemplate = jQuery('input[name="current_template"]').val();
        localStorage.setItem('current_template', currentTemplate);
    }

    jQuery(document).ready(function () {
        jQuery('.salvar-info-template').on('click', function (event) {
            saveTemplate();
            saveBannerInfo();
            saveSectionInfo();
            saveTheCoupleInfo();
            saveCeremonyInfo();
            saveTipsInfo();
            // Redirecione para a página de cadastro
            window.location.href = '/cadastro';
        });
    });

</script>