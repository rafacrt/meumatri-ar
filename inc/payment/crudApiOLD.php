<?php

function generate_authorization_header()
{
    $secret_key = 'sk_test_7a149a8bc6b6465eab933ac15d28f7e5';
    $password = '';
    $credentials = base64_encode($secret_key . ':' . $password);
    $authorization_header = 'Basic ' . $credentials;
    return $authorization_header;
}

function getDataApi($endpoint)
{
    $args = [
        'method' => 'GET',
        'headers' => [
            'Authorization' => generate_authorization_header(),
            'Content-Type' => 'application/json',
        ],
    ];
    $response = wp_remote_request("https://api.pagar.me/core/v5/$endpoint", $args);
    return wp_remote_retrieve_body($response);
}

function postDataApi($endpoint, $body)
{

    $args = [
        'method' => 'POST',
        'body' => json_encode($body),
        'headers' => [
            'Authorization' => generate_authorization_header(),
            'Content-Type' => 'application/json',
        ],
    ];
    $response = wp_remote_request("https://api.pagar.me/core/v5/$endpoint", $args);
    $response = wp_remote_retrieve_body($response, true, 4);
    return json_decode($response);
}

function putDataApi($endpoint, $body)
{
    $args = [
        'method' => 'PUT',
        'body' => json_encode($body),
        'headers' => [
            'Authorization' => generate_authorization_header(),
            'Content-Type' => 'application/json',
        ],
    ];
    $response = wp_remote_request("https://api.pagar.me/core/v5/$endpoint", $args);
    return wp_remote_retrieve_body($response);
}

function deleteDataApi($endpoint)
{
    $args = [
        'method' => 'DELETE',
        'headers' => [
            'Authorization' => generate_authorization_header(),
            'Content-Type' => 'application/json',
        ],
    ];
    $response = wp_remote_request("https://api.pagar.me/core/v5/$endpoint", $args);
    return wp_remote_retrieve_body($response);
}

function getBalanceRecipient($id)
{
    $endpoint = "recipients/$id/balance";
    return json_decode(getDataApi($endpoint), true, 4);
}

function getOrdersById($id)
{
    $endpoint = "recipients/orders/$id";
    return json_decode(getDataApi($endpoint), true, 4);
}

function createWithdraw($id, $value)
{
    $endpoint = "recipients/$id/withdrawals";
    return json_decode(postDataApi($endpoint, $value), true, 4);
}

function getWithdrawalsByRecipients($id)
{
    $endpoint = "recipients/$id/withdrawals";
    return json_decode(getDataApi($endpoint), true, 4);
}

function getWithdrawalsById($recipientId, $id)
{
    $endpoint = "recipients/$recipientId/withdrawals/$id";
    return json_decode(getDataApi($endpoint), true, 4);
}

function createOrderCoupleGift()
{
    $produto = sanitize_text_field($_POST['produto']);
    $price = str_replace("R$", '', sanitize_text_field($_POST['price']));
    $id_produto = sanitize_text_field($_POST['id_produto']);
    $id_subsite = sanitize_text_field($_POST['id_subsite']);

    if (isset($_POST['produto'])) {
        $body = [
            "customer" => [
                "address" => [
                    "country" => "BR",
                    "state" => "SP",
                    "city" => "São Caetano do Sul",
                    "zip_code" => "09570500",
                    "line_1" => "Rua Bom Pastor 252"
                ],
                "phones" => [
                    "mobile_phone" => [
                        "country_code" => "55",
                        "area_code" => "11",
                        "number" => "945874512"
                    ]
                ],
                "name" => "Augusto Cliente Checkout",
                "type" => "individual",
                "email" => "augustosumac@gmail.com",
                "code" => "80.3",
                "document" => "41255618850",
                "document_type" => "CPF",
                "gender" => "Male"
            ],
            "payments" => [
                [
                    "checkout" => [
                        "expires_in" => 30,
                        "default_payment_method" => "credit_card",
                        "accepted_payment_methods" => ["credit_card", "debit_card"],
                        "success_url" => "http://localhost/derekcobb",
                        "customer_editable" => true,
                        "billing_address_editable" => true
                    ],
                    "Pix" => [
                        "expires_in" => 1200
                    ],
                    "split" => [
                        [
                            "amount" => 100,
                            "type" => "percentage",
                            "recipient_id" => "re_clod1jx26018j019tadz20hz1"
                        ]
                    ],
                    "payment_method" => "checkout"
                ]
            ],
            "code" => "80.3",
            "items" => [
                [
                    "amount" =>  $price,
                    "description" =>  $produto,
                    "quantity" => 1,
                    "code" => $id_subsite . " . ". $id_produto,
                ]
            ]
        ];

        $response = postDataApi("orders", $body);

        if (isset($response->checkouts[0]->payment_url)) {
            echo json_encode(['status' => 'success', 'url' => $response->checkouts[0]->payment_url]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao criar pedido.']);
        }
     } else {
        $response = ['status' => 'error', 'message' => 'Erro ao gerar link de pagamento.'];
        echo json_encode($response);
    }
    wp_die();
}

add_action('wp_ajax_nopriv_createOrderCoupleGift', 'createOrderCoupleGift');
add_action('wp_ajax_createOrderCoupleGift', 'createOrderCoupleGift');


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