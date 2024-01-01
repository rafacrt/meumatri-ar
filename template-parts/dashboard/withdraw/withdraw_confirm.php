<?php
require get_template_directory() . '/inc/icons.php';
$current_user = wp_get_current_user();
$username = $current_user->user_login;
$user_id = $current_user->ID;
$active_blog = get_active_blog_for_user($user_id);
$site_id = $active_blog->blog_id;
$couple = get_blog_option($site_id, 'pagarme_recipient_id');
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
</style>
<section class="hero-dashboar-index" style="margin-top:20px">
    <div class="withdraw">
        <h3>Confirmação</h3>
        <form action="">
            <p>Detalhes</p>
            <div class="form-group">
                <p>Valor solicitado: <span>R$795</span></p>
                <p>Taxa de Transferência: <span>Gratutita</span></p>
            </div>
            <div class="form-group">
                <p>Data de solicitação</p>
                <p>22/10/2023</p>
                <p><small>Os valores serão transferidos em 2 dias úteis após a data de solicitação</small></p>
            </div>
            <hr>
            <p style="margin-top: 40px;">Dados de Pagamento</p>
            <p>Dados para nota fiscal:</p>
            <div class="form-group">
                <p><strong>Nome completo</strong></p>
                <p>RENAN ASSENCIO</p>
            </div>
            <div class="form-group">
                <p><strong>CPF</strong></p>
                <p>34276598022</p>
            </div>
            <p style="margin-top: 40px;">Dados Bancários</p>
            <div class="form-group">
                <p><strong>Nome completo</strong></p>
                <p>RENAN ASSENCIO</p>
            </div>
            <div class="form-group">
                <p><strong>CPF</strong></p>
                <p>34276598022</p>
            </div>
            <div class="form-group">
                <p><strong>Instituição bancária</strong></p>
                <p>336 - C6 S.A</p>
            </div>
            <div class="form-group">
                <p><strong>Instituição bancária</strong></p>
                <p>336 - C6 S.A</p>
            </div>
            <div class="form-group">
                <div>
                    <p><strong>Agência</strong></p>
                    <p>7139</p>
                </div>
                <div>
                    <p><strong>Conta Corrente</strong></p>
                    <p>01074456-9</p>
                </div>
            </div>
            <div class="form-group">
                <!--<input type="submit" class="btn" style="width: 70%;" value="Continuar"/>-->
                <a href="/comprovante-de-resgate" class="btn" style="width: 70%;"></a>
            </div>
        </form>
    </div>
</section>
