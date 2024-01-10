<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); // Carrega o WordPress
global $wpdb;

if(isset($_POST['nomecasal']) && isset($_POST['datecasal']) && isset($_POST['templateName'])) {
    $nome_casal = $_POST['nomecasal'];
    $date_casal = $_POST['datecasal'];
    $template = $_POST['templateName'];

$current_user = wp_get_current_user();

$new_page = array(
    'post_type'     => 'page',
    'post_title'    => 'Página do Casal ' . $nome_casal,
    'post_content'  => 'Conteúdo personalizado aqui', // Adicione o conteúdo do template aqui
    'post_status'   => 'publish',
    'post_author'   => $current_user->ID,
    'page_template' => $template . '.php' // Especifica o template
);

$page_id = wp_insert_post($new_page);

if($page_id != 0) {
    echo "Página criada com sucesso.";
    $url = get_permalink($page_id);
    echo "<script>console.log('URL da nova página: $url');</script>";
    echo "<script>console.log('URL da nova página: $nome_casal');</script>";
} else {
    echo "Erro ao criar a página.";
}
} else {
    echo "Dados necessários não fornecidos.";
}

?>

<html>
    
    <body>
        <h1>Hello World!</h1>
    </body>
</html>