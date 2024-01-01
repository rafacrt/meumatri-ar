<?php
/* Template Name: Meus Convidados */

//Retorna o conteúdo editado do usuário
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $siteID = $current_user->ID;
    get_header();
    get_template_part('template-parts/meus-convidados/visualizar',null ,'$args');
    get_footer();
} else {
    // O usuário não está logado, redirecione para outra página.
    wp_redirect(site_url() . '/login');
    exit;
}