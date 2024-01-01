<?php
/*
    Obligatory Args:
        {
            description: String,
            image: Array
            ...
        }
*/
require get_template_directory() . '/inc/icons.php';
$editIcon = get_template_directory_uri() . '/assets/images/Icon.svg';
$titulo = 'Aos nossos amigos e familiares';
$description = 'Histórias de amor existem, e, às vezes, nem nós mesmos acreditamos todo o tempo que já estamos juntos. Porém, o brilho intenso e apaixonado dos nossos olhares nos fazem lembrar o porquê de chegarmos até aqui sem sentir tanto o tempo passar....Vamos nos casar! Estamos preparando tudo com muito carinho para curtirmos cada momento com nossos amigos e familiares queridos!';
$image = get_template_directory_uri() . '/assets/images/couple.png';
$breakIcon = get_template_directory_uri() . '/assets/images/' . $args . '-ms.png';
?>

<div class="row">
    <div class="col-12 jardim-subtext jardim-bgsct2 jardim-margins py-5 text-center">
        <p class="jardim-lead1-title" contenteditable="true">
            <?= $titulo ?>
        </p>
        <p class="jardim-lead1" contenteditable="true">
            <?= $description ?>
        </p>
        <img id="meu-botao3" class="edit" onclick="toggleContentEditable('meu-elemento3', 'meu-botao3')" src="<?= $editIcon ?>" alt="" srcset="">
    </div>
</div>