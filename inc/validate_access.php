<div id="primeiroAcesso" class="modal">
    <div class="modal-content-valida">
        <span class="close" id="closeModal">&times;</span>
        <h2>Estamos quase lá!</h2>
        <p>Chegou a hora de criar a sua <br> lista de presentes<p>
        <p>Você pode escolher uma de <br> nossas listas prontas ou criar <br> os presentes do seu jeito
        </p>
        <a href="https://meumatri.com/lista-de-presentes/" id="botao1">Criar Lista</a>
        <br>
        <button class="closeModal" style="opacity:0.7">Agora Não</button>
    </div>
</div>
<script>
    // Mostra o modal quando a página é carregada
   jQuery(".closeModal").click(function() {
       jQuery("#primeiroAcesso").hide();
    });
</script>
<style>
    .modal {
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .modal-content-valida {
        background-color: #fff;
        margin: 10% auto;
        padding: 30px;
        border: 1px solid #888;
        width: 294px;
        height: 357px;
        text-align: center;
        background-color: #fff;
        border-radius: 21px;
        border: 1.5px solid #000; /* Adicione a cor da borda desejada */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra para o modal */
    }

    @media screen and (max-width: 767px) {
    .modal-content-valida {
        margin: 30% auto; /* Margem de 70% apenas em dispositivos móveis */
    }
    }

    .modal-content-valida h2 {
        font-family: Inter;
        font-size: 24px;
        font-weight: 700;
        line-height: 29px;
        letter-spacing: -0.04em;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .modal-content-valida p {
        font-family: Inter;
        font-size: 16px;
        font-weight: 700;
        line-height: 19px;
        letter-spacing: -0.04em;
        text-align: center;
        margin-bottom: 20px;
    }


    .close {
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    .modal-content-valida a {
        color: var(--white);
        background: var(--primary);
        border-style: none;
        border-radius: 8px;
        font-style: normal;
        font-weight: 600;
        font-size: 15px;
        line-height: 19px;
        text-align: center;
        letter-spacing: -0.04em;
        display: block;
        height: 38px;
        padding: 0 60px;
        margin: 0 auto;
    }

    .modal-content-valida button {
        color: var(--white);
        background: var(--primary);
        border-style: none;
        border-radius: 8px;
        font-style: normal;
        font-weight: 600;
        font-size: 15px;
        line-height: 19px;
        text-align: center;
        letter-spacing: -0.04em;
        display: block;
        height: 38px;
        padding: 0 60px;
        margin: 0 auto;
    }
</style>
