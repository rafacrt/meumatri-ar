<?php
require get_template_directory() . '/inc/icons.php';

// Obtém o ID do subsite atual
$subsite_id = get_current_blog_id();
$site_users = get_users( array(
	'blog_id' => $subsite_id,
) );
$user_id    = $site_users[0]->ID;
$blog_name  = get_blog_details( $subsite_id )->path;
$couple_name = get_user_meta($user_id, 'couple_name', true);
$active_blog = get_active_blog_for_user($user_id);
$site_url = get_site_url($active_blog->blog_id);
$pagarme_recipient_id = get_blog_option($subsite_id, 'pagarme_recipient_id');
// Verifica se o usuário já possui listas de presentes
$lists = get_posts(
	array(
		'post_type'   => 'lista_presentes',
		'post_parent' => 0,
		'limit'       => - 1,
	)
);
switch_to_blog( $subsite_id );
$user_lista_ids = get_user_meta( $user_id, 'site_principal_lista_ids', true );
switch_to_blog( 1 );

// Verifique se há IDs de lista no metadado do usuário
if ( ! empty( $user_lista_ids ) ) {
	$args = array(
		'post_type' => 'lista_presentes',
		'post__in'  => $user_lista_ids,
	);

	$site_principal_lists = get_posts( $args );

	// Coloque o código para exibir as listas associadas a esses IDs aqui
} else {
	// Não exiba nada
}

switch_to_blog( $subsite_id );
$user_presente_ids = get_user_meta( $user_id, 'site_principal_presente_ids', true );
switch_to_blog( 1 );

// Verifique se há IDs de presente no metadado do usuário
if ( ! empty( $user_presente_ids ) ) {
	$args = array(
		'post_type' => 'presente',
		'post__in'  => $user_presente_ids,
	);

	$site_principal_presentes = get_posts( $args );

	// Coloque o código para exibir os presentes associados a esses IDs aqui
} else {
	// Não exiba nada
}

switch_to_blog( $subsite_id );
$args           = array(
	'post_type' => 'presente',
);
$meus_presentes = get_posts( $args );
restore_current_blog();
?>


<section class="gift-list" style="margin-bottom: 60px; cursor: pointer;">
    <h2 class="section-title" style="margin-top: 40px;">
        Presentes<?= $title ?>
    </h2>
    <img class="middle-icon" src="<?= $breakIcon ?>" alt="">
    <div class="gift-list-container" id="myList">
		<?php
		switch_to_blog( 1 );
		if ( $site_principal_presentes ) {
			echo '<table class="gift-list-table">';
			foreach ( $site_principal_presentes as $site_principal_presente ) {
				setup_postdata( $site_principal_list );
				$presente_id    = $site_principal_presente->ID;
				$presente_title = $site_principal_presente->post_title;
				$presente_image = get_the_post_thumbnail_url( $presente_id, 'medium' );
				$presente_image = str_replace( "https", "http", $presente_image );
				$presente_image = str_replace( $blog_name, "/", $presente_image );
				$valor_presente = get_post_meta( $presente_id, 'valor_presente', true );
				?>
                <tr>
                    <td class="gift-list-image">
                        <img src="<?php echo esc_url( $presente_image ); ?>" alt="">
                    </td>
                    <td>
                        <p class="titulo_produto"><?php echo $presente_title; ?></p>
                        <p class="price"><?php echo esc_html( $valor_presente ); ?></p>
                    </td>
                    <td>
                        <input type="hidden" class="id_produto" value="<?php echo $presente_id; ?>">
                        <input type="hidden" class="id_subsite" value="<?php echo $subsite_id; ?>">
                        <input type="hidden" class="nome_casal" value="<?php echo $couple_name; ?>">
                        <input type="hidden" class="site_url" value="<?php echo $site_url; ?>">
                        <input type="hidden" class="pagarme_recipient_id" value="<?php echo $pagarme_recipient_id; ?>">
                        <a class="btn criarPedido" id="criarPedido">Presentear</a>
                    </td>
                </tr>
				<?php
			}
			echo '</table>';
		} else {
			echo '<p style="padding-top:10px;">O casal ainda não publicou a lista, aguarde!.</p>';
		}
		restore_current_blog();
		?>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    jQuery(document).ready(function () {
        jQuery('.criarPedido').on('click', function (e) {
            e.preventDefault();
            let row = jQuery(this).closest('tr');
            let produto = row.find('.titulo_produto').text();
            let price = row.find('.price').text();
            let id_produto = row.find('.id_produto').val();
            let id_subsite = row.find('.id_subsite').val();
            let nome_casal = row.find('.nome_casal').val();
            let site_url = row.find('.site_url').val();
            let pagarme_recipient_id = row.find('.pagarme_recipient_id').val();

            jQuery.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'createOrderCoupleGift',
                    produto: produto,
                    price: price,
                    id_produto: id_produto,
                    id_subsite: id_subsite,
                    nome_casal: nome_casal,
                    site_url: site_url,
                    pagarme_recipient_id: pagarme_recipient_id,
                },
                beforeSend: function () {
                    jQuery(".loading-overlay").show();
                    jQuery(".btn").css('color', 'white');
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        window.location.href = data.url;
                    } else {

                    }
                    jQuery(".loading-overlay").hide();
                },
                complete: function () {
                    jQuery(".loading-overlay").hide();
                }
            });
        });
    });
</script>

<style>
    .gift-list-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .gift-list-table {
        border-collapse: collapse;
        width: 100%;
    }

    .gift-list-table td {
        border: none;
        padding: 10px;
        text-align: center;
    }

    .gift-list-image img {
        width: 100px !important;
        height: 100px !important;
        float: left; /* Alinhar a imagem à esquerda */
        margin-right: 10px; /* Adicionar um espaço entre a imagem e o texto */
    }

    .gift-list-button {
        text-align: right; /* Alinhar o botão à direita */
    }

    .btn {
        padding: 10px;
        cursor: pointer;
    }
    .btn:hover {
        color:white;
    }
</style>
