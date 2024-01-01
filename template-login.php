<?php
/* Template Name: Login*/

if (is_user_logged_in()) {
    wp_redirect(site_url() . '/painel');
    exit;
}

$google = get_template_directory_uri() . '/assets/images/common/login-with-google.png';
$facebook = get_template_directory_uri() . '/assets/images/common/login-with-facebook.png';
$apple = get_template_directory_uri() . '/assets/images/common/login-with-apple.png';
//get_template_part('wp-content/plugins/ultimate-member/templates/register.php');
get_header();
?>
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
        color: #101828;
        font-family: Inter;
        font-size: 24px;
        font-weight: 600;
        line-height: 32px;
        letter-spacing: 0em;
        text-align: center;

    }

    .home.login>p.section-sub-title {
        font-family: Inter;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        letter-spacing: 0em;
        text-align: center;
        color: #101828; 
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
        font-family: Inter;
        font-size: 18px;
        font-weight: 600;
        line-height: 27px;
        letter-spacing: 0em;
        text-align: center;
        background-color: #283F3B;

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
        font-family: Inter;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        letter-spacing: 0em;
        text-align: center;
        color:#475467;

    }
    .login-text-small{
        font-family: Inter;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        letter-spacing: 0em;
        margin: 10px 0px 30px 10px;

    }
    .button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    }

</style>

<section class="home login">
    <h1 class="section-title">Bem vindo de volta!</h1>
    <p class="section-sub-title">Faça login na sua conta</p>
    <div class="form-group">
        <form name="loginform" id="loginform" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>" method="post">
            <input type="text" name="log" id="user_login" class="input" value="" size="20" placeholder="E-mail" />
            <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" placeholder="Senha" />
            <input type="submit" name="wp-submit" id="wp-submit" class="btn" value="Continuar" />
            <p class="login-text-small"><small>Ainda não tem uma conta? <a href="/cadastro">Clique aqui</a></small></p>
        </form>
    </div>

    <p class="divider-text"><span class="divider"></span> Ou <span class="divider"></span></p>
    <div class="login-options">
        <a href="https://accounts.google.com/o/oauth2/auth?client_id=722833543778-rpqjjnhqoidugejo46pv82jcvs6dcui9.apps.googleusercontent.com&redirect_uri=<?php echo home_url('/login'); ?>&scope=email&response_type=code"><img src="<?= $google ?>" alt="" width="95%"></a>
        <a style="cursor:pointer;" id="facebook-login-button"><img src="<?= $facebook ?>" alt="" width="95%"></a>
        <!-- <a><img src="<?php //$apple ?>" alt="" width="95%"></a> -->
    </div>


    <div class="button-container">
        <a class="login-text-small" href="/recuperar-senha">Esqueci minha senha</a>
        <label for="rememberme"><input type="checkbox" name="rememberme" id="rememberme" value="forever"> Lembrar-me</label>
    </div>

   
    <?php if ($_GET['password'] == 'changed') : ?>
            <p>Sua senha foi alterada com sucesso. Você pode agora fazer login com sua nova senha.</p>
        <?php endif; ?>
</section>

<script>
document.getElementById('facebook-login-button').addEventListener('click', function() {
    var facebookAppId = '280703424706156'; // Substitua pelo seu App ID.
    var redirectUri = encodeURIComponent('<?php echo home_url('/login?AuthSocial=Facebook'); ?>');
    var facebookLoginUrl = 'https://www.facebook.com/v13.0/dialog/oauth?client_id=' + facebookAppId + '&redirect_uri=' + redirectUri + '&scope=email';
    window.location.href = facebookLoginUrl;
});
</script>
