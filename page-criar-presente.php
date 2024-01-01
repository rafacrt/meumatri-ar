<?php
/* Template Name: Criar Presente */
require_once get_template_directory() . '/inc/icons.php';

// Verifique se o usuário está associado a algum site na rede
$user_id = get_current_user_id();
$subsite_id = get_user_meta($user_id, 'primary_blog', true);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if ($subsite_id) {
        if (isset($_POST['submit'])) {
            switch_to_blog($subsite_id);

            // Processar o envio do formulário e criar o presente
            $thumbnail = $_FILES['thumbnail'];
            $descricao = sanitize_text_field($_POST['descricao']);
            $nova_categoria = sanitize_text_field($_POST['nova_categoria']);
            $categoria = sanitize_text_field($_POST['categoria']);
            $preco = floatval($_POST['preco']);
            
            
            
            // Configurar os dados do presente
            $present_data = array(
                'post_title' => $descricao,
                'post_type' => 'presente',
                'post_status' => 'publish',
            );
            
            // Inserir o presente como um novo post
            $present_id = wp_insert_post($present_data);
            
    
            if (!is_wp_error($present_id)) {
                // Anexar a imagem como destaque do presente
                if (!empty($thumbnail['tmp_name'])) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    require_once(ABSPATH . 'wp-admin/includes/media.php');
    
                    $attachment_id = media_handle_upload('thumbnail', $present_id);
    
                    if (!is_wp_error($attachment_id)) {
                        set_post_thumbnail($present_id, $attachment_id);
                    }
                }
    
                // Definir a categoria do presente (você pode criar a categoria se ela não existir)
                if ($categoria !== 'default') {
                    wp_set_post_terms($present_id, $categoria, 'categorias_presente', true);
                } elseif (!empty($nova_categoria)) {
                    // Se uma nova categoria for especificada, crie-a
                    wp_insert_term($nova_categoria, 'categorias_presente');
                    $nova_categoria_id = get_term_by('name', $nova_categoria, 'categorias_presente')->term_id;
                    wp_set_post_terms($present_id, $nova_categoria_id, 'categorias_presente', true);
                }
    
                // Definir o preço do presente
                update_post_meta($present_id, 'preco', $preco);

                // Restaure o contexto para o site principal
                restore_current_blog();
    
                // Redirecionar para a página de lista de presentes ou uma página de confirmação
                wp_safe_redirect(site_url('/lista-de-presentes'));
                exit;
            } else {
                // Ocorreu um erro ao criar o presente
                echo 'Erro ao criar o presente.';
            }
        }
        
    }
}
get_header();
?>

<div id="primary" class="content-area" style="margin-top:80px;">
    <div id="main" class="site-main container inner-container">
        <span class="back-arrow"><a href="<?= site_url() . '/lista-de-presentes' ?>">
                <?= $backArrow ?>
            </a></span>

        <!-- Criar presente.php -->
        <form method="post" enctype="multipart/form-data">
            <div class="gift-icon__input-area">
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display: none;" required>
                <label for="thumbnail">
                    <?= $camera ?>
                </label>
                <img id="thumbnail-preview" src="#" alt="Imagem do Presente">
            </div>

            <input name="descricao" id="descricao" placeholder="Nome do presente" required>
            <input name="nova_categoria" id="nova_categoria" placeholder="Nova Categoria (opcional)">
            <select name="categoria" id="categoria" required>
                <option value="default" selected disabled hidden>Categoria</option>
                <?php
                $terms = get_terms(
                    array(
                        'taxonomy' => 'categorias_presente',
                        'hide_empty' => false,
                    )
                );

                foreach ($terms as $term) {
                    echo '<option value="' . $term->name . '">' . $term->name . '</option>';
                }
                ?>
            </select>
            <input type="number" step="0.01" name="preco" id="preco" placeholder="Valor" required>
            <input class="btn" type="submit" name="submit" value="Criar Presente" style="margin: 24px auto;">
        </form>



        <script>
            // Script para atualizar a pré-visualização da imagem
            document.getElementById("thumbnail").addEventListener("change", function (event) {
                const fileInput = event.target;
                const file = fileInput.files[0];
                const thumbnailPreview = document.getElementById("thumbnail-preview");
                const svgIcon = document.querySelector(".gift-icon__input-area > label > svg");

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        thumbnailPreview.src = e.target.result;
                        thumbnailPreview.style.display = "block";
                        svgIcon.style.opacity = 0; // Reduza a opacidade do ícone
                    };

                    reader.readAsDataURL(file);
                } else {
                    thumbnailPreview.src = "#";
                    thumbnailPreview.style.display = "none";
                    svgIcon.style.opacity = 1; // Restaure a opacidade do ícone
                }
            });
        </script>
    </div><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>




<style>
    .gift-icon__input-area {
        width: 100%;
        height: 25vh;
        background-color: rgba(162, 173, 132, 0.50);
        position: relative;
        margin-bottom: 32px;
    }

    .gift-icon__input-area label {
        display: inline-block;
        width: 100%;
        height: 100%;
        text-align: center;
        cursor: pointer;
        position: absolute;
        top: 0;
        left: 0;
    }

    .gift-icon__input-area>label>svg {
        background: #283F3B;
        border: solid 2px #fff;
        border-radius: 50%;
        height: 100px;
        width: 100px;
        margin-top: 5vh;
        padding: 0px 20px;
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    .gift-icon__input-area img {
        max-height: 100%;
        max-width: 100%;
        display: none;
        margin: 0 auto;
    }

    /* common.css | http://localhost:10014/wp-content/themes/vamoscasar/assets/css/common.css?ver=0.5 */

    input:not([type="checkbox"]):not([type="submit"]) {
        border: none;
        border-radius: initial;
        font-family: Poligon;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 150%;
        border-bottom: 1px solid #d5cfcf;
    }

    /* Inline #17 | http://localhost:10014/criar-presente/ */

    #categoria {
        font-family: Poligon;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 150%;
        width: 100%;
        height: 20px;
        background-color: transparent;
        box-sizing: border-box;
        border: 0.5px solid #000000;
        filter: drop-shadow(4px 10px 10px rgba(0, 0, 0, 0.25));
        height: 40px;
        padding: 8px;
        margin: 8px auto;
        border: none;
        border-bottom: solid 1px #d5cfcf;
        color: #333;
    }

    input {
        padding: 8px 16px;
        font-size: 20px;
        line-height: 120%;
        letter-spacing: 0;
        cursor: pointer;
        text-decoration: none;
        background-color: #A2AD84;
        transition: background-color .3s, color .3s;
    }
</style>