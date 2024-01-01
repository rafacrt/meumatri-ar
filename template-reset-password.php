<?php
/**
 * Template Name: Redefinir Senha
 */

get_header();

if (isset($_GET['reset_key']) && isset($_GET['user_login'])) {
    $reset_key = $_GET['reset_key'];
    $user_login = $_GET['user_login'];

    $user = get_user_by('login', $user_login);
    if ($user) {
        $stored_reset_key = get_user_meta($user->ID, 'reset_password_key', true);

        if ($stored_reset_key === $reset_key) {
            if (isset($_POST['reset_password_submit'])) {
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];

                if ($new_password === $confirm_password) {
                    wp_set_password($new_password, $user->ID);
                    delete_user_meta($user->ID, 'reset_password_key');

                    // Enviar e-mail com a nova senha para o usuário
                    $email_subject = 'Sua senha foi redefinida';
                    $email_message = 'Sua senha foi redefinida com sucesso. Sua nova senha é: ' . $new_password;
                    wp_mail($user->user_email, $email_subject, $email_message);

                    // Redirecionar para a página de login com mensagem de sucesso
                    $login_url = wp_login_url();
                    wp_redirect(add_query_arg('reset_success', '1', $login_url));
                    exit;
                } else {
                    $error_message = 'As senhas não coincidem.';
                }
            }
        } else {
            $error_message = 'Link inválido de redefinição de senha.';
        }
    } else {
        $error_message = 'Usuário não encontrado.';
    }
} else {
    $error_message = 'Link inválido de redefinição de senha.';
}
?>
<section class="home login">
<div id="primary" class="content-area">
    <div id="main" class="site-main">
        <div class="reset-password-form">
            <?php if (isset($error_message)) : ?>
                <div class="reset-error"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form method="post" class="reset-password-form">
                <input type="password" name="new_password" placeholder="Nova senha" required>
                <input type="password" name="confirm_password" placeholder="Confirmar nova senha" required>
                <input type="hidden" name="reset_key" value="<?php echo esc_attr($reset_key); ?>">
                <input type="hidden" name="user_login" value="<?php echo esc_attr($user_login); ?>">
                <input class="btn" type="submit" name="reset_password_submit" value="Redefinir Senha">
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

    .home.login>h1.section-title {
        font-size: clamp(24px, 2.5vw, 48px);
        line-height: 150%;
        color: #101828;
    }

    .home.login>p.section-sub-title {
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
