var lower = $('.lower');
var upper = $('.upper');
var lowerVal = parseInt(lower.val());
var upperVal = parseInt(upper.val());
var resultL = $('.result-l');
var resultU = $('.result-u');
var lowMin = parseInt(lower.attr('min'));
var lowMax = parseInt(lower.attr('max'));
var upMin = parseInt(upper.attr('min'));
var upMax = parseInt(upper.attr('max'));
var line = $('.line');
var lineW = upperVal - lowerVal - 15;
line.width(lineW);
console.log(lineW);
lower.on('input', function(){
    lowerVal = parseInt(lower.val());
    upperVal = parseInt(upper.val());
     if (upperVal <= lowerVal + 1 ) {
                upper.val(lowerVal + 2)
            if (lowerVal == lowMin) {
                 upper.val(lowerVal + 2)
            }
     }
        resultL.html(lowerVal)
        resultU.html(upperVal)
        lineW = upperVal - lowerVal;
        line.css({'left': + lowerVal + 'px'});
        line.width(lineW);
})
upper.on('input', function(){
    lowerVal = parseInt(lower.val());
     upperVal = parseInt(upper.val());

     if (lowerVal >= upperVal - 1) {
            lower.val(upperVal - 2)

            if (upperVal == upMax) {
                 lower.val(upperVal - 2)
            }

     }
    resultL.html(lowerVal)
    resultU.html(upperVal)
    lineW = upperVal - lowerVal;
        line.css({'left': + lowerVal + 'px'});
        line.width(lineW);
})
