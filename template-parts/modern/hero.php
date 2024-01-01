<?php

$main_site_url = get_site_url( 1 );

if ( wp_is_mobile() ) {
	$background = $main_site_url . '/wp-content/themes/meumatri/assets/images/modern-bg.jpg';
	$editIcon   = $main_site_url . '/wp-content/themes/meumatri/assets/images/Icon.svg';
} else {
	$background = $main_site_url . '/wp-content/themes/meumatri/assets/images/modernDesktop.png';
	$editIcon   = $main_site_url . '/wp-content/themes/meumatri/assets/images/Icon.svg';
}
$bootstrap = $main_site_url . "/wp-content/themes/meumatri/assets/css/bootstrap_4.5.2.min.css";
$common    = $main_site_url . "/wp-content/themes/meumatri/assets/css/common.css";
$modern    = $main_site_url . "/wp-content/themes/meumatri/assets/css/modern.css";
$gifts     = $main_site_url . "/wp-content/themes/meumatri/assets/css/components/gifts.css";
$presence  = $main_site_url . "/wp-content/themes/meumatri/assets/css/components/confirme-presence.css";
$tips      = $main_site_url . "/wp-content/themes/meumatri/assets/css/components/tips.css";
$ceremony  = $main_site_url . "/wp-content/themes/meumatri/assets/css/components/ceremony.css";

if ( ! is_main_site() ) {

	$dataTemplate = get_option( 'locaStorageInfoSite' );
	$template     = json_decode( $dataTemplate, true );

	$title = $template['titleBanner'];
	$date  = $template['dateBanner'];

} else {
	$title = 'Thaís & Renan';
	$date  = '23/06/2023';
}

?>
<style>
    @import url('<?php echo $bootstrap; ?>');
    @import url('<?php echo $common; ?>');
    @import url('<?php echo $modern; ?>');
    @import url('<?php echo $gifts; ?>');
    @import url('<?php echo $presence; ?>');
    @import url('<?php echo $tips; ?>');
    @import url('<?php echo $ceremony; ?>');
</style>
<section id="modern" class="hero modern"
         style="background-image: url(<?= $background ?>); background-repeat: no-repeat; background-size: cover;"
         alt="">
    <div class="content">
        <div class="edition-wrap">
            <h1 id="meu-elemento1" contenteditable="false"><?= $title ?></h1>
			<?php if ( ! is_main_site() && is_user_logged_in() ) : ?>
                <img id="meu-botao1" class="edit" onclick="toggleContentEditable('meu-elemento1', 'meu-botao1')"
                     src="<?= $editIcon ?>" alt="" srcset="">
			<?php endif; ?>
			<?php if ( is_main_site() ): ?>
                <img id="meu-botao1" class="edit" onclick="toggleContentEditable('meu-elemento1', 'meu-botao1')"
                     src="<?= $editIcon ?>" alt="" srcset="">
			<?php endif; ?>
        </div>
        <div class="edition-wrap">
            <p id="meu-elemento2" contenteditable="false"><?= $date ?></p>
			<?php if ( ! is_main_site() && is_user_logged_in() ) : ?>
                <img id="meu-botao2" class="edit" onclick="toggleContentEditable('meu-elemento2', 'meu-botao2')"
                     src="<?= $editIcon ?>" alt="" srcset="">
			<?php endif; ?>
			<?php if ( is_main_site() ): ?>
                <img id="meu-botao2" class="edit" onclick="toggleContentEditable('meu-elemento2', 'meu-botao2')"
                     src="<?= $editIcon ?>" alt="" srcset="">
			<?php endif; ?>
        </div>
    </div><!--content-->
</section>