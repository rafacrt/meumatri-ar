<?php $check_mark = get_template_directory_uri().'/assets/images/check-mark.png'; ?>
<?php //$img_section3 = get_template_directory_uri().'/assets/images/cel_section3.png'; ?>
<?php //$img_cel_rotate = get_template_directory_uri().'/assets/images/cel_rotate.png'; ?>
<?php $img_cel_rotate = get_template_directory_uri().'/assets/images/home/rotate_cel_home.gif' ?>
<?php $img_section3 = get_template_directory_uri().'/assets/images/home/rotate_cel_home.gif' ?>

<section class="cel_container" id="section3">
    <div class="container py-5 my-5">
        <div class="row align-items-center">
            <div class="col-md-6 titulo_section_mobile">
                <h2 class="mb-5 d-none d-sm-block">Monte um site de casamento com a sua cara e direto pelo celular</h2>
                <h2 class="d-block d-sm-none ">Monte um site de casamento com a sua cara e direto pelo <br> celular</h2>
                <p class="img_cel_mobile d-block d-sm-none d-flex align-items-center justify-content-center"><img src="<?php echo $img_section3; ?>" alt=""></p>
                <p class="text_section_4"><img src="<?php echo $check_mark; ?>" class="mr-2"> Seu site de casamento moderno
                    e sem precisar de computador</p>
                <hr class="mt-4 mb-4 divisor">
                <p class="text_section_4"><img src="<?php echo $check_mark; ?>" class="mr-2"> Adicione fotos do casal e
                    compartilhe bons momentos com seus convidados
                </p>
                <hr class="mt-4 mb-4 divisor">
                <p class="text_section_4"><img src="<?php echo $check_mark; ?>" class="mr-2"> Escolha e personalize layouts
                    com a sua cara em poucos cliques</p>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center ">
                <p class="cel d-none d-sm-block"><img src="<?php echo $img_cel_rotate; ?>" alt="" class="section3-img-rotate"></p>
            </div>
        </div>
    </div>
</section>
<script>
// $(document).ready(function() {
//     // Quando o mouse entra na seção cel_container
//     $(".cel_container").mouseenter(function() {
//         // Altera o atributo src da imagem para a imagem cel_rotate
        // $(".cel img").attr("src", "<?php //echo $img_cel_rotate; ?>");
//     });

//     // Quando o mouse sai da seção cel
//     $(".cel").mouseleave(function() {
//         // Retorna o atributo src da imagem para a imagem cel_section3
//         $(".cel img").attr("src", "<?php //echo $img_section3; ?>");
//     });
// });
</script>