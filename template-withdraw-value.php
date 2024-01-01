<?php
/* Template Name: Valor Resgate */
if (is_user_logged_in()) {
    get_header('user');
        get_template_part('template-parts/dashboard/withdraw/withdraw_value');

} else {
    wp_redirect(site_url() . '/login');
    exit;
}
?>