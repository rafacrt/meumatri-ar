<?php
require 'inc/setup.php';
require 'inc/menu.php';
require 'inc/social-login.php';
require 'inc/register.php';
//require 'inc/reset-password.php';
require 'inc/create-gift.php';
require 'inc/rsvp.php';
require 'inc/forms-rsvp.php';
require 'inc/payment/crudApi.php';
require 'custom_post_type/presentes.php';

function meu_matri_setup(){
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'meu_matri_setup');
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// function custom_menu_items($items, $args) {
//     if ($args->theme_location == 'menu-logado-mobile') {
//         $menu_items = array(
//             array(
//                 'title' => '<img src="https://meumatri.com/wp-content/uploads/2023/10/Icon_menu_dicas.png" /> Adicionar dicas',
//                 'url' => 'https://meumatri.com/dicas/'
//             ),
//             array(
//                 'title' => '<img src="https://meumatri.com/wp-content/uploads/2023/10/Icon_menu_edit_lista_presente.png" /> Editar Lista de Presentes',
//                 'url' => '#'
//             ),
//             array(
//                 'title' => '<img src="https://meumatri.com/wp-content/uploads/2023/10/Icon_menu_tx_presente.png" /> Taxa dos presentes',
//                 'url' => '#'
//             )
//         );

//         foreach ($menu_items as $menu_item) {
//             $items .= '<li class="menu-item"><a href="' . esc_url($menu_item['url']) . '">' . $menu_item['title'] . '</a></li>';
//         }
//     }
//     return $items;
// }
// add_filter('wp_nav_menu_items', 'custom_menu_items', 10, 2);

function create_dicas_post_type() {
    register_post_type('dicas',
        array(
            'labels' => array(
                'name' => __('Dicas'),
                'singular_name' => __('Dica')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'dicas'),
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}
add_action('init', 'create_dicas_post_type');

function create_tip_taxonomies() {
    // Taxonomia para Hotéis
    register_taxonomy(
        'hoteis',
        'dicas',
        array(
            'labels' => array(
                'name' => __('Hotéis'),
                'add_new_item' => __('Adicionar Novo Hotel'),
                'new_item_name' => __('Nome do Novo Hotel')
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'hoteis'),
            'hierarchical' => true,
        )
    );
    
    // Taxonomia para Restaurantes
    register_taxonomy(
        'restaurantes',
        'dicas',
        array(
            'labels' => array(
                'name' => __('Restaurantes'),
                'add_new_item' => __('Adicionar Novo Restaurante'),
                'new_item_name' => __('Nome do Novo Restaurante')
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'restaurantes'),
            'hierarchical' => true,
        )
    );
    
    // Taxonomia para Salão de Beleza
    register_taxonomy(
        'salao-de-beleza',
        'dicas',
        array(
            'labels' => array(
                'name' => __('Salão de Beleza'),
                'add_new_item' => __('Adicionar Novo Salão de Beleza'),
                'new_item_name' => __('Nome do Novo Salão de Beleza')
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'salao-de-beleza'),
            'hierarchical' => true,
        )
    );

    // Taxonomia para Outras dicas
    register_taxonomy(
        'outras',
        'dicas',
        array(
            'labels' => array(
                'name' => __('Outras Dicas'),
                'add_new_item' => __('Adicionar Outra Dica'),
                'new_item_name' => __('Nome da Nova Dica')
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'outras'),
            'hierarchical' => true,
        )
    );
}
add_action('init', 'create_tip_taxonomies');


function meu_matri_register_rest_route() {
    register_rest_route('meu-matri/v1', '/busca-localizacao/', array(
        'methods' => 'GET',
        'callback' => 'busca_localizacao_callback',
    ));
}

add_action('rest_api_init', 'meu_matri_register_rest_route');

// Adicione isso ao seu arquivo functions.php
function register_add_dica_route() {
    register_rest_route('meu-matri/v1', '/adicionar-dica/', array(
        'methods' => 'POST',
        'callback' => 'add_dica_handler',
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'register_add_dica_route');

function add_dica_handler(WP_REST_Request $request) {
  
    $params = $request->get_params();
    if (isset($params['nome'], $params['endereco'], $params['lat'], $params['lng'], $params['place_id'])) {

        $files = $request->get_file_params();

        if (!empty($files['imagem'])) {
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
    
            // Lidar com o upload da imagem
            $file_handler = 'imagem';
            $attach_id = media_handle_upload($file_handler, 0);
        }

        
        $post_id = wp_insert_post(array(
            'post_title'    => sanitize_text_field($params['nome']),
            'post_content'  => '', // Você pode adicionar uma descrição se necessário
            'post_status'   => 'publish', // Ou 'pending' se você quer que seja revisado antes de publicar
            'post_type'     => 'dicas',
            'meta_input'    => array( // Adiciona metadados diretamente
                'endereco' => sanitize_text_field($params['endereco']),
                'telefone' => sanitize_text_field($params['telefone']),
                'website'  => esc_url_raw($params['website']),
                'lat'      => sanitize_text_field($params['lat']),
                'lng'      => sanitize_text_field($params['lng']),
                'place_id' => sanitize_text_field($params['place_id']),
                'descricao' => sanitize_text_field($params['descricao']),
            ),
        ));

        if (!is_wp_error($post_id)) {
            if(isset($attach_id)) {
                set_post_thumbnail($post_id, $attach_id); // Associa a imagem destacada ao post
            }
            return new WP_REST_Response('Dica adicionada com sucesso!', 200);
        } else {
            return new WP_REST_Response('Erro ao adicionar dica', 400);
        }
    } else {
        return new WP_REST_Response('Dados incompletos para adicionar a dica.', 400);
    }
}

function register_api_routes() {
    register_rest_route('meu-matri/v1', '/get-dicas/', array(
        'methods' => 'GET',
        'callback' => 'get_dicas',
        'permission_callback' => '__return_true' 
    ));
}
add_action('rest_api_init', 'register_api_routes');

function get_dicas(WP_REST_Request $request) {
    $args = array(
        'post_type'      => 'dicas',
        'posts_per_page' => -1, // Buscar todas as dicas
    );

    $query = new WP_Query($args);
    $dicas = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $imagem = get_the_post_thumbnail_url($post_id, 'full'); 

            $dica = array(
                'place_id' => get_post_meta($post_id, 'place_id', true),
                'nome' => get_the_title($post_id),
                'endereco' => get_post_meta($post_id, 'endereco', true),
                'telefone' => get_post_meta($post_id, 'telefone', true),
                'website' => get_post_meta($post_id, 'website', true),
                'lat' => get_post_meta($post_id, 'lat', true),
                'lng' => get_post_meta($post_id, 'lng', true),
                'imagem' => $imagem ? $imagem : null, 
                'idPost' => $post_id,
            );
            array_push($dicas, $dica);
        }
    }

    wp_reset_postdata();
    return new WP_REST_Response($dicas, 200);
}

function register_dicas_delete_route() {
    register_rest_route('meu-matri/v1', '/dicas/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'delete_dica_handler',
        'permission_callback' => '__return_true' 
    ));
}
add_action('rest_api_init', 'register_dicas_delete_route');

function delete_dica_handler(WP_REST_Request $request) {
    $post_id = (int) $request['id'];
    $post = get_post($post_id);

    if (empty($post)) {
        return new WP_Error('rest_post_invalid_id', 'Dica não encontrada.', array('status' => 404));
    }

    wp_delete_post($post_id, true);

    return new WP_REST_Response(true, 200);
}

function salvar_template() {
    // Certifique-se de validar e limpar os dados recebidos
    $nome_casal = sanitize_text_field($_POST['nome_casal']);
    $data_casal = sanitize_text_field($_POST['data_casal']);
    $template_escolhido = sanitize_text_field($_POST['template_escolhido']);

    // Lógica para criar a nova página com os dados recebidos
    // ...

    wp_die(); // Finaliza a execução do AJAX
}
add_action('wp_ajax_salvar_template', 'salvar_template');
add_action('wp_ajax_nopriv_salvar_template', 'salvar_template');
