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
    .btn{
        color: white;
    }
</style>
<section class="hero-dashboar-index" style="margin-top:20px">
    <div class="withdraw">
        <h3>Informe os seus dados</h3>
        <form action="">
            <p>Dados para nota fiscal</p>
            <div class="form-group">
                <label for="">Nome Completo</label>
                <input type="text" class="form-control" required name="nome_completo"/>
            </div>
            <div class="form-group">
                <label for="">CPF</label>
                <input type="text" class="form-control" required name="cpf"/>
            </div>
            <p style="margin-top: 40px;">Dados para pagamento</p>
            <div class="form-group">
                <label for="">Banco</label>
                <input type="text" class="form-control" required name="banco"/>
            </div>
            <div class="form-group">
                <label for="">Agência</label>
                <input type="text" class="form-control" required name="agencia"/>
            </div>
            <div class="form-group">
                <div>
                    <label for="">Conta Corrente</label>
                    <input type="text" class="form-control" required name="conta"/>
                </div>
                <div>
                    <label for="">Dígito</label>
                    <input type="text" class="form-control" required name="digito"/>
                </div>
            </div>
            <div class="form-group" style="margin-top:20px;margin-bottom:20px;">
                <input type="checkbox" id="aceite">
                Salvar dados para resgates futuros
            </div>
            <div class="form-group">
                <button type="submit" href="resgate/valor-do-resgate" class="btn" style="width: 70%; padding-top: 0px;">Avançar</button>
            </div>
        </form>
    </div>
</section>
