<?php
/* Template Name: Lista Para Casa*/
if (is_user_logged_in()) {
  require get_template_directory() . '/inc/icons.php';
  get_header();


  //only for now
  $list_image1 = get_template_directory_uri() . '/assets/images/lists/image 1.png';
  $list_image2 = get_template_directory_uri() . '/assets/images/lists/image 2.png';
  $list_image3 = get_template_directory_uri() . '/assets/images/lists/image 3.png';
  $list_image4 = get_template_directory_uri() . '/assets/images/lists/image 4.png';
  $list_image5 = get_template_directory_uri() . '/assets/images/lists/image 5.png';
  $list_image6 = get_template_directory_uri() . '/assets/images/lists/image 6.png';

  $text1 = 'Acessórios de servir 80 presentes Total da lista';
  $text2 = 'Aparelhos de jantar 33 presentes Total da lista';
  $text3 = 'Banheiro 37 presentes Total da lista';
  $text4 = 'Bar e petiscos 64 presentes Total da lista';
  $text5 = 'Cama e cia. 35 presentes Total da lista';
  $text6 = 'Eletrodomésticos 37 presentesTotal da lista';

  $price1 = '6.300,00';
  $price2 = '239,31';
  $price3 = '103,00';
  $price4 = '239,31';
  $price5 = '103,00';
  $price6 = '239,31';
?>
  <section class="user-panel edit-gift-list">
    <div class="instructions">
      <h1 class="title">
        Lista Para Casa
      </h1>

      <div class="gift-list__container" id="myList">
        <!-- TO DO: Replace for to foreach here -->
        <div class="gift-list__item">
          <div class="gift-list__image">
            <img class="" src="<?= $list_image1 ?>" alt="">
          </div>
          <div class="gift-list__desc">
            <p class="text"><?= $text1 ?></p>
            <p class="price">R$ <?= $price1 ?></p>
          </div>
          <div class="gift-list__button">
            <button class="btn">Adicionar</button>
          </div>
        </div>

        <div class="gift-list__item">
          <div class="gift-list__image">
            <img class="" src="<?= $list_image2 ?>" alt="">
          </div>
          <div class="gift-list__desc">
            <p class="text"><?= $text2 ?></p>
            <p class="price">R$ <?= $price2 ?></p>
          </div>
          <div class="gift-list__button">
            <button class="btn">Adicionar</button>
          </div>
        </div>

        <div class="gift-list__item">
          <div class="gift-list__image">
            <img class="" src="<?= $list_image3 ?>" alt="">
          </div>
          <div class="gift-list__desc">
            <p class="text"><?= $text3 ?></p>
            <p class="price">R$ <?= $price3 ?></p>
          </div>
          <div class="gift-list__button">
            <button class="btn">Adicionar</button>
          </div>
        </div>
        <div class="gift-list__item">
          <div class="gift-list__image">
            <img class="" src="<?= $list_image4 ?>" alt="">
          </div>
          <div class="gift-list__desc">
            <p class="text"><?= $text4 ?></p>
            <p class="price">R$ <?= $price4 ?></p>
          </div>
          <div class="gift-list__button">
            <button class="btn">Adicionar</button>
          </div>
        </div>
        <div class="gift-list__item">
          <div class="gift-list__image">
            <img class="" src="<?= $list_image5 ?>" alt="">
          </div>
          <div class="gift-list__desc">
            <p class="text"><?= $text5 ?></p>
            <p class="price">R$ <?= $price5 ?></p>
          </div>
          <div class="gift-list__button">
            <button class="btn">Adicionar</button>
          </div>
        </div>
        <div class="gift-list__item">
          <div class="gift-list__image">
            <img class="" src="<?= $list_image6 ?>" alt="">
          </div>
          <div class="gift-list__desc">
            <p class="text"><?= $text6 ?></p>
            <p class="price">R$ <?= $price6 ?></p>
          </div>
          <div class="gift-list__button">
            <button class="btn">Adicionar</button>
          </div>
        </div>
      </div> <!-- /gift-list__container -->
  </section>


  <!-- pop-up dialog box, containing a form -->
  <dialog id="listDialog">
    <form method="dialog">
      <p>Tipos de lista:<span id="close" type="reset"><?= $close ?></span></p>

      <div class="gift-list__type-wrap">
        <input type="radio" name="opt" id="opt1" value="true" checked>
        <label for="opt1">Para Casa</label>
      </div>

      <div class="gift-list__type-wrap">
        <input type="radio" name="opt" id="opt2" value="false">
        <label for="opt2">Cotas de lua de mel</label>
      </div>

      <div class="gift-list__type-wrap">
        <input type="radio" name="opt" id="opt3" value="false">
        <label for="opt3">Presentes de casamento</label>
      </div>

      <div class="gift-list__choose">
        <button class="btn" type="submit" onclick="inserirConteudoNaDiv(document.getElementById('myList'))">Criar lista</button>
      </div>
    </form>
  </dialog>



  <style>
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
      line-height: 150%;
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
    .gift-list__choose>a {
      width: 165px;
      height: 60px;
      margin: 42px auto 0;
    }
  </style>


  <script>
    const createButton = document.getElementById("createList");
    const closeButton = document.getElementById("close");
    const modal = document.getElementById("listDialog");
    modal.returnValue = "boolean";

    function openCheck(modal) {
      if (modal.open) {
        console.log("Dialog open");
      } else {
        console.log("Dialog closed");
      }
    }

    // Update button opens a modal modal
    createButton.addEventListener("click", () => {
      modal.showModal();
      openCheck(modal);
    });

    // Form modal button closes the modal box
    closeButton.addEventListener("click", () => {
      modal.close("listNotChosen");
      openCheck(modal);
    });

    /**************************/
    function inserirConteudoNaDiv(div) {
      // Cria a div que irá conter os elementos
      const minhaDiv = Object.assign(document.createElement('div'), {
        classList: 'gift-list__item',
        innerHTML: '<div class="gift-list__image"><img class="" src="<?= $list_image2 ?>" alt=""></div><div class="gift-list__desc"><p class="text"><?= $text2 ?></p><p class="price">R$ <?= $price2 ?></p></div><div class="gift-list__button"><button  class="btn">Adicionar</button></div>'
      });

      // Cria a imagem e define seu src
      // const minhaImagem = document.createElement("img");
      // minhaImagem.src = "caminho/para/imagem.jpg";

      // // Cria o texto e define seu conteúdo
      // const meuTexto = document.createElement("p");
      // meuTexto.innerText = "Este é o meu texto.";

      // // Cria o botão e define seu texto
      // const meuBotao = document.createElement("button");
      // meuBotao.innerText = "Clique aqui!";

      // // Adiciona os elementos criados na div
      // minhaDiv.appendChild(minhaImagem);
      // minhaDiv.appendChild(meuTexto);
      // minhaDiv.appendChild(meuBotao);

      // Insere a div dentro da div especificada
      div.appendChild(minhaDiv);
    }
    event.preventDefault();

    const minhaDiv = document.getElementById("myList");
    inserirConteudoNaDiv(minhaDiv);
  </script>
<?php
  get_footer();
} else {
  // O usuário não está logado, redirecione para outra página.
  wp_redirect(site_url() . '/login');
  exit;
}
