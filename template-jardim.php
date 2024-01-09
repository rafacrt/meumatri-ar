<?php
/*
Template Name: Jardim
*/

// Carrega o style.css exclusivo do template
wp_enqueue_style('style-jardim', get_template_directory_uri() . '/assets/css/jardim.css');

// Recupera informações personalizadas do sub-site, como o nome e a data do casal
$nome_casal = get_blog_option(get_current_blog_id(), 'nome_do_casal', 'Insira aqui o nome do casal');
$data_casal = get_blog_option(get_current_blog_id(), 'data_do_evento', 'Data');

// Caminho para imagens e ícones
$background = wp_is_mobile() ? 
    get_template_directory_uri() . '/assets/images/templates-assets/jardimBgMobile.png' :
    get_template_directory_uri() . '/assets/images/templates-assets/jardimBg1.png';
$editIcon = get_template_directory_uri() . '/assets/images/Icon.svg';
?>

<!DOCTYPE html>
<html id="update_font_size" <?= get_language_attributes() ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/jardim.css'; ?>" />
    <!-- Outros links e scripts aqui -->
    <?php wp_head(); ?>
</head>

<body>
    <?php
    // Barra de navegação
    if (is_home() || is_page_template('template-home-template.php')) {
        get_template_part('template-parts/common/nav-bar-home');
    } else {
        get_template_part('template-parts/common/nav-bar-couple');
    }
    ?>

    <div class="loading-overlay">
        <div class="loading-indicator"></div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 jardim-header jardim-bgsct1 jardim-margins text-center text-white" style="background-image: url('<?php echo $background; ?>');">
                <h1 id="nomecasal" class="display-4 jardim-fonte">
                    <?= $nome_casal ?>
                </h1>
                <p id="datecasal" class="jardimDate1">
                    <?= $data_casal ?>
                </p>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>