<?php
// Função para criar a tabela personalizada
function criar_tabela_rsvp() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'rsvp_data'; // Substitua 'rsvp_data' pelo nome que desejar

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        attendance BOOLEAN NOT NULL,
        adults_number INT NOT NULL,
        kids_number INT NOT NULL,
        email VARCHAR(255) NOT NULL,
        tel VARCHAR(20) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_setup_theme', 'criar_tabela_rsvp');




// Função para processar o envio do formulário
function processar_formulario_rsvp() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Certifique-se de que os campos necessários foram preenchidos
        if (isset($_POST['name']) && isset($_POST['boolean']) && isset($_POST['email'])) {
            global $wpdb;

            // Substitua 'nome_da_tabela' pelo nome real da tabela onde deseja armazenar os dados
            $table_name = $wpdb->prefix . 'rsvp_data';

            $name = sanitize_text_field($_POST['name']);
            $boolean = $_POST['boolean'] === 'true' ? true : false;
            $adults_number = intval($_POST['adults_number']);
            $kids_number = intval($_POST['kids_number']);
            $email = sanitize_email($_POST['email']);
            $tel = sanitize_text_field($_POST['tel']);

            $data = array(
                'name' => $name,
                'attendance' => $boolean,
                'adults_number' => $adults_number,
                'kids_number' => $kids_number,
                'email' => $email,
                'tel' => $tel
            );

            // Insira os dados na tabela
            $wpdb->insert($table_name, $data);

            // Redirecione ou exiba uma mensagem de confirmação aqui
        }
    }
}
?>
