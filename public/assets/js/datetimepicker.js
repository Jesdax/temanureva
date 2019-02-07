var currentDate = new Date();


$(document).ready(function(){


    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        yearRange: 100,
        firstDay: 1,
        i18n: {
            months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
            monthsShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
            weekdays: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
            weekdaysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
            weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
        },
        maxDate: currentDate,
        onSelect: function (date) {
            console.log(date)
            var time = $('.timepicker').val()
            if (time) {
                $('#observation_observation_date').val(date.getFullYear()+ '-' + date.getMonth() + '-' + date.getDate())
            }
        },

    });



    $('.timepicker').timepicker({
        twelveHour: false,
        onSelect: function (hour, minute){
           var time = hour + ':' + minute;
            var date = $('.datepicker').val()
            dateParts = date.split('/')
            if (date) {
                $('#observation_observation_date').val(dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0])
            }
        },
    });
});
