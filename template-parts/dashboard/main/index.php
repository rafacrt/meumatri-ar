<?php
require get_template_directory() . '/inc/icons.php';
$current_user = wp_get_current_user();
$username = $current_user->user_login;
$user_id = $current_user->ID;
$active_blog = get_active_blog_for_user($user_id);
$site_id = $active_blog->blog_id;
$couple = get_blog_option($site_id, 'pagarme_recipient_id');
$data = getBalanceRecipient($couple);
?>
<style>
    .splide__arrows,
    .splide__pagination {
        display: none;
    }

    li.splide__slide {
        width: 80% !important;
    }
</style>

<section class="hero-dashboar-index" style="margin-top:80px">
    <div class="container">
        <p class="section-subtitle">
            <?php
            if ($active_blog) {
                $site_url = get_site_url($active_blog->blog_id);

                // Recupere o ID do usuário atualmente logado
                $user_id = get_current_user_id();


                // Recupere o metadado 'couple_name' associado ao usuário
                $couple_name = get_user_meta($user_id, 'couple_name', true);

                if (!empty($couple_name)) {
                    // Exiba a saída com o valor de 'couple_name'
                    echo "<h1 class='section-title' style='text-align:left;'>Olá " . esc_html($couple_name) . "</h1>";
                    echo "Endereço do seu site: <br>";
                    echo '<a href="' . esc_url($site_url) . '">' . esc_url($site_url) . '</a>';
                } else {
                    echo 'Usuário não está associado a um subsite ou não há nome de casal definido.';
                }
            } else {
                echo 'Usuário não está associado a um subsite.';
            }

            ?>
        </p>
    </div>
</section>
<?php if (wp_is_mobile()) : ?>
    <section class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="info-cards">
                        <div class="info-cards__title"><?= $gift ?> Presentes</div>
                        <?php echo "<div class='info-cards__numbers'>R$ " . $data['available_amount'] . "</div>"; ?>

                        <div class="info-cards__more"><p class="showStatistics">Estatísticas</p> | <a
                                    href="/resgate/">Resgates</a></div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="info-cards">
                        <div class="info-cards__title"><?= $guest ?> RSVP</div>
                        <div class="info-cards__numbers">0 Confirmados</div>
                        <div class="info-cards__more"><a href="/meus-convidados">Lista de convidados</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
<?php else: ?>
    <section class="container dashboard-information">
        <div class="info-cards">
            <div class="info-cards__title"><?= $gift ?><p>Presentes</p></div>
            <?php echo "<div class='info-cards__numbers'>R$ " . $data['available_amount'] . "</div>"; ?>
            <div class="info-cards__more">
                <p class="showStatistics">Estatísticas</p>
                <a href="/resgate/">Resgates</a></div>
        </div>
        <div class="info-cards">
            <div class="info-cards__title"><?= $guest ?><p>RSVP</p></div>
            <div class="info-cards__numbers"><p>0 Confirmados</p></div>
            <div class="info-cards__more"><a href="/meus-convidados">Lista de convidados</a></div>
        </div>
    </section>
<?php endif; ?>
<!-- Virtual Gifts -->
<section class="dashboard-index">
    <p class="section-title">Presentes virtuais</p>
    <div class="dashboard-index-content">
        <!-- TODO: IF ELSE PRA VER SE TEM PRESENTE -->
        <div class="dashboard-index-content__icon"><?= $gift ?></div>
        <div class="dashboard-index-content__title">
            <p>Lista de presentes</p>
        </div>
        <div class="dashboard-index-content__text">
            <p>Sem novos presentes, por enquanto. Divulgue sua lista com seus convidados, eles vão gostar!</p>
        </div>
    </div>
</section>
<!-- RSVP -->
<section class="dashboard-index">
    <p class="section-title">RSVP</p>
    <div class="dashboard-index-content">
        <!-- TODO: IF ELSE PRA VER SE TEM convidados -->
        <div class="dashboard-index-content__icon"><?= $guest ?></div>
        <div class="dashboard-index-content__title">
            <p>Nenhum convidado</p>
        </div>
        <div class="dashboard-index-content__text">
            <p>convide quem você mais gosta</p>
        </div>
    </div>
</section>

<!-- Modal de Listas -->
<div id="listDialog" class="modal">
    <div class="modal-content">

        <h2 class="title-modal-payment">Presentes </h2>
        <div class="card-modal-payment">
            <?php echo "<p class='text-left border-card'><span class='ellipse green'></span> Resgatado: <span class='text-right'>R$ " . $data['transferred_amount'] . "</span></p>"; ?>
            <?php echo "<p class='text-left border-card-1'><span class='ellipse blue'></span> Disponível: <span class='text-right'>R$ " . $data['available_amount'] . "</span></p>"; ?>
            <?php echo "<p class='text-left border-card-2'><span class='ellipse orange'></span> Crédito a Liberar: <span class='text-right'>R$ " . $data['waiting_funds_amount'] . "</span></p>"; ?>
        </div>
        <div class="buttons-modal-payment">
            <a class="close">Fechar</a> <a href="/extrato">Ver Extrato</a>
        </div>
    </div>
</div>

<!-- CSS -->

<!-- CSS -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var splide = new Splide('.splide');
        splide.mount();
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    jQuery(document).ready(function () {
        jQuery(".close").click(function () {
            jQuery(".modal").fadeOut();
        });
        jQuery(".showStatistics").click(function () {
            jQuery("#listDialog").fadeIn();
        });
    });
</script>