$(document).ready(function() {

    $('.btnHeaderLogin').hover(function() {
            $( this ).addClass('btnHeaderOver');
            $('.btnHeaderLogin').not($(this)).addClass('btnHeaderWrong');
        }, function() {
            $( this ).removeClass('btnHeaderOver');
            $('.btnHeaderLogin').not($(this)).removeClass('btnHeaderWrong');
        }
    );

    $('.imgHome').hover( function() {
            $('.imgHome').not($(this)).addClass('opacity');
        }, function () {
            $('.imgHome').not($(this)).removeClass('opacity');
        }

    );

    $(window).ready(function () {
        setTimeout(function(){
            $('.popUpDocto').removeClass('displayNone');
        }, 7000);

    });

    $('body').on('click', function () {
            $('.popUpDocto').addClass('displayNone');

    });


    $(window).ready(function() {
        setTimeout(function() {
            $('.filterHome').fadeTo(1000, 1);
        }, 500)
    });

    $(window).ready(function() {
        setTimeout(function() {
            $('.filterText1').fadeTo(1000, 1);
        }, 1500)
    });
    $(window).ready(function() {
        setTimeout(function() {
            $('.filterText2').fadeTo(500, 1);
        }, 2000)
    });
    $(window).ready(function() {
        setTimeout(function() {
            $('.filterText3').fadeTo(500, 1);
        }, 2500)
    });
    $(window).ready(function() {
        setTimeout(function() {
            $('.filterText4').fadeTo(500, 1);
        }, 3000)
    });


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
