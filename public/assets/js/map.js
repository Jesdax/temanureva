// On initialise la latitude et la longitude de Paris (centre de la carte)
var lat = 48.852969;
var lon = 2.349903;
var myMap = L.map('map-observation').setView([lat, lon], 5);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiamVzZGF4IiwiYSI6ImNqbGlqcnJjazAxemsza3MxbGhvMTljd2UifQ.Sj-xlNYTfb_hU1R0XseFag',
}).addTo(myMap);


var myMarker = L.marker([lat, lon], {draggable: true}, {interactive: true}).addTo(myMap);
var myCustomButton = L.Control.extend({
    options: {
        position: 'topright'
        //control position - allowed: 'topleft', 'topright', 'bottomleft', 'bottomright'
    },
    onAdd: function (myMap) {
        var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');

        container.style.backgroundColor = 'white';
        /*$('div.leaflet-control-custom').css('backgroud-image', '../img/icon_close.png')*/
         container.style.backgroundImage = 'url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlxbvPh3HEPc4ANqILXKinC810UYB9CUcgMIq9pylbmOfbGbE4Ug)';
         container.style.backgroundSize = "10px 10px";
         container.style.backgroundRepeat = 'no-repeat';
         container.style.backgroundPosition = 'center';
         container.style.width = '30px';
         container.style.height = '30px';
         container.style.marginTop = '7.5px';

         container.onclick = function(){
             $('#observation-map').hide();
         }
         return container;
     },
 });
myMap.addControl(new myCustomButton());

window.onload = function() {

      /**
       * function to retrieve geographical coordinates
       */
        myMarker.on('dragend', function(e) {
        var newCoordinates = myMarker.getLatLng();
        $('#observation_latitude').focus().val(newCoordinates.lat);
        $('#observation_longitude').focus().val(newCoordinates.lng);
        $('#location-input').focus().val(newCoordinates.lat + '/ ' + newCoordinates.lng);
    });

    /**
     * to show the map when user clicks into the location-input
     */
    $('#location-input').click(function () {
        $('#observation-map').show();
         myMap.invalidateSize();
    });

    /**
     * to hide map when user clicks on button "validate" below the map
     */
    $('#hide').click(function () {
        $('#observation-map').hide();
    });
};