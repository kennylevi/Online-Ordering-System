$(function () {
    
    // getting the first step toggle
    $('.step-one-preview, .open-icon-1').hide(); //hidden by default

    $('.step-one-toggle').click(function (e) {
        if ($('.step-one-preview, .open-icon-1').is(':hidden')) {
            $('.step-one-preview, .open-icon-1').slideDown('fast');
            $('.close-icon-1').hide('fast');
        }
    });
   
    $('.step-two-preview, .open-icon-2').hide(); //step two preview hiden by default

    $('.step-1-next').click(function (e) {
        $('.step-one-preview, .open-icon-1').slideUp('fast');
        $('.close-icon-1').show('fast');

        if ($('.step-two-preview, .open-icon-2').is(':hidden')) {
            $('.step-two-preview, .open-icon-2').slideDown('fast');
            $('.close-icon-2').hide('fast');
        }
    });

    // hidding bacl the step two sectio and opening the next step that step three
    $('.step-2-next').click(function (e) {
        $('.step-two-preview, .open-icon-2').slideUp('fast');
        $('.close-icon-2').show('fast');
    });


    


});