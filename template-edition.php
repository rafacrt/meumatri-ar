<?php

$file = get_template_directory() . $args;
if (file_get_contents($file)):
    $conteudo = file_get_contents($file);
    $conteudo_sem_barras = stripslashes($conteudo);

    // Desativa os erros do analisador XML temporariamente
    libxml_use_internal_errors(true);

    // Obtém o ID da primeira seção encontrada
    $dom = new DOMDocument();
    $dom->loadHTML($conteudo_sem_barras);

    // Limpa os erros do analisador XML
    libxml_clear_errors();

    $sections = $dom->getElementsByTagName('section');
    if ($sections->length > 0) {
        $firstSection = $sections->item(0);
        $templateId = $firstSection->getAttribute('id');

        // Gera o caminho da folha de estilo correspondente ao template
        $stylesheetPath = get_template_directory_uri() . '/assets/css/' . $templateId . '.css';

        // Inclui a folha de estilo correspondente
        echo '<link rel="stylesheet" type="text/css" href="' . $stylesheetPath . '">';
    }

    echo $conteudo_sem_barras;
    // get_template_part('template-parts/all-templates/gift-list',null , $templateId);
    // get_template_part('template-parts/all-templates/tips',null , $templateId);
    // get_template_part('template-parts/all-templates/presence-forms',null , $templateId);
    // get_footer();
    ?>
    <style>
    dialog {
        display: none;
    }
    </style>
    <?php
else :
    wp_redirect( '/painel/' );
endif;