<?php
/* Template Name: Editar Lista de Presentes*/
if (is_user_logged_in()) {
    get_header('user');
    get_template_part('template-parts/dashboard/gifts/gift-list');
} else {
    // O usuário não está logado, redirecione para outra página.
    wp_redirect(site_url() . '/login');
    exit;
}
?>
