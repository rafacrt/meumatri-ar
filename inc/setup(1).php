<?php

/**
 * vamoscasartheme's functions and definitions
 *
 * @package vamoscasartheme
 * @since vamoscasartheme 1.0
 */

/**
 * First, let's set the maximum content width based on the theme's
 * design and stylesheet.
 * This will limit the width of all uploaded images and embeds.
 */
if (!isset($content_width)) {
	$content_width = 800; /* pixels */
}


/**
 * Sets up theme defaults and registers support for various
 * WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme
 * hook, which runs before the init hook. The init hook is too late
 * for some features, such as indicating support post thumbnails.
 */
function vamoscasartheme_setup()
{

	// Common includes
	wp_enqueue_style('hero-css', get_template_directory_uri() . '/assets/css/home.css', '', );
	wp_enqueue_style('templates-css', get_template_directory_uri() . '/assets/css/templates.css', '', );
	wp_enqueue_style('templatesNew-css', get_template_directory_uri() . '/assets/css/templates.css', '', );
	wp_enqueue_style('common-css', get_template_directory_uri() . '/assets/css/common.css', '', );
	wp_enqueue_script('common-js', get_template_directory_uri() . '/assets/js/common.js', array(), false, true);
	wp_enqueue_script('countdown-maps', get_template_directory_uri() . '/assets/js/countdown_maps.js',);
	// Specific includes
	if (is_home() && is_main_site() || (is_page_template('template-home-template.php') && is_main_site())) {
		wp_enqueue_style('home-css', get_template_directory_uri() . '/assets/css/home.css', '', null);
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap_4.5.2.min.css', '', '4.5.2');
	}
	if (is_page_template('template-classic.php')) {
		wp_enqueue_style('classic-css', get_template_directory_uri() . '/assets/css/classic.css', '', );
		wp_enqueue_script('editation-js', get_template_directory_uri() . '/assets/js/toggle-contenteditable.js', array(), false, true);
		wp_enqueue_script('custom-confirm-script', get_template_directory_uri() . '/js/custom-confirm.js', array(), '1.0', true);
	}
	if (is_page_template('template-nature.php')) {
		wp_enqueue_style('nature-css', get_template_directory_uri() . '/assets/css/nature.css', '', );
		wp_enqueue_script('editation-js', get_template_directory_uri() . '/assets/js/toggle-contenteditable.js', array(), false, true);
		wp_enqueue_script('custom-confirm-script', get_template_directory_uri() . '/js/custom-confirm.js', array(), '1.0', true);
	} elseif (is_page_template('template-modern.php')) {
		wp_enqueue_style('modern-css', get_template_directory_uri() . '/assets/css/modern.css', '', );
		wp_enqueue_script('editation-js', get_template_directory_uri() . '/assets/js/toggle-contenteditable.js', array(), false, true);
		wp_enqueue_script('custom-confirm-script', get_template_directory_uri() . '/js/custom-confirm.js', array(), '1.0', true);
	} elseif (is_page_template('template-classic.php')) {
		wp_enqueue_style('classic-css', get_template_directory_uri() . '/assets/css/classic.css', '', );
		wp_enqueue_script('editation-js', get_template_directory_uri() . '/assets/js/toggle-contenteditable.js', array(), false, true);
		wp_enqueue_script('custom-confirm-script', get_template_directory_uri() . '/js/custom-confirm.js', array(), '1.0', true);
	} elseif (is_page_template('template-dashboard.php')) {
		wp_enqueue_style('dashboard-css', get_template_directory_uri() . '/assets/css/dashboard.css', '', );
	} elseif (is_page_template('template-edit-mySite.php')) {
		wp_enqueue_script('editation-js', get_template_directory_uri() . '/assets/js/toggle-contenteditable.js', array(), false, true);
	}
	/**
	 * Make theme available for translation.
	 * Translations can be placed in the /languages/ directory.
	 */
	load_theme_textdomain('vamoscasartheme', get_template_directory() . '/languages');

	/**
	 * Add default posts and comments RSS feed links to <head>.
	 */
	add_theme_support('automatic-feed-links');

	/**
	 * Enable support for post thumbnails and featured images.
	 */
	add_theme_support('post-thumbnails', array(
		'post',
		'page',
		'lista_presentes',
	)
	);

	/**
	 * Add support for two custom navigation menus.
	 */
	add_theme_support('menus');
	add_theme_support('widgets');
	add_theme_support('custom-header');

	register_nav_menus(
		array(
			'primary' => __('Primary Menu', 'vamoscasartheme'),
			'secondary' => __('Secondary Menu', 'vamoscasartheme'),
		)
	);

	/**
	 * Enable support for the following post formats:
	 * aside, gallery, quote, image, and video
	 */
	add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));

	/**
	 * Ajax settup
	 */
	// wp_localize_script('')
}

add_action('wp_enqueue_scripts', 'vamoscasartheme_setup');

// add_action('after_setup_theme', 'vamoscasartheme_setup'); //pra que isso!? aparentemente esta linha é desnecessário, pois executa a mesma função acima, com um hook diferente.

// VAMOS CASAR SETUP

// Generate breadcrumbs
function get_breadcrumb()
{

	if (is_category() || is_single()) {
		the_category('  ');
		if (is_single()) {
			echo ' > ';
			the_title();
		}
	} elseif (is_page()) {
		echo ' > ';
		echo the_title();
	} elseif (is_search()) {
		// echo ' > ';Search Results for…
		echo '>';
		echo the_search_query();
	}
}

// ================= Update css and js version ===============

function update_css_and_js_version($src)
{
	$version = wp_get_theme()->get('Version');
	$src = add_query_arg('ver', $version, $src);
	return esc_url($src);
}

function update_version()
{
	add_filter('style_loader_src', 'update_css_and_js_version', 9999);
	add_filter('script_loader_src', 'update_css_and_js_version', 9999);
}

add_action('init', 'update_version');

// ================= Custom redirect after login
function custom_login_redirect($redirect_to, $request, $user)
{
	$redirect_url = home_url('/painel/');

	return $redirect_url;
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);

// ================= Custom redirect after registration
function custom_registration_redirect()
{
	$redirect_url = home_url('/painel/');
	wp_redirect($redirect_url);
	exit;
	// return $redirect_url;
}
add_filter('registration_redirect', 'custom_registration_redirect');



// VALIDAR -> É PRECISO TESTAR AS FUNÇÕES ABAIXO!!

// Função que redireciona para a página de login dos usuários da plataforma Vamos Casar
function redirect_login_page()
{
	$login_page = home_url('/login/');
	$page_viewed = basename($_SERVER['REQUEST_URI']);

	if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		wp_redirect($login_page);
		exit;
	}
}
add_action('init', 'redirect_login_page');

function salvar_pagina_callback()
{
	check_ajax_referer('salvar_pagina_nonce', '_ajax_nonce');

	if (isset($_POST['conteudo'])) {
		$conteudo = $_POST['conteudo'];
		$current_user = wp_get_current_user();
		$siteID = $current_user->ID;

		if ($siteID === 0) {
			$users = get_users(
				array(
					'orderby' => 'ID',
					'order' => 'DESC',
					'number' => 1
				));

			$last_user_id = !empty($users) ? wp_list_pluck($users, 'ID')[0] : 0;

			// $siteID = $last_user_id+1; //Pela logica, se o usuario estiver deslogado ele deveria receber o id do ultimo user cadastrado e somar 1, pois este campo é auto incrementado no banco.
			$siteID = $last_user_id; //Acredito que, neste caso, o user é criado antes do salvamento do post. Logo, ultimo id será exatamente do usuário atual no momento da consulta.


		}
		// Caminho do arquivo PHP
		$arquivo = get_template_directory() . '/sites/yourpage' . $siteID . '.php';

		// Gravar o conteúdo no arquivo
		if (file_put_contents($arquivo, $conteudo) !== false) {
			echo 'Conteúdo salvo com sucesso no arquivo ' . $arquivo;
		} else {
			echo 'Erro ao salvar o conteúdo no arquivo ' . $arquivo;
		}
	}

	// Redirecionar para a página
	wp_redirect('/casal/');
	exit;
}

add_action('wp_ajax_salvar_pagina', 'salvar_pagina_callback');
add_action('wp_ajax_nopriv_salvar_pagina', 'salvar_pagina_callback');

// Cria menu do usuario dentro da dashboard
function wpb_custom_new_menu()
{
	register_nav_menu('custom-menu', __('Custom Menu'));
}
add_action('init', 'wpb_custom_new_menu');

//Redireciona para a homepage ao fazer logout
// Função para redirecionar para a homepage após o logout
function logout_redirect_home()
{
	wp_redirect(home_url());
	exit();
}

// Adicione o link de logout no menu de navegação
function add_logout_link($items, $args)
{
	if ($args->theme_location == 'custom-menu') { // Verifique o nome do seu menu de navegação
		$items .= '<li class="menu-item" id="menu-item-logout"><a href="' . wp_logout_url(home_url()) . '">' . __('Logout') . '</a></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'add_logout_link', 10, 2);

// Redirecionar para a homepage após o logout
add_action('wp_logout', 'logout_redirect_home');

/**
 * A função abaixo assegura que o redirecionamento aconteça sem warnings do arquivo wp-includes/pluggable.php.
 * Essa função anula a renderização inicial, permitindo assim o redirecionamento. 
 */
add_filter('template_redirect', function () {
	ob_start(null, 0, 0);
});


/**
 * Slugify user name to be used as subdomain on URL
 */
function slugify($string)
{
	// Remove caracteres especiais e acentos
	$string = preg_replace('/[^\p{L}\p{N}]+/u', '-', $string);

	// Transforma a string em minúsculas
	$string = strtolower($string);

	// Remove hífens duplicados
	$string = preg_replace('/-+/', '-', $string);

	// Remove hífens no início e no fim da string
	$string = trim($string, '-');

	return $string;
}

/**
 * Exemple of how i call a jquery function in my theme.
 */
function add_my_script()
{
	
}
add_action('wp_enqueue_scripts', 'add_my_script');


/**
 * Lost password redirection
 */
// functions.php

function custom_reset_password_template($template)
{
	if (is_page_template('template-reset-password.php')) {
		// Utiliza o arquivo de modelo de página personalizado para a página de redefinição de senha
		$template = get_stylesheet_directory() . '/template-reset-password.php';
	}
	return $template;
}
add_filter('template_include', 'custom_reset_password_template');


// Multisite - Casal

function custom_subsite_template($template) {
    if (is_multisite() && !is_main_site()) {
        $site_id = get_current_blog_id();
        $template_blog = get_option('template_blog', 'template-classic'); 

        $new_template = locate_template(array($template_blog . '.php'));

        if (!empty($new_template)) {
            return $new_template;
        }
    }

    return $template;
}

add_filter('template_include', 'custom_subsite_template', 99);

/*function redirect_to_main_site_login()
{
	if (!is_main_site() && is_admin()) {
		wp_redirect(network_site_url('/login'));
		exit();
	}
}
add_action('init', 'redirect_to_main_site_login');*/

/*function redirect_logged_in_users_to_specific_page()
{
	// Verifica se o usuário está logado e tentando acessar o painel
	if (is_user_logged_in() && is_admin() && !is_main_site()) {
		wp_redirect(home_url('/painel')); // Redireciona para a página desejada (por exemplo, /painel)
		exit();
	}
}
add_action('admin_init', 'redirect_logged_in_users_to_specific_page');*/


function hide_admin_bar_for_multisite_users()
{
	if (is_user_logged_in()) {
		add_filter('show_admin_bar', '__return_false');
	}
}

add_action('init', 'hide_admin_bar_for_multisite_users');

function validateFirstAccess()
{
	$user_id = get_current_user_id();

	$valida = get_user_meta($user_id, 'validate_access', true);
	if (is_user_logged_in() && $valida == false && is_page_template('template-dashboard.php')) {
		include_once 'validate_access.php';
		update_user_meta($user_id, 'validate_access', true);
	}
}

add_action('wp_head', 'validateFirstAccess');