<?php
?>

<section class="confirm-presence">
  <div class="container">
     <h2 class="confirm-presence__title">Confirme sua Presença</h2>

     <form class="confirm-presence__form">
        <label class="confirm-presence__form__input-field" for="name">
          <span>Nome completo</span>
          <input type="text" id="name" name="name">
        </label>
        <label class="confirm-presence__form__input-field" for="email">
          <span>E-mail</span>
          <input type="email" id="email" name="email" placeholder="exemplo@email.com.br">
        </label>
        <div class="confirm-presence__form__radio-field">
          <span>Podemos contar com a sua presença no evento?</span>
          <div class="confirm-presence__form__radio-field__options">
            <label class="confirm-presence__form__radio-field__options__option">
              <input type="radio" name="presence" value="yes" checked>
              Sim
            </label>
            <label class="confirm-presence__form__radio-field__options__option">
              <input type="radio" name="presence" value="no">
              Não
            </label>
          </div>
        </div>
        <label class="confirm-presence__form__input-field" for="phone">
          <span>Telefone</span>
          <input type="phone" id="phone" name="phone" placeholder="(XX)99999-9999">
        </label>
        <div class="dropdowns">
          <div class="dropdown dropdown--adult ">
            <button class="btn btn-secondary dropdown__toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              <span class="dropdown__placeholder">Ordenar lista</span>
              <span class="dropdown__toggle__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none">
                  <path d="M0.724074 0.641554C0.945963 0.419666 1.29318 0.399494 1.53786 0.581039L1.60796 0.641554L6.99935 6.03266L12.3907 0.641554C12.6126 0.419666 12.9598 0.399494 13.2045 0.581039L13.2746 0.641554C13.4965 0.863443 13.5167 1.21066 13.3351 1.45534L13.2746 1.52544L7.44129 7.35877C7.2194 7.58066 6.87218 7.60083 6.62751 7.41929L6.55741 7.35877L0.724074 1.52544C0.479996 1.28136 0.479996 0.885632 0.724074 0.641554Z" fill="currentColor"/>
              </svg>
              </span>
            </button>
            <div class="dropdown__menu ">
              <li data-value="1" class="dropdown__menu__item">Opção 1</li>
              <li data-value="2" class="dropdown__menu__item">Opção 2</li>
              <li data-value="3" class="dropdown__menu__item">Opção 3</li>
              <li data-value="4" class="dropdown__menu__item">Opção 4</li>
            </div>
          </div>
          <div class="dropdown dropdown--children ">
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
        </div>
        <button class="confirm-presence__form__submit" type="submit">
          Confirmar presença
        </button>
     </form>
  </div>
</section>

<script>
    const confirmPresenceBtnDropdown = document.querySelectorAll('.confirm-presence .dropdown__toggle')
    
    confirmPresenceBtnDropdown.forEach(btn => {
      const elFather = btn.closest('.confirm-presence .dropdown')
      const classFather = Array.from(elFather.classList).map(cl => `.${cl}`).join('');

      btn.addEventListener('click', function(){
        const btnAriaExpanded = btn.getAttribute('aria-expanded');
        btnAriaExpanded === 'true' ? btn.setAttribute('aria-expanded', 'false') : btn.setAttribute('aria-expanded', 'true');
        slideToggle(`.confirm-presence ${classFather} .dropdown__menu`)
      })

      const options = elFather.querySelectorAll('.dropdown__menu__item');
      const selectedOption = elFather.querySelector(' .dropdown__placeholder')
      
      options.forEach(option => {
        option.addEventListener('click', function(){
          const optionValue = option.getAttribute('data-value');
          const optionLabel = option.innerHTML;
          if(optionLabel === selectedOption.innerHTML){
            return;
          }
          selectedOption.innerHTML = optionLabel;
          btn.setAttribute('aria-expanded', 'false');
          slideToggle(`${classFather} .dropdown__menu`)
          elFather.classList.toggle('active')
        })
      })

    })
    
    
</script>