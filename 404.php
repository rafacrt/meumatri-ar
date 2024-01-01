<?php get_header(); ?>
<section style="background: url(<?= get_template_directory_uri(  )?>/assets/images/404.jpeg) center no-repeat; min-height: 80vh;">
    <h2 style="margin: 10vh auto; text-align: center;"><?php esc_html_e( 'Error 404 - Not Found', 'textdomain' ); ?></h2>
    <p style="margin: 10vh auto; text-align: center;">Ooops! Parece que a página que você está procurando não existe.</p>
    <!-- <img src="<?= get_template_directory_uri(  )?>/assets/images/404.jpeg" alt="" srcset=""> -->
</section>
<?php get_footer(); ?>
