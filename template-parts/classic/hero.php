<?php
$main_site_url = get_site_url(1);
require_once get_template_directory() . '/inc/icons.php';
$editIcon = $main_site_url . '/wp-content/themes/meumatri/assets/images/Icon.svg';
if (!is_main_site()) {
    $dataTemplate = get_option('locaStorageInfoSite');
    $template = json_decode($dataTemplate, true);
    $title = $template['titleBanner'];
    $date = $template['dateBanner'];
    $background = get_option('backgroundBanner');
} else {
    $title = 'Thaís & Renan';
    $date = '23/06/2023';
    $background = get_template_directory_uri() . '/assets/images/classic-bg.png';
}
$bootstrap = $main_site_url . "/wp-content/themes/meumatri/assets/css/bootstrap_4.5.2.min.css";
$common = $main_site_url . "/wp-content/themes/meumatri/assets/css/common.css";
$classic = $main_site_url . "/wp-content/themes/meumatri/assets/css/classic.css";
$gifts = $main_site_url . "/wp-content/themes/meumatri/assets/css/components/gifts.css";
$presence = $main_site_url . "/wp-content/themes/meumatri/assets/css/components/confirme-presence.css";
$tips = $main_site_url . "/wp-content/themes/meumatri/assets/css/components/tips.css";
$ceremony = $main_site_url . "/wp-content/themes/meumatri/assets/css/components/ceremony.css";
?>
<style>
    @import url('<?php echo $bootstrap; ?>');
    @import url('<?php echo $common; ?>');
    @import url('<?php echo $classic; ?>');
    @import url('<?php echo $gifts; ?>');
    @import url('<?php echo $presence; ?>');
    @import url('<?php echo $tips; ?>');
    @import url('<?php echo $ceremony; ?>');
</style>
<style>
    h2.name-initials {
        writing-mode: vertical-rl;
        text-orientation: upright;
        color: #F7F7F7;
        font-family: Marck Script;
        font-size: 70px;
        font-weight: 100;
        height: 100%;
        letter-spacing: -0.6em;
        background: radial-gradient(266.13% 266.13% at 50.13% 34.68%, #F7F7F7 0%, rgba(0, 0, 0, 0) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .upload-wrapper {
        position: relative;
        width: 50%;
        height: 50px;
        cursor: pointer;
    }

    .upload-label {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
        padding: 8px;
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Opcional: Estilo de hover para dar um feedback visual */
    .upload-label:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .right-overlay {
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 38rem;
        padding-top: 75px;
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
<section id="classic" class="hero classic"
         style="background-image: url(<?= $background ?>); background-repeat: no-repeat;  background-size: cover;"
         alt="">
    <div class="right-overlay">
        <div class="edition-wrap">
            <h2 class="name-initials" id="meu-elemento0" contenteditable="false">T & R</h2>
            <?php if (!is_main_site() && is_user_logged_in()): ?>
                <img id="meu-botao0" class="edit" onclick="toggleContentEditable('meu-elemento0', 'meu-botao0')"
                     src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
            <?php if (is_main_site()): ?>
                <img id="meu-botao0" class="edit" onclick="toggleContentEditable('meu-elemento0', 'meu-botao0')"
                     src="<?= $editIcon ?>" alt="" srcset="">
            <?php endif; ?>
        </div>
    </div>
    <?php if (!is_main_site() && is_user_logged_in()): ?>
        <div class="upload-wrapper">
            <label for="uploadBackground" class="upload-label">Clique aqui para trocar o background</label>
            <input type="file" id="uploadBackground" style="display:none" accept="image/*"
                   onchange="changeBackgroundOfClassicSection(this)">
        </div>
    <?php endif; ?>
</section>

<section class="sub-hero">
    <div class="content">
        <img id="meu-botao1" class="edit" onclick="toggleContentEditable('meu-elemento1', 'meu-botao1')"
             src="<?= $editIcon ?>" alt="" srcset="">
        <h1 id="meu-elemento1" contenteditable="false">
            <?= $title ?>
        </h1>
        <img id="meu-botao2" class="edit" onclick="toggleContentEditable('meu-elemento2', 'meu-botao2')"
             src="<?= $editIcon ?>" alt="" srcset="">
        <p id="meu-elemento2" contenteditable="false">
            <?= $date ?>
        </p>
    </div>
</section>

<script>
    function changeBackgroundOfClassicSection(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var section = document.getElementById('classic');
                section.style.backgroundImage = "url(" + e.target.result + ")";
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
