<?php
/* Template Name: Blank*/
if (is_user_logged_in()) {
    get_header('user');
} else {
    wp_redirect(site_url() . '/login');
    exit;
}
?>