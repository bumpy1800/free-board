$(document).on("click", ".btn-todayIsue-left", function(){
    $('.sec-issue').hide();
    $('.fir-issue').show();
});

$(document).on("click", ".btn-todayIsue-right", function(){
    $('.fir-issue').hide();
    $('.sec-issue').show();
});
