<?php
$main_site_url = get_site_url(1);
require get_template_directory() . '/inc/icons.php';
$editIcon = $main_site_url.'/wp-content/themes/meumatri/assets/images/Icon.svg';

if (!is_main_site()) {

    $dataTemplate = get_option('locaStorageInfoSite');
    $template = json_decode($dataTemplate, true);

    $description = $template['section_description'];
    $image = $template['section_image'];
    $breakIcon = get_template_directory_uri() . '/assets/images/' . $args . '-ms.png';

} else {
    $description = 'Criamos esse site para compartilhar com vocês os detalhes da organização do nosso casamento. Estamos muito felizes e contamos com a presença de todos no nosso grande dia!Aqui vocês encontrarão também dicas para hospedagem, salão de beleza, trajes, estacionamento, etc.Ah, é importante também confirmar sua presença. Para isto contamos com sua ajuda clicando no menu “Confirme sua Presença” e preenchendo os dados necessários.Para nos presentear, escolha qualquer item da Lista de Casamento, seja um item de algum dos sites, lojas físicas, ou então vocês podem utilizar a opção de cotas. Fiquem à vontade!Aguardamos vocês no nosso grande dia!';
    $image = get_template_directory_uri() . '/assets/images/couple.png';
    $breakIcon = get_template_directory_uri() . '/assets/images/' . $args . '-ms.png';
}
?>

<section class="description <?= $args ?>" draggable="true">
    <div class="container">
        <img class="middle-icon" src="<?= $breakIcon ?>" alt="">

        <div class="edition-wrap">
            <p class="text" id="meu-elemento3" contenteditable="false">
                <?= $description ?>
            </p>
            <?php if (!is_main_site() && is_user_logged_in()): ?>
                <img id="meu-botao3" class="edit" onclick="toggleContentEditable('meu-elemento3', 'meu-botao3')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
            <?php if (is_main_site()): ?>
                <img id="meu-botao3" class="edit" onclick="toggleContentEditable('meu-elemento3', 'meu-botao3')"
                    src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
        </div>
        <br>
        <?php if (isset($image) && !empty($image)): ?>
            <label for="upload">
                <img id="imgOfDesc" width="100%" class="couple" src="<?= $image ?>" alt="Imagem selecionada">
                <?php if (!is_main_site() && is_user_logged_in()): ?>
                    <input type="file" id="upload" style="display:none" accept="image/*" onchange="changeImgOfDesc(this)">
                <?php endif; ?>
                <?php if (is_main_site()): ?>
                    <input type="file" id="upload" style="display:none" accept="image/*" onchange="changeImgOfDesc(this)">
                <?php endif; ?>
            </label>
        <?php endif; ?>
        <img class="middle-icon" src="<?= $breakIcon ?>" alt="">
    </div>
    </div>
</section>
<script>
    function changeImgOfDesc(input) {
        if (input.files && input.files[0]) {
            var leitor = new FileReader();

            leitor.onload = function (e) {
                document.getElementById('imgOfDesc').setAttribute('src', e.target.result);
            }

            leitor.readAsDataURL(input.files[0]);
        }
    }

</script>