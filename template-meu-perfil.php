<?php
/* Template Name: Meu Perfil*/

if (is_user_logged_in()) {
    // $current_user = wp_get_current_user();
    // $siteID = $current_user->ID;
    get_header('user');
    // get_template_part('template-parts/meu-perfil/editar',null ,'$args');
    get_footer();
} else {
    // O usuário não está logado, redirecione para outra página.
    wp_redirect(site_url() . '/login');
    exit;
}