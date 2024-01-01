<?php
/*
    Obligatory Args:
        {
            title: String,
            description: String,
            list: Array,
            ...
        }
*/
require_once get_template_directory() . '/inc/icons.php';
$editIcon = get_template_directory_uri() . '/assets/images/Icon.svg';
$breakIcon = get_template_directory_uri() . '/assets/images/' . $args . '-ms.png';

if (!is_main_site()) {

    $dataTemplate = get_option('locaStorageInfoSite');
    $template = json_decode($dataTemplate, true);

    $title = $template['title_tips'];
    $description = $template['description_tips'];

} else {
    $title = 'Dicas';
    $description = 'Separamos algumas opções para ajudar vocês, nossos queridos convidados, a se prepararem para o grande dia.';
}

?>

<section class="tips" draggable="true">
    <div class="container">
        <div class="edition-wrap">
            <h2 class="tips__title" id="meu-elemento6" contenteditable="false">
                <?= $title ?>
            </h2>
            <?php if (!is_main_site() && is_user_logged_in()): ?>
                <img id="meu-botao6" class="edit" onclick="toggleContentEditable('meu-elemento6', 'meu-botao6')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
            <?php if (is_main_site()): ?>
                <img id="meu-botao6" class="edit" onclick="toggleContentEditable('meu-elemento6', 'meu-botao6')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
        </div>
        <img class="middle-icon" src="<?= $breakIcon ?>" alt="">
        <div class="edition-wrap">
            <p class="text tips__subtitle" id="meu-elemento7" contenteditable="false">
                <?= $description ?>
            </p>
            <?php if (!is_main_site() && is_user_logged_in()): ?>
                <img id="meu-botao7" class="edit" onclick="toggleContentEditable('meu-elemento7', 'meu-botao7')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
            <?php if (is_main_site()): ?>
                <img id="meu-botao7" class="edit" onclick="toggleContentEditable('meu-elemento7', 'meu-botao7')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
        </div>
        <br>
        <div class="tips__buttons--container">
            <div class="tips__buttons--items">
                <button class="btn">Todos</button>
                <button class="btn">Hotéis</button>
            </div>
            <div class="tips__buttons--items">
                <button class="btn">Salões de Beleza</button>
                <button class="btn">Restaurantes</button>
            </div>
        </div>
    </div>
</section>