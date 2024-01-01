<?php
// require_once '../assets/images/*';
/*
    Obligatory Args:
        {
            title: String,
             date: String,
            background: Array,
            ...
        }
*/
require_once get_template_directory() . '/inc/icons.php';
$editIcon = get_template_directory_uri() . '/assets/images/Icon.svg';

if (!is_main_site()) {

    $dataTemplate = get_option('locaStorageInfoSite');
    $template = json_decode($dataTemplate, true);

    $title = $template['titleBanner'];
    $date = $template['dateBanner'];
    $background = get_option('backgroundBanner');
    
}else{
    $title = 'Thaís & Renan';
    $date = '23/06/2023';
    $background = get_template_directory_uri() . '/assets/images/classic-bg.png';
}

?>
<section id="nature" class="hero nature" style="background-image: url(<?=$background?>); background-repeat: no-repeat; background-size: cover;" alt="">
    <div class="content">
        <div class="edition-wrap">
            <h1 id="meu-elemento1" contenteditable="false"><?=$title?></h1>
            <img id="meu-botao1" class="edit" onclick="toggleContentEditable('meu-elemento1', 'meu-botao1')" src="<?=$editIcon?>" alt="" srcset="">
        </div>
        <div class="edition-wrap">
            <p id="meu-elemento2" contenteditable="false"><?=$date?></p>
            <img id="meu-botao2" class="edit" onclick="toggleContentEditable('meu-elemento2', 'meu-botao2')" src="<?=$editIcon?>" alt="" srcset="">
        </div>
    </div>
</section>  