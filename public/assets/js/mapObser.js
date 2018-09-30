var lat = document.getElementsByClassName('latitude');
var lng = document.getElementsByClassName('longitude');
var map = L.map('mapObser', {
    center: [46.70973594407157, 2.6367187500000004],
    zoom: 5,
    scrollWheelZoom: false
});
latLength = lat.length;
lngLength = lng.length;

for (var i = 0; i < latLength && i < lngLength; i++ ) {
    L.marker([lat[i].innerHTML, lng[i].innerHTML]).addTo(map);
}




L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiamVzZGF4IiwiYSI6ImNqbGlqcnJjazAxemsza3MxbGhvMTljd2UifQ.Sj-xlNYTfb_hU1R0XseFag',
}).addTo(map);