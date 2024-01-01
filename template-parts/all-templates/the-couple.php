<?php
$main_site_url = get_site_url(1);
$editIcon = $main_site_url.'/wp-content/themes/meumatri/assets/images/Icon.svg';
$breakIcon = $main_site_url.'/wp-content/themes/meumatri/assets/images/' . $args . '-ms.png';

if (!is_main_site()) {

    $dataTemplate = get_option('locaStorageInfoSite');
    $template = json_decode($dataTemplate, true);

    $title = $template['title_couple'];
    $description = $template['description_couple'];
    $images = array(
         $main_site_url.'/wp-content/themes/meumatri/assets/images/casal 2.png',
         $main_site_url.'/wp-content/themes/meumatri/assets/images/casal 2.png',
         $main_site_url.'/wp-content/themes/meumatri/assets/images/casal 2.png'
    );

} else {
    $title = 'O casal';
    $description = 'Histórias de amor existem, e, às vezes, nem nós mesmos acreditamos todo o tempo que já estamos juntos. Porém, o brilho intenso e apaixonado dos nossos olhares nos fazem lembrar o porquê de chegarmos até aqui sem sentir tanto o tempo passar....Vamos nos casar! Estamos preparando tudo com muito carinho para curtirmos cada momento com nossos amigos e familiares queridos!';
    $images = array(
         $main_site_url.'/wp-content/themes/meumatri/assets/images/casal 2.png',
         $main_site_url.'/wp-content/themes/meumatri/assets/images/casal 2.png',
         $main_site_url.'/wp-content/themes/meumatri/assets/images/casal 2.png'
    );
}
?>
<section class="the-couple <?= $args ?>" draggable="true">
    <div class="container">
        <div class="edition-wrap">
            <h2 class="section-title" id="meu-elemento8" contenteditable="false">
                <?= $title ?>
            </h2>
            <?php if (!is_main_site() && is_user_logged_in()): ?>
                <img id="meu-botao8" class="edit" onclick="toggleContentEditable('meu-elemento8', 'meu-botao8')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
            <?php if (is_main_site()): ?>
                <img id="meu-botao8" class="edit" onclick="toggleContentEditable('meu-elemento8', 'meu-botao8')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
        </div>

        <div class="edition-wrap">
        <img class="middle-icon" style="text-align: center;" src="<?= $breakIcon ?>" alt="">
            <p  style="text-align: center;" class="text" id="meu-elemento9" contenteditable="false">
                <?= $description ?>
            </p>
            <?php if (!is_main_site() && is_user_logged_in()): ?>
                <img id="meu-botao9" class="edit" onclick="toggleContentEditable('meu-elemento9', 'meu-botao9')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
            <?php if (is_main_site()): ?>
                <img id="meu-botao9" class="edit" onclick="toggleContentEditable('meu-elemento9', 'meu-botao9')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
        </div>
        <div class="splide" aria-label="Splide Carousel <?= $args ?>">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php foreach ($images as $index => $image): ?>
                        <li class="splide__slide">
                            <label for="upload<?= $index ?>">
                                <img width="100%" class="splide_image_carousel" src="<?= $image ?>"
                                    onclick="openFileUploader(event, 'upload<?= $index ?>')">
                                <?php if (!is_main_site() && is_user_logged_in()): ?>
                                    <input type="file" id="upload<?= $index ?>" style="display:none" accept="image/*"
                                        onchange="changeSlideImage(event, <?= $index ?>)">
                                <?php endif; ?>
                                <?php if (is_main_site()): ?>
                                    <input type="file" id="upload<?= $index ?>" style="display:none" accept="image/*"
                                        onchange="changeSlideImage(event, <?= $index ?>)">
                                <?php endif; ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<script>
    function openFileUploader(event, inputId) {
        event.preventDefault();
        document.getElementById(inputId).click();
    }

    function changeSlideImage(event, index) {
        var input = event.target;
        var slideImage = document.getElementsByClassName('splide_image_carousel')[index];

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                slideImage.setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var splide = new Splide('.splide');
        splide.mount();
    });
</script>