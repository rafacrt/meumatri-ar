<?php 
  $itemActive = '';
  $iconCardMobile = '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.8125 11.9699C8.502 11.9699 8.25 11.7179 8.25 11.4074V5.91211C8.25 5.60161 8.502 5.34961 8.8125 5.34961C9.123 5.34961 9.375 5.60161 9.375 5.91211V11.4074C9.375 11.7179 9.123 11.9699 8.8125 11.9699Z" fill="black"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5627 9.22217H6.06299C5.75174 9.22217 5.50049 8.97017 5.50049 8.65967C5.50049 8.34917 5.75174 8.09717 6.06299 8.09717H11.5627C11.8732 8.09717 12.1252 8.34917 12.1252 8.65967C12.1252 8.97017 11.8732 9.22217 11.5627 9.22217Z" fill="black"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.298 1.72949C3.219 1.72949 1.875 3.15224 1.875 5.35574V11.9782C1.875 14.1817 3.219 15.6045 5.298 15.6045H12.327C14.4067 15.6045 15.75 14.1817 15.75 11.9782V5.35574C15.75 3.15224 14.4067 1.72949 12.327 1.72949H5.298ZM12.327 16.7295H5.298C2.57775 16.7295 0.75 14.82 0.75 11.9782V5.35574C0.75 2.51399 2.57775 0.604492 5.298 0.604492H12.327C15.0472 0.604492 16.875 2.51399 16.875 5.35574V11.9782C16.875 14.82 15.0472 16.7295 12.327 16.7295Z" fill="black"/>
  </svg>';
  $iconCardDesktop = '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M2.1638 3.17374L2.4653 6.75974C2.4873 7.03574 2.7128 7.24274 2.9883 7.24274H2.9903H8.4458H8.4468C8.7073 7.24274 8.9298 7.04874 8.9668 6.79124L9.4418 3.51174C9.4528 3.43374 9.4333 3.35574 9.3858 3.29274C9.3388 3.22924 9.2698 3.18824 9.1918 3.17724C9.0873 3.18124 4.7508 3.17524 2.1638 3.17374ZM2.9873 7.99274C2.3288 7.99274 1.7713 7.47874 1.7178 6.82124L1.2598 1.37424L0.506297 1.24424C0.301797 1.20824 0.165297 1.01474 0.200297 0.810243C0.236297 0.605744 0.433797 0.472744 0.633797 0.504744L1.6738 0.684744C1.8413 0.714244 1.9688 0.853244 1.9833 1.02324L2.1008 2.42374C9.2388 2.42674 9.2618 2.43024 9.2963 2.43424C9.5748 2.47474 9.8198 2.62024 9.9868 2.84424C10.1538 3.06774 10.2238 3.34324 10.1838 3.61924L9.7093 6.89824C9.6198 7.52224 9.0778 7.99274 8.4478 7.99274H8.4453H2.9913H2.9873Z" fill="white"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M7.64369 5.02197H6.25769C6.05019 5.02197 5.88269 4.85397 5.88269 4.64697C5.88269 4.43997 6.05019 4.27197 6.25769 4.27197H7.64369C7.85069 4.27197 8.01869 4.43997 8.01869 4.64697C8.01869 4.85397 7.85069 5.02197 7.64369 5.02197Z" fill="white"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M2.77226 9.35107C2.92276 9.35107 3.04426 9.47257 3.04426 9.62307C3.04426 9.77357 2.92276 9.89557 2.77226 9.89557C2.62126 9.89557 2.49976 9.77357 2.49976 9.62307C2.49976 9.47257 2.62126 9.35107 2.77226 9.35107Z" fill="white"/>
  <mask id="mask0_587_3512" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="9" width="2" height="1">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.49939 9.62259C2.49939 9.77359 2.62089 9.89559 2.77239 9.89559C2.92289 9.89559 3.04439 9.77359 3.04439 9.62259C3.04439 9.47209 2.92289 9.35059 2.77239 9.35059C2.62089 9.35059 2.49939 9.47209 2.49939 9.62259Z" fill="white"/>
  </mask>
  <g mask="url(#mask0_587_3512)">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M-0.00012207 12.3951H5.54438V6.85059H-0.00012207V12.3951Z" fill="white"/>
  </g>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M2.77176 9.52058C2.71526 9.52058 2.66926 9.56658 2.66926 9.62308C2.66926 9.73658 2.87476 9.73658 2.87476 9.62308C2.87476 9.56658 2.82826 9.52058 2.77176 9.52058ZM2.77176 10.2706C2.41476 10.2706 2.12476 9.98007 2.12476 9.62307C2.12476 9.26607 2.41476 8.97607 2.77176 8.97607C3.12876 8.97607 3.41926 9.26607 3.41926 9.62307C3.41926 9.98007 3.12876 10.2706 2.77176 10.2706Z" fill="white"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.41239 9.35107C8.56289 9.35107 8.68489 9.47257 8.68489 9.62307C8.68489 9.77357 8.56289 9.89557 8.41239 9.89557C8.26139 9.89557 8.13989 9.77357 8.13989 9.62307C8.13989 9.47257 8.26139 9.35107 8.41239 9.35107Z" fill="white"/>
  <mask id="mask1_587_3512" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="8" y="9" width="1" height="1">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.13989 9.62259C8.13989 9.77359 8.26139 9.89559 8.41239 9.89559C8.56239 9.89559 8.68489 9.77359 8.68489 9.62259C8.68489 9.47209 8.56239 9.35059 8.41239 9.35059C8.26139 9.35059 8.13989 9.47209 8.13989 9.62259Z" fill="white"/>
  </mask>
  <g mask="url(#mask1_587_3512)">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.63989 12.3951H11.1849V6.85059H5.63989V12.3951Z" fill="white"/>
  </g>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.41189 9.52057C8.35589 9.52057 8.30989 9.56657 8.30989 9.62307C8.31039 9.73757 8.51539 9.73657 8.51489 9.62307C8.51489 9.56657 8.46839 9.52057 8.41189 9.52057ZM8.41189 10.2706C8.05489 10.2706 7.76489 9.98007 7.76489 9.62307C7.76489 9.26607 8.05489 8.97607 8.41189 8.97607C8.76939 8.97607 9.05989 9.26607 9.05989 9.62307C9.05989 9.98007 8.76939 10.2706 8.41189 10.2706Z" fill="white"/>
  </svg>';
  $gifts = [
    [
      'category' => 'Categoria',
      'name' => 'Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido',
      'price' => 'R$ 450,00'
    ],
    [
      'category' => 'Categoria',
      'name' => 'Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido',
      'price' => 'R$ 450,00'
    ],
    [
      'category' => 'Categoria',
      'name' => 'Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido',
      'price' => 'R$ 450,00'
    ],
    [
      'category' => 'Categoria',
      'name' => 'Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido',
      'price' => 'R$ 450,00'
    ],
    [
      'category' => 'Categoria',
      'name' => 'Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido',
      'price' => 'R$ 450,00'
    ],
    [
      'category' => 'Categoria',
      'name' => 'Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido',
      'price' => 'R$ 450,00'
    ],
    [
      'category' => 'Categoria',
      'name' => 'Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido',
      'price' => 'R$ 450,00'
    ],
    [
      'category' => 'Categoria',
      'name' => 'Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido',
      'price' => 'R$ 450,00'
    ],
  ]
?>



<section class="gifts">
  <h3 class="gifts__title">Presentes</h3>

  <div class="gifts__filters">
    <div class="dropdown dropdown--gifts">
      <button class="btn btn-secondary dropdown__toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
        <span class="dropdown__placeholder">Ordenar lista</span>
        <span class="dropdown__toggle__icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none">
            <path d="M0.724074 0.641554C0.945963 0.419666 1.29318 0.399494 1.53786 0.581039L1.60796 0.641554L6.99935 6.03266L12.3907 0.641554C12.6126 0.419666 12.9598 0.399494 13.2045 0.581039L13.2746 0.641554C13.4965 0.863443 13.5167 1.21066 13.3351 1.45534L13.2746 1.52544L7.44129 7.35877C7.2194 7.58066 6.87218 7.60083 6.62751 7.41929L6.55741 7.35877L0.724074 1.52544C0.479996 1.28136 0.479996 0.885632 0.724074 0.641554Z" fill="currentColor"/>
        </svg>
        </span>
      </button>
      <div class="dropdown__menu">
        <li data-value="1" class="dropdown__menu__item">Opção 1</li>
        <li data-value="2" class="dropdown__menu__item">Opção 2</li>
        <li data-value="3" class="dropdown__menu__item">Opção 3</li>
        <li data-value="4" class="dropdown__menu__item">Opção 4</li>
      </div>
    </div>
    <div class="pills">
      <div class="pill active">Label</div>
      <div class="pill">Label</div>
      <div class="pill">Label</div>
      <div class="pill">Label</div>
      <div class="pill">Label</div>
      <div class="pill">Label</div>
    </div>

    <div class="pagination pagination--desk">
      <span>Pagina</span>
      <div class="dropdown">
        <button class="dropdown__toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          <span class="dropdown__placeholder">1</span>
          <span class="dropdown__toggle__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none">
              <path d="M0.724074 0.641554C0.945963 0.419666 1.29318 0.399494 1.53786 0.581039L1.60796 0.641554L6.99935 6.03266L12.3907 0.641554C12.6126 0.419666 12.9598 0.399494 13.2045 0.581039L13.2746 0.641554C13.4965 0.863443 13.5167 1.21066 13.3351 1.45534L13.2746 1.52544L7.44129 7.35877C7.2194 7.58066 6.87218 7.60083 6.62751 7.41929L6.55741 7.35877L0.724074 1.52544C0.479996 1.28136 0.479996 0.885632 0.724074 0.641554Z" fill="currentColor"/>
          </svg>
          </span>
        </button>
        <div class="dropdown__menu">
          <li data-value="1" class="dropdown__menu__item">1</li>
          <li data-value="2" class="dropdown__menu__item">2</li>
          <li data-value="3" class="dropdown__menu__item">3</li>
          <li data-value="4" class="dropdown__menu__item">4</li>
        </div>
      </div>
      <span>de 10</span>
    </div>

  </div>
  <div class="gifts__list">
    <?php foreach($gifts as $gift) :?>
      <div class="gift__card">
        <div class="gift__card__img">
          <img src="https://placehold.co/80x60" alt="">
        </div>

        <div class="gift__card__content">
          <p class="gift__card__category">
            Categoria
          </p>
          <p class="gift__card__name">Nome do item mesmo que seja longo demais vai caber ou então vai ficar comprimido</p>
          <strong class="gift__card__price">R$ 450,00         
            <button class="gift__card__icon gift__card__icon--mobile">
              <?= $iconCardMobile ?>
            </button>

            <button class="gift__card__icon gift__card__icon--desktop">
              <?= $iconCardDesktop ?>
            </button>
        
          </strong>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="pagination pagination--mobile">
      <span>Pagina</span>
      <div class="dropdown">
        <button class="dropdown__toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          <span class="dropdown__placeholder">1</span>
          <span class="dropdown__toggle__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none">
              <path d="M0.724074 0.641554C0.945963 0.419666 1.29318 0.399494 1.53786 0.581039L1.60796 0.641554L6.99935 6.03266L12.3907 0.641554C12.6126 0.419666 12.9598 0.399494 13.2045 0.581039L13.2746 0.641554C13.4965 0.863443 13.5167 1.21066 13.3351 1.45534L13.2746 1.52544L7.44129 7.35877C7.2194 7.58066 6.87218 7.60083 6.62751 7.41929L6.55741 7.35877L0.724074 1.52544C0.479996 1.28136 0.479996 0.885632 0.724074 0.641554Z" fill="currentColor"/>
          </svg>
          </span>
        </button>
        <div class="dropdown__menu">
          <li data-value="1" class="dropdown__menu__item">1</li>
          <li data-value="2" class="dropdown__menu__item">2</li>
          <li data-value="3" class="dropdown__menu__item">3</li>
          <li data-value="4" class="dropdown__menu__item">4</li>
        </div>
      </div>
      <span>de 10</span>
    </div>

</section>

<script>
  const btn = document.querySelector('.dropdown--gifts .dropdown__toggle')
  const selectedOption = document.querySelector('.dropdown--gifts .dropdown__placeholder')
  btn.addEventListener('click', function(){
    const btnAriaExpanded = btn.getAttribute('aria-expanded');
    btnAriaExpanded === 'true' ? btn.setAttribute('aria-expanded', 'false') : btn.setAttribute('aria-expanded', 'true');
    slideToggle('.dropdown--gifts .dropdown__menu')
  })
  
  const options = document.querySelectorAll('.dropdown--gifts  .dropdown__menu__item');
  options.forEach(option => {
    option.addEventListener('click', function(){
      const optionValue = option.getAttribute('data-value');
      const optionLabel = option.innerHTML;
      if(optionLabel === selectedOption.innerHTML){
        return;
      }
      selectedOption.innerHTML = optionLabel;
      btn.setAttribute('aria-expanded', 'false');
      slideToggle('.dropdown--gifts .dropdown__menu')
    })
  })

  const pills = document.querySelectorAll('.pill');
  pills.forEach(pill => {
    pill.addEventListener('click', function(){
      pill.classList.toggle('active')
    })
  })


  // Pagination

  const btnTogglePagination = document.querySelectorAll('.pagination .dropdown__toggle')

  btnTogglePagination.forEach(btn => {
    const elFather = btn.closest('.pagination')
    const classFather = Array.from(elFather.classList).map(cl => `.${cl}`).join('');
    btn.addEventListener('click', function(){
      
      if(!classFather) return;

      const btnAriaExpanded = btn.getAttribute('aria-expanded');
      btnAriaExpanded === 'true' ? btn.setAttribute('aria-expanded', 'false') : btn.setAttribute('aria-expanded', 'true');

      slideToggle(`${classFather} .dropdown__menu`)
    })

    const optionsPagination = elFather.querySelectorAll('.dropdown__menu__item');
    const selectedOptionPagination = elFather.querySelector(' .dropdown__placeholder')
    optionsPagination.forEach(option => {
      option.addEventListener('click', function(){
        const optionValue = option.getAttribute('data-value');
        const optionLabel = option.innerHTML;
        if(optionLabel === selectedOptionPagination.innerHTML){
          return;
        }
        selectedOptionPagination.innerHTML = optionLabel;
        btn.setAttribute('aria-expanded', 'false');
        slideToggle(`${classFather} .dropdown__menu`)
        elFather.classList.toggle('active')

      })
    })
  })

</script>