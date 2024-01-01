<?php
/*
    Obligatory Args:
        {
            title: String,
            ...
        }
*/
$editIcon = get_template_directory_uri().'/assets/images/Icon.svg';

$title = 'O casal';
$description = 'Histórias de amor existem, e, às vezes, nem nós mesmos acreditamos todo o tempo que já estamos juntos. Porém, o brilho intenso e apaixonado dos nossos olhares nos fazem lembrar o porquê de chegarmos até aqui sem sentir tanto o tempo passar....Vamos nos casar! Estamos preparando tudo com muito carinho para curtirmos cada momento com nossos amigos e familiares queridos!';
$breakIcon = get_template_directory_uri().'/assets/images/'.$args.'-ms.png';
$images = get_template_directory_uri().'/assets/images/casal 2.png';
?>
<section class="the-couple <?=$args?>" draggable="true">
<div class="container">
    <h2 class="section-title"><?=$title?></h2>
    <img class="middle-icon" src="<?=$breakIcon?>" alt="">    
    <p class="text"><?= $description ?></p>
</section>
<section class="splide" aria-label="Splide Basic HTML Example" draggable="true">
  <div class="splide__track">
		<ul class="splide__list">
			<li class="splide__slide">
			<label for="uploadSplide1">
				<img id="splide1" class="splide_image_carousel" src="<?=$images?>" alt="Imagem selecionada">
				<input type="file" id="uploadSplide1" style="display:none" accept="image/*" onchange="changeImgOfSplide1(this)">            
			</label>
			</li>
			<li class="splide__slide">
			<label for="uploadSplide2">
				<img id="splide2" class="splide_image_carousel" src="<?=$images?>" alt="Imagem selecionada">
				<input type="file" id="uploadSplide2" style="display:none" accept="image/*" onchange="changeImgOfSplide2(this)">            
			</label>	
			</li>
			<li class="splide__slide">
			<label for="uploadSplide3">
				<img id="splide3" class="splide_image_carousel" src="<?=$images?>" alt="Imagem selecionada">
				<input type="file" id="uploadSplide3" style="display:none" accept="image/*" onchange="changeImgOfSplide3(this)">            
			</label>	
			</li>
		</ul>
  </div>
  </div>
</section>
<script>
    function changeImgOfSplide1(input) {
        if (input.files && input.files[0]) {
            var leitorSplide1 = new FileReader();
console.log("splide")
            leitorSplide1.onload = function(e) {
              document.getElementById('splide1').setAttribute('src', e.target.result);
            }

            leitorSplide1.readAsDataURL(input.files[0]);
        }
    }

    function changeImgOfSplide2(input) {
        if (input.files && input.files[0]) {
            var leitorSplide2 = new FileReader();
console.log("splide")
            leitorSplide2.onload = function(e) {
              document.getElementById('splide1').setAttribute('src', e.target.result);
            }

            leitorSplide2.readAsDataURL(input.files[0]);
        }
    }
	function changeImgOfSplide3(input) {
        if (input.files && input.files[0]) {
            var leitorSplide3 = new FileReader();
console.log("splide")
            leitorSplide3.onload = function(e) {
              document.getElementById('splide1').setAttribute('src', e.target.result);
            }

            leitorSplide3.readAsDataURL(input.files[0]);
        }
    }
</script>