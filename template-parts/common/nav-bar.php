<?php $logo = get_template_directory_uri() . '/assets/images/logo-menu-mobile.png'; ?>
<?php $base_url = home_url(); ?>

<style>
  .logo {
    float: right;
    margin-right: 20px;
  }

  .transparent-menu {
    background-color: transparent !important;
    box-shadow: none !important;
  }

  .navbar-brand img {
    max-width: 100px;
    /* Adjust as needed */
  }

  .navbar-toggler {
    color: white !important;
  }

  .navbar-nav {
    flex-direction: column;
    /* Display items vertically */
  }

  .navbar-nav li.nav-item {
    margin-right: 0;
    /* Remove horizontal margin */
  }

  .navbar-nav li.nav-item a.nav-link {
    color: white;
    text-decoration: none;
    border-left: 4px solid transparent;
    /* Add left border */
    padding: 10px 15px;
    /* Adjust padding as needed */
    display: block;
    /* Display items as block elements */
    margin-bottom: 10px;
    /* Add bottom margin to create spacing */
  }

  .nav-button-login {
    list-style: none;
  }
</style>
<script>
  function openMenu() {
    let menu = document.getElementById("site-navigation");
    if (menu.style.display === "none") {
      menu.style.display = "block";
    } else {
      menu.style.display = "none";
    }
  }
</script>
<nav>
  <div class="container">

    <div class="menu-hamburguer">
      <input id="menu-hamburguer" type="checkbox" onclick="openMenu()" />
      <label for="menu-hamburguer">
        <menu class="">
          <span class="hamburguer"></span>
        </menu>
      </label>
    </div>

    <div class="save-btn">

    </div>

    <div class="logo">
      <?php if (is_user_logged_in()): ?>
        <a href="<?php $base_url; ?>"><img width="100" src="<?php $logo ?>" alt="" srcset=""></a>
      <?php else: ?>
        <a href="/cadastro" class="btn btn-primary salvar-info-template"
          style="background-color:#a4ad88; color:#FFF; padding-top: 12px; font-size:20px; text-decoration:none; cursor:pointer; font-weight: 600;">Salvar</a>
      <?php endif; ?>
    </div>

  </div>

</nav>

<nav id="site-navigation" class="container main-navigation"
  style="display: none; box-shadow: none !important; list-style:none;">
  <?php
  wp_nav_menu(
    array(
      'theme_location' => 'menu-principal-home',
      'container' => false,
      'menu_class' => '',
      'fallback_cb' => '__return_false',
      'items_wrap' => '<ul id="%1$s" class="navbar-nav ml-auto %2$s">%3$s</ul>',
      'depth' => 2,
      'walker' => new bootstrap_5_wp_nav_menu_walker()
    )
  );
  ?>

  <?php
  wp_nav_menu(
    array(
      'theme_location' => 'menu-btn-home',
      'container' => false,
      'menu_class' => '',
      'fallback_cb' => '__return_false',
      'items_wrap' => '<ul id="%1$s" class="navbar-nav ml-auto %2$s">%3$s</ul>',
      'depth' => 2,
      'walker' => new bootstrap_5_wp_nav_menu_walker()
    )
  );
  ?>
</nav>
<script>
  jQuery(document).ready(function ($) {
    $('#menu-item-99').removeClass('nav-button-home');
    $('span').removeClass('btn-home-black');
    $('.navbar-nav li.nav-item').css({
      'display': 'block',
      'margin-right': '0',
    });

    $('.navbar-nav li.nav-item a.nav-link').css({
      'color': 'white',
      'text-decoration': 'none',
      'padding-bottom': '5px',
      'padding': '20px'
    });
    $('#menu-item-99').css({
      'border-bottom': '1px solid white'
    });
    $('.navbar-nav li.nav-item:last-child a.nav-link').css({
      'border-bottom': '1px solid white'
    });
    $('#menu-item-99').addClass('nav-button-home-new');
    $('#menu-item-100').removeClass('nav-button-login');
    $('#menu-item-99').addClass('nav-button-login-new');
    $('.nav-button-login-new').css({
      'color': '#A1C337',
      'font-family': 'Tomato Grotesk',
      'font-size': '20px',
      'font-weight': '700',
      'line-height': '28px',
      'letter-spacing': '0.04em',
      'text-align': 'left',
    });

    $('span').css({
      'color': '#A1C337',
    });
  });

</script>