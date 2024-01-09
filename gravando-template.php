<?php
/*
 Template Name: Grava dados
 */

global $wpdb;
$current_user = wp_get_current_user();

if (isset($_POST['save'])) {
    // Validação e limpeza dos dados
    $template_choice = sanitize_text_field($_POST['template_choice']);
    $nome_casal = sanitize_text_field($_POST['nome_casal']);
    $data_evento = sanitize_text_field($_POST['data_evento']);

    // Atualiza o meta do usuário com a escolha do template
    update_user_meta($current_user->ID, 'chosen_template', $template_choice);

    // Cria uma nova página com o template específico
    $new_page = array(
        'post_type'     => 'page',
        'post_title'    => 'Página do Casal ' . $nome_casal,
        'post_content'  => 'Conteúdo personalizado aqui', // Adicione o conteúdo do template aqui
        'post_status'   => 'publish',
        'post_author'   => $current_user->ID,
        'page_template' => 'template-jardim.php' // Especifica o template
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
}
?>

<script>
jQuery(document).ready(function($) {
    // Recupera os dados do localStorage
    var nomeCasal = localStorage.getItem('nomeCasal');
    var dataCasal = localStorage.getItem('dataCasal');
    var chosenTemplate = localStorage.getItem('chosenTemplate');

    // Envia os dados para o servidor
    $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
        data: {
            'action': 'salvar_template',
            'nome_casal': nomeCasal,
            'data_casal': dataCasal,
            'template_escolhido': chosenTemplate
        },
        success: function(response) {
            // Trate a resposta aqui
            if(response.success) {
                window.location.href = response.redirect_url; // Redireciona para a nova página
            } else {
                alert("Erro ao criar a página: " + response.error);
            }
        }
    });
});
</script>


<!-- HTML para o formulário -->
<!--
<form action="" method="post">
    <input type="text" name="nome_casal" id="nome_casal" placeholder="Nome do Casal" required>
    <br>
    <input type="text" name="data_evento" id="data_evento" placeholder="Data do Evento" required>
    <br>
    <input type="hidden" name="template_choice" value="nome_do_template">
    <br>
    <input type="submit" value="Salvar" name="save">
</form>

-->