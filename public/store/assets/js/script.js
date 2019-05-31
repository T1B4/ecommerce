$(document).ready(function () {
    $('.cartao_aniversario').mask('00/00/0000');
    $('.telephone').mask('00-00000-0000');
});

$(function () {
    var width = window.screen.width;
    if (width > 768) {
        $("#row-destaque").addClass("valign-wrapper");
    }
    if (width < 768) {
        $("#logo").addClass("center-align");
        $("#row-product").addClass("center-align");
        $(".cart-buttons").addClass("center-align");
        $(".cart-buttons").removeClass("right-align");
    }
});

$(function () {
    var width = $(".img-carroussel").width()
    $(".div-img-carroussel").css('min-height', width)
    // document.getElementsByClassName('div-img-carroussel').css("min-height", width)
})

$(function () {
    $('.nav-mobile-button').on("click", function () {
        $('.nav-mobile-group').animate({
            left: '0',
        });
    });
});

$(function () {
    $('.close-btn').on("click", function () {
        $('.nav-mobile-group').animate({
            left: '-576px',
        });
    });
});

$(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 50,
        dots: false,
        navText: ['<img class="owl-buttons" src="/assets/img/left-button.png"/>', '<img class="owl-buttons" src="/assets/img/right-button.png"/>'],
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: true
            },
            576: {
                items: 3,
                nav: false
            },
            992: {
                items: 4,
                nav: true,
            },
            1200: {
                items: 6,
                nav: true,
            }
        }
    })
});

$(function () {
    $(".scroll_top_btn").on("click", function () {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
    });
});

function selectPg() {
    var pgCode = document.getElementById("pg_form").value;
    if (pgCode == 'CREDIT_CARD') {
        document.getElementById("cc").style.display = "block";
    } else {
        document.getElementById("cc").style.display = "none";
    }
}

$(document).ready(function () {
    $(window).scroll(function () {
        if ($(document).scrollTop() > 400) {
            $(".scroll_top_btn").fadeIn();
        } else {
            $(".scroll_top_btn").fadeOut();
        }
    });
});

$(function () {
    $(".scroll_top_btn").on("click", function () {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
    });
});

$(function () {
    $(".main_dropdown").hover(
        function () {
            $(this).children(".main_dropdown_content").fadeIn(200);
        },
        function () {
            $(this).children(".main_dropdown_content").fadeOut(200);
        }
    );
});

$(function () {
    $('.form-check').on('click', function () {
        $('.cart-submit').removeClass('hidden');
        var price = $(this).children('input[type=hidden]').val();
        var total = $('#total').val();
        price = price.replace(',', '.');
        total = total.replace(',', '.');
        var final = parseFloat(price) + parseFloat(total);
        price = price.replace('.', ',');
        // price = parseFloat(price);
        $('#frete').html('<b>Frete</b> - R$ ' + price);
        $('#cart-total').html('<b>Total à vista</b> - R$ ' + final.toFixed(2));
        var type = $(this).children('.form-check-input').val();
        $('input[id=shipping-type]').val(type);
    });
});

$(function () {

    $('#freteprod').bind('submit', function (e) {
        e.preventDefault();
        var txt = $(this).serialize();

        $.ajax({
            type: 'post',
            url: '/functions/frete_prazo.php',
            data: txt,
            success: function (resultado) {
                $('.frete').html(resultado);
            },
            error: function () {
                alert("Ocorreu um erro!");
            }
        });
    });

});

$(function () {
    $('#finalizar').on('click', function () {
        $('#load').css('display', 'block');
    });
});

$(function () {

    // if(typeof maxslider != 'undefined') {
    //     $( "#slider-range" ).slider({
    //         range: true,
    //         min: 0,
    //         max: maxslider,
    //         values: [ $('#slider0').val(), $('#slider1').val() ],
    //         slide: function( event, ui ) {
    //             $( "#amount" ).val( "R$" + ui.values[ 0 ] + " - R$" + ui.values[ 1 ] );
    //         },
    //         change: function( event, ui ) {
    //             $('#slider'+ui.handleIndex).val(ui.value);
    //             $('.filterarea form').submit();
    //         }
    //     });
    // }

    // $( "#amount" ).val( "R$" + $( "#slider-range" ).slider( "values", 0 ) + " - R$" + $( "#slider-range" ).slider( "values", 1 ) );


    // $('.filterarea').find('input').on('change', function(){
    //     $('.filterarea form').submit();
    // });

    $('.addtocartform button').on('click', function (e) {
        e.preventDefault();

        var qt = parseInt($('.addtocart_qt').val());
        var action = $(this).attr('data-action');

        if (action == 'decrease') {
            if (qt - 1 >= 1) {
                qt = qt - 1;
            }
        } else if (action == 'increase') {
            qt = qt + 1;
        }

        $('.addtocart_qt').val(qt);
        $('input[name=qt_product]').val(qt);

    });

    $('.photo_item').on('click', function () {
        var url = $(this).find('img').attr('src');
        $('.mainphoto').find('img').attr('src', url);
    });

});