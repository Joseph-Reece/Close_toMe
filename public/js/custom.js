/*global jQuery:false */
jQuery(document).ready(function($) {
    ("use strict");

    //add some elements with animate effect
/*
    $(".big-cta").hover(
        function() {
            $(".cta a").addClass("animated shake");
        },
        function() {
            $(".cta a").removeClass("animated shake");
        }
    ); */
    $(".box").hover(
        function() {
            $(this)
                .find(".icon")
                .addClass("animated fadeInDown");
            $(this)
                .find("p")
                .addClass("animated fadeInUp");
        },
        function() {
            $(this)
                .find(".icon")
                .removeClass("animated fadeInDown");
            $(this)
                .find("p")
                .removeClass("animated fadeInUp");
        }
    );

    $(".carousel-inner").hover(
        function() {
            $(this)
                .find(".head")
                .addClass("animated headShake");
            $(this)
                .find(".btn")
                .addClass("animated jello");
        },
        function() {
            $(this)
                .find(".head")
                .removeClass("animated headShake");
            $(this)
                .find(".btn")
                .removeClass("animated jello");
        }
    );

    $(".accordion").on("show", function(e) {
        $(e.target)
            .prev(".accordion-heading")
            .find(".accordion-toggle")
            .addClass("active");
        $(e.target)
            .prev(".accordion-heading")
            .find(".accordion-toggle i")
            .removeClass("icon-plus");
        $(e.target)
            .prev(".accordion-heading")
            .find(".accordion-toggle i")
            .addClass("icon-minus");
    });

    $(".accordion").on("hide", function(e) {
        $(this)
            .find(".accordion-toggle")
            .not($(e.target))
            .removeClass("active");
        $(this)
            .find(".accordion-toggle i")
            .not($(e.target))
            .removeClass("icon-minus");
        $(this)
            .find(".accordion-toggle i")
            .not($(e.target))
            .addClass("icon-plus");
    });

    // tooltip
    $(".social-network li a, .options_box .color a").tooltip();

    //scroll to top
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $(".scrollup").fadeIn();
        } else {
            $(".scrollup").fadeOut();
        }
    });
    $(".scrollup").click(function() {
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });

    $(".scroller > li").click(function(event) {
        event.preventDefault();
        var target = $(this)
            .find(">a")
            .prop("hash");
        $("html, body").animate(
            {
                scrollTop: $(target).offset().top
            },
            500
        );
    });
    //scrollspy
    $('[data-spy="scroll"]').each(function() {
        var $spy = $(this).scrollspy("refresh");
    });

    // Datatables
    $(document).ready(function() {
        $("#myTable").DataTable();
        $("#chat").DataTable();
        $("#complete_table").DataTable();
        $("#pending_table").DataTable();
        $("#pat_table").DataTable();
        $("#kin_table").DataTable();
        $("#doc_table").DataTable();
        $("#patdoc").DataTable();
        $("#missed_table").DataTable();
    });


});
