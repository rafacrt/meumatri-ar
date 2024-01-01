</main>

<script>
// Função para enviar o conteúdo da página para o servidor
function enviarConteudoParaServidor(ajaxurl) {
    var mainElement = document.querySelector('main');
    var conteudo = mainElement.innerHTML;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', ajaxurl, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send('action=salvar_pagina&_ajax_nonce=<?php echo wp_create_nonce('salvar_pagina_nonce'); ?>&conteudo=' +
        encodeURIComponent(conteudo));
}
</script>
<?php if (is_home() && is_main_site()) {
    echo'<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>';
    echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
}?>
<?php wp_footer(); ?>
</body>
</html>