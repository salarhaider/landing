


$('.logos-slider').slick({
    centerMode: true,
    centerPadding: '50px',
    arrows: false,
    autoplay: true,
    autoplaySpeed: 100,
    speed: 10000,
    cssEase: 'linear',
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1600,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 1300,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 992,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 575,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '10px',
                slidesToShow: 1,
            }
        }
    ]
});


$('.multiple-items').slick({
    infinite: true,
    arrows: false,
    slidesToShow: 2,
    autoplay: true,
    centerMode: true,
    centerPadding: '50px',
    slidesToScroll: 1,
    arrows: true,
    nextArrow: '.left',
    prevArrow: '.right',
    responsive: [
        {
            breakpoint: 1600,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 1200,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 992,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 575,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '10px',
                slidesToShow: 1,
            }
        }
    ]

});


$('.news-items').slick({
    infinite: true,
    arrows: false,
    slidesToShow: 1,
    dots: true,
    autoplay: true,
    centerMode: false,
    centerPadding: '0',
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1600,
            settings: {
                arrows: false,
                centerMode: false,
                centerPadding: '0',
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 1200,
            settings: {
                arrows: false,
                centerMode: false,
                centerPadding: '0',
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 992,
            settings: {
                arrows: false,
                centerMode: false,
                centerPadding: '0',
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 575,
            settings: {
                arrows: false,
                centerMode: false,
                centerPadding: '0',
                slidesToShow: 1,
            }
        }
    ]

});

$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('#dynamic').addClass('newClass');
    } else {
        $('#dynamic').removeClass('newClass');
    }

});

// The function toggles more (hidden) text when the user clicks on "Read more". The IF ELSE statement ensures that the text 'read more' and 'read less' changes interchangeably when clicked on.
$('.moreless-button').click(function () {
    $('.moretext').slideToggle();
    if ($('.moreless-button').text() == "Read more") {
        $(this).text("Read less")
    } else {
        $(this).text("Read more")
    }
});

$('.navbar-nav li.dropdown').hover(function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(400);
}, function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(400);
});


// Function to handle tab switching via click
function switchTabsOnClick() {
    $('#tabs-nav li').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').hide();

    var activeTabId = $(this).data('tab-id');
    $('#' + activeTabId).show();
    return false;
}

// Function to handle tab switching via mouseover
function switchTabsOnMouseOver() {
    $('#tabs-nav li').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').hide();

    var activeTabId = $(this).data('tab-id');
    $('#' + activeTabId).show();
    return false;
}

// Check screen width and apply tab functionality accordingly
function applyTabFunctionality() {
    if ($(window).width() <= 991.98) {
        $('#tabs-nav li').off('click', switchTabsOnMouseOver).on('click', switchTabsOnClick);
    } else {
        $('#tabs-nav li').off('click', switchTabsOnClick).on('mouseenter', switchTabsOnMouseOver);
        // Hide all tab contents except the first one
        $('.tab-content').hide();
        $('.tab-content:first').show();
    }
}

// Initial setup
applyTabFunctionality();

// Update tab functionality on window resize
$(window).resize(applyTabFunctionality);

// Chat toggle function
function setButtonURL() {
    $zopim.livechat.window.toggle();
}