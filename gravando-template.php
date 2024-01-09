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

    // Determina o caminho do template escolhido
    $template_path = get_template_directory() . '/template-parts/template-' . $template_escolhido . '.php';
    
    if (file_exists($template_path)) {
        ob_start();
        include($template_path);
        $content = ob_get_clean();
    } else {
        $content = 'Template escolhido não encontrado.';
    }

    // Lógica para criar a nova página com os dados e conteúdo do template
    $new_page = array(
        'post_type'     => 'page',
        'post_title'    => 'Página do Casal ' . $nome_casal,
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_author'   => $current_user->ID,
    );

    // Insere a página no banco de dados
    $post_id = wp_insert_post($new_page);

    // Atualiza meta campos com informações personalizadas
    update_post_meta($post_id, 'nome_do_casal', $nome_casal);
    update_post_meta($post_id, 'data_do_evento', $data_casal);

    if ($post_id) {
        // Supondo que você tenha o ID do novo sub-site aqui
        $new_site_id = ...; // Substitua com a lógica para obter o ID do novo sub-site

        // Salva a escolha do template nos metadados do novo sub-site
        update_blog_option($new_site_id, 'chosen_theme', $template_escolhido);

        // Redireciona para a nova página ou exibe uma mensagem de sucesso
        echo "<script>window.location.href = '" . get_permalink($post_id) . "';</script>";
        exit;
    } else {
        echo "Erro ao criar a página.";
    }
}
?>
