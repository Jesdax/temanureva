import axios from 'axios'

require('../css/app.css');
var app = new Vue({
    el: '#observation-autocomplete', // on vise l'element (div) pour initialiser l'instance VueJS dessus
    delimiters: ['${', '}'], // pour dire à vueJS : tu n'utilises pas ces délimiteurs utilisés par Twig >>> no conflict between VueJs and Twig
    data: {
        autocomplete: '',
        items: []
    },
    // attendre que VueJS charge les éléments dans le DOM
    mounted () {
        $('input.autocomplete').autocomplete({
            onAutocomplete: (v) => { // function (v) {return v} >>> on clique, ça fait quelque chose
                let item = this.items.find(i => {
                    return i.name === v
                })
                $('#observation_bird').val(item.id) // il récupère l'id pour le mettre dans  #observation-bird (champ caché)
            }
        });
    },
    /**
     * methods >>> on met tout ce que l'on veut exécuter
     */
    methods: {
        search (v) {  // "lié" à @input = search dans html.twig >>> passe l'élément en entier (v = event)
            axios.get('/autocomplete?dataBird='+v.target.value).then( //.then permet d'attendre la réponse de la fonction asynchrone axios.get
                response => {
                    $('input.autocomplete').css('border-bottom', '1px solid green')
                    this.items = response.data // on récupère l'array d'objet
                    if (this.items.length === 0){
                        $('input.autocomplete').css('border-bottom', '1px solid red')
                    }
                    let valuesObject = {} //let : variable de bloc, uniquement utilisable dans le bloc en question; ex : for, if...
                    let mapfn = i => { //map <=> foreach, retourne une fonction avec l'élément de l'itération en paramètre
                        valuesObject[i.name] = ''  //pour rajouter une image >>> = i.attribut image
                    }
                    this.items.map(mapfn) // il injecte l'élément en tant que paramètre de la fonction à exécuter

                    $('input.autocomplete').autocomplete('updateData', valuesObject);
                }
            )
        }
    }
})

// valuesObject[i.name + '[' + i.order + ']'] = '' >>> pour afficher ordre et cie