<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); // Carrega o WordPress

global $wpdb;

$nome_casal = sanitize_text_field($_POST['nomecasal']);
$data_evento = sanitize_text_field($_POST['datecasal']);
$template = sanitize_text_field($_POST['template']);

$current_user = wp_get_current_user();

$new_page = array(
    'post_type'     => 'page',
    'post_title'    => 'Página do Casal ' . $nome_casal,
    'post_content'  => 'Conteúdo personalizado aqui', // Adicione o conteúdo do template aqui
    'post_status'   => 'publish',
    'post_author'   => $current_user->ID,
    'page_template' => $template . '.php' // Especifica o template
);

// Insere a página no banco de dados
$post_id = wp_insert_post($new_page);

// Atualiza meta campos com informações personalizadas
update_post_meta($post_id, 'nome_do_casal', $nome_casal);
update_post_meta($post_id, 'data_do_evento', $data_evento);

if ($post_id) {
    // Redireciona para a nova página
    wp_redirect(get_permalink($post_id));
    exit;
} else {
    echo "Erro ao criar a página.";
}
?>