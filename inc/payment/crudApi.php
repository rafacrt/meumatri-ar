<?php

function generate_authorization_header() {
	$secret_key  = 'sk_test_7a149a8bc6b6465eab933ac15d28f7e5';
	$password    = '';
	$credentials = base64_encode( $secret_key . ':' . $password );

	return 'Basic ' . $credentials;
}

function getDataApi( $endpoint ) {
	$args     = [
		'method'  => 'GET',
		'headers' => [
			'Authorization' => generate_authorization_header(),
			'Content-Type'  => 'application/json',
		],
	];
	$response = wp_remote_request( "https://api.pagar.me/core/v5/$endpoint", $args );

	return wp_remote_retrieve_body( $response );
}

function postDataApi( $endpoint, $body ) {
	$args     = [
		'method'  => 'POST',
		'timeout' => 60,
		'body'    => json_encode( $body ),
		'headers' => [
			'Authorization' => generate_authorization_header(),
			'Content-Type'  => 'application/json',
		],
	];
	$response = wp_remote_request( "https://api.pagar.me/core/v5/$endpoint", $args );
	return wp_remote_retrieve_body( $response );
}

function putDataApi( $endpoint, $body ) {
	$args     = [
		'method'  => 'PUT',
		'body'    => json_encode( $body ),
		'headers' => [
			'Authorization' => generate_authorization_header(),
			'Content-Type'  => 'application/json',
		],
	];
	$response = wp_remote_request( "https://api.pagar.me/core/v5/$endpoint", $args );

	return wp_remote_retrieve_body( $response );
}

function deleteDataApi( $endpoint ) {
	$args     = [
		'method'  => 'DELETE',
		'headers' => [
			'Authorization' => generate_authorization_header(),
			'Content-Type'  => 'application/json',
		],
	];
	$response = wp_remote_request( "https://api.pagar.me/core/v5/$endpoint", $args );

	return wp_remote_retrieve_body( $response );
}

function getBalanceRecipient( $id ) {
	$endpoint = "recipients/$id/balance";

	return json_decode( getDataApi( $endpoint ), true, 4 );
}

function getOrdersById( $id ) {
	$endpoint = "/orders?code=site_casal_$id";

	return getDataApi( $endpoint );
}

function createWithdraw( $id, $value ) {
	$endpoint = "recipients/$id/withdrawals";

	return json_decode( postDataApi( $endpoint, $value ), true, 4 );
}

function getWithdrawalsByRecipients( $id ) {
	$endpoint = "recipients/$id/withdrawals";

	return json_decode( getDataApi( $endpoint ), true, 4 );
}

function getWithdrawalsById( $recipientId, $id ) {
	$endpoint = "recipients/$recipientId/withdrawals/$id";

	return json_decode( getDataApi( $endpoint ), true, 4 );
}

function createOrderCoupleGift() {
	$produto              = sanitize_text_field( $_POST['produto'] );
	$price                = str_replace( "R$ ", '', sanitize_text_field( $_POST['price'] ) );
	$price                = str_replace( ",", '.', $price );
	$price                = str_replace( ".", '', $price );
	$id_produto           = sanitize_text_field( $_POST['id_produto'] );
	$id_subsite           = sanitize_text_field( $_POST['id_subsite'] );
	$nome_casal           = sanitize_text_field( $_POST['nome_casal'] );
	$site_url             = sanitize_text_field( $_POST['site_url'] );
	$pagarme_recipient_id = sanitize_text_field( $_POST['pagarme_recipient_id'] );

	if ( isset( $_POST['produto'] ) ) {
		$body = [
			"customer" => [
				"address"       => [
					"country"  => "BR",
					"state"    => "Estado",
					"city"     => "Cidade",
					"zip_code" => "12345-678",
					"line_1"   => "Endereço"
				],
				"phones"        => [
					"mobile_phone" => [
						"country_code" => "55",
						"area_code"    => "11",
						"number"       => "912345678"
					]
				],
				"name"          => "$nome_casal",
				"type"          => "individual",
				"email"         => "seuemail@email.com.br",
				"code"          => "sie_casal_$id_subsite",
				"document"      => "26224451990",
				"document_type" => "CPF",
				"gender"        => ""
			],
			"payments" => [
				[
					"payment_method" => "credit_card",
					"credit_card"    => [
						"card"         => [
							"number"          => "342793631858229",
							"holder_name"     => "Tony Stark",
							"exp_month"       => 1,
							"exp_year"        => 30,
							"cvv"             => "3531",
							"billing_address" => [
								"line_1"   => "10880, Malibu Point, Malibu Central",
								"zip_code" => "90265",
								"city"     => "Malibu",
								"state"    => "CA",
								"country"  => "US"
							],
						],
						"installments" => 1,

					],
					"split"          => [
						[
							"recipient_id" => "$pagarme_recipient_id",
							"amount"       => 100,
							"type"         => "percentage",
							"options"      => [
								"charge_processing_fee" => true,
								"charge_remainder_fee"  => true,
								"liable"                => true
							],
						]
					],
				],
			],
			"code"     => "site_casal_$id_subsite",
			"items"    => [
				[
					"amount"      => $price,
					"description" => $produto,
					"quantity"    => 1,
					"code"        => $id_subsite . "." . $id_produto,
				]
			]
		];

		$response = postDataApi( "orders", $body );

		if ( $response ) {
			echo json_encode( [ 'status' => 'success', 'url' => $site_url] );
		} else {
			echo json_encode( [ 'status' => 'error', 'message' => 'Erro ao criar pedido.' ] );
		}
	} else {
		$response = [ 'status' => 'error', 'message' => 'Erro ao gerar link de pagamento.' ];
		echo json_encode( $response );
	}
	wp_die();
}

add_action( 'wp_ajax_nopriv_createOrderCoupleGift', 'createOrderCoupleGift' );
add_action( 'wp_ajax_createOrderCoupleGift', 'createOrderCoupleGift' );


function update_custom_user_option() {
	if ( isset( $_POST['user_id'] ) && isset( $_POST['selected_option'] ) ) {
		print_r( $_POST );
		$user_id         = intval( $_POST['user_id'] );
		$selected_option = sanitize_text_field( $_POST['selected_option'] );

		// Atualize a opção de taxa do usuário usando update_user_meta
		update_user_meta( $user_id, 'tax_value', $selected_option );
		wp_send_json_success( 'Opção de taxa atualizada com sucesso!' );
	} else {
		wp_send_json_error( 'Parâmetros inválidos' );
	}
}

add_action( 'wp_ajax_update_custom_user_option', 'update_custom_user_option' );
add_action( 'wp_ajax_nopriv_update_custom_user_option', 'update_custom_user_option' );