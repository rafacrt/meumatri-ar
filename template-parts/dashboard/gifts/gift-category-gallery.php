<?php
ob_clean();
// Inclua o arquivo que possui os ícones, se necessário.
require get_template_directory() . '/inc/icons.php';

// Verifique se o usuário está logado
if (is_user_logged_in()) {

    // Verifique se o usuário está associado a algum site na rede
    $user_id = get_current_user_id();
    $subsite_id = get_user_meta($user_id, 'primary_blog', true);

    // Obtém o ID da lista de presentes a partir do parâmetro GET
    if (isset($_GET['categoria_presente_id'])) {
        $id_categoria = $_GET['categoria_presente_id'];
        $args = array(
            'post_type' => 'presente',
            'posts_per_page' => -1,
            // Para obter todos os presentes
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorias_presente',
                    'field' => 'id',
                    // Campo para correspondência (ID)
                    'terms' => $id_categoria,
                    // O ID da categoria que você deseja
                ),
            ),
        );
        $user_presentes = get_posts($args);
    }

    if (isset($_GET['presente_id'])) {

        $presente_id = intval($_GET['presente_id']);
        // Vá para o subsite
        switch_to_blog($subsite_id); // Substitua $subsite_id pelo ID do subsite

        // Obtenha o ID do usuário atual
        $user_id = get_current_user_id();

        // Obtenha a lista de IDs de lista associados ao usuário (se já houver)
        $user_presente_ids = get_user_meta($user_id, 'site_principal_presente_ids', true);

        // Adicione o novo ID da lista à matriz (se ainda não existir)
        if (empty($user_presente_ids)) {
        $user_presente_ids = array();
        }

        // Verifique se o ID da lista já está na lista (evita duplicatas)
        if (!in_array($presente_id, $user_presente_ids)) {
        $user_presente_ids[] = $presente_id;

        // Salve a matriz de IDs da lista como metadado de usuário
        update_user_meta($user_id, 'site_principal_presente_ids', $user_presente_ids);
        }

        // Restaure o contexto do subsite
        restore_current_blog();

        wp_safe_redirect('http://meumatri.local/lista-de-presentes?message=Presente adicionado com Sucesso!');

    }
    ?>
<section class="user-panel edit-gift-list container" style="margin-top:80px; padding: 0px;">
    <?php if (isset($_GET['message'])): ?>
    <p
        style="text-align:center; font-size: 16px; background-color: #283F3B; color: #FFF; padding:10px; border-radius:7px;">
        <?php echo $_GET['message']; ?>
    </p>
    <?php endif ?>
    <div class="instructions">
        <h1 class="title" style="margin-bottom:10px; text-align: center;">
            Galeria de Presentes
        </h1>
        <p style="text-align: center;"><a href="/galeria-de-presentes"> Voltar</a></p>
    </div>

    <div class=" myList" id="myList">
        <hr>
        <?php
            if ($user_presentes) {
                foreach ($user_presentes as $user_presente) {
                    setup_postdata($user_presente);
                    $presente_id = $user_presente->ID;
                    $presente_title = $user_presente->post_title;
                    $presente_image = get_the_post_thumbnail_url($presente_id, 'medium');
                    $valor_presente = get_post_meta($presente_id, 'valor_presente', true);
                    $presente_description = esc_html(get_the_content($presente_id));
                    ?>

        <div class="gift-list__item">
            <div class="gift-list__image">
                <img src="<?php echo esc_url($presente_image); ?>" alt="">
            </div>
            <div class="gift-list__desc">
                <h2>
                    <?php echo $presente_title; ?>
                </h2>
                <p>
                    <?php echo $presente_description; ?>
                </p>
                <p>
                    <?php echo $total_presentes_lista_filha; ?> presentes
                </p>
                <p> R$ <strong><?php echo $valor_presente; ?></strong></p>
            </div>
            <div class="">
                <a style="padding-top:10px;"
                    href="../selecionar-presentes/?categoria_presente_id=<?php echo $id_categoria; ?>&presente_id=<?php echo $presente_id; ?>"
                    class="btn adicionar-lista_filha"">Adicionar</a>
            </div>

        </div>
        <?php
                }
            } else {
                echo '<p style="padding-top:10px;">Você ainda não criou e nem selecionou nenhum presente.</p>';
            }
            ?>
    </div>
</section>

<?php
        restore_current_blog();
} else {
    // Exiba uma mensagem para os usuários não logados, ou redirecione-os para fazer login.
    echo '<p>Faça login para criar e gerenciar suas listas de presentes.</p>';
}
?>
<style>
    .gift-list__item {
        width: 100%;
        text-align: left !important;
    }

    .gift-list__desc h2 {
        text-align: left !important;
        float: left !important;
        font-weight: 600 !important;
        font-size: 14px;

    }

    .gift-list__desc p {
        text-align: left !important;

    }

    .gift-list__desc .price {
        text-align: left !important;

    }

    dialog#listDialog {
        position: fixed;
        width: 100vw;
        height: 83vh;
        margin-top: 150px;
    }

    .user-panel {
        background: #fff;
    }

    .user-panel>.instructions {
        padding: 16px 8px;
    }

    .user-panel>.instructions>p {
        font-family: 'Poligon';
        font-style: normal;
        font-weight: 400;
        font-size: 17px;
        line-height: 21px;
        letter-spacing: -0.04em;
    }

    .gift-list__type-wrap {
        font-family: 'Poligon';
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 26px;
        text-align: center;
        letter-spacing: -0.04em;
        color: #283F3B;
        display: flex;
        flex-direction: row;
        align-items: center;
        margin: 24px auto;
        gap: 16px;
        width: 232px;
        height: 55px;
        background: #FFFEFE;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 8px;
        padding: 8px;
    }

    .gift-list__type-wrap:has(>input[type=" radio"]:checked) {
        color: #FFFFFF;
        background: rgba(90, 109, 80, 0.45);
        border: 2px solid #283F3B;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 8px;
    }

    .gift-list__type-wrap>input[type="radio"] {
        accent-color: rgba(90, 109, 80, 0.45);
        margin: 0;
    }

    .gift-list__type-wrap>input {
        height: 16px !important;
        width: 16px !important;
    }

    .gift-list__type-wrap>label {
        margin: 0 auto;
    }

    .gift-list__choose {
        display: flex;
        justify-content: space-between;
    }

    .gift-list__choose>button,
    .gift-list__choose>a.btn {
        width: 165px;
        height: 60px;
        margin: 42px auto 0;
    }

    .gift-list__choose>a.btn {
        text-decoration: none;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .modal {
        display: none;
        position: fixed;
        width: 294px;
        background-color: white;
        border-radius: 21px;
        border: 1.5px solid #000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        height: 500px;
    }

    .modal-content {
        padding: 20px;
        height: 500px;
        box-shadow: none;
        border: none;
    }

    .close {
        cursor: pointer;
        float: right;
        /* Move o botão close para o lado direito */
        margin-right: 10px;
        /* Adiciona um espaço à direita do botão */
    }
</style>
