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
        text-align: center;
    }

    .withdraw h3 {
        color: #101828;
        text-align: center;
        font-family: Inter;
        font-size: 26px;
        font-style: normal;
        font-weight: 600;
        line-height: 32px;
        margin-bottom: 15px;
    }

    .withdraw a {
        text-decoration: none;
        text-align: center;
    }

    .withdraw-success{
        color: #00a32a;
    }
    .withdraw-error {
        color: #bb2020;
    }
</style>
<section class="hero-dashboar-index" style="margin-top:20px">
    <div class="withdraw">
        <h3><span class="withdraw-success">Resgate efetuado com sucesso!</span></h3>
        <a href="/painel">Voltar para o Dashboard</a>
    </div>
<!--    <div class="withdraw">
        <h3> <span class="withdraw-error">Erro ao solicitar o resgate, tente novamente mais tarde!</span></h3>
        <a href="/painel">Voltar para o Dashboard</a>
    </div>-->
</section>
