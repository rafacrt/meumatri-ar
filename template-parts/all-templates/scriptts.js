jQuery("#carousel").owlCarousel({
    autoplay: true,
    rewind: true, /* use rewind if you don't want loop */
    margin: 20,
    /*
   animateOut: 'fadeOut',
   animateIn: 'fadeIn',
   */
    responsiveClass: true,
    autoHeight: true,
    autoplayTimeout: 7000,
    smartSpeed: 800,
    nav: true,
    responsive: {
        0: {
            items: 1
        },

        600: {
            items: 3
        },

        1024: {
            items: 4
        },

        1366: {
            items: 4
        }
    }
});


// Código JavaScript para tratar a mudança nos filtros (simulação)
document.getElementById('ordemSelect').addEventListener('change', function () {
    alert('Filtro de ordem selecionado: ' + this.value);
});

document.getElementById('paginaSelect').addEventListener('change', function () {
    alert('Página selecionada: ' + this.value);
});