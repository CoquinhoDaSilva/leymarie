$(document).ready(function() {

    ////////////////// Timers description et popup doctolib //////////////////////////////////

    setTimeout(function() {
        $('.filterHome').fadeTo(1000, 1);
    }, 500)

    setTimeout(function() {
        $('.filterText1').fadeTo(1000, 1);
    }, 1500)

    setTimeout(function() {
        $('.filterText2').fadeTo(500, 1);
    }, 2000)

    setTimeout(function() {
        $('.filterText3').fadeTo(500, 1);
    }, 2500)

    setTimeout(function() {
        $('.filterText4').fadeTo(500, 1);
    }, 3000)

    setTimeout(function(){
        $('.popUpDocto').removeClass('displayNone');
    }, 7000);

    ////////////////////////// hover sur le menu header /////////////////////////////////////

    $('.btnHeaderLogin').hover(function() {
            $( this ).addClass('btnHeaderOver');
            $('.btnHeaderLogin').not($(this)).addClass('btnHeaderWrong');
        }, function() {
            $( this ).removeClass('btnHeaderOver');
            $('.btnHeaderLogin').not($(this)).removeClass('btnHeaderWrong');
        }
    );

    //////////////////////////////// hover sur les images ////////////////////////////////////

    $('.imgHome').hover( function() {
            $('.imgHome').not($(this)).addClass('opacity');
        }, function () {
            $('.imgHome').not($(this)).removeClass('opacity');
        }

    );

    ////////////////////////////// disparition du popup Doctolib ////////////////////////

    $('body').on('click', function () {
            $('.popUpDocto').addClass('displayNone');

    });

    ///////////////////////////// menu burger ///////////////////////////////////////////

    var isMenuOpen = false;

    $('.baseLogoMenu').click(function () {
        if ( isMenuOpen == false) {
            $('.menuPopUp').removeClass('displayNone');
            isMenuOpen = true;
        } else {
            $('.menuPopUp').addClass('displayNone');
            isMenuOpen = false;
        }
    })

});

    ///////////////////////////////////// fadin /////////////////////////////////////////

$(window).on("load",function() {
    $(window).scroll(function() {
        var windowBottom = $(this).scrollTop() + ($(this).innerHeight()*1.3);
        $(".fading").each(function() {
            /* Check the location of each desired element */
            var objectBottom = $(this).offset().top + $(this).outerHeight();

            /* If the element is completely within bounds of the window, fade it in */
            if (objectBottom < windowBottom) { //object comes into view (scrolling down)
                $(this).fadeTo(1000,1);
            }
        });
    }).scroll(); //invoke scroll-handler on page-load
});
