<?php
/* Template Name: Confirmação do Resgate */
if (is_user_logged_in()) {
    get_header('user');
        get_template_part('template-parts/dashboard/withdraw/withdraw_confirm');

} else {
    wp_redirect(site_url() . '/login');
    exit;
}
?>