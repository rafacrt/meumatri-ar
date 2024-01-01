<?php
/* Template Name: Extrato */
if (is_user_logged_in()) {
    get_header('user');
        get_template_part('template-parts/dashboard/orders/index');

} else {
    wp_redirect(site_url() . '/login');
    exit;
}
?>