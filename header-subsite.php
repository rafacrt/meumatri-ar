<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

// global $wpdb;
$current_user = wp_get_current_user();
//  $teste = $wpdb->get_results("SELECT post_title FROM ".$wpdb->prefix."posts");
//  $teste = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_author =".$current_user->ID." AND post_status = 'publish' ");
// $users = get_users( array(
//     'orderby' => 'ID',
//     'order'   => 'DESC',
//     'number'  => 1
// ) );

// $last_user_id = ! empty( $users ) ? wp_list_pluck( $users, 'ID' )[0] : 0;


// // Start the buffering //
// // $start =  ob_start();
// var_dump($last_user_id );
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

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <title>Meu Matri</title>
    <?php wp_head(); ?>

    <script>
        /**
         * Turn on/off contentEditable property
         *
         * @param {*} elementId
         * @param {*} buttonId
         */
        function toggleContentEditable(elementId, buttonId) {
            const element = document.getElementById(elementId);
            const button = document.getElementById(buttonId);

            // Toggle contentEditable
            element.contentEditable = !element.isContentEditable;

            // Add/remove highlight class
            if (element.isContentEditable) {
                element.classList.add('highlight');
            } else {
                element.classList.remove('highlight');
            }

            if (element.getAttribute('contenteditable') === 'true') {
                element.setAttribute('contenteditable', 'false');
                button.classList.remove('botao-editando');
            } else {
                element.setAttribute('contenteditable', 'true');
                button.classList.add('botao-editando');
            }

        }

        /**
         * Impede que o usuário saia sem salvar a pagina
         */
        (function() {
            // Variável para verificar se houve alterações na página
            let hasUnsavedChanges = false;

            // Monitora alterações nos campos de entrada do formulário
            const formInputs = document.querySelectorAll('input, textarea');
            formInputs.forEach(input => {
                input.addEventListener('change', function() {
                    hasUnsavedChanges = true;
                });
            });

            // Monitora cliques em links do site
            const siteLinks = document.querySelectorAll('a');
            siteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (hasUnsavedChanges) {
                        e.preventDefault();
                        const confirmationMessage = 'Você tem alterações não salvas. Tem certeza de que deseja sair da página?';
                        e.returnValue = confirmationMessage;
                        return confirmationMessage;
                    }
                });
            });

            // Monitora a tentativa de fechar a página
            window.addEventListener('beforeunload', function(e) {
                if (hasUnsavedChanges) {
                    const confirmationMessage = 'Você tem alterações não salvas. Tem certeza de que deseja sair da página?';
                    e.returnValue = confirmationMessage;
                    return confirmationMessage;
                }
            });
        })();
    </script>
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
            animation: blink 1s infinite;
        }

        @keyframes blink {
            50% {
                background-color: yellow;
            }
        }
    </style>
</head>

<body <?php body_class('mobile-menu-opened') ?>>
    <main>
        <div class="loading-overlay">
            <div class="loading-indicator"></div>
        </div>