<?php
ob_start();

function validar_usuario() {
    // Verifique se as chaves do array estão definidas
    if (isset($_POST['coupleName'], $_POST['cpf'], $_POST['userLogin'], $_POST['userPass'], $_POST['userPassConfirm'])) {
        // Recupere os dados do formulário
        $coupleName = sanitize_text_field($_POST['coupleName']);
        $cpf = sanitize_text_field($_POST['cpf']);
        $userLogin = sanitize_email($_POST['userLogin']);
        $userPass = sanitize_text_field($_POST['userPass']);
        $userPassConfirm = sanitize_text_field($_POST['userPassConfirm']);
        $template = sanitize_text_field($_POST['templateBlog']);
        $template = str_replace('.php', '', $template);

        // Verifique se o e-mail já está cadastrado
        if (email_exists($userLogin)) {
            $response = array('status' => 'email_exists', 'message' => 'E-mail já está em uso.');
            echo json_encode($response);
        } else {
            // Verifique se a senha e a confirmação de senha coincidem
            if ($userPass === $userPassConfirm) {
                $user_id = wp_create_user($userLogin, $userPass, $userLogin);
                if (is_wp_error($user_id)) {
                    $response = array('status' => 'error', 'message' => 'Erro ao criar usuário.');
                    echo json_encode($response);
                } else if (!is_wp_error($user_id)) {
                    $main_domain = get_network()->domain;
                    $cleanedCoupleName = str_replace(' ', '', strtolower($coupleName));
                    $new_blog_id = wpmu_create_blog($main_domain, '/' . $cleanedCoupleName . '/', $coupleName, $user_id, array('public' => 1));

                    if (!is_wp_error($new_blog_id)) {
                        add_user_to_blog($new_blog_id, $user_id, 'subscriber');

                        // Adicione um metadado para o nome do casal
                        update_user_meta($user_id, 'couple_name', $coupleName);

                        // Recupere os dados do localStorage
                        $locaStorageInfoSite = json_encode($_POST['locaStorageInfoSite'], true);

                        // Salve os dados do localStorage como uma opção do subsite
                        switch_to_blog($new_blog_id);
                        switch_theme('meumatri');
                        update_option('locaStorageInfoSite', $locaStorageInfoSite);
                        update_option('template_blog', $template);
                        restore_current_blog();

                        // Cria uma conta de Recebedor dentro do Pagar.me
                        $recipientData = [
                            "default_bank_account" => [
                                "holder_name" => $coupleName,
                                "bank" => "341",
                                "branch_number" => "1234",
                                "account_number" => "12345",
                                "account_check_digit" => "6",
                                "holder_type" => "individual",
                                "holder_document" => $cpf,
                                "type" => "checking"
                            ],
                            "name" => $coupleName,
                            "email" => $userLogin,
                            "document" => $cpf,
                            "type" => "individual",
                            "code" => $new_blog_id
                        ];

                        // Fazer a chamada para criar o recebedor na API
                        $createRecipient = postDataApi('recipients', $recipientData);
                        switch_to_blog($new_blog_id);
                        update_option('pagarme_recipient_id', $createRecipient->id);
                        restore_current_blog();

                        wp_set_auth_cookie($user_id);

                        $cleanedCoupleName = preg_replace('/[^a-zA-Z0-9]+/', '', $coupleName);
                        $url_site = $cleanedCoupleName;

                        $response = array('status' => 'success', 'message' => 'Registro bem-sucedido.', 'url_site' => $url_site);
                        echo json_encode($response);
                    }
                }
            } else {
                $response = array('status' => 'password_mismatch', 'message' => 'Senhas não correspondem.');
                echo json_encode($response);
            }
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Dados do formulário incompletos.');
        echo json_encode($response);
    }
    die();
}

add_action('wp_ajax_nopriv_validar_usuario', 'validar_usuario');
