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
    if (isset($_GET['lista_presente_id'])) {
        $lista_presente_id = intval($_GET['lista_presente_id']);

        // Recupere as listas filhas associadas a esta lista pai
        $listas_filhas = get_posts(
            array(
                'post_type' => 'lista_presentes',
                'post_parent' => $lista_presente_id
                // Filtra apenas as listas filhas desta lista pai
            )
        );
    }

    if (isset($_GET['lista_id'])) {
        $lista_id = intval($_GET['lista_id']);

        // Vá para o subsite
        switch_to_blog($subsite_id); // Substitua $subsite_id pelo ID do subsite

        // Obtenha o ID do usuário atual
        $user_id = get_current_user_id();

        // Obtenha a lista de IDs de lista associados ao usuário (se já houver)
        $user_lista_ids = get_user_meta($user_id, 'site_principal_lista_ids', true);

        // Adicione o novo ID da lista à matriz (se ainda não existir)
        if (empty($user_lista_ids)) {
            $user_lista_ids = array();
        }

        // Verifique se o ID da lista já está na lista (evita duplicatas)
        if (!in_array($lista_id, $user_lista_ids)) {
            $user_lista_ids[] = $lista_id;

            // Salve a matriz de IDs da lista como metadado de usuário
            update_user_meta($user_id, 'site_principal_lista_ids', $user_lista_ids);
        }

        // Restaure o contexto do subsite
        restore_current_blog();
    }
    ?>
    <section class="user-panel edit-gift-list container" style="margin-top:80px">
        <?php if (isset($_GET['message'])): ?>
            <p
                    style="text-align:center; font-size: 16px; background-color: #283F3B; color: #FFF; padding:10px; border-radius:7px;">
                <?php echo $_GET['message']; ?>
            <p style="text-align: center;"><a href="/galeria-de-presentes"> Voltar</a></p>
            </p>
        <?php endif ?>
        <div class="instructions">
            <h1 class="title" style="margin-bottom:10px; text-align: center;">
                <?php echo esc_html(get_the_title($lista_presente_id)); ?>
                <p style="text-align: center;"><a href="/galeria-de-presentes"> Voltar</a></p>

            </h1>
        </div>

        <div class="gift-list__container myList" id="myList">
            <hr>
            <?php
            if ($listas_filhas) {
                foreach ($listas_filhas as $lista_filha_id) {
                    $lista_filha = get_post($lista_filha_id);
                    if ($lista_filha) {
                        $lista_filha_id = $lista_filha_id->ID;
                        $lista_filha_title = esc_html(get_the_title($lista_filha_id));
                        $lista_filha_image = get_the_post_thumbnail_url($lista_filha_id, 'medium');
                        $lista_filha_description = esc_html(get_the_content($lista_filha_id));

                        // Recupere os IDs dos presentes associados a esta lista filha
                        $presentes_associados_lista_filha = get_post_meta($lista_filha_id, 'presentes_a_lista_presentes', true);

                        // Inicialize o valor total da lista filha
                        $total_valor_lista_filha = 0;

                        if ($presentes_associados_lista_filha) {
                            foreach ($presentes_associados_lista_filha as $presente_id) {
                                // Recupere o valor de cada presente e some ao valor total
                                $presente_valor = get_post_meta($presente_id, 'valor_presente', true);
                                $total_valor_lista_filha += floatval($presente_valor);
                            }
                        }

                        // Contagem de presentes associados a esta lista filha
                        $total_presentes_lista_filha = count($presentes_associados_lista_filha);

                        ?>
                        <div class="gift-list__item">
                            <div class="gift-list__image">
                                <img src="<?php echo esc_url($lista_filha_image); ?>" alt="">
                            </div>
                            <div class="gift-list__desc">
                                <h2>
                                    <?php echo $lista_filha_title; ?>
                                </h2>
                                <p>
                                    <?php echo $lista_filha_description; ?>
                                </p>
                                <p>
                                    <?php echo $total_presentes_lista_filha; ?> presentes
                                </p>
                                <p>Total da lista<br>
                                    <strong>R$
                                        <?php echo number_format($total_valor_lista_filha, 2, ',', '.'); ?>
                                    </strong>
                                </p>
                            </div>
                            <div class="">
                                <a style="padding-top:10px;"
                                   href="../selecionar-lista-de-presentes/?lista_presente_id=<?php echo $lista_presente_id; ?>&lista_id=<?php echo $lista_filha_id; ?>"
                                   class="btn " data-lista-filha-id="<?php echo $lista_filha_id; ?>">Adicionar</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                echo '<p style="padding-top:10px;">Nenhum presente associado a esta lista.</p>';
            }
            ?>
        </div>
    </section>


    <?php
} else {
    // Exiba uma mensagem para os usuários não logados, ou redirecione-os para fazer login.
    echo '<p>Faça login para criar e gerenciar suas listas de presentes.</p>';
}
?>

<style>
    .gift-list__item {
        width: 100%;
    }

    .gift-list__desc h2 {
        text-align: left !important;
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

    .user-panel > .instructions {
        padding: 16px 8px;
    }

    .user-panel > .instructions > p {
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

    .gift-list__type-wrap:has(>input[type="radio"]:checked) {
        color: #FFFFFF;
        background: rgba(90, 109, 80, 0.45);
        border: 2px solid #283F3B;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 8px;
    }

    .gift-list__type-wrap > input[type="radio"] {
        accent-color: rgba(90, 109, 80, 0.45);
        margin: 0;
    }

    .gift-list__type-wrap > input {
        height: 16px !important;
        width: 16px !important;
    }

    .gift-list__type-wrap > label {
        margin: 0 auto;
    }

    .gift-list__choose {
        display: flex;
        justify-content: space-between;
    }

    .gift-list__choose > button,
    .gift-list__choose > a.btn {
        width: 165px;
        height: 60px;
        margin: 42px auto 0;
    }

    .gift-list__choose > a.btn {
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
    }

    .modal-content {
        padding: 20px;
    }

    .close {
        cursor: pointer;
        float: right;
        /* Move o botão close para o lado direito */
        margin-right: 10px;
        /* Adiciona um espaço à direita do botão */
    }
</style>