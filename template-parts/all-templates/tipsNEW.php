<?php
/*
    Obligatory Args:
        {
            title: String,
            description: String,
            list: Array,
            ...
        }
*/
require_once get_template_directory() . '/inc/icons.php';

$editIcon = get_template_directory_uri().'/assets/images/Icon.svg';
$bgSection = get_template_directory_uri() . '/assets/images/templates-assets/jardimTips.png';
$title = 'Dicas dos Noivos';
$breakIcon = get_template_directory_uri().'/assets/images/'.$args.'-ms.png';
$description = 'Preparem-se para a diversão! A festa será realizada na Villa Bisutti Casa do Ator após a cerimônia religiosa. A cerimônia será rápida e tentaremos ser extremamente pontuais. Contamos com vocês!';
?>

<section class="tipsNew" draggable="true" style="background: url(<?php echo $bgSection ?>)">
<div class="container">
    <div class="edition-wrap">
        <h2 class="sectionTitleNew" id="meu-elemento6" contenteditable="false"><?=$title?></h2>
        <img id="meu-botao6" class="edit" onclick="toggleContentEditable('meu-elemento6', 'meu-botao6')" src="<?=$editIcon?>" alt="" srcset="">
    </div>
    <img class="middle-icon" src="<?=$breakIcon?>" alt="">
    <div class="edition-wrap">
        <p class="text descriptionNew" id="meu-elemento7" contenteditable="false">
            <?= $description ?>
        </p>
        <img id="meu-botao7" class="edit" onclick="toggleContentEditable('meu-elemento7', 'meu-botao7')" src="<?=$editIcon?>" alt="" srcset="">
    </div>    
    <br>
    <div class="tips__buttons--container">
        <div class="tips__buttons--items">
            <button  class="btn">Todos</button>
            <button  class="btn">Hotéis</button>
        </div>
        <div class="tips__buttons--items">
            <button  class="btn">Salões de Beleza</button>
            <button  class="btn">Restaurantes</button>
        </div>
    </div>
    </div>
</section>