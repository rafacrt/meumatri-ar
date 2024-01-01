<?php
// Inclua o arquivo que possui os ícones, se necessário.
require get_template_directory() . '/inc/icons.php';

// Verifique se o usuário está logado
if (is_user_logged_in()) {

  // Obtém o ID do usuário logado
  $user_id = get_current_user_id();
  $subsite_id = get_user_meta($user_id, 'primary_blog', true);

  // Verifica se o usuário já possui listas de presentes
  $lists = get_posts(
    array(
      'post_type' => 'lista_presentes',
      'post_parent' => 0,
      'limit' => -1,
    )
  );

  switch_to_blog($subsite_id);
  $user_lista_ids = get_user_meta($user_id, 'site_principal_lista_ids', true);
  switch_to_blog(1);

  // Verifique se há IDs de lista no metadado do usuário
  if (!empty($user_lista_ids)) {
    $args = array(
      'post_type' => 'lista_presentes',
      'post__in' => $user_lista_ids,
    );

    $site_principal_lists = get_posts($args);

    // Coloque o código para exibir as listas associadas a esses IDs aqui
  } else {
    // Não exiba nada
  }

  switch_to_blog($subsite_id);
  $user_presente_ids = get_user_meta($user_id, 'site_principal_presente_ids', true);
  switch_to_blog(1);

  // Verifique se há IDs de presente no metadado do usuário
  if (!empty($user_presente_ids)) {
    $args = array(
      'post_type' => 'presente',
      'post__in' => $user_presente_ids,
    );

    $site_principal_presentes = get_posts($args);

    // Coloque o código para exibir os presentes associados a esses IDs aqui
  } else {
    // Não exiba nada
  }

  switch_to_blog($subsite_id);
  $args = array(
    'post_type' => 'presente',
  );
  $meus_presentes = get_posts($args);
  restore_current_blog();

  // Função para remover o presente por ID
  function remover_lista_por_id($lista_id)
  {
    $user_id = get_current_user_id();

    // Recupere o array de IDs de lista do metadado do usuário
    $user_lista_ids = get_user_meta($user_id, 'site_principal_lista_ids', true);

    if (is_array($user_lista_ids) && in_array($lista_id, $user_lista_ids)) {
      // Encontre e remova o ID da lista do array
      $index = array_search($lista_id, $user_lista_ids);
      if ($index !== false) {
        unset($user_lista_ids[$index]);
      }

      // Atualize o metadado do usuário com o array modificado
      update_user_meta($user_id, 'site_principal_lista_ids', $user_lista_ids);

      wp_safe_redirect('https://meumatri.com/lista-de-presentes?message=Removido com Sucesso!');
    } else {
      wp_safe_redirect('https://meumatri.com/lista-de-presentes?message=Erro ao remover!');
    }
  }


  // Função para remover o m eu presente por ID
  function remover_presente_por_id($presente_id)
  {
    $user_id = get_current_user_id();

    // Recupere o array de IDs de lista do metadado do usuário
    $user_presente_ids = get_user_meta($user_id, 'site_principal_presente_ids', true);

    if (is_array($user_presente_ids) && in_array($presente_id, $user_presente_ids)) {
      // Encontre e remova o ID da presente do array
      $index = array_search($presente_id, $user_presente_ids);
      if ($index !== false) {
        unset($user_presente_ids[$index]);
      }

      // Atualize o metadado do usuário com o array modificado
      update_user_meta($user_id, 'site_principal_presente_ids', $user_presente_ids);

      wp_safe_redirect('https://meumatri.com/lista-de-presentes?message=Removido com Sucesso!');
    } else {
      wp_safe_redirect('https://meumatri.com/lista-de-presentes?message=Erro ao remover!');
    }
  }

  // Função para remover o presente por ID
  function remover_meu_presente_por_id($meu_presente_id)
  {
    $user_id = get_current_user_id();
    $subsite_id = get_user_meta($user_id, 'primary_blog', true);

    switch_to_blog($subsite_id);
    // Verifique se o presente pertence ao usuário logado
    $presente = get_post($meu_presente_id);

    echo"<br><br><br>";echo"<pre>";print_r($presente);

    if ($presente) {
      // Remova o presente
      wp_delete_post($meu_presente_id, true);
      wp_safe_redirect('https://meumatri.com/lista-de-presentes?message=Removido com Sucesso!');
    } else {
      wp_safe_redirect('https://meumatri.com/lista-de-presentes?message=Erro ao remover!');
    }
  }

  // Verifique se o ID do presente está presente na URL
  if (isset($_GET['presente_id'])) {
    $presente_id = intval($_GET['presente_id']);
    remover_presente_por_id($presente_id);
  }

  if (isset($_GET['lista_id'])) {
    $lista_id = intval($_GET['lista_id']);
    remover_lista_por_id($lista_id);
  }

  if (isset($_GET['meu_presente_id'])) {
    $meu_presente_id = intval($_GET['meu_presente_id']);
    remover_meu_presente_por_id($meu_presente_id);
  }
  ?>

  <section class="user-panel edit-gift-list container" style="margin-top:80px">
    <?php if (isset($_GET['message'])): ?>
      <p
        style="text-align:center; font-size: 16px; background-color: #283F3B; color: #FFF; padding:10px; border-radius:7px;">
        <?php echo $_GET['message']; ?>
      </p>
    <?php endif ?>
    <div class="instructions">
      <h1 class="title" style="margin-bottom:10px;">
        Edite os presentes da sua lista
      </h1>
      <p>
        Você pode editar a imagem, descrição e valor dos seus presentes. Basta clicar no item que deseja alterar.
        Você
        também pode utilizar nossas opções de listas automáticas ou criar presentes personalizados na opção criar
        meu
        presente.
      </p>
      <div class="gift-list__choose">
        <button class="btn" id="abrirListModal" style="margin-right: 10px;">Listas</button>
        <button class="btn" id="abrirGiftModal">Presentes</button>
      </div>
    </div>

    <div class="gift-list__container myList" id="myList">
      <h1 class="title" style="padding-bottom:10px;">Minhas Listas</h1>
      <hr>
      <?php
      if ($site_principal_lists) {
        switch_to_blog(1);
        foreach ($site_principal_lists as $site_principal_list) {
          setup_postdata($site_principal_list);
          $lista_id = $site_principal_list->ID;
          $list_title = $site_principal_list->post_title;
          $list_image = get_the_post_thumbnail_url($lista_id);
          $list_description = esc_html($site_principal_list->post_content);

          ?>
          <div class="gift-list__item">
            <div class="gift-list__image">
              <img src="<?php echo esc_url($list_image); ?>" alt="">
            </div>
            <div class="gift-list__desc">
              <h2>
                <?php echo $list_title; ?>
              </h2>
              <p>
                <?php echo $list_description; ?>
              </p>
            </div>
            <div class="">
              <a class="btn remover-lista" href="?lista_id=<?php echo $lista_id; ?>">Remover Lista</a>
            </div>
          </div>
          <?php
        }
      } else {
        echo '<p style="padding-top:10px;">Você ainda não selecionou nenhuma lista.</p>';
      }
      restore_current_blog();
      ?>
    </div>

    <div class="gift-list__container myList" id="myList">
      <h1 class="title" style="padding-bottom:10px;">Meus Presentes</h1>
      <hr>
      <?php

      switch_to_blog(1);
      if ($site_principal_presentes) {
        foreach ($site_principal_presentes as $site_principal_presente) {
          setup_postdata($site_principal_list);
          $presente_id = $site_principal_presente->ID;
          $presente_title = $site_principal_presente->post_title;
          $presente_image = get_the_post_thumbnail_url($presente_id, 'medium');
          $presente_description = esc_html($site_principal_presente->post_content);
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
            </div>
            <div class="">
              <a class="btn remover-presente" href="?presente_id=<?php echo $presente_id; ?>">Remover Presente</a>
            </div>
          </div>
          <?php
        }
      } else {
        echo '<p style="padding-top:10px;">Você ainda não criou e nem selecionou nenhum presente.</p>';
      }
      restore_current_blog();

      switch_to_blog($subsite_id);
      if ($meus_presentes) {
        foreach ($meus_presentes as $user_presente) {
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
            </div>
            <div class="">
              <a class="btn remover-presente" href="?meu_presente_id=<?php echo $presente_id; ?>">Remover Presente</a>
            </div>
          </div>
          <?php
        }
      }
      restore_current_blog();
      ?>
    </div>

  </section>
  <?php
} else {
  // Exiba uma mensagem para os usuários não logados, ou redirecione-os para fazer login.
  echo '<p>Faça login para criar e gerenciar suas listas de presentes.</p>';
}
?>
<!-- Modal de Presentes -->
<div id="giftDialog" class="modall">
  <div class="modall-content">
    <form method="dialog" id="giftForm">
      <p>Tipos de Presentes: <span class="close">
          <?= $close ?>
        </span></p>

      <div class="gift-list__type-wrap">
        <input type="radio" name="optGift" id="optGift1" value="Galeria de Presentes" checked>
        <label for="optGift1">Galeria de Presentes</label>
      </div>

      <div class="gift-list__type-wrap">
        <input type="radio" name="optGift" id="optGift2" value="Criar Meu Presente">
        <label for="optGift2">Criar Meu Presente</label>
      </div>

      <div class="gift-list__choose">
        <button type="button" class="btn" id="giftButton">Avançar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal de Listas -->
<div id="listDialog" class="modall">
  <div class="modall-content">
    <form method="dialog" id="listForm">
      <p>Tipos de lista: <span class="close">
          <?= $close ?>
        </span></p>

      <?php
      foreach ($lists as $list) {
        switch_to_blog(1);
        $list_id = $list->ID;
        $list_title = esc_html(get_the_title($list_id));
        $list_image = get_the_post_thumbnail_url($list_id, 'medium');
        $list_description = esc_html(get_the_content($list_id));
        ?>
        <div class="gift-list__type-wrap">
          <input type="radio" name="optList" id="optList1" value="<?php echo $list_id; ?>">
          <label for="optList1">
            <?php echo $list_title; ?>
          </label>
        </div>

        <?php
      }
      ?>

      <div class="gift-list__choose">
        <button type="button" class="btn" id="listButton">Avançar</button>
      </div>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  jQuery(document).ready(function () {
    jQuery(".close").click(function () {
      jQuery(".modall").fadeOut();
    });

    // Abre o modall de Listas
    jQuery("#abrirListModal").click(function () {
      jQuery("#listDialog").fadeIn();
    });

    // Abre o modall de Presentes
    jQuery("#abrirGiftModal").click(function () {
      jQuery("#giftDialog").fadeIn();
    });

    // Redireciona o usuário com base na seleção no modall de Listas
    jQuery("#listButton").click(function () {
      var selectedOption = jQuery("input[name='optList']:checked").val();
      window.location.href =
        "lista-de-presentes/selecionar-lista-de-presentes/?lista_presente_id=" + selectedOption;
    });

    // Redireciona o usuário com base na seleção no modall de Presentes
    jQuery("#giftButton").click(function () {
      var selectedOption = jQuery("input[name='optGift']:checked").val();
      if (selectedOption === "Galeria de Presentes") {
        window.location.href = "lista-de-presentes/galeria-de-presentes";
      } else {
        window.location.href = "lista-de-presentes/criar-presente";
      }
    });
  });

  // Adicione este código para remover o presente
  jQuery(document).on("click", ".remover-presente", function () {
    var presenteId = jQuery(this).data("presente-id");
    if (confirm("Tem certeza de que deseja remover este presente?")) {

    }
  });

  jQuery(document).on("click", ".remover-lista", function () {
    var listaId = jQuery(this).data("lista-id");
    if (confirm("Tem certeza de que deseja remover esta lista de presentes?")) {

    }
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

  .modall {
    display: none;
    position: fixed;
    width: 294px;
    background-color: white;
    border-radius: 21px;
    border: 1.5px solid #000;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    height: auto;
  }

  .modall-content {
    height: auto;
    padding: 20px;
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