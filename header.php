<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
$current_user = wp_get_current_user();
?>
<!DOCTYPE html>
<html id="update_font_size" <?= get_language_attributes() ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link href="https://fonts.cdnfonts.com/css/poligon" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Marck+Script&family=Parisienne&family=Poly:ital@0;1&display=swap" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>



    <title>
        <?php wp_title(''); ?>
    </title>
    <?php wp_head(); ?>
    <script>
        function salvaTudo() {
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
            enviarConteudoParaServidor(ajaxurl);
        }
   
        function toggleContentEditable(elementId, buttonId) {
            var element = document.getElementById(elementId);
            var button = document.getElementById(buttonId);

            // Alternar a propriedade contenteditable
            element.contentEditable = element.contentEditable === 'true' ? 'false' : 'true';

            // Adicionar ou remover a classe de destaque
            if (element.contentEditable === 'true') {
                element.classList.add('highlight');
            } else {
                element.classList.remove('highlight');
            }

            // Alternar o ícone do botão
            button.src = element.contentEditable === 'true' ? 'icone-desativar-edicao.png' : 'icone-ativar-edicao.png';
        }
    </script>
    <style type="text/css" media="screen">
        html {
            margin-top: 0px !important;
        }

        @media screen and (max-width: 782px) {
            html {
                margin-top: 0px !important;
            }
        }

        .footer {
            background-color: #112320 !important;
        }
    </style>
    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
        }

        .loading-indicator {
            width: 100px;
            height: 100px;
            border: 1px solid #FFF;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin: 100% auto;
        }

        .loading-indicator::before {
            content: "";
            width: 50px;
            height: 50px;
            border: 5px solid #B4D748;
            border-top: 4px solid transparent;
            border-radius: 50%;
            position: absolute;
            animation: spin 0.5s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        
        .highlight {
            border: 2px solid blue; /* Adicione um destaque visual, como uma borda azul */
            padding: 5px; /* Ajuste conforme necessário */
            display: inline-block;
        }
    </style>
</head>

<body <?php body_class('mobile-menu-opened') ?>>
    <?php
    if (is_home() || is_page_template('template-home-template.php')) {
        get_template_part('template-parts/common/nav-bar-home');
    } else {
        get_template_part('template-parts/common/nav-bar-couple');
    }
    ?>
    <main>
        <div class="loading-overlay">
            <div class="loading-indicator"></div>
        </div>