<?php
/* Template Name: Lista de Presentes*/
if (is_user_logged_in()) {
  get_header('user');
  get_template_part('template-parts/dashboard/gifts/list-gallery');
} else {
  wp_redirect(site_url() . '/login');
  exit;
}
?>
<script>
    jQuery(document).ready(function () {
        jQuery('.adicionar-lista_filha').on('click', function (e) {
          jQuery(this).text("Adicionando ...");
        });
    });
</script>