<?php
$main_site_url = get_site_url(1);
$breakIcon = $main_site_url . '/wp-content/themes/meumatri/assets/images/' . $args . '-ms.png';
$editIcon = $main_site_url.'/wp-content/themes/meumatri/assets/images/Icon.svg';
if (!is_main_site()) {

    $dataTemplate = get_option('locaStorageInfoSite');
    $template = json_decode($dataTemplate, true);

    $title = $template['title_ceremony'];
    $description = $template['description_ceremony'];
    $image = $template['image_ceremony'];

} else {
    $title = 'Cerimonia';
    $image = get_template_directory_uri() . '/assets/images/ceremony-image.png';
    $description = 'Gostaríamos muito de contar com a presença de todos vocês no momento em que nossa união será abençoada diante de Deus!A cerimônia será rápida e tentaremos ser extremamente pontuais. Contamos com vocês!Dia 17 de agosto de 2022, às 18h.Praça Nossa Sra. do Brasil - Jardim Paulista, São Paulo - SP, 01438-060';
    $iframe = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.0630458656574!2d-46.674205384816595!3d-23.602071784662623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59f8e9ffac95%3A0xd02a34bc9438ea3b!2sMoema%2C%20S%C3%A3o%20Paulo%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1678920159613!5m2!1spt-BR!2sbr" width="90%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
}
?>
<section class="ceremony <?= $args ?>" draggable="true">
    <div class="container">
        <div class="edition-wrap">
            <h2 style="color: white; text-align: center;" class="section-title" id="meu-elemento4" contenteditable="false">
                <?= $title ?>
            </h2>
            <?php if (!is_main_site() && is_user_logged_in()): ?>
                <img id="meu-botao4" class="edit" onclick="toggleContentEditable('meu-elemento4', 'meu-botao4')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
            <?php if (is_main_site()): ?>
                <img id="meu-botao4" class="edit" onclick="toggleContentEditable('meu-elemento4', 'meu-botao4')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
        </div>

        <p style="text-align: center;"><img class="middle-icon"  src="<?= $breakIcon ?>" alt=""></p>
        <?php if (isset($image) && !empty($image)): ?>
            <label for="upload2">
                <img width="100%" id="imgOfCeremony" class="ceremony-image" src="<?= $image ?>" alt="Imagem selecionada">
                <?php if (!is_main_site() && is_user_logged_in()): ?>
                    <input type="file" id="upload2" style="display:none" accept="image/*" onchange="changeImgOfCeremony(this)">
                <?php endif; ?>
                <?php if (is_main_site()): ?>
                    <input type="file" id="upload2" style="display:none" accept="image/*" onchange="changeImgOfCeremony(this)">
                <?php endif; ?>
            </label>
        <?php endif; ?>

        <div class="edition-wrap">
            <p style="color: white;" class="text" id="meu-elemento5" contenteditable="false">
                <?= $description ?>
            </p>
            <?php if (!is_main_site() && is_user_logged_in()): ?>
                <img id="meu-botao5" class="edit" onclick="toggleContentEditable('meu-elemento5', 'meu-botao5')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
            <?php if (is_main_site()): ?>
                <img id="meu-botao5" class="edit" onclick="toggleContentEditable('meu-elemento5', 'meu-botao5')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
        </div>
        <div class="maps">
            <?= $iframe ?>
        </div>
    </div>
</section>
<script>
    function changeImgOfCeremony(input) {
        if (input.files && input.files[0]) {
            var leitor2 = new FileReader();
            leitor2.onload = function (e) {
                document.getElementById('imgOfCeremony').setAttribute('src', e.target.result);
            }

            leitor2.readAsDataURL(input.files[0]);
        }
    }

</script>