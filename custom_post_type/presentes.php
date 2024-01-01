<?php
function enqueue_custom_admin_styles() {
    // Enfileire seu arquivo CSS no painel administrativo
    wp_enqueue_style('custom-admin-css', get_template_directory_uri() . '/assets/css/admin.css');
}
// Ação para carregar seu CSS no painel administrativo
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_styles');

// Registrando o Custom Post Type "Presente"
function registrar_custom_post_type_presente()
{
    $labels = array(
        'name' => 'Presentes',
        'singular_name' => 'Presente',
        'menu_name' => 'Presentes',
        'add_new' => 'Adicionar Novo Presente',
        'add_new_item' => 'Adicionar Novo Presente',
        'edit_item' => 'Editar Presente',
        'new_item' => 'Novo Presente',
        'view_item' => 'Ver Presente',
        'search_items' => 'Buscar Presentes',
        'not_found' => 'Nenhum presente encontrado',
        'not_found_in_trash' => 'Nenhum presente encontrado na lixeira'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'author',
            'comments',
            'revisions',
            'custom-fields',
            'page-attributes',
        ),
        'hierarchical' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'presentes'),
        'register_meta_box_cb' => 'adicionar_metabox_valor_presente',
    );

    register_post_type('presente', $args);
}
add_action('init', 'registrar_custom_post_type_presente');

function adicionar_metabox_valor_presente()
{
    add_meta_box(
        'valor_presente',
        'Valor do Presente',
        'exibir_metabox_valor_presente',
        'presente',
        'normal',
        'high'
    );
}

function exibir_metabox_valor_presente($post)
{
    // Recupere o valor do presente, se existir
    $valor_presente = get_post_meta($post->ID, 'valor_presente', true);

    print_r("$valor_presente");

    // Campos do formulário
    echo '<label for="valor_presente">Valor do Presente:</label>';
    echo '<br />';
    echo '<input type="text" id="valor_presente" name="valor_presente" value="' . esc_attr($valor_presente) . '" size="30" />';
    echo '<br />';
    echo '<small>Informe o valor do presente no formato R$ 99,99</small>';
}


// Salvar valor do presente quando o post for atualizado
function salvar_valor_presente($post_id)
{
    if (isset($_POST['valor_presente'])) {
        update_post_meta($post_id, 'valor_presente', sanitize_text_field($_POST['valor_presente']));
    }
}
add_action('save_post', 'salvar_valor_presente');



// Registrando a Taxonomia "Categorias de Presentes"
function registrar_taxonomy_categorias_presente()
{
    $labels = array(
        'name' => 'Categorias de Presentes',
        'singular_name' => 'Categoria de Presente',
        'menu_name' => 'Categorias de Presentes',
        'search_items' => 'Buscar Categorias',
        'all_items' => 'Todas as Categorias',
        'parent_item' => 'Categoria Pai',
        'parent_item_colon' => 'Categoria Pai:',
        'edit_item' => 'Editar Categoria',
        'update_item' => 'Atualizar Categoria',
        'add_new_item' => 'Adicionar Nova Categoria',
        'new_item_name' => 'Nome da Nova Categoria',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_admin_column' => true,
    );

    register_taxonomy('categorias_presente', 'presente', $args);
}
add_action('init', 'registrar_taxonomy_categorias_presente');

// Registrando o Custom Post Type "Lista de Presentes"
function registrar_custom_post_type_lista_presentes()
{
    $labels = array(
        'name' => 'Listas de Presentes',
        'singular_name' => 'Lista de Presentes',
        'menu_name' => 'Listas de Presentes',
        'add_new' => 'Adicionar Nova Lista',
        'add_new_item' => 'Adicionar Nova Lista de Presentes',
        'edit_item' => 'Editar Lista de Presentes',
        'new_item' => 'Nova Lista de Presentes',
        'view_item' => 'Ver Lista de Presentes',
        'search_items' => 'Buscar Listas de Presentes',
        'not_found' => 'Nenhuma lista encontrada',
        'not_found_in_trash' => 'Nenhuma lista encontrada na lixeira'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-list-view',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'author',
            'comments',
            'revisions',
            'custom-fields',
            'page-attributes',
        ),
        'hierarchical' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'listas-de-presentes'),
    );

    register_post_type('lista_presentes', $args);
}
add_action('init', 'registrar_custom_post_type_lista_presentes');

// Registrando a Taxonomia "Categorias de Lista de Presentes"
function registrar_taxonomy_categorias_lista_presentes()
{
    $labels = array(
        'name' => 'Categorias de Lista de Presentes',
        'singular_name' => 'Categoria de Lista de Presentes',
        'menu_name' => 'Categorias de Lista de Presentes',
        'search_items' => 'Buscar Categorias',
        'all_items' => 'Todas as Categorias',
        'parent_item' => 'Categoria Pai',
        'parent_item_colon' => 'Categoria Pai:',
        'edit_item' => 'Editar Categoria',
        'update_item' => 'Atualizar Categoria',
        'add_new_item' => 'Adicionar Nova Categoria',
        'new_item_name' => 'Nome da Nova Categoria',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_admin_column' => true,
    );

    register_taxonomy('categorias_lista_presentes', 'lista_presentes', $args);
}
add_action('init', 'registrar_taxonomy_categorias_lista_presentes');

// Adicionando metabox para adicionar e visualizar/remover presentes à lista de presentes
function adicionar_metaboxes_presentes_lista_presentes()
{
    add_meta_box(
        'metabox_presentes_a_lista_presentes',
        'Adicionar e Visualizar/Remover Presentes',
        'exibir_metabox_presentes_a_lista_presentes',
        'lista_presentes',
        'normal',
        'high'
    );
    /*add_meta_box(
        'metabox_presentes_adicionados',
        'Presentes Adicionados à Lista',
        'exibir_metabox_presentes_adicionados',
        'lista_presentes',
        'normal',
        'high'
    );*/
}
add_action('add_meta_boxes', 'adicionar_metaboxes_presentes_lista_presentes');

// Exibir o conteúdo do metabox de presentes não adicionados à lista
// Exibir o conteúdo do metabox de presentes não adicionados à lista
function exibir_metabox_presentes_a_lista_presentes($post)
{
    // Recuperando todas as categorias de presentes
    $categorias = get_terms('categorias_presente', 'hide_empty=0');

    // Recuperando os presentes já adicionados a esta lista
    $presentes_adicionados = get_post_meta($post->ID, 'presentes_a_lista_presentes', true);
    $presentes_adicionados = !empty($presentes_adicionados) ? $presentes_adicionados : array();

    echo '<div class="presentes-container">';
    
    foreach ($categorias as $categoria) {
        $categoria_nome = $categoria->name;
        $categoria_slug = $categoria->slug;

        echo '<div class="categoria-box">';
        echo '<div class="categoria-header">' . esc_html($categoria_nome) . '</div>';
        echo '<div class="categoria-body">';
        
        // Consulta para recuperar os presentes dessa categoria
        $args_presentes = array(
            'post_type' => 'presente',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorias_presente',
                    'field' => 'slug',
                    'terms' => $categoria_slug,
                ),
            ),
        );

        $presentes_categoria = new WP_Query($args_presentes);
        
        if ($presentes_categoria->have_posts()) {
            while ($presentes_categoria->have_posts()) {
                $presentes_categoria->the_post();
                $presente_id = get_the_ID();
                $presente_nome = get_the_title();

                // Verificando se o presente já foi adicionado à lista
                $is_adicionado = in_array($presente_id, $presentes_adicionados);

                echo '<label>';
                echo '<input type="checkbox" name="presentes_a_lista_presentes[]" value="' . esc_attr($presente_id) . '"' . checked($is_adicionado, true, false) . '>';
                echo esc_html($presente_nome);
                echo '</label> <br>';
            }
        } else {
            echo '<p><i>Não há presentes nesta categoria.</i></p>';
        }
        
        wp_reset_postdata();
        echo '</div>'; // Fechando a categoria-body
        echo '<div class="categoria-footer"></div>'; // Adicione aqui o estilo de fundo desejado para o rodapé
        echo '</div>'; // Fechando a categoria-box
    }
    
    echo '</div>'; // Fechando a presentes-container
}


// Exibir o conteúdo do metabox de presentes adicionados à lista
//function exibir_metabox_presentes_adicionados($post)
//{
//    $presentes_adicionados = get_post_meta($post->ID, 'presentes_a_lista_presentes', true);
//    $presentes_adicionados = !empty($presentes_adicionados) ? $presentes_adicionados : array();
//
//    $total_valor_presentes = 0;
//    $categorias_valor_total = array();
//
//    echo '<div class="">';
//
//    // Recuperando todas as categorias de presentes
//    $categorias = get_terms('categorias_presente', 'hide_empty=0');
//
//    foreach ($categorias as $categoria) {
//        $categoria_nome = $categoria->name;
//        $categoria_slug = $categoria->slug;
//
//        // Inicialize o valor total da categoria como zero
//        $total_valor_categoria = 0;
//
//        echo '<div class="categoria-box">';
//        echo '<div class="categoria-header-sub">' . esc_html($categoria_nome) . '</div>';
//        echo '<div class="categoria-body">';
//
//        // Consulta para recuperar os presentes dessa categoria
//        $args_presentes = array(
//            'post_type' => 'presente',
//            'posts_per_page' => -1,
//            'tax_query' => array(
//                array(
//                    'taxonomy' => 'categorias_presente',
//                    'field' => 'slug',
//                    'terms' => $categoria_slug,
//                ),
//            ),
//        );
//
//        $presentes_categoria = new WP_Query($args_presentes);
//
//        if ($presentes_categoria->have_posts()) {
//            while ($presentes_categoria->have_posts()) {
//                $presentes_categoria->the_post();
//                $presente_id = get_the_ID();
//                $presente_nome = get_the_title();
//
//                $valor_presente = get_post_meta($presente_id, 'valor_presente', true);
//
//                if (!empty($valor_presente)) {
//                    $total_valor_presentes += floatval($valor_presente);
//                    $total_valor_categoria += floatval($valor_presente); // Atualize o valor total da categoria
//
//                    echo '<div>' . esc_html($presente_nome) . ' - R$ ' . esc_html($valor_presente) . '</div>';
//                } else {
//                    echo '<div>' . esc_html($presente_nome) . ' - <small><i>Valor não especificado</i></small></div>';
//                }
//            }
//        } else {
//            echo '<p><i>Não há presentes nesta categoria.</i></p>';
//        }
//
//        wp_reset_postdata();
//
//        // Exibir o valor total da categoria
//        echo '<div class="valor-total-categoria">Valor Total da Categoria: R$ ' . number_format($total_valor_categoria, 2, ',', '.') . '</div>';
//
//        echo '</div>'; // Fechando a categoria-body
//        echo '</div>'; // Fechando a categoria-box
//    }
//
//    echo '</div>'; // Fechando a presentes-container
//
//    // Exibir o valor total dos presentes da lista
//    echo '<div class="valor-total-presentes"><strong>Valor Total da Lista:</strong> R$ ' . number_format($total_valor_presentes, 2, ',', '.') . '</div>';
//}

// Salvar os presentes associados à lista de presentes
function salvar_presentes_a_lista_presentes($post_id)
{
    if (isset($_POST['presentes_a_lista_presentes'])) {
        $presentes_lista = array_map('intval', $_POST['presentes_a_lista_presentes']);
        update_post_meta($post_id, 'presentes_a_lista_presentes', $presentes_lista);
    }
}
add_action('save_post', 'salvar_presentes_a_lista_presentes');

