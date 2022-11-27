$('.demo').daterangepicker({
    "showISOWeekNumbers": true,
    "timePicker": false,
    "autoUpdateInput": true,
    "locale": {
        "cancelLabel": 'Clear',
        "format": "MMMM DD, YYYY ",
        "separator": " | ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
        "monthNames": [
            "Jan",
            "Feb",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",   
            "Sep.t",
            "Oct.",
            "Nov.",
            "Dec."
        ],
        "firstDay": 1
    },
    "linkedCalendars": true,
    "showCustomRangeLabel": false,
    "startDate": 1,
    "endDate": "December 31, 2016 @ h:mm A",
    "opens": "center"
});