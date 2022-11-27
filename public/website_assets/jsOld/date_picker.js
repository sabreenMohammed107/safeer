$('.start-date').datepicker({
    templates: {
      leftArrow: '<i class="fa fa-chevron-left"></i>',
      rightArrow: '<i class="fa fa-chevron-right"></i>'
    },
    format: "dd/mm/yyyy",
    startDate: new Date(),
    keyboardNavigation: false,
    autoclose: true,
    todayHighlight: true,
    disableTouchKeyboard: true,
    orientation: "bottom auto"
  });
  
  $('.end-date').datepicker({
    templates: {
      leftArrow: '<i class="fa fa-chevron-left"></i>',
      rightArrow: '<i class="fa fa-chevron-right"></i>'
    },
    format: "dd/mm/yyyy",
    startDate: moment().add(1, 'days').toDate(),
    keyboardNavigation: false,
    autoclose: true,
    todayHighlight: true,
    disableTouchKeyboard: true,
    orientation: "bottom auto"
  
  });
  
  
  $('.start-date').datepicker().on("changeDate", function () {
    var startDate = $('.start-date').datepicker('getDate');
    var oneDayFromStartDate = moment(startDate).add(1, 'days').toDate();
    $('.end-date').datepicker('setStartDate', oneDayFromStartDate);
    $('.end-date').datepicker('setDate', oneDayFromStartDate);
  });
  
  $('.end-date').datepicker().on("show", function () {
    var startDate = $('.start-date').datepicker('getDate');
    $('.day.disabled').filter(function (index) {
      return $(this).text() === moment(startDate).format('D');
    }).addClass('active');
  });