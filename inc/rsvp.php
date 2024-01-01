<?php
ob_start();
function cadastrar_rsvp() {
    $response = array();

    // Obtenha os dados do formulário
    $rsvpName = sanitize_text_field($_POST['rsvpName']);
    $adults_number = intval($_POST['adults_number']);
    $kids_number = intval($_POST['kids_number']);
    $email = sanitize_email($_POST['email']);
    $telefone = sanitize_text_field($_POST['telefone']);

    // Verifique se os dados são válidos (adicione suas próprias validações)

    if (empty($rsvpName) || empty($email)) {
        $response['status'] = 'error';
        $response['message'] = 'Por favor, preencha todos os campos obrigatórios.';
    } else {
        // Obtém o ID do subsite atual
        $subsite_id = get_current_blog_id();

        // Crie o post type "rsvp" no subsite atual
        switch_to_blog($subsite_id);

        $post_data = array(
            'post_title' => $rsvpName,
            'post_type' => 'rsvp', // Defina o tipo de post
            'post_status' => 'publish',
        );

        $post_id = wp_insert_post($post_data);

        // Salve os metadados personalizados (campos do formulário) como metadados do post
        update_post_meta($post_id, 'adults_number', $adults_number);
        update_post_meta($post_id, 'kids_number', $kids_number);
        update_post_meta($post_id, 'email', $email);
        update_post_meta($post_id, 'telefone', $telefone);

        if ($post_id) {
            $response['status'] = 'success';
            $response['message'] = 'Confirmação de presença realizada com sucesso';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Houve um erro ao salvar a confirmação de presença.';
        }

        // Restaure o subsite atual
        restore_current_blog();
    }

    // Retorne a resposta em formato JSON
    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_nopriv_cadastrar_rsvp', 'cadastrar_rsvp');
add_action('wp_ajax_cadastrar_rsvp', 'cadastrar_rsvp');

function excluir_convidado() {
    $convidadoID = $_POST['convidado_id'];

    // Verifique se o usuário tem permissão para excluir o convidado

    // Realize a exclusão do convidado com base no ID
    $success = wp_delete_post($convidadoID, true);

    // Retorne uma resposta de sucesso ou erro em formato JSON
    $response = array();

    if ($success) {
        $response['status'] = 'success';
        $response['message'] = 'Convidado excluído com sucesso.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Erro ao excluir o convidado.';
    }

    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_excluir_convidado', 'excluir_convidado');
add_action('wp_ajax_nopriv_excluir_convidado', 'excluir_convidado');