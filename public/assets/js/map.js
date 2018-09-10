// On initialise la latitude et la longitude de Paris (centre de la carte)
var lat = 48.852969;
var lon = 2.349903;
var myMap = null;

var myMarker = null;
// Fonction d'initialisation de la carte
function initMap() {
    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    myMap = L.map('map-observation').setView([lat, lon], 5);
    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        minZoom: 1,
        maxZoom: 20,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiamVzZGF4IiwiYSI6ImNqbGlqcnJjazAxemsza3MxbGhvMTljd2UifQ.Sj-xlNYTfb_hU1R0XseFag',
    }).addTo(myMap);

    myMarker = L.marker([lat, lon], {draggable: true}, {interactive: true}).addTo(myMap);
}


window.onload = function(){
    // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
    initMap();

    /**
     * function to retrieve geographical coordinates
     */
    myMarker.on('dragend', function(e) {
        var newCoordinates = myMarker.getLatLng();
        $('#observation_latitude').val(newCoordinates.lat);
        $('#observation_longitude').val(newCoordinates.lng);
        $('#location-input').val(newCoordinates.lat + '/ ' + newCoordinates.lng);
    });

    /**
     * to show the map when user clicks into the location-input
     */
    $('#location-input').click(function(){
        $('#observation-map').show();
        myMap.invalidateSize();
    });

    /**
     * to hide map when user clicks on button "validate" below the map
     */
    $('#hide').click(function(){
        $('#observation-map').hide();
    });
};
