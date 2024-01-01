<?php
/* Template Name: Cadastro*/

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
        cursor: pointer;

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
        color: #475467;

    }

    .login-text-small {
        font-family: Inter;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        letter-spacing: 0em;
        margin: 10px 0px 30px 10px;

    }

    .btn {
        color: white !important;
    }

    .button-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .error-message {
        font-family: Inter;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        letter-spacing: 0em;
        text-align: center;
        color: #F06543;
        padding: 10px 10px 10px 10px;
    }
</style>

<section class="home login">
    <h1 class="section-title">Criar Conta</h1>
    <p class="section-sub-title">Crie sua conta gratuitamente e tenha acesso ao seu site editado!</p>
    <div class="form-group">
        <form name="loginform" id="registration-form" method="post">
            <input type="text" name="couple_name" id="couple_name" class="input" value="" size="20"
                placeholder="Nome do casal" />
            <input type="hidden" name="cpf" id="cpf" class="input" value="26224451990" maxlength="11"
                placeholder="CPF do recebedor" />
            <input type="email" name="user_login" id="user_login" class="input" value="" size="20"
                placeholder="E-mail" />
            <input type="password" name="user_pass" id="user_pass" class="input" value="" size="20"
                placeholder="Criar Senha" />
            <input type="password" name="user_pass_confirm" id="user_pass_confirm" class="input" value="" size="20"
                placeholder="Confirmar a senha" />
            <div id="password-error" class="error-message"></div>
            <input type="submit" name="register" class="btn" value="Continuar" />
            <div id="email-error" class="error-message"></div>
        </form>
    </div>

    <p class="divider-text"><span class="divider"></span> Ou <span class="divider"></span></p>
    <div class="login-options">
        <a
            href="https://accounts.google.com/o/oauth2/auth?client_id=722833543778-rpqjjnhqoidugejo46pv82jcvs6dcui9.apps.googleusercontent.com&redirect_uri=<?php echo home_url('/login'); ?>&scope=email&response_type=code"><img
                src="<?= $google ?>" alt="" width="95%"></a>
        <a style="cursor:pointer;" id="facebook-login-button"><img src="<?= $facebook ?>" alt="" width="95%"></a>
        <!-- <a><img src="<?php //$apple ?>" alt="" width="95%"></a> -->
    </div>


    <p class="login-text-small"><small>Já tem conta? <a href="/login">Entrar</a></small></p>

</section>
<script>
    document.getElementById('facebook-login-button').addEventListener('click', function () {
        var facebookAppId = '280703424706156'; // Substitua pelo seu App ID.
        var redirectUri = encodeURIComponent('<?php echo home_url('/login?AuthSocial=Facebook'); ?>');
        var facebookLoginUrl = 'https://www.facebook.com/v13.0/dialog/oauth?client_id=' + facebookAppId + '&redirect_uri=' + redirectUri + '&scope=email';
        window.location.href = facebookLoginUrl;
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    jQuery(document).ready(function () {
        // Verifica se o valor está armazenado no localStorage e o insere no campo
        var nomeCasal = localStorage.getItem('nomeCasal');
        if (nomeCasal) {
            jQuery('#couple_name').val(nomeCasal);
        }
        jQuery(document).ready(function () {
            function mapLocaStorageInfoSite() {
                var localStorageData = {};
                for (var i = 0; i < localStorage.length; i++) {
                    var key = localStorage.key(i);
                    var value = localStorage.getItem(key);
                    localStorageData[key] = value;
                }
                return localStorageData;
            }

            console.log(mapLocaStorageInfoSite())

            jQuery('#registration-form').on('submit', function (e) {
                e.preventDefault();

                var coupleName = jQuery('#couple_name').val();
                var cpf = jQuery('#cpf').val();
                var userLogin = jQuery('#user_login').val();
                var userPass = jQuery('#user_pass').val();
                var userPassConfirm = jQuery('#user_pass_confirm').val();
                var locaStorageInfoSite = mapLocaStorageInfoSite();
                var templateBlog = localStorage.getItem('current_template');

                jQuery('.error-message').text('');

                jQuery.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    data: {
                        action: 'validar_usuario',
                        coupleName: coupleName,
                        cpf: cpf,
                        userLogin: userLogin,
                        userPass: userPass,
                        userPassConfirm: userPassConfirm,
                        locaStorageInfoSite: locaStorageInfoSite,
                        templateBlog: templateBlog
                    },
                    beforeSend: function () {
                        jQuery(".loading-overlay").show();
                        jQuery(".btn").val("Enviando ...");
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.status === 'email_exists') {
                            jQuery('#email-error').text(data.message);
                            jQuery(".loading-overlay").hide();
                        } else if (data.status === 'password_mismatch') {
                            jQuery('#password-error').text(data.message);
                            jQuery(".loading-overlay").hide();
                        } else if (data.status === 'success') {
                            window.location.href = 'https://meumatri.com/painel';
                        } else {
                            jQuery('#password-error').text(data.message);
                            jQuery(".loading-overlay").hide();
                        }
                        jQuery(".btn").val("Continuar");
                    }
                });
            });
        });
    });
</script>