$(document).ready(function() {

    $('.btnHeader').hover(function() {
            $( this ).addClass('btnHeaderOver');
            $('.btnHeader').not($(this)).addClass('btnHeaderWrong');
        }, function() {
            $( this ).removeClass('btnHeaderOver');
            $('.btnHeader').not($(this)).removeClass('btnHeaderWrong');
        }
    );

    $('.imgHome').hover( function() {
            $('.imgHome').not($(this)).addClass('opacity');
        }, function () {
            $('.imgHome').not($(this)).removeClass('opacity');
        }

    );

    $(document).ready(function () {
        setTimeout(function(){
            $('.popup').removeClass('displayNone');
        }, 5000);

    });

    $('body').on('click', function () {
            $('.popup').addClass('displayNone');

    });










});