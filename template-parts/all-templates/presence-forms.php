<?php
/*
    Obligatory Args:
        {
            title: String,
            ...
        }
*/
$editIcon = get_template_directory_uri() . '/assets/images/Icon.svg';

$title = 'Confirme sua presença';
$breakIcon = get_template_directory_uri() . '/assets/images/' . $args . '-ms.png';
$description = 'Separamos algumas opções para ajudar vocês, nossos queridos convidados, a se prepararem para o grande dia.';
?>

<section class="rsvp" draggable="true">
    <div class="container">
        <h2 class="section-title">
            <?= $title ?>
        </h2>
        <p style="text-align:center;"><img class="middle-icon" src="<?= $breakIcon ?>" alt=""></p>
        <div class="error-message" style="color: red; text-align:center; margin-bottom:10px;"></div>
        <div class="success-message" style="color: green; text-align:center; margin-bottom:10px;"></div>
        <form id="rsvp_forms" method="post">

            <label for="rsvpName">Nome completo:
                <br>
                <input type="text" id="rsvpName" name="name" placeholder="Insira seu nome completo">
            </label>

            <label for="boolean">
                Você irá ao evento?
                <div class="flex" style="display: flex">
                    <label for="yes" class="for">
                        <input id="yes" type="radio" name="boolean" value="true" checked>
                        Sim</label>
                    <label for="no" class="for">
                        <input id="no" type="radio" name="boolean" value="false">
                        Não</label>
                </div>
            </label>

            <label for="adults_number">
                Quantidade de adultos incluindo você
                <br>
                <input type="number" name="adults_number" id="adults_number" min="1">
            </label>
            <label for="kids_number">
                Quantidade de crianças
                <br>
                <input type="number" name="kids_number" id="kids_number" min="0">
            </label>

            <label for="email">
                E-mail
                <br>
                <small>Você receberá a confirmação de presença neste e-mail</small>
                <br>
                <input type="email" name="email" id="email" placeholder="exemplo@email.com">
            </label>

            <label for="tel">
                Telefone
                <br>
                <input type="tel" name="telefone" id="telefone" placeholder="(11)99999-9999">
            </label>
            <br>
            <br>
            <label class="policy" for="policy">
                <input type="checkbox" name="policy" id="policy">
                Declaro que tive acesso, li e concordo com os
                <a href="">
                    Termos de uso e Política de Privacidade do Casar.com
                </a>
            </label>


            <button type="submit" class="btn">Confirmar Presença</button>
        </form>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#criarPedido').on('click', function (e) {
            e.preventDefault();
            $('.error-message').text('');

            let id = 1;

            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'createOrderCoupleGift',
                },
                beforeSend: function () {
                    $(".loading-overlay").show();
                },
                success: function (response) {
                    var data = JSON.parse(response);
                },
                complete: function () {
                    $(".loading-overlay").hide();
                }
            });
        });
    });

    $(document).ready(function () {
        $('#rsvp_forms').on('submit', function (e) {
            $(".loading-overlay").show();
            e.preventDefault();

            var rsvpName = $('#rsvpName').val();
            var adults_number = $('#adults_number').val();
            var kids_number = $('#kids_number').val();
            var email = $('#email').val();
            var telefone = $('#telefone').val();
            var policy = $('#policy').is(':checked');
            var isGoing = $('input[name="boolean"]:checked').val();

            // Verificar se o usuário concordou com a política
            if (!policy) {
                $('.error-message').text('Você deve concordar com a política de privacidade');
                $(".loading-overlay").hide();
                return;
            }

            // Validar o e-mail
            if (!isValidEmail(email)) {
                $('.error-message').text('E-mail inválido');
                $(".loading-overlay").hide();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'cadastrar_rsvp',
                    rsvpName: rsvpName,
                    adults_number: adults_number,
                    kids_number: kids_number,
                    email: email,
                    telefone: telefone,
                },
                beforeSend: function () {
                    $(".loading-overlay").show();
                },
                success: function (response) {
                    $(".loading-overlay").hide();
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        // Redirecionar ou realizar ações após o sucesso
                        $('.success-message').text('Sua presença foi confirmada!');
                        $('.error-message').hide();
                        window.location.reload;
                    } else {
                    }
                },
                complete: function () {
                    $(".loading-overlay").hide();
                }

            });
        });
    });

    // Função para validar e-mail
    function isValidEmail(email) {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(email);
    }
</script>