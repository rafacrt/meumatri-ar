<?php
/*
Template Name: Jardim
*/

if (!is_user_logged_in()) {
  get_template_part('template-parts/create-account-modal', null, 'jardim');
}

// Carrega o style.css exclusivo do template
wp_enqueue_style('style-jardim', get_template_directory_uri() . '/assets/css/jardim.css');

$title = 'Insira aqui o nome do casal';
$date = 'Data';
if (wp_is_mobile()) {
  $background = get_template_directory_uri() . '/assets/images/templates-assets/jardimBgMobile.png';
} else {
  $background = get_template_directory_uri() . '/assets/images/templates-assets/jardimBg1.png';
}
;
$editIcon = get_template_directory_uri() . '/assets/images/Icon.svg';

?>

<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
$current_user = wp_get_current_user();
?>
<!DOCTYPE html>
<html id="update_font_size" <?= get_language_attributes() ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <link rel="stylesheet" href="<?php get_template_directory_uri() . '/assets/css/jardim.css'; ?>" />

  <link href="https://fonts.cdnfonts.com/css/poligon" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Marck+Script&family=Parisienne&family=Poly:ital@0;1&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

  <title>
    <?php wp_title(''); ?>
  </title>
  <?php wp_head(); ?>

</head>

<body>
  <?php
  if (is_home() || is_page_template('template-home-template.php')) {
    get_template_part('template-parts/common/nav-bar-home');
  } else {
    get_template_part('template-parts/common/nav-bar-couple');
  }
  ?>

  <div class="loading-overlay">
    <div class="loading-indicator"></div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 jardim-header jardim-bgsct1 jardim-margins text-center text-white">
        <h1 id="nomecasal" class="display-4 jardim-fonte" contenteditable="true">
          <?= $title ?>
        </h1>
        <p id="datecasal" class="jardimDate1" contenteditable="true">
          <?= $date ?>
        </p>
      </div>
    </div>
    <button id="button-floating-jardim" class="button-floating-jardim" onclick="escolherTemplate()">Escolher Template</button>
  </div>

  <script>
    
    function escolherTemplate() {
  // Captura dos dados
  var nomeCasal = document.getElementById('nomecasal').innerText;
  var date = document.getElementById('datecasal').innerText;
  var templateId = 'template-jardim'; // ID estático do template

  // Armazenamento no localStorage
  localStorage.setItem('nomeCasal', nomeCasal);
  localStorage.setItem('dataCasal', date); // Armazenando a data
  localStorage.setItem('chosenTemplate', templateId); // Armazenando o ID do template

  // Redirecionamento para outra página
  window.location.href = 'https://meumatri.com/cadastro/';
}

  </script>

  <?php get_footer(); ?>