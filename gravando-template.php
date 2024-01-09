<?php
/*
 Template Name: Grava dados
 */

global $wpdb;
$current_user = wp_get_current_user();

if (isset($_GET['nomeCasal'], $_GET['dataCasal'], $_GET['chosenTemplate'])) {
    $nome_casal = sanitize_text_field($_GET['nomeCasal']);
    $data_casal = sanitize_text_field($_GET['dataCasal']);
    $template_escolhido = sanitize_text_field($_GET['chosenTemplate']);

    // Lógica para criar a nova página com os dados recebidos
    $new_page = array(
        'post_type'     => 'page',
        'post_title'    => 'Página do Casal ' . $nome_casal,
        'post_content'  => 'Aqui vai o conteúdo do template ' . $template_escolhido, // Substitua com o conteúdo real do template
        'post_status'   => 'publish',
        'post_author'   => $current_user->ID,
    );

    $post_id = wp_insert_post($new_page);

    if ($post_id) {
        // Cria um novo sub-site (blog) no WordPress Multisite
        $domain = 'meumatri.com';
        $path = '/'. sanitize_title($nome_casal) .'/';
        $title = 'Casamento de ' . $nome_casal;
        $user_id = $current_user->ID; // Ou o ID de um administrador do site

        $new_site_id = wpmu_create_blog($domain, $path, $title, $user_id);

        if (is_wp_error($new_site_id)) {
            echo "Erro ao criar o sub-site: " . $new_site_id->get_error_message();
            exit;
        }

        // Salva a escolha do template nos metadados do novo sub-site
        switch_to_blog($new_site_id);
        update_option('chosen_theme', $template_escolhido);
        restore_current_blog();

        // Redireciona para a nova página ou exibe uma mensagem de sucesso
        echo "<script>window.location.href = '" . get_permalink($post_id) . "';</script>";
        exit;
    } else {
        echo "Erro ao criar a página.";
    }
}
?>
