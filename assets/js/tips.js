
const updateButton = document.getElementById("addTips");
const cancelButton = document.getElementById("cancel");
const dialog = document.getElementById("listDialogTips");
dialog.returnValue = "boolean";
var placesResults = [];
var placesInseridos = [];
var typeSearch = '';

function openCheck(dialog) {
    if (dialog.open) {
        console.log("Dialog open");
    } else {
        console.log("Dialog closed");
    }
}

// Update button opens a modal dialog
updateButton.addEventListener("click", () => {
    dialog.showModal();
    openCheck(dialog);
});

// Form cancel button closes the dialog box
cancelButton.addEventListener("click", () => {
    dialog.close("listNotChosen");
    openCheck(dialog);
});

jQuery(function() {
    jQuery(".btnRemover").on("click", function(){
        var _this = jQuery(this)
        if(confirm('Tem certeza que deseja remover esta dica?')) {
            var postIdA = _this.data("postId")

            jQuery.ajax({
                url: '/wp-json/meu-matri/v1/dicas/' + postIdA,
                method: 'DELETE',
              
                success: function( data ) {
                    console.log('Dica removida com sucesso');
                    window.location.reload(true);
                },
                error: function( error ) {
                    console.error('Erro ao remover a dica', error);
                }
            });
        }
    });
    
    jQuery(".back-arrow").on("click", function(event) {
        placesResults = [];
        let _this = jQuery(this)
        let index = _this.data('arrow')
        if(index == 1) {
            window.location.reload(true);
        }
        if(index == 2) {
            _this.data('arrow', '1')
            jQuery(".maps-content").hide()
            jQuery(".maps-content .map-list .result-item").remove()
            jQuery("#search-location").val('')
            jQuery(".dicas-content-tips").show();
        }
        if(index == 3) {
            _this.data('arrow', '2')
            jQuery(".dicas-detalhes").hide()
            jQuery(".main-dicas-content").show()

        }
    });
    jQuery(document).on("click", ".detalhes", function() {
        var index = jQuery(this).data('index');
        var postId = jQuery(this).data('post');
        var place = getPlaceDetailsByPlaceId(index, placesInseridos);
    
        jQuery(".btnRemover").data("postId", postId)

        if (place) {
            
            // Caso a dica tenha uma imagem personalizada, use-a
            if (place.imagem && place.imagem !== '') {
                displayDetails(place);
            } else {
                // Caso contrário, busque a imagem do Google
                var serviceDetail = new google.maps.places.PlacesService(map);
                serviceDetail.getDetails({
                    placeId: place.place_id
                }, function(result, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        // Se o resultado do Google tiver uma imagem, use-a
                        if (result.photos && result.photos.length > 0) {
                            place.imagem = result.photos[0].getUrl();
                        }
                        displayDetails(place);
                    }
                });
            }
        }
    });
    
    jQuery.ajax({
        url: '/wp-json/meu-matri/v1/get-dicas/',
        method: 'GET',
        success: function(data) {
            placesInseridos = data
            
            var resultsPlaced = document.getElementById('results-placed');
            resultsPlaced.innerHTML = ''; 
            
            placesInseridos.forEach(function(place) {
                var placeName = limitAddress(place.nome, 22);
                var placeAddress = limitAddress(place.endereco, 43);
                console.log(place.nome+': '+place.imagem)
                var imageUrl = '';
                if (!place.imagem || place.imagem == '') {
                    fetchPlaceImage(place.place_id).then(photoUrl => {
                        imageUrl = photoUrl;
                        var resultHtml = '<div class="result-item">' +
                        '<img src="' + imageUrl + '" alt="' + placeName + '">' +
                        '<div class="info">' +
                        '<strong>' + place.nome + '</strong>' +
                        placeAddress +
                        '</div>' +
                        '<div class="button-action-tips">' +
                        '<button type="button" data-post="'+place.idPost+'" data-index="'+place.place_id+'" class="detalhes">Detalhes</button>' +
                        '</div>' +
                        '</div>';
                        resultsPlaced.innerHTML += resultHtml;
                    }).catch(error => {
                        console.error('Erro ao buscar imagem do Google:', error);
                    });
                }else {
                    var resultHtml = '<div class="result-item">' +
                    '<img src="' + place.imagem + '" alt="' + placeName + '">' +
                    '<div class="info">' +
                    '<strong>' + place.nome + '</strong>' +
                    placeAddress +
                    '</div>' +
                    '<div class="button-action-tips">' +
                    '<button type="button" data-post="'+place.idPost+'" data-index="'+place.place_id+'" class="detalhes">Detalhes</button>' +
                    '</div>' +
                    '</div>';
                    
                    resultsPlaced.innerHTML += resultHtml;
                }
            
              
            });
            
            
        },
        error: function(error) {
            console.error('Erro ao buscar place_ids:', error);
        }
    });
    
    jQuery("[name='opt']").on("click", function() {
        let _this = jQuery(this)

        if(_this.val() == 'Restaurantes') {
            typeSearch = ['restaurant'];
        }else if(_this.val() == 'Salão de Beleza') {
            typeSearch = ['beauty_salon'];
        }else{
            typeSearch = ['lodging'];
        }

        console.log(_this.val(), typeSearch)
        jQuery('.back-arrow').data('arrow', '1')
        jQuery("#results-placed").hide()
        if(_this.val() != 'Outra') {
            jQuery(".title-dicas").text(_this.val())
            jQuery(".text-legend-dicas").text(_this.siblings('.legend-title').text())
            jQuery("#addTips").hide();
            
            jQuery(".location-content").show()
        }else{
            jQuery(".main-dicas-content").hide()
            jQuery(".nova-dica").show()
        }
        dialog.close("listNotChosen");
        openCheck(dialog);
    })
    jQuery('#search-location').on('keyup', function() {
        jQuery('.back-arrow').data('arrow', '2')
        
        jQuery(".dicas-content-tips").hide();
        jQuery(".maps-content").show()
    });
    jQuery(document).on('click', '.button-action-tips button', function() {
        var index = jQuery(this).data('index');
        var _this = jQuery(this)
        var place = getPlaceDetailsByPlaceId(index, placesResults);
        
        if (place) {
            var service = new google.maps.places.PlacesService(map);
            service.getDetails({
                placeId: place.place_id
            }, function(result, status) {
                
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    
                    var dadosHotel = {
                        'action': 'add_dica',
                        'nome': result.name,
                        'endereco': result.formatted_address,
                        'telefone': result.international_phone_number || result.formatted_phone_number,
                        'website': result.website,
                        'lat': result.geometry.location.lat(),
                        'lng': result.geometry.location.lng(),
                        'place_id': result.place_id,
                    };
                    
                    jQuery.ajax({
                        method: 'POST',
                        url: '/wp-json/meu-matri/v1/adicionar-dica/',
                        data: dadosHotel,
                        success: function(response) {
                            if(response == "Dica adicionada com sucesso!") {
                                _this.text("Incluída!")
                                _this.prop("disabled", true)
                                _this.addClass("tips-include")
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        }
    });
    
})
function displayDetails(place) {
    jQuery(".main-dicas-content").hide();
    jQuery(".dicas-detalhes-body h2").text(place.nome);
    jQuery(".dicas-detalhes-body .endereco p").text(place.endereco);
    jQuery(".dicas-detalhes-body .telefone p").text(place.telefone);
    jQuery(".dicas-detalhes-body .website p").text(place.website);
    jQuery(".dicas-detalhes-imagem img").attr("src", place.imagem || 'caminho_para_imagem_padrao.jpg');

    var detailMapElement = document.getElementById('dicas-detalhes-mapa');
    if (!detailMapElement.__map_initialized__) {
        var detailMap = new google.maps.Map(detailMapElement, {
            center: new google.maps.LatLng(place.lat, place.lng),
            zoom: 15
        });
        new google.maps.Marker({
            position: new google.maps.LatLng(place.lat, place.lng),
            map: detailMap,
            title: place.nome
        });
        detailMapElement.__map_initialized__ = true;
    } else {
        var detailMap = detailMapElement.__google_map_instance__;
        detailMap.setCenter(new google.maps.LatLng(place.lat, place.lng));
    }

    jQuery(".dicas-detalhes").show();
}
function getPlaceDetailsByPlaceId(placeId, placesArray) {
    return placesArray.find(place => place.place_id === placeId);
}

// Inicializa o mapa
function initMap(element) {
    var map = new google.maps.Map(element, {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
    });
    
    return map;
}

// Função para criar marcadores no mapa
function createMarker(place, map) {
    if (!place.geometry || !place.geometry.location) return;
    
    const marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
    });
    
    google.maps.event.addListener(marker, 'click', () => {
        // Aqui você pode adicionar ações ao clicar no marcador, como abrir uma InfoWindow
    });
}

function getPlaceDetailsByPlaceId(placeId, search) {
    var placeDetails = search.find(function(place) {
        return place.place_id === placeId;
    });
    
    if (placeDetails) {
        return placeDetails;
    } else {
        console.log('Lugar não encontrado.');
        return null; 
    }
}

// Instancia o mapa
var map = initMap(document.getElementById('map-tips'));

document.getElementById('search-location').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Previne o formulário de ser enviado
        var query = this.value;
        
        var service = new google.maps.places.PlacesService(map);
        service.textSearch({
            query: query,
            type: typeSearch[0]
        }, function(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                placesResults = results; 
                var bounds = new google.maps.LatLngBounds();
                
                var resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = ''; // Limpar resultados anteriores
                
                results.forEach(function(place) {
                    // Adiciona marcadores ao mapa para cada local
                    createMarker(place, map);
                    
                    // Ajusta o mapa para mostrar todos os marcadores
                    if (place.geometry.viewport) {
                        // Somente os locais que têm uma viewport
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                    
                    if (place.photos && place.photos.length > 0) {
                        var photoUrl = place.photos[0].getUrl();
                    }else {
                        var photoUrl = '';
                    }
                    var placeName = limitAddress(place.name, 22);
                    var placeAddress = limitAddress(place.formatted_address, 43);
                    var isPlaceAdded = isPlaceIdAdded(place.place_id, placesInseridos);
                    
                    
                    var buttonHtml = isPlaceAdded ? '<button type="button" disabled class="tips-include">Inclúida!</button>' :
                    '<button type="button" data-index="'+place.place_id+'">Adicionar</button>';
                    
                    // Construir o HTML para o resultado
                    var resultHtml = '<div class="result-item">' +
                    '<img src="' + photoUrl + '" alt="' + placeName + '">' +
                    '<div class="info">' +
                    '<strong>' + placeName + '</strong>' +
                    placeAddress +
                    '</div>' +
                    '<div class="button-action-tips">' +
                    buttonHtml +
                    '</div>' +
                    '</div>';
                    
                    resultsDiv.innerHTML += resultHtml;
                });
                
                // Centraliza e ajusta o zoom do mapa para os resultados
                map.fitBounds(bounds);
            }
        });
    }
});
function limitAddress(address, maxLength) {
    if (address.length <= maxLength) {
        return address;
    }
    
    let trimmedAddress = address.substr(0, maxLength);
    
    trimmedAddress = trimmedAddress.substr(0, Math.min(trimmedAddress.length, trimmedAddress.lastIndexOf(" ")));
    
    return trimmedAddress + '...';
}

function isPlaceIdAdded(placeId, placesArray) {
    return placesArray.some(function(place) {
        return place.place_id === placeId;
    });
}

function fetchPlaceImage(placeId) {
    return new Promise((resolve, reject) => {
        var service = new google.maps.places.PlacesService(document.createElement('div'));
        
        service.getDetails({
            placeId: placeId
        }, function(place, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK && place.photos && place.photos.length > 0) {
                var imgUrl = place.photos[0].getUrl(); // Pega a URL da primeira foto do local
                resolve(imgUrl);
            } else {
                reject("Não foi possível encontrar a imagem.");
            }
        });
    });
}

jQuery('#place-image').on('change', function(event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        jQuery('#image-preview').attr('src', e.target.result);
        
        jQuery(".icon-upload").hide()
        jQuery(".image-box p").hide()
        jQuery('#image-preview').show()
    };

    reader.readAsDataURL(file);
});
var selectedPlaceId;
var selectedAddressLat;
var selectedAddressLng;
var selectedPhone;
var selectedAddress;

document.getElementById('show-address-input').addEventListener('click', function() {
    document.getElementById('search-location-outra-label').style.display = 'block';
    initAutocompleteLocation(); 
});

document.getElementById('new-place-form').addEventListener('submit', function(event) {
    event.preventDefault();
    if(jQuery("#search-location-outra").val() == '') {
        alert("Adicione um mapa");
        return;
    }
    var formData = new FormData();
    formData.append('nome', document.getElementById('place-name').value);
    formData.append('endereco', selectedAddress);
    formData.append('telefone', selectedPhone);
    formData.append('website', document.getElementById('place-website').value);
    formData.append('lat', selectedAddressLat);
    formData.append('lng', selectedAddressLng);
    formData.append('place_id', selectedPlaceId);
    formData.append('descricao', document.getElementById('place-description').value);
    formData.append('imagem', document.getElementById('place-image').files[0]);

    jQuery.ajax({
        method: 'POST',
        url: '/wp-json/meu-matri/v1/adicionar-dica/',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if(response == "Dica adicionada com sucesso!") {
                window.location.reload(true);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });

});
function initAutocompleteLocation() {
    var input = document.getElementById('search-location-outra');
    var autocomplete = new google.maps.places.Autocomplete(input, { types: ['address'] });

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (place.geometry) {
            selectedPlaceId = place.place_id;
            selectedAddressLat = place.geometry.location.lat();
            selectedAddressLng = place.geometry.location.lng();
            selectedPhone      = place.international_phone_number || place.formatted_phone_number;
            selectedAddress    = place.formatted_address
        }
        if (!place.geometry) {
            console.log("No details available for input: '" + place.name + "'");
            return;
        }

        // Se o lugar tem uma geometria, atualiza o mapa
        var map = new google.maps.Map(document.getElementById('map-dica-outra'), {
            center: place.geometry.location,
            zoom: 17
        });
        

        // Adiciona um marcador no mapa na localização selecionada
        new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });
        jQuery("#map-dica-outra").show()

    });

}

google.maps.event.addDomListener(window, 'load', initAutocompleteLocation);


