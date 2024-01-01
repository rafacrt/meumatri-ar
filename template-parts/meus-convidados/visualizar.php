<section style="margin-top:70px; margin-left:-15px;">
  <span class="container"><a href="<?= site_url() . '/painel' ?>">
      <?= $backArrow ?>
    </a></span>
  <div class="container inner-container">
    <h1 style="text-align:center">Lista de Confirmados</h1>
    <button class="btn" id="abrirModal">Adicionar convidado</button>
    <a class="download-link" style="text-align:center" href="">Download da lista de convidados (Excel)</a>
    <?php
    require get_template_directory() . '/inc/icons.php';

    // Função para gerar a tabela de leads e calcular os totais
    function gerar_tabela_de_leads()
    {
      global $wpdb;

      // Altere isso para o nome correto do seu post type "rsvp"
      $post_type = 'rsvp';

      $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        // Recupere todos os posts do tipo
      );

      $leads = new WP_Query($args);

      $total_confirmados = 0;
      $total_adultos = 0;
      $total_criancas = 0;

      echo '<table>';
      echo '<tr><th>Nome</th><th>Quantidade</th><th>Excluir</th></tr>';

      if ($leads->have_posts()) {
        while ($leads->have_posts()) {
          $leads->the_post();
          $lead_id = get_the_ID();
          $lead_name = get_the_title();
          $lead_adults_number = get_post_meta($lead_id, 'adults_number', true);
          $lead_kids_number = get_post_meta($lead_id, 'kids_number', true);

          // Calcule os totais com base nos dados
          $total_confirmados++;
          $total_adultos += $lead_adultos_number;
          $total_criancas += $lead_kids_number;

          echo '<tr>';
          echo '<td style="width: 80% !important; ">' . $lead_name . '</td>';
          echo '<td style="width: 10% !important;">' . ($lead_adultos_number + $lead_kids_number) . '</td>';
          echo '<td style="width: 10% !important;"><a class="btn-excluir" data-id="' . $lead_id . '">X</a></td>';
          echo '</tr>';
        }
      }

      echo '</table>';

      // Retorne os totais como um array
      return array(
        'total_confirmados' => $total_confirmados,
        'total_adultos' => $total_adultos,
        'total_criancas' => $total_criancas,
      );
    }

    // Chame a função para calcular os totais
    $totals = gerar_tabela_de_leads();
    $total_confirmados = $totals['total_confirmados'];
    $total_adultos = $totals['total_adultos'];
    $total_criancas = $totals['total_criancas'];
    ?>




    <div style="float:right">
      <p>Total de confirmados:
        <?php echo $total_confirmados; ?>
      </p>
      <p>Total de adultos:
        <?php echo $total_adultos; ?>
      </p>
      <p>Total de crianças:
        <?php echo $total_criancas; ?>
      </p>
      <p>Total de ausentes:
        <?php echo $total_confirmados - ($total_adultos + $total_criancas); ?>
      </p>
    </div>
  </div>
</section>
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close" id="fecharModal">&times;</span>
    <h2>Adicionar Convidado</h2>
    <form id="rsvp_forms" method="post">

      <label for="rsvpName">Nome completo:
        <br>
        <input type="text" id="rsvpName" name="name" placeholder="Insira seu nome completo">
      </label>

      <label for="email">
        E-mail
        <input type="email" name="email" id="email" placeholder="exemplo@email.com">
      </label>

      <label for="adults_number">
        Quantidade de adultos
        <br>
        <input type="number" name="adults_number" id="adults_number" min="1">
      </label>
      <label for="kids_number">
        Quantidade de crianças
        <br>
        <input type="number" name="kids_number" id="kids_number" min="0">
      </label>

      <label for="tel">
        Telefone
        <br>
        <input type="tel" name="telefone" id="telefone" placeholder="(11)99999-9999">
      </label>
      <br>
      <br>
      <button type="submit" class="btn">Confirmar Presença</button>
    </form>
  </div>
</div>

<style>
  .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
  }

  .modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 95%;
    position: relative;
  }

  .close {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 24px;
    cursor: pointer;
  }

  .btn {
    font-size: 20px;
    font-weight: 600;
    line-height: 26px;
    letter-spacing: -0.04em;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    width: 280px;
    height: 54px;
    margin: 24px auto;
  }

  a.download-link {
    display: block;
  }

  table {
    border-collapse: collapse;
    width: 100%;
    margin: 50px auto;
    background-color: #ffffff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }

  th,
  td {
    padding: 12px 15px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
    font-weight: 600;
  }

  tr:nth-child(even) {
    background-color: #f7f7f7;
  }

  tr:hover {
    background-color: #e0e0e0;
  }

  th:last-child,
  td:last-child {
    text-align: center;
  }

  td:last-child {
    padding: 8px;
  }

  td:last-child a {
    color: #d9534f;
    text-decoration: none;
    transition: color 0.3s;
  }

  td:last-child a:hover {
    color: #c9302c;
  }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
  jQuery('.btn-excluir').click(function () {
    var convidadoId = $(this).data("id");
    excluirConvidado(convidadoId);
  })
  function excluirConvidado(convidadoID) {
    if (confirm("Tem certeza de que deseja excluir este convidado? Essa ação não pode ser desfeita.")) {
      jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
          action: 'excluir_convidado',
          convidado_id: convidadoID
        },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.status === 'success') {
            location.reload();
          } else {
            alert('Erro ao excluir o convidado: ' + response.message);
          }
        }
      });
    }
  }
  $(document).ready(function () {
    // Abrir o modal quando o botão for clicado
    $("#abrirModal").click(function () {
      $("#modal").css("display", "block");
    });

    // Fechar o modal quando o botão de fechar for clicado
    $("#fecharModal").click(function () {
      $("#modal").css("display", "none");
    });

    // Fechar o modal quando a área fora do modal for clicada
    $(window).click(function (e) {
      if (e.target.id === "modal") {
        $("#modal").css("display", "none");
      }
    });
  });

  jQuery('#rsvp_forms').on('submit', function (e) {
    e.preventDefault();

    var rsvpName = jQuery('#rsvpName').val();
    var adults_number = jQuery('#adults_number').val();
    var kids_number = jQuery('#kids_number').val();
    var email = jQuery('#email').val();
    var telefone = jQuery('#telefone').val();
    var policy = jQuery('#policy').is(':checked');
    var isGoing = jQuery('input[name="boolean"]:checked').val();

    // Verificar se o usuário concordou com a política
    if (!policy) {
      jQuery('.error-message').text('Você deve concordar com a política de privacidade');
      return;
    }

    // Validar o e-mail
    if (!isValidEmail(email)) {
      jQuery('.error-message').text('E-mail inválido');
      return;
    }

    jQuery.ajax({
      type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      data: {
        action: 'cadastrar_rsvp',
        rsvpName: rsvpName,
        adults_number: adults_number,
        kids_number: kids_number,
        email: email,
        telefone: telefone,
      },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.status === 'success') {
          // Redirecionar ou realizar ações após o sucesso
          jQuery('.success-message').text('Sua presença foi confirmada!');
          jQuery('.error-message').hide();
          window.location.reload;
        } else {
        }
      }
    });
  });
</script>