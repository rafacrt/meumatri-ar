<?php
/**
 * Template Name: Esqueci minha Senha
 */

get_header();

if (isset($_POST['reset_password_email'])) {
    $user_email = $_POST['reset_password_email'];
    $user = get_user_by('email', $user_email);

    if ($user) {
        $reset_key = wp_generate_password(20, false);
        update_user_meta($user->ID, 'reset_password_key', $reset_key);

        // Enviar e-mail com o link de redefinição de senha para o usuário
        $reset_link = get_permalink() . '?reset_key=' . $reset_key . '&user_login=' . $user->user_login;
        $email_subject = 'Redefinir Senha';
        $email_message = 'Para redefinir sua senha, clique no link a seguir: ' . $reset_link;
        wp_mail($user->user_email, $email_subject, $email_message);

        // Redirecionar para a página de sucesso após o envio do email
        $success_url = get_permalink() . '?reset_email_sent=1';
        wp_redirect($success_url);
        exit;
    } else {
        $error_message = 'E-mail não encontrado.';
    }
}
?>
<section class="home login">
    <div id="primary" class="content-area">
        <div id="main" class="site-main">
            <h1 class="section-title">Esqueceu sua senha?</h1>
            <p class="section-sub-title">Insira seu e-mail abaixo e lhe enviaremos um link de recuperação.</p>
            <div class="reset-password-form">
                <?php if (isset($error_message)) : ?>
                    <div class="reset-error"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <?php if (isset($_GET['reset_email_sent']) && $_GET['reset_email_sent'] === '1') : ?>
                    <div class="reset-success">Um e-mail com o link para redefinir sua senha foi enviado.</div>
                <?php endif; ?>

                <form method="post" class="reset-password-form">
                    <input type="email" name="reset_password_email" placeholder="Digite seu e-mail" required>
                    <input class="btn" type="submit" name="reset_password_submit" value="Enviar Link">
                </form>
            </div>
        </div>
    </div>
</section>
<style>
    /* LOGIN STYLES */
    .home.login {
        padding: 160px 8px;
        text-align: center;
        max-width: 400px;
        margin: 0 auto;
        background: transparent;
    }

    #main>h1.section-title {
        font-size: clamp(24px, 2.5vw, 48px);
        line-height: 150%;
        color: #101828;
        text-align: center;
    }

    #main>p.section-sub-title {
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        text-align: center;
        color: #475467;
    }

    .login>.form-group>form>input:not([type='submit']) {
        box-sizing: border-box;
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 10px 14px;
        margin: 16px auto;
        width: 95%;
        height: 44px;
        border: 1px solid #D0D5DD;
        box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
        border-radius: 8px;

    }

    .login>.form-group>form>input[type='submit'] {
        width: 95%;
        margin: 0 auto;
        padding: 15px 26px;
    }

    .divider {
        display: inline-block;
        width: 40%;
        height: 1px;
        background: #EAECF0;
        vertical-align: middle;
    }

    .divider-text {
        margin: 24px auto;
        font-style: normal;
        font-weight: 500;
        font-size: 14px;
        line-height: 20px;
        text-align: center;
        color: #475467;
    }
    input.btn {
    padding: 8px 16px;
    font-size: 20px;
    line-height: 120%;
    letter-spacing: 0;
    cursor: pointer;
    text-decoration: none;
    color: #FFF;
    background-color: #A2AD84;
    margin: 0 auto;
    transition: background-color .3s, color .3s;
}
</style>
<?php
get_footer();
