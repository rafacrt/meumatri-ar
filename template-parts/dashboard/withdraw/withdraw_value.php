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
    .withdraw {
        padding: 20px;
    }

    .form-group{
        padding: 10px;
    }

    .withdraw h3 {
        color: #101828;
        text-align: center;
        font-family: Inter;
        font-size: 24px;
        font-style: normal;
        font-weight: 600;
        line-height: 32px;
        margin-bottom: 15px;
    }

    .withdraw p {
        color: rgba(0, 0, 0, 0.80);
        text-align: left;
        font-family: Inter;
        font-size: 18px;
        font-style: normal;
        font-weight: 700;
        line-height: 150%;
    }

    .withdraw label {
        color: #5A6D50;
        font-family: Inter;
        font-size: 18px;
        font-style: normal;
        font-weight: 700;
        line-height: 150%;
    }

    .withdraw input[type="text"] {
        border: none !important;
        border-bottom: 1px solid #000 !important;
        border-radius: 0px !important;
       }
    .btn{
        color: white;
    }
</style>
<section class="hero-dashboar-index" style="margin-top:20px">
    <div class="withdraw">
        <h3>Valor do Resgate</h3>
        <form action="">
            <p>Saldo Disponível: R$ <?php echo number_format( floatval( $data['available_amount'] ) / 100, 2, ',', '.' ); ?></p>
            <p style="font-size: 11px; font-weight: 300; margin-top:-15px !important; color: #C00;">Saldo a liberar: R$ <?php echo number_format( floatval( $data['waiting_funds_amount'] ) / 100, 2, ',', '.' ); ?></p>
            <div class="form-group">
                <label for="">Quanto deseja resgatar?</label>
                <input type="text" class="form-control" name="nome_completo" placeholder="R$ "/>
                <small>Valor mínimo: R$0,01</small>
            </div>
            <div class="form-group">
                <!--<input type="submit" class="btn" style="width: 70%;" value="Continuar"/>-->
                <a href="/confirmacao-do-resgate" class="btn" style="width: 70%; padding-top: 10px;">Solicitar Resgate</a>
            </div>
        </form>
    </div>
</section>
