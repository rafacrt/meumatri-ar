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
 
     // Insere a página no banco de dados
     $post_id = wp_insert_post($new_page);
 
     // Atualiza meta campos com informações personalizadas
     update_post_meta($post_id, 'nome_do_casal', $nome_casal);
     update_post_meta($post_id, 'data_do_evento', $data_casal);
 
     if ($post_id) {
         // Redireciona para a nova página ou exibe uma mensagem de sucesso
         echo "<script>window.location.href = '" . get_permalink($post_id) . "';</script>";
         exit;
     } else {
         echo "Erro ao criar a página.";
     }
 }
?>

<script>
    jQuery(document).ready(function ($) {
        // Recupera os dados do localStorage
        var nomeCasal = localStorage.getItem('nomeCasal');
        var dataCasal = localStorage.getItem('dataCasal');
        var chosenTemplate = localStorage.getItem('chosenTemplate');

        // Envia os dados para o servidor
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'salvar_template',
                nome_casal: nomeCasal,
                data_casal: dataCasal,
                template_escolhido: chosenTemplate
            },
            success: function (response) {
                // Trate a resposta aqui, se necessário
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