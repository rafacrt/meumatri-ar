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
$title = 'Monica & Edu';
$date = '08/02/2024';
if (wp_is_mobile()) {
    $background = get_template_directory_uri() . '/assets/images/templates-assets/jardimBgMobile.png';
} else {
    $background = get_template_directory_uri() . '/assets/images/templates-assets/jardimBg1.png';
}

$editIcon = get_template_directory_uri() . '/assets/images/Icon.svg';

?>

<div class="container-lg">
    <div class="row">
        <div class="col-12 jardim-header jardim-bgsct1 jardim-margins text-center text-white">
            <img id="meu-botao1" class="edit" onclick="toggleContentEditable('meu-elemento1', 'meu-botao1')" src="<?= $editIcon ?>" alt="" srcset="">
            <h1 class="display-4 jardim-fonte" contenteditable="true"><?= $title ?>
            </h1>
            <img id="meu-botao2" class="edit" onclick="toggleContentEditable('meu-elemento2', 'meu-botao2')" src="<?= $editIcon ?>" alt="" srcset="">
            <p id="meu-elemento2" class="jardimDate1" contenteditable="true">
                <?= $date ?>
            </p>
        </div>
    </div>

    <!--
<section id="jardim" class="hero jardim" style="background-image: url(<?= $background ?>); background-repeat: no-repeat; background-size: cover;" alt="">
    <div class="content2">
        <div class="edition-wrap">
            <h1 id="meu-elemento1" class="jardimTlt1" contenteditable="true"><?= $title ?></h1>
            <img id="meu-botao1" class="edit" onclick="toggleContentEditable('meu-elemento1', 'meu-botao1')" src="<?= $editIcon ?>" alt="" srcset="">
        </div>
        <div class="edition-wrap">
            <p id="meu-elemento2" class="jardimDate1" contenteditable="true"><?= $date ?></p>
            <img id="meu-botao2" class="edit" onclick="toggleContentEditable('meu-elemento2', 'meu-botao2')" src="<?= $editIcon ?>" alt="" srcset="">
        </div>
    </div>
</section>  -->