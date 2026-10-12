{{-- Start/end date+time pickers for the offer add & edit forms (inside a DOMContentLoaded handler).
     The end picker can't go before the chosen start, and vice versa. --}}
var periodOptions = { enableTime: true, time_24hr: true, dateFormat: 'Y-m-d H:i', allowInput: true };
var endPicker = flatpickr('#end_date', Object.assign({}, periodOptions, {
    minDate: document.getElementById('start_date').value || null,
    onChange: function(selected, dateStr) {
        startPicker.set('maxDate', dateStr || null);
    },
}));
var startPicker = flatpickr('#start_date', Object.assign({}, periodOptions, {
    maxDate: document.getElementById('end_date').value || null,
    onChange: function(selected, dateStr) {
        endPicker.set('minDate', dateStr || null);
    },
}));
