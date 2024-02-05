$(document).ready(function () {
    //  Media Query
    let x = window.matchMedia("(max-width: 991px)");
    myFunction(x); // Call listener function at run time
    x.addListener(myFunction); // Attach listener function on state changes
    function myFunction(x) {
        if (x.matches) {
            // If media query matches
            $("#navbarSupportedContent").removeClass(
                "collapse navbar-collapse"
            );
            $("#navbarSupportedContent").addClass(
                "offcanvas offcanvas-start overflow-scroll"
            );
            $("#navbarSupportedContent").css("visibility", "visible");
            $(".offcanvas-header").removeClass("d-none");
        } else {
            $(".offcanvas-header").addClass("d-none");
            $("#navbarSupportedContent").removeClass(
                "offcanvas offcanvas-start overflow-scroll"
            );
            $("#navbarSupportedContent").addClass("collapse navbar-collapse");
            $("#navbarSupportedContent").css("visibility", "visible");

            // Menu dropdown onhover
            $("ul.navbar-nav li.dropdown").hover(
                function () {
                    $(this).find(".dropdown-menu:first").addClass("show");
                },
                function () {
                    $(this).find(".dropdown-menu:first").removeClass("show");
                }
            );
        }
    }

    $(".carousel").carousel({
        interval: 1000 * 3,
    });

    $(".gallery").magnificPopup({
        type: "image",
        delegate: ".img-popup",
        gallery: {
            enabled: true,
        },
    });

    //back to top
    var backToTop = $("#backToTopBtn");

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            backToTop.addClass("show");
            $(".top-nav").addClass("hidden");
        } else {
            backToTop.removeClass("show");
            $(".top-nav").removeClass("hidden");
        }
    });

    backToTop.click(function () {
        $("html, body").animate({ scrollTop: 0 }, 0);
        return false;
    });
});

// All Animation
new WOW().init();

$(".panel-heading")
    .parent(".panel")
    .hover(
        function () {
            $(this).children(".collapse").collapse("show");
        },
        function () {
            $(this).children(".collapse").collapse("hide");
        }
    );
