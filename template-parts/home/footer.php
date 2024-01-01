<?php $logo = get_template_directory_uri().'/assets/images/logo_branco.png'; ?>
<?php $insta = get_template_directory_uri().'/assets/images/insta.png'; ?>
<?php $youtube = get_template_directory_uri().'/assets/images/youtube.png'; ?>

<style>
#menu-menu-footer-1{padding-left:0;}
.menu li{padding-left:0;}
</style>
<footer class="footer text-light">
    <div class="container d-block d-sm-none ">
        <div class="row">
            <div class="col-md-6 p-2">
                <a class="navbar-brand-footer" href="#"><img src="<?php echo $logo; ?>" alt=""></a>
                <p class="mt-5 text-footer">
                Tecnologia, modernidade e praticidade para<br>
                um dos momentos mais especiais de sua vida.
                </p>
            </div>
            <div class="col-md-6 mt-4 ml-n2">
                <?php wp_nav_menu(array('theme_location' => 'menu-footer')); ?>
                <a class="mr-4" href="#"><img src="<?php echo $insta; ?>" alt=""></a>
                <a class="mr-4" href="#"><img src="<?php echo $youtube; ?>" alt=""></a></p>
                <p class="mt-4 text-footer2">CNPJ 50.553.179/0001-82 - Meu Matri Ltda</p>
            </div>
        </div>
    </div>
    <div class="container d-none d-sm-block">
        <div class="row">
            <div class="col-md-6">
                <a class="navbar-brand-footer" href="#"><img src="<?php echo $logo; ?>" alt=""></a>
                <p class="mt-5 mb-5 text-footer">
                Tecnologia, modernidade e praticidade para<br>
                um dos momentos mais especiais de sua vida.
                </p>
                <p class="mt-5 text-footer2">CNPJ 50.553.179/0001-82 - Meu Matri Ltda</p>
            </div>
            <div class="col-md-6">
                <?php wp_nav_menu(array('theme_location' => 'menu-footer')); ?>
                <div class="">
                    <a class="mr-4" href="#"><img src="<?php echo $insta; ?>" alt=""></a>
                    <a class="mr-4" href="#"><img src="<?php echo $youtube; ?>" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</footer>