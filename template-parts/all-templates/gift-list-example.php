<?php
require get_template_directory() . '/inc/icons.php';

$args = array(
    'post_type' => 'presente',
    'posts_per_page' => -1,
    // Mostrar todos os presentes
);

$query = new WP_Query($args);
?>

<section class="gift-list" draggable="false">
    <div class="container">
        <h2 class="section-title">
            <?= $title ?>
        </h2>
        <img class="middle-icon" src="<?= $breakIcon ?>" alt="">
        <div class="gift-list__container" id="myList">
            <?php
            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post();
                    $list_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    $text = get_the_title();
                    $preco_presente = get_post_meta(get_the_ID(), 'valor_presente', true);
                    ?>
                    <div class="gift-list__item">
                        <div class="gift-list__image">
                            <img class="" src="<?php echo esc_url($list_image); ?>" alt="">
                        </div>
                        <div class="gift-list__desc">
                            <p class="text" style="text-align:left; margin-left:0;">
                                <?php echo esc_html($text); ?> <br>
                                <strong class="price"  style="text-align:left; margin-left:0;">R$ <?php echo esc_html($preco_presente); ?></strong>
                            </p>
                        </div>
                        <div class="">
                            <button class="btn">Presentear</button>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <p>Nenhum presente encontrado.</p>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>
<?php
get_footer();
?>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToListButtons = document.querySelectorAll('.add-to-list');
        addToListButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const giftId = this.getAttribute('data-gift-id');
                fetch('/adicionar-a-lista', {
                    method: 'POST',
                    body: JSON.stringify({ giftId: giftId }),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Presente adicionado à lista com sucesso!');
                    })
                    .catch(error => {
                        console.error('Erro ao adicionar o presente à lista:', error);
                    });
            });
        });
    });
</script> -->
