<?php
// Inclua o arquivo que possui os ícones, se necessário.
require get_template_directory() . '/inc/icons.php';

// Verifique se o usuário está logado
if (is_user_logged_in()) {
  // Obtém o ID do usuário logado

  $user_presentes = get_posts(
    array(
      'post_type' => 'presente',
      'status' => 'publish',
      'limit' => -1,
    )
  );

  $categorias_presentes = array(
    'post_type' => 'presente',
    'status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'categorias_presente',
        // Nome da sua taxonomia de categorias
        'field' => 'id',
        // Campo para correspondência (pode ser 'id', 'slug', 'name', etc.)
        'terms' => get_terms('categorias_presente', array('fields' => 'ids')),
        // Obtém todos os IDs de termos da taxonomia
        'operator' => 'IN',
        // Operador para correspondência (pode ser 'IN', 'NOT IN', etc.)
      ),
    ),
  );

  ?>

  <section class="user-panel edit-gift-list container" style="margin-top:80px">
<!--   <span class="back-arrow"><a href="<?= site_url() . '/lista-de-presentes' ?>"><?= $backArrow ?></a></span>
 -->    <?php if (isset($_GET['message'])): ?>
      <p
        style="text-align:center; font-size: 16px; background-color: #283F3B; color: #FFF; padding:10px; border-radius:7px;">
        <?php echo $_GET['message']; ?>
      </p>
    <?php endif ?>
    <div class="instructions">
      <h1 class="title" style="margin-bottom:10px; text-align:center;">
        Galeria de Presentes
      </h1>
      <h5 class="abrir_categorias" style="text-align:center;">Ver Categorias</h5>
      <p style="text-align: center;"><a href="/galeria-de-presentes"> Voltar</a></p>

    </div>

    <div class="gift-list__container myList" id="myList">
      <hr>
      <?php
      if ($user_presentes) {
        foreach ($user_presentes as $user_presente) {
          $presente_id = $user_presente->ID;
          $presente_title = esc_html(get_the_title($presente_id));
          $presente_image = get_the_post_thumbnail_url($presente_id, 'medium');
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
              <p> <strong>R$2</strong></p>
            </div>
            <div class="">
              <button class="btn adicionar-lista_filha" href="?presente_id=<?php echo $presente_id; ?>">Adicionar</button>
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

  <!-- Modal de Presentes -->
  <div id="giftDialog" class="modal">
    <div class="modal-content">
      <form method="dialog" id="giftForm">
        <p>Categorias de Presentes: <span class="close">
            <?= $close ?>
          </span></p>

          <?php
          $categorias_presente = get_terms('categorias_presente', 'hide_empty=0');
          if ($categorias_presente) {
            foreach ($categorias_presente as $categoria) {
              echo ' <div class="gift-list__type-wrap">';
              echo ' <input type="radio" name="optGift" id="optGift' . esc_attr($categoria->term_id) . '" value="' . esc_attr($categoria->term_id) . '" checked>';
              echo ' <label for="optGift1">' . esc_html($categoria->name) . '</label>';
              echo '</div>';
            }
          }
          ?>

        <div class="gift-list__choose">
          <button type="button" class="btn" id="giftButton">Avançar</button>
        </div>
      </form>
    </div>
  </div>

  <?php
  restore_current_blog();
} else {
  // Exiba uma mensagem para os usuários não logados, ou redirecione-os para fazer login.
  echo '<p>Faça login para criar e gerenciar suas listas de presentes.</p>';
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  jQuery(document).ready(function () {
    jQuery("#giftDialog").fadeIn();
    
    jQuery(".abrir_categorias").click(function () {
      jQuery("#giftDialog").fadeIn();
    });

    jQuery(".close").click(function () {
      jQuery(".modal").fadeOut();
    });

    // Abre o modal de Presentes
    jQuery("#abrirGiftModal").click(function () {
      jQuery("#giftDialog").fadeIn();
    });

    // Redireciona o usuário com base na seleção no modal de Listas
    jQuery("#giftButton").click(function () {
      var selectedOption = jQuery("input[name='optGift']:checked").val();
      window.location.href = "/lista-de-presentes/galeria-de-presentes/selecionar-presentes?categoria_presente_id=" + selectedOption;
    });

  });
</script>

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

  .gift-list__type-wrap:has(>input[type="radio"]:checked) {
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
    height: 700px;
  }

  .modal-content {
    height: 600px;
    padding: 20px;
    box-shadow: none;
    border: none;
  }

  .close {
    cursor: pointer;
    float: right;
    margin-right: 10px;
  }
</style>