<?php
// Inclua o arquivo que possui os ícones, se necessário.
require get_template_directory() . '/inc/icons.php';

// Verifique se o usuário está logado
if (is_user_logged_in()) {


    // Obtém o ID do usuário logado
    $user_id = get_current_user_id();
    $subsite_id = get_user_meta($user_id, 'primary_blog', true);
    $tax_value = get_user_meta($user_id, 'tax_value', true);
    ?>

    <section class="user-panel edit-gift-list container" style="margin-top:80px">
        <h1 class="title_tax">Como você quer configurar<br> a taxa?</h1>
        <p class="tax_list">
            <strong>Taxa da Lista</strong> <br>
            <span class="tax_list_text">3,89%</span>
        </p>
        <p class="tax_list">
            <strong>Custo por saque </strong> <br>
            <span class="tax_list_text"> R$0,00</span>
        </p>
        <p class="tax_list">
            <strong> Quantidade de saques </strong> <br>
            <span class="tax_list_text"> Ilimitado</span>
        </p>
        <p class="tax_list_text" style="margin-left: 5px;">Você pode optar por assumir ou repassar a taxa da lista para
            seus convidados. <br> Basta escolher a opção desejada
            a baixo:</p>

        <div class="card red<?php echo ($tax_value === 'pagar_taxa') ? ' highlight' : ''; ?>">
            <input type="radio" name="accordion" id="red-card" class="radio-button"
                   value="tax_couple" <?php echo ($tax_value === 'tax_couple') ? 'checked' : ''; ?>>
            <label for="red-card" class="card-header">
                <span class="radio"></span>
                <p class="title-radio">Quero pagar a taxa dos meus presentes.<br> <small class="saiba-mais">Saiba Mais
                        <span class="arrow">&#x25BC;</span></small></p>
            </label>
            <div class="card-content ">
                <p>Nesta opção o casal opta por pagar a taxa dos presentes da lista, ou seja, o valor é descontado do
                    total que o
                    casal irá resgatar.
                    Exemplo:</p>
                <p class="desc_value_red"><strong>Valor do presente <span class="float_desc">R$100,00</span></strong>
                </p>
                <p class="desc_value_red"><strong>Valor pago pelo convidado <span
                                class="float_desc">R$100,00</span></strong></p>
                <p class="desc_value_red"><strong>Valor taxa paga pelo casal <span
                                class="float_desc">R$3,89 </span></strong></p>
                <p class="desc_value_red"><strong>Valor que o casal irá resgatar <span class="float_desc">R$96,11</span></strong>
                </p>
            </div>
        </div>

        <div class="card green<?php echo ($tax_value === 'repassar_taxa') ? ' highlight' : ''; ?>">
            <input type="radio" name="accordion" id="green-card" class="radio-button"
                   value="tax_rsvp" <?php echo ($tax_value === 'tax_rsvp') ? 'checked' : ''; ?>>
            <label for="green-card" class="card-header">
                <span class="radio"></span>
                <p class="title-radio">Quero repassar a taxa dos presentes para meus convidados.<br> <small
                            class="saiba-mais">Saiba Mais <span class="arrow">&#x25BC;</span></small></p>
            </label>
            <div class="card-content">
                <p>Nesta opção o casal opta por receber o valor total dos seus presentes (sem desconto) repassando a
                    taxa para seus convidados. A taxa é inclusa no valor total do presente e não aparece distinta par o
                    convidado <br>
                    Exemplo:</p>
                <p class="desc_value_green"><strong>Valor do presente <span class="float_desc">R$100,00</span></strong>
                </p>
                <p class="desc_value_green"><strong>Valor pago pelo convidado <span
                                class="float_desc">R$100,00</span></strong></p>
                <p class="desc_value_green"><strong>Valor taxa paga pelo casal <span
                                class="float_desc">R$3,89 </span></strong></p>
                <p class="desc_value_green"><strong>Valor que o casal irá resgatar <span
                                class="float_desc">R$96,11</span></strong></p>
            </div>
        </div>

        <p class="tax_list_text_small"><small>Você pode alterar essa opção sempre que quiser. Basta acessar “Taxa dos
                presentes”, no menu principal, e
                mudar a configuação.</small></p>

        <!-- Adicione a mensagem de sucesso -->
        <div class="success-message"></div>

    </section>

    <?php
} else {
    // Exiba uma mensagem para os usuários não logados, ou redirecione-os para fazer login.
    echo '<p>Faça login para criar e gerenciar suas listas de presentes.</p>';
}
?>

<script>
    var selectedOption;
    jQuery(document).ready(function () {
        jQuery('input[type="radio"]').on('click', function () {
            selectedOption = jQuery(this).val();
        });
        jQuery('.card-header').click(function () {
            var content = jQuery(this).next('.card-content');
            content.slideToggle();

            if (selectedOption) {

                var userId = <?php echo $user_id; ?>;

                // Use AJAX para enviar os dados ao servidor
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'update_custom_user_option',
                        user_id: userId,
                        selected_option: selectedOption
                    },
                    complete: function (data) {
                        alert("Taxa selecionada com sucesso!.")
                    }
                });
            }
        });
    });
</script>


<style>
    .accordion {
        max-width: 400px;
        margin: 0 auto;
    }

    .card {
        margin-bottom: 10px;
        background-color: #fff;
    }

    .card-header {
        height: 40px !important;
        display: flex;
        align-items: center;
        padding: 10px;
        background-color: ;
        cursor: pointer;

        font-weight: 300;
    }

    .title-radio {
        color: rgba(0, 0, 0, 0.60);
        font-family: Poligon;
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        letter-spacing: -0.6px;
        margin-top: 5px;
    }

    .radio-button {
        display: none;
        /* Oculta o botão de rádio */
    }

    .radio {
        width: 20px;
        height: 20px;
        border: 2px solid #666;
        border-radius: 5px;
        margin-left: 10px;
        margin-right: 15px;
        position: relative;
        text-align: center;
        font-size: 16px;
        line-height: 20px;
        color: transparent;
    }

    .radio::before {
        content: "\2713";
        /* Código do símbolo de check */
        display: block;
        color: transparent;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        font-size: 18px;
        line-height: 20px;
    }

    .radio-button:checked + .card-header .radio::before {
        color: #666;
        /* Define a cor do símbolo de check quando estiver marcado */
    }

    .saiba-mais {
        margin-left: 0px;
        color: inherit;
    }

    .card-content {
        display: none;
        padding: 10px 30px 10px 30px;
        background-color: inherit;
        color: rgba(0, 0, 0, 0.60);
        font-family: Poligon;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        letter-spacing: -0.56px;
    }

    .green .card-header {
        background: #acb6a7;
        border: 2px solid #556F44;
        border-radius: 20px !important;
    }

    .red .card-header {
        background: #f9c1b4;
        border: 2px solid #F06543;
        border-radius: 20px !important;
        margin-top: 80px;
    }

    .tax_list {
        margin-bottom: 20px;
        margin-left: 5px;
    }

    .title_tax {
        color: #000;
        text-align: center;
        font-family: Inter;
        font-size: 25px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%; /* 30px */
        margin-bottom: 20px;
    }

    .tax_list_text {
        color: rgba(0, 0, 0, 0.60);
        text-align: left;
        font-family: Poligon;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        letter-spacing: -0.8px;

    }

    .tax_list_text_small {
        color: rgba(0, 0, 0, 0.60);
        font-family: Inter;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 120%; /* 16.8px */
        margin-top: 15px;
        margin-left: 5px;
    }

    .desc_value_red {
        margin-top: 10px;
        border-bottom: 1px solid #f9c1b4;
    }

    .desc_value_green {
        margin-top: 10px;
        border-bottom: 1px solid #acb6a7;
    }

    .float_desc {
        float: right;
    }
</style>