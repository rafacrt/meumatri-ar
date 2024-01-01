<?php
/*
    Obligatory Args:
        {
            title: String,
            ...
        }
*/
$editIcon = get_template_directory_uri().'/assets/images/Icon.svg';

$title = 'Confirme sua presença';
$breakIcon = get_template_directory_uri().'/assets/images/'.$args.'-ms.png';
$description = 'Separamos algumas opções para ajudar vocês, nossos queridos convidados, a se prepararem para o grande dia.';
?>

<section class="rsvp" draggable="true">
    <div class="container">
        <h2 class="section-title"><?=$title?></h2>
        <img class="middle-icon" src="<?=$breakIcon?>" alt="">
            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" class="rsvp__forms" method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="inputNome4" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" placeholder="Nome completo" aria-label="First name">
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="exemplo@email.com.br">
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Podemos contar com a sua presença no evento?</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Não
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Telefone</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="d-flex py-3">
                        <div class="col-md-3">
                            <select id="inputState" class="form-select">
                                <option selected>Adultos</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5 +</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="inputState" class="form-select">
                                <option selected>Crianças</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5 +</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn">Confirmar presença</button>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</section>    
<?php
processar_formulario_rsvp();
?>
