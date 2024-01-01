// document.addEventListener('DOMContentLoaded', function() {
//     // Função para salvar a data no armazenamento local
//     function setTargetDate(targetDate) {
//         localStorage.setItem('targetDate', targetDate);
//     }

//     // Função para recuperar a data do armazenamento local
//     function getTargetDate() {
//         return localStorage.getItem('targetDate');
//     }

//     // Função para salvar o horário no armazenamento local
//     function setTargetTime(targetTime) {
//         localStorage.setItem('targetTime', targetTime);
//     }

//     // Função para recuperar o horário do armazenamento local
//     function getTargetTime() {
//         return localStorage.getItem('targetTime');
//     }

//     function countdown(targetDate, targetTime) {
//         const currentDate = new Date().getTime();
//         const timeLeft = targetDate - currentDate;

//         if (timeLeft <= 0) {
//             // O tempo expirou
//             document.getElementById('days').innerText = '00';
//             document.getElementById('hours').innerText = '00';
//             document.getElementById('minutes').innerText = '00';
//             document.getElementById('new-time').textContent = 'Horário';
//         } else {
//             const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
//             const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//             const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));

//             // Atualize os elementos HTML com os valores calculados
//             document.getElementById('days').innerText = days.toString().padStart(2, '0');
//             document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
//             document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
//             document.getElementById('new-time').textContent = targetTime;
//         }
//     }

//     function updateCountdown() {
//         const storedDate = getTargetDate();
//         const storedTime = getTargetTime();
//         if (storedDate && storedTime) {
//             countdown(storedDate, storedTime);
//         }
//     }

//     // Abrir modal para editar data e hora
//     document.getElementById('edit-button').addEventListener('click', function () {
//         document.getElementById('modal').style.display = 'block';
//     });

//     // Fechar modal
//     document.getElementById('close-button').addEventListener('click', function () {
//         document.getElementById('modal').style.display = 'none';
//     });

//     // Salvar data e hora e atualizar a contagem regressiva
//     document.getElementById('save-button').addEventListener('click', function () {
//         const newDate = new Date(document.getElementById('new-date').value).getTime();
//         setTargetDate(newDate);

//         const newTime = document.getElementById('new-time').value;
//         setTargetTime(newTime);
//         updateCountdown();

//         document.getElementById('modal').style.display = 'none';
//     });

//     // Inicializar a contagem regressiva e atualizar a cada segundo
//     updateCountdown();
//     setInterval(updateCountdown, 1000);
// });


// // mapa

// document.addEventListener('DOMContentLoaded', function() {
//     var map;
//     var addressInput = document.getElementById('address-input');
//     var marker;

//     var pegaEnd = document.getElementById('address-input').value;
//     console.log (pegaEnd);

//     // Recupere o endereço e coordenadas do armazenamento local
//     var storedAddress = localStorage.getItem('savedAddress');
//     var storedLat = parseFloat(localStorage.getItem('savedLat'));
//     var storedLng = parseFloat(localStorage.getItem('savedLng'));

//     // Inicialize o mapa
//     if (!isNaN(storedLat) && !isNaN(storedLng)) {
//         map = L.map('map').setView([storedLat, storedLng], 15);
//         marker = L.marker([storedLat, storedLng]).addTo(map);

//         // Configure o popup com o endereço
//         marker.bindPopup('Endereço: ' + storedAddress).openPopup();
//     } else {
//         map = L.map('map').setView([0, 0], 15); // Centro inicial do mapa
//     }
//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

//     // Função para mostrar o endereço no mapa
//     function showOnMap(address) {
//         fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + address)
//             .then(function(response) {
//                 return response.json();
//             })
//             .then(function(data) {
//                 if (data.length > 0) {
//                     var location = data[0];

//                     if (marker) {
//                         marker.setLatLng([location.lat, location.lon]);

//                         // Configure o popup com o endereço
//                         marker.bindPopup('Endereço: ' + address).openPopup();
//                     } else {
//                         marker = L.marker([location.lat, location.lon]).addTo(map);

//                         // Configure o popup com o endereço
//                         marker.bindPopup('Endereço: ' + address).openPopup();
//                     }

//                     var googleMapsLink = document.getElementById('google-maps-link');
//                     googleMapsLink.href = 'https://www.google.com/maps?q=' + location.lat + ',' + location.lon;
//                     // document.getElementById('address').innerText = address;

//                     // Atualize o mapa com as novas coordenadas
//                     map.setView([location.lat, location.lon], 15);

//                     // Salve o endereço e coordenadas no armazenamento local
//                     localStorage.setItem('savedAddress', address);
//                     localStorage.setItem('savedLat', location.lat);
//                     localStorage.setItem('savedLng', location.lon);
//                 } else {
//                     alert('Endereço não encontrado');
//                 }
//             })
//             .catch(function(error) {
//                 console.error('Erro ao buscar o endereço:', error);
//             });
//     }

//     // Clique no botão "Mostrar no Mapa"
//     document.getElementById('show-on-map').addEventListener('click', function() {
//         var address = addressInput.value;
//         showOnMap(address);
//     });

//     // Clique no botão "Abrir Popup"
//     document.getElementById('show-popup').addEventListener('click', function() {
//         var address = prompt('Insira o endereço:');
//         if (address) {
//             addressInput.value = address;
//             showOnMap(address);
//         }
//     });
// });