import axios from 'axios'

require('../css/app.css');

//Autocomplete for add Observation
var app = new Vue({
    el: '#bird-autocomplete', // on vise l'element (div) pour initialiser l'instance VueJS dessus >>>
    delimiters: ['${', '}'], // pour dire à vueJS : tu n'utilises pas ces délimiteurs utilisés par Twig >>> no conflict between VueJs and Twig
    data: {
        autocomplete: '',
        items: []
    },
    // attendre que VueJS charge les éléments dans le DOM
    mounted () {
        $('input#family-input').autocomplete({ //
            onAutocomplete: (v) => { // function (v) {return v} >>> on clique, ça fait quelque chose
                window.location.replace('?famille='+v)
            }
        });

        $('input#bird-input').autocomplete({
            onAutocomplete: (v) => { // function (v) {return v} >>> on clique, ça fait quelque chose
                let item = this.items.find(i => {
                    return i.name === v
                })
                $('#bird_list_id').val(item.id) /*|| $('#bird_list_name_order').val(item.order) || $('#bird_list_family').val(item.family)*/// il récupère l'id pour le mettre dans  #observation-bird (champ caché)
                //tester avec l'ajout d'un autre $('#gnagna...)
            }
        });
    },
    /**
     * methods >>> on met tout ce que l'on veut exécuter
     */
    methods: {
        search (v) {  // "lié" à @input = search dans html.twig >>> passe l'élément en entier (v = event)
            axios.get('/multi-autocomplete?dataBird='+v.target.value).then( //.then permet d'attendre la réponse de la fonction asynchrone axios.get
                response => {
                    $('input#bird-input').css('border-bottom', '1px solid green')
                    this.items = response.data // on récupère l'array d'objet
                    if (this.items.length === 0){
                        $('input#bird-input').css('border-bottom', '1px solid red')
                    }
                    let valuesObject = {} //let : variable de bloc, uniquement utilisable dans le bloc en question; ex : for, if...
                    let mapfn = i => { //
                        valuesObject[i.name] = ''  //pour rajouter une image >>> = i.attribut image
                        valuesObject[i.order] = ''
                        valuesObject[i.family] = ''
                    }
                    this.items.map(mapfn) // map <=> foreach, retourne une fonction ,il injecte l'élément en tant que paramètre de la fonction à exécuter

                    $('input#bird-input').autocomplete('updateData', valuesObject);
                }
            )
        },
        searchFamily (v) {
            axios.get('/familyList?name='+v.target.value).then( //.then permet d'attendre la réponse de la fonction asynchrone axios.get
                response => {
                    $('input#family-input').css('border-bottom', '1px solid green')
                    this.items = response.data // on récupère l'array d'objet
                    if (this.items.length === 0){
                        $('input#family-input').css('border-bottom', '1px solid red')
                    }
                    let valuesObject = {} //let : variable de bloc, uniquement utilisable dans le bloc en question; ex : for, if...
                    let mapfn = i => { //map <=> foreach, retourne une fonction avec l'élément de l'itération en paramètre
                        valuesObject[i.family] = ''  //pour rajouter une image >>> = i.attribut image
                    }
                    this.items.map(mapfn) // il injecte l'élément en tant que paramètre de la fonction à exécuter

                    $('input#family-input').autocomplete('updateData', valuesObject);
                }
            )
        }
    }
})