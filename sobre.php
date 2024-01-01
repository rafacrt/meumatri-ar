<?php
/* Template Name: Sobre*/
?>
<?php
get_header();

$autores = get_template_directory_uri() . '/assets/images/autores.png';
?>

<!DOCTYPE html>
<html>

    <body>
                <style>
            li.menu_footer a{color: #FFF;text-decoration:none;}
            .container{width: 100%;}
        </style>
        <div class="container-fluid ct1Quemsomos">
            <div class="container">
                <div class="row d-flex flex-column">
                    <h1>Conheça o Meu Matri.</h1>
                    <p>
                        Somos uma equipe apaixonada e inovadora que se dedica<Br> 
                        a tornar o seu casamento uma experiência inesquecível, simplificada e linda.
                    </p>
                </div>
            </div>
        </div>
        <section class="autoresInfo">
            <div class="container">
                <div class="row d-flex align-items-center flex-column flex-lg-row">
                    <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                        <img 
                        src="<?php echo $autores; ?>"
                        width="460px"
                        height="450px"
                        alt="Quem somos"
                        class="img-fluid"
                        >
                    </div>
                    <div class="col-12 col-lg-6">
                        <h2>
                            Nossa missão
                        </h2>
                        <p>
                        O Meu Matri nasceu com o objetivo de tornar cada casamento uma celebração
                        única e memorável. 
                        <br>
                        <br>
                        Combinando nossa paixão por tecnologia, design e praticidade, criamos
                        uma plataforma moderna que coloca o casal no controle total de seu site de
                        casamento.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>

<?php get_template_part('template-parts/home/section6'); ?>
<?php get_template_part('template-parts/home-templates/footer'); ?>