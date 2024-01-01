<?php
/* Template Name: Templates*/

// require_once '../assets/images/*';
/*
    Obligatory Args:
        {
            templates: Array,
            ...
        }
*/
$classic = get_template_directory_uri().'/assets/images/templates/classic.png';
$modern = get_template_directory_uri().'/assets/images/templates/modern.png';
$nature = get_template_directory_uri().'/assets/images/templates/nature.png';
$flores = get_template_directory_uri().'/assets/images/templates/flores.png';

if (is_user_logged_in()) {
    get_header();
} else {
    get_header();
}
?>
<section class="home templates" style="margin-top:80px">
    <h1 class="section-title">Escolha um template e comece a criar o seu site</h1>
    <div class="template-list">
        <!-- foreach here -->
        <div class="template-item">
            <h2 class="template-name">Clássico</h2>
            <img width="100%" src="<?=$classic?>" alt="" srcset="">
            <a href="/templates/classico" class="btn" style="margin-top:40px; margin-bottom:40px; padding-top:10px; font-size: 20px; text-decoration: none; ">Usar este tema</a>
        </div>
        <!-- end foreach here -->
        <!-- remove these itens, after foreach worked -->
        <div class="template-item">
            <h2 class="template-name">Moderno</h2>
            <img width="100%" src="<?=$modern?>" alt="" srcset="">
            <a href="/templates/moderno" class="btn" style="margin-top:40px; margin-bottom:40px; padding-top:10px; font-size: 20px; text-decoration: none; ">Usar este tema</a>
        </div>

        <div class="template-item">
            <h2 class="template-name">Natureza</h2>
            <img width="100%" src="<?=$nature?>" alt="" srcset="">
            <a href="/templates/natureza" class="btn" style="margin-top:40px; margin-bottom:40px; padding-top:10px; font-size: 20px; text-decoration: none; ">Usar este tema</a>
        </div>

        <div class="template-item">
            <h2 class="template-name">Flores</h2>
            <img width="100%" src="<?=$flores?>" alt="" srcset="">
            <a href="/templates/flores" class="btn" style="margin-top:40px; margin-bottom:40px; padding-top:10px; font-size: 20px; text-decoration: none; ">Usar este tema</a>
        </div>
       <!-- end remove  -->
    </div>
</section>
<?php
get_footer();
