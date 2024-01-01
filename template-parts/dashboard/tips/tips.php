
<?php
require get_template_directory() . '/inc/icons.php';
$tips = get_template_directory_uri().'/assets/images/common/tips-image.png';
?>
<section class="tips-section dicas">
    <span class="back-arrow" data-arrow="1"><?= $backArrow ?></span>
    <div class="main-dicas-content">
      <h1 class="section-title title-dicas">Dicas</h1>

    
      <div class="location-content" id="location-content">
        <h2>Busque por endereço ou pontos de referência próximos ao evento.</h2>
        <label for="search-location">
          <img src="<?php echo get_template_directory_uri().'/assets/images/Pesquisar.png'?>" alt="">
          <input type="text" name="search-location" class="search-location" placeholder="Informe o local" id="search-location">
        </label>
      </div>
  
      <div class="tips-content dicas-content-tips">
          <img src="<?=$tips?>" alt="" srcset="">
          <p class="text text-legend-dicas">Facilite a vida dos seus convidados</p>
      </div>
  
      <div class="maps-content">
          <div class="maps-box" id="map-tips">
  
          </div>
          <div class="map-list" id="results">
            
          </div>
      </div>
  
      <div id="results-placed">
  
      </div>
      <button id="addTips" class="btn">Adicionar Dicas</button>
    </div>
    
    <div class="dicas-detalhes">
      <div class="dicas-detalhes-imagem">
        <img src="" alt="">
      </div>
      <div class="dicas-detalhes-body">
        <h2></h2>
        <span class="endereco">
          <strong>Endereço:</strong>
          <p></p>
        </span>
        <span class="telefone">
          <strong>Telefone:</strong>
          <p></p>
        </span>
        <span class="website"></span>
        <p></p>
      </div>

      <div id="dicas-detalhes-mapa" class="dicas-detalhes-mapa">
        
      </div>
      <button type="button" class="btn btn-danger btnRemover">Remover Dica</button>
    </div>

    <div class='nova-dica'>
      <h1 class="section-title title-dicas">Adicionar dica</h1>
      <h2>Preencha os campos a baixo:</h2>

        <form id="new-place-form">
          <label for="place-name">
            Nome:
            <input type="text" id="place-name" placeholder="Dica" required>
          </label>
          <label for="place-website">
            Site
            <input type="text" id="place-website" placeholder="http://www.dica.com.br">
          </label>
          <label for="place-description">
            Descrição
            <textarea id="place-description" placeholder="Recomendamos esta dica pensando no seu conforto e comodidade."></textarea>
          </label>
          <label for="search-location-outra" id="search-location-outra-label" style="display: none;">
            Endereço
            <input type="text" id="search-location-outra" placeholder="Endereço">
          </label>
          <div id="map-dica-outra" class="map-dica-outra">

          </div>
          <label for="place-image" class="image-box">
            <img class='icon-upload' src="<?php echo get_template_directory_uri().'/assets/images/uploadDicas.png'; ?>" alt="">
            <img class='dicas-preview' id="image-preview" src="" alt="">
            <p><strong>Clique para carregar</strong> ou arraste e solte SVG, PNG, JPG or GIF (max. 800x400px)</p>
            <input type="file" id="place-image" accept="image/*">
          </label>
          <button type="button" id="show-address-input">Adicionar Mapa</button>
          <button type="submit" class='btn' id="addDicaOutras">Adicionar Dica</button>
      </form>
    </div>
</section> 

<!-- pop-up dialog box, containing a form -->
<dialog id="listDialogTips">
  <form method="dialog">
    <p>Tipo de Dica:<span id="cancel" type="reset"><?= $close ?></span></p>

        <div class="gift-list__type-wrap">
        <label for="opt1">
          <input type="radio" name="opt" id="opt1" value="Hotéis">
          <legend class='legend-title' style="display: none">Encontre hotéis próximos ao local da festa e garanta o conforto dos seus convidados </legend>
          <?=$hotel?>Hotéis
        </label>
        </div>
  
        <div class="gift-list__type-wrap">
          <label for="opt2">
            <input type="radio" name="opt" id="opt2" value="Salão de Beleza" >
            <legend class='legend-title' style="display: none;">Encontre os salões de beleza mais recomendados e deixe que os profissionais realcem a beleza de cada convidado</legend>
            <?=$beauty?>Salão de Beleza</label>
        </div>  
          
        <div class="gift-list__type-wrap">
        <label for="opt3">
          <input type="radio" name="opt" id="opt3" value="Restaurantes" >
          <legend  class='legend-title' style="display: none;">Descubra os melhores restaurantes na vizinhança do evento e transforme a celebração em uma experiência gastronômica inesquecível. </legend>
          <?=$restaurant?>Restaurantes</label>
        </div>

        <div class="gift-list__type-wrap">
        <label for="opt4">
          <input type="radio" name="opt" id="opt3" value="Outra" >
          <?=$other?>Outra</label>
        </div>

        
  </form>
</dialog>   

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHu4iSIY1rutDG2emSGKJwN6GU_CNAJco&libraries=places"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/tips.js"></script>
<style>
label{
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 24px;
  margin: 24px 0;
}
#listDialogTips{
  max-width: 300px;
}
  /* HIDE RADIO */
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
input[type=radio]:checked + img {
  outline: 2px solid #f00;
}
</style>
