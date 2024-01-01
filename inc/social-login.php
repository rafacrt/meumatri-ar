<?php

ob_start();

if (isset($_GET['code'])) {
    $redirect_uri = sanitize_text_field($_SERVER['REQUEST_URI']);
    if (strpos($redirect_uri, '/login?AuthSocial=Facebook') !== false) {
        handle_facebook_login();
    } elseif (strpos($redirect_uri, '/login') !== false) {
        handle_google_login();
    } elseif (strpos($redirect_uri, '/login?AuthSocial=Apple') !== false) {
        // Lidar com o login da Apple (se necessário).
    }
}

function handle_facebook_login() {
    $facebook_app_id = '280703424706156';
    $facebook_app_secret = 'b787917f2d4616d177ef4c8c2480de80';
    $redirect_url = home_url('/login?AuthSocial=Facebook');
    $code = $_GET['code'];

    // Solicitar token de acesso do Facebook.
    $token_data = [
        'client_id' => $facebook_app_id,
        'client_secret' => $facebook_app_secret,
        'redirect_uri' => $redirect_url,
        'code' => $code,
    ];

    $token_response = wp_safe_remote_get("https://graph.facebook.com/v13.0/oauth/access_token?" . http_build_query($token_data));

    if (is_wp_error($token_response)) {
        echo 'Erro na solicitação do token de acesso: ' . $token_response->get_error_message();
        exit;
    }

    $token_body = wp_remote_retrieve_body($token_response);
    $token_data = json_decode($token_body, true);

    if (!isset($token_data['access_token'])) {
        echo "Token de acesso não recebido do Facebook.";
        exit;
    }

    $access_token = $token_data['access_token'];

    // Obter informações do usuário do Facebook.
    $user_info_url = "https://graph.facebook.com/v13.0/me?fields=id,email,first_name,last_name&access_token={$access_token}";

    $user_response = wp_safe_remote_get($user_info_url);

    if (is_wp_error($user_response)) {
        echo 'Erro na solicitação das informações do usuário: ' . $user_response->get_error_message();
        exit;
    }

    $user_body = wp_remote_retrieve_body($user_response);
    $user_data = json_decode($user_body, true);

    handle_social_user_data($user_data);
}

function handle_google_login() {
    $client_id = '722833543778-rpqjjnhqoidugejo46pv82jcvs6dcui9.apps.googleusercontent.com';
    $client_secret = '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';
    $redirect_uri = home_url('/login');
    $code = $_GET['code'];

    // Solicitar token de acesso do Google.
    $token_data = [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code',
    ];

    $token_response = wp_safe_remote_post('https://accounts.google.com/o/oauth2/token', [
        'body' => $token_data,
    ]);

    if (is_wp_error($token_response)) {
        echo 'Erro na solicitação do token de acesso: ' . $token_response->get_error_message();
        exit;
    }

    $token_body = wp_remote_retrieve_body($token_response);
    $token_data = json_decode($token_body, true);

    if (!isset($token_data['access_token'])) {
        echo "Token de acesso não recebido do Google.";
        exit;
    }

    // Obter informações do usuário do Google.
    $user_data_url = 'https://www.googleapis.com/oauth2/v1/userinfo';
    $user_response = wp_safe_remote_get($user_data_url . '?access_token=' . $token_data['access_token']);

    if (is_wp_error($user_response)) {
        echo 'Erro na solicitação das informações do usuário: ' . $user_response->get_error_message();
        exit;
    }

    $user_body = wp_remote_retrieve_body($user_response);
    $user_data = json_decode($user_body, true);

    handle_social_user_data($user_data);
}

function handle_social_user_data($user_data) {
    $user_email = $user_data['email'];

    // Verificar se o usuário já existe no WordPress.
    $existing_user = get_user_by('email', $user_email);

    if ($existing_user) {
        // O usuário já existe, faça o login.
        wp_set_auth_cookie($existing_user->ID, true);
        wp_redirect(home_url('/painel'));
        exit;
    } else {
        // O usuário não existe, registre-o.
        $username = sanitize_user($user_data['email']);
        $password = wp_generate_password();
        $user_id = wp_create_user($username, $password, $user_email);

        if (!is_wp_error($user_id)) {
            // Faça o login para o novo usuário.
            wp_set_auth_cookie($user_id, true);
            wp_redirect(home_url('/painel'));
            exit;
        } else {
            echo 'Erro ao criar usuário no WordPress: ' . $user_id->get_error_message();
            exit;
        }
    }
}
