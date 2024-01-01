<?php
/* Template Name: Meu Site */

//Retorna o conteúdo editado do usuário
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $siteID = $current_user->ID;
    get_header('user');
    get_template_part('recovery-clean-page','recovery links','/sites/yourpage'.$siteID.'.php');
    // get_footer();
} else {
    // O usuário não está logado, redirecione para outra página.
    wp_redirect(site_url() . '/login');
    exit;
}
