import axios from "axios";

require('../css/app.css');

var exploCompletion = new Vue({
    el: '#exploration-autocomplete',
    delimiters: ['${', '}'],
    data: {
        autocomplete: '',
        items: [],
        observation: [],
        map: {}
    },

    mounted () {
        $('input.autocomplete').autocomplete({
            onAutocomplete: (v) => {
                axios.get('/observer-carte-oiseaux/rechercher?dataBird='+ v).then( //faire la requête qui retourne la liste des observations where bird.id = id (ou v)

                    response => {
                        let list = response.data
                        list.map(o => {
                            this.map.addMarker({lat: o.latitude, lon: o.longitude}) //à vérifier comment c'est dans leaflet
                        })
                    }

                )
                console.log(v);
            }

        });
        this.map = L.map('mappex', {
            center: [46.70973594407157, 2.6367187500000004],
            zoom: 6,
            zoomControl: false
        });
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiamVzZGF4IiwiYSI6ImNqbGlqcnJjazAxemsza3MxbGhvMTljd2UifQ.Sj-xlNYTfb_hU1R0XseFag',
        }).addTo(this.map);

    },
    methods: {
        search (v) {
            axios.get('/autocomplete?dataBird='+v.target.value).then(
                response => {
                    $('input.autocomplete').css('border-bottom', '1px solid green')
                    this.items = response.data
                    if (this.items.length === 0){
                        $('input.autocomplete').css('border-bottom', '1px solid red')
                    }
                    let valuesObject = {}
                    let mapfn = i => {
                        valuesObject[i.name] = ''
                    }
                    this.items.map(mapfn)

                    $('input.autocomplete').autocomplete('updateData', valuesObject);
                }
            )
        }
    }
})
