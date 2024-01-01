<?php
require get_template_directory() . '/inc/icons.php';
$current_user = wp_get_current_user();
$username     = $current_user->user_login;
$user_id      = $current_user->ID;
$active_blog  = get_active_blog_for_user( $user_id );
$site_id      = $active_blog->blog_id;
$couple       = get_blog_option( $site_id, 'pagarme_recipient_id' );
$data         = getBalanceRecipient( $couple );
$tax_value    = get_user_meta( $user_id, 'tax_value', true );
?>
<style>
    .orders-buttons {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 50px;
    }

    .orders-buttons a {
        padding: 30px;
    }

    .btn-orders {
        color: #FFF;
        text-align: center;
        font-family: Poligon;
        font-size: 20px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
    }

    .btn-orders-outline {
        padding-top: -10px !important;
        border-radius: 8px;
        border: 3px solid #283F3B;
        background: #FDFDFD;
        color: #283F3B;
        text-align: center;
        font-family: Poligon;
        font-size: 20px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
    }

    .orders-total {
        border-bottom: 1px solid black;
        border-top: 1px solid black;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .orders-available {
        border-bottom: 1px solid black;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .orders-tax {
        border-bottom: 1px solid black;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .orders-total h3, .orders-available h3, .orders-tax h3 {
        color: rgba(0, 0, 0, 0.50);
        text-align: left;
        font-family: Poligon;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%;
    }

    .orders-total p, .orders-available p, .orders-tax p {
        color: #000;
        font-family: Poligon;
        font-size: 28px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
    }

    .orders-total a, .orders-available a, .orders-tax a {
        color: #556F44;
        font-family: Poligon;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 150%; /* 27px */
    }

    .gifts-received h3 {
        color: #000;
        font-family: Poligon;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 150%;
    }

    .gifts-received {
        padding-top: 20px;
    }

    /* styles.css */
    .gifts-received {
        font-family: Arial, sans-serif;
        max-width: 600px;
        margin: 0 auto;
    }

    .orders-accordion {
        margin-top: 20px;
    }

    .order {
        border-bottom: 1px solid #333;
        padding: 20px 0px 20px 0px;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        cursor: pointer;
    }

    .order-time {
        font-weight: bold;
    }

    .order-status {
        color: #0074d9;
        padding-top: 10px;
    }

    .order-details {
        display: none;
        padding: 10px;
    }

    .order-product {
        font-weight: bold;
    }

    .customer-details {
        margin-top: 20px;
        padding: 10px;
        border-radius: 5px;
    }

    .step {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .step-title {
        margin-left: 10px;
    }

    .step-number {
        width: 20px;
        height: 20px;
        background-color: #F06543;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
    }

    .title_order {
        font-family: Poligon;
        font-size: 14px;
        font-weight: 400;
        line-height: 21px;
        letter-spacing: 0em;
        text-align: left;
    }

    .value_customer_order {
        font-family: Poligon;
        font-size: 14px;
        font-weight: 400;
        line-height: 21px;
        letter-spacing: 0em;
        text-align: left;
    }

    .step-marker {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .step-line {
        width: 2px;
        height: 120px;
        background-color: #F06543;
        margin-left: -11px;
    }


    /* Restante do estilo do Step */
    .step-title {
        margin-left: 30px;
    }

</style>

<section class="hero-dashboar-index" style="margin-top:80px">

    <div class="orders-buttons">
        <a class="btn btn-orders"><span>Histórico</span></a>
        <a href="/resgate" class="btn btn-orders-outline"><span>Resgate</span></a>
    </div>

    <div class="orders-total">
        <h3>Total Confirmado</h3>
		<?php echo "<p>R$ " . number_format( floatval( $data['waiting_funds_amount'] ) / 100, 2, ',', '.' ) . "</p>"; ?>
        <!--        <a>Ver Extrato Detalhado</a>
		-->    </div>

    <div class="orders-available">
        <h3>Saldo disponível para resgate</h3>
		<?php echo "<p>R$ " . number_format( floatval( $data['available_amount'] ) / 100, 2, ',', '.' ) . "</p>"; ?>
        <a href="/resgate">Solicitar Resgate</a>
    </div>

    <div class="orders-tax">
        <h3>Tarifa Atual</h3>
		<?php
		if ( $tax_value == "tax_rsvp" ) {
			echo "<p>3,79% <br> <small style='font-size: 14px; font-weight: 300;'>Taxa paga pelo convidado.</small></p>";
		} else {
			echo "<p>3,79% <br> <small style='font-size: 14px; font-weight: 300;'>Taxa paga pelo casal.</small></p>";
		}
		?>
    </div>

	<?php
	switch_to_blog( $site_id );
	$pedidos   = json_decode( getOrdersById( $site_id ) );
	$orderData = array();
	foreach ( $pedidos->data as $order ) {
		$customerName       = $order->customer->name;
		$status             = $order->status;
		$productDescription = $order->items[0]->description;
		$amount             = $order->amount;

		$itemCreated    = $order->items[0]->created_at;
		$payment_method = $order->charges[0]->payment_method;
		$currency       = $order->charges[0]->currency;
		$paid_at        = $order->charges[0]->paid_at;

		$orderInfo = array(
			'CustomerName'       => $customerName,
			'Status'             => $status,
			'ProductDescription' => $productDescription,
			'Amount'             => $amount,
			'ItemCreated'        => $itemCreated,
			'PaymentMethod'      => $payment_method,
			'Currency'           => $currency,
			'PaidAt'             => $paid_at,
		);

		$orderData[] = $orderInfo;
	}
	restore_current_blog();

	?>
    <div class="gifts-received">
        <h3>Presentes Recebidos</h3>
        <div class="orders-accordion">
			<?php foreach ( $orderData as $order ) { ?>
                <div class="order">
                    <div class="value_customer_order"><small><?php echo $order['CustomerName']; ?></small> <span
                                style="float: right;">12/12/2023</span></div>
                    <div class="order-header">
                        <div class="order-time">
                            <img 
                            src="http://meumatri.local/wp-content/uploads/2023/10/Cotas-para-lua-de-mel.jpg"
                            width="60" 
                            alt=""
                            >
                        </div>
                        <div class="order-time">
							<?php echo $order->created_at; ?>
                        </div>
                        <div class="order-total">
                            <span class="title_order"
                                  style="text-align: left;"><?php echo $order['ProductDescription']; ?></span> <br>
                            <span class="value_customer_order">Total: R$ <?php echo number_format( $order['Amount'] / 100, 2, ',', '.' ); ?></span>
                        </div>
                        <div class="order-status">
							<?php echo $order->status; ?>
                            <p style="width: 20px; border-radius: 100%; height: 20px;top: 731px;left: 317px; background: #556F44;"></p>
                        </div>
                        <div class="order-arrow" style="padding-top: 10px;">
                            <i class="fa fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="order-details">
                        <div class="order-product">
							<?php echo $order->items[0]->description; ?>
                        </div>
                        <div class="value_customer_order" style="text-align: center; margin-top: 30px;  ">
                            <p>Status de compra e liberação de crédito</p>
                        </div>
                        <div class="order-steps"
                             style="border-top: 1px solid black; margin-top: 20px; padding-top: 20px;">
                            <h3>Informações da Compra</h3>
                            <div class="step">
                                <div class="step-marker">
                                    <div class="step-number"></div>
                                    <div class="step-line"></div>
                                </div>
                                <div class="step-title">
                                    Pedido Realizado
                                    <br>
                                    <small><?php echo $order['ItemCreated']; ?> - <?php echo $order['CustomerName']; ?>
                                        fez uma compra de R$ <?php echo $order['Amount']; ?>
                                        utilizando <?php echo $order['PaymentMethod']; ?>.</small>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-marker">
                                    <div class="step-number"></div>
                                    <div class="step-line"></div>
                                </div>
                                <div class="step-title">
                                    Pagamento <?php echo $order['Status']; ?>
                                    <br>
                                    <small><?php echo $order['PaidAt']; ?> - Recebemos a confirmação de
                                        pagamento.</small>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-marker">
                                    <div class="step-number"></div>
                                    <div class="step-line"></div>
                                </div>
                                <div class="step-title">
                                    Pagamento <?php echo $order['Status']; ?>
                                    <br>
                                    <small>O crédito estará disponível ao longo dos dias.</small>
                                </div>
                            </div>
                        </div>
						<?php
						$valor_total    = floatval( $order['Amount'] ) / 100;
						$tarifa_percent = 3.79;
						$tarifa         = ( $valor_total * $tarifa_percent ) / 100;
						$valor_liquido  = $valor_total - $tarifa;


						?>
                        <div class="order-detailss"
                             style="border-top: 1px solid black; margin-top: 20px; padding-top: 20px;">
                            <h3>Detalhes da Compra</h3>
                            <div class="">
                                <div class="-title"><?php echo $order['ProductDescription']; ?>
									<?php echo "<span style='float: right;'>R$ " . number_format( floatval( $valor_total ), 2, ',', '.' ) . "</span>"; ?>
                                </div>
                            </div>
                            <div class="">
                                <div class="-title">

                                    Tarifa (Convidado - 3,79%):
									<?php echo "<span style='float: right;'>R$ " . number_format( floatval( $tarifa ), 2, ',', '.' ) . "</span>"; ?>
                                </div>
                            </div>
                            <div class="">
                                <div class="-title">Valor
                                    Líquido <?php echo "<span style='float: right;'>R$ " . number_format( floatval( $valor_liquido ), 2, ',', '.' ) . "</span>"; ?></div>

                            </div>
                        </div>
                        <div class="customer-details"
                             style="border-top: 1px solid black; margin-top: 20px; padding-top: 20px;">
                            <h3>Compra feita por:</h3>
                            <div class="customer-name" style="margin-bottom: 10px;">
                                Nome Completo :<br>
								<?php echo $order['CustomerName']; ?>
                            </div>
                            <div class="customer-email" style="margin-bottom: 10px;">
                                Email: <br>
								<?php echo $order['CustomerName']; ?>
                            </div>
                            <div class="customer-document" style="margin-bottom: 10px;">
                                Telefone: <br>
                                <small>+55 <?php echo $order['CustomerName']; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
			<?php } ?>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // script.js
    $(document).ready(function () {
        $('.order-header').click(function () {
            var details = $(this).next('.order-details');
            $('.order-details').not(details).slideUp();
            details.slideToggle();
        });
    });

</script>
