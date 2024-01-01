
<?php
/**
 * Processar redefinição de senha
 */
function custom_reset_password() {
    if (isset($_POST['reset_password_submit'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $reset_key = $_POST['reset_key'];
        $user_login = $_POST['user_login'];

        $user = get_user_by('login', $user_login);
        if ($user) {
            $stored_reset_key = get_user_meta($user->ID, 'reset_password_key', true);

            if ($stored_reset_key === $reset_key) {
                if ($new_password === $confirm_password) {
                    // Gerar uma nova chave de redefinição de senha e armazená-la no perfil do usuário.
                    $new_reset_key = wp_generate_password(20, false);
                    update_user_meta($user->ID, 'reset_password_key', $new_reset_key);

                    // Redirecionar para a página de redefinição de senha com a nova chave.
                    $reset_password_url = get_permalink() . '?reset_key=' . $new_reset_key . '&user_login=' . $user_login;
                    wp_redirect($reset_password_url);
                    exit;
                } else {
                    $error_message = 'As senhas não coincidem.';
                }
            } else {
                $error_message = 'Link inválido de redefinição de senha.';
            }
        } else {
            $error_message = 'Usuário não encontrado.';
        }
    }

    if (isset($_GET['reset_success']) && $_GET['reset_success'] === '1') {
        // Exibir mensagem de sucesso após a redefinição de senha.
        echo '<div class="reset-success">Senha redefinida com sucesso! Verifique seu e-mail para a nova senha.</div>';
    }
}
add_action('init', 'custom_reset_password');
