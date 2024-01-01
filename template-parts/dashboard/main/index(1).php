<?php
require get_template_directory() . '/inc/icons.php';
$current_user = wp_get_current_user();
$username     = $current_user->user_login;
$user_id      = $current_user->ID;
$active_blog  = get_active_blog_for_user( $user_id );
$site_id      = $active_blog->blog_id;
$couple       = get_blog_option( $site_id, 'pagarme_recipient_id' );
$data         = getBalanceRecipient( $couple );

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
			if ( $active_blog ) {
				$site_url = get_site_url( $active_blog->blog_id );

				// Recupere o ID do usuário atualmente logado
				$user_id = get_current_user_id();


				// Recupere o metadado 'couple_name' associado ao usuário
				$couple_name = get_user_meta( $user_id, 'couple_name', true );

				if ( ! empty( $couple_name ) ) {
					// Exiba a saída com o valor de 'couple_name'
					echo "<h1 class='section-title' style='text-align:left;'>Olá " . esc_html( $couple_name ) . "</h1>";
					echo "Endereço do seu site: <br>";
					echo '<a href="' . esc_url( $site_url ) . '">' . esc_url( $site_url ) . '</a>';
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
<?php if ( wp_is_mobile() ) : ?>
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
                <p class=.showStatistics">Estatísticas</p>
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
            <p class="text-left border-card">
                <span class="ellipse green"></span>
                Resgatado:
                <span class="text-right">R$ <?php echo number_format( floatval( $data['transferred_amount'] ) / 100, 2, ',', '.' ); ?></span>
            </p>
            <p class="text-left border-card-1">
                <span class="ellipse blue"></span>
                Disponível:
                <span class="text-right">R$ <?php echo number_format( floatval( $data['available_amount'] ) / 100, 2, ',', '.' ); ?></span>
            </p>
            <p class="text-left border-card-2">
                <span class="ellipse orange"></span>
                Crédito a Liberar:
                <span class="text-right">R$ <?php echo number_format( floatval( $data['waiting_funds_amount'] ) / 100, 2, ',', '.' ); ?></span>
            </p>
        </div>

        <div class="buttons-modal-payment">
            <a class="close">Fechar</a> <a href="/extrato">Ver Extrato</a>
        </div>
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        background-color: white;
        border-radius: 21px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        left: 50%;
        top: 40%;
        transform: translate(-50%, -50%);
        width: 326px;
        height: 479px;
        border: 1px solid #CCC;
    }

    .modal-content {
        padding: 20px;
        height: 300px;
        box-shadow: none;
        border: none;
    }

    .close {
        cursor: pointer;
        float: right;
        margin-right: 10px;
    }

    .buttons-modal-payment {
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        margin-top: 20px;
    }

    .buttons-modal-payment a {
        color: #556F44;
        font-family: Poligon;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 150%;
        text-decoration: none;
    }

    .title-modal-payment {
        color: #000;
        font-family: Poligon;
        font-size: 28px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
        text-align: center;
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .card-modal-payment {
        margin-top: 20px;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        float: right;
    }

    .ellipse {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .ellipse.green {
        background-color: #556F44;;
    }

    .ellipse.blue {
        background-color: #1F9FBC;
    }

    .ellipse.orange {
        background-color: #DAB054;
    }

    .border-card {
        padding: 20px 0px 20px 0px;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }

    .border-card-1 {
        padding: 10px 0px 20px 0px;
        border-bottom: 1px solid black;
    }

    .border-card-2 {
        padding: 10px 0px 20px 0px;
        border-bottom: 1px solid black;
    }
</style>
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
