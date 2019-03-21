$(function() {
    var n = $("#projects-container"),
        r = n.contents(".slider-projects"),
        l = r.data("total"),
        c = r.data("limit-add") || r.data("limit"),
        d = {
            filter: $(".auto-update-projects .project-filters li.active").data("status"),
            latitude: 0,
            longitude: 0,
            pag: 0,
            limit: r.data("limit")
        };

    function a() {
        var t = r.find('.widget-slide[aria-hidden="false"]');
        t.css("opacity", 1), t.first().prev().css("opacity", 0)
    }

    function o() {
        r.slick({
            dots: !1,
            arrows: !0,
            slide: ".widget-slide",
            slidesToShow: 3,
            slidesToScroll: 0,
            centerMode: !0,
            centerPadding: "150px",
            infinite: !0,
            prevArrow: '<div class="custom-left-arrow"><span class="fa fa-angle-left"></span><span class="sr-only">Prev</span></div>',
            nextArrow: '<div class="custom-right-arrow"><span class="fa fa-angle-right"></span><span class="sr-only">Prev</span></div>',
            responsive: [{
                breakpoint: 769,
                settings: {
                    arrows: !1,
                    centerMode: !0,
                    slidesToShow: 2,
                    centerPadding: "100px"
                }
            }, {
                breakpoint: 500,
                settings: {
                    arrows: !1,
                    centerMode: !0,
                    slidesToShow: 1,
                    centerPadding: "75px"
                }
            }]
        }), r.on("beforeChange", function(t, i, e, a) {
            if (r.find(".widget-slide").css("opacity", 1), !n.hasClass("loading-container")) {
                var o = r.find(".widget-slide:not(.slick-cloned)").length;
                if (e + r.find('.widget-slide[aria-hidden="false"]').length + 1 === o && e < l && o < l) {
                    d.pag++;
                    var s = jQuery.extend({}, d);
                    s.limit = c, s.strict = !0, n.addClass("loading-container"), $.getJSON("/discover/ajax", s, function(t) {                      
                        l = t.total;
                        var e = "";
                        t.items.forEach(function(t, i) {
                            e += '<div class="item widget-slide">' + t + "</div>"
                        }), r.slick("slickAdd", e), n.removeClass("loading-container")
                    })
                }
            }
        }), r.slick("slickGoTo", 1), a(), r.on("afterChange", function(t, i, e) {
            a()
        })
    }

    function s(t, i, e) {
        n.addClass("loading-container"), d.filter = t, d.latitude = i, d.longitude = e, d.pag = 0, $.getJSON("/discover/ajax", d, function(t) {
            r.hasClass("slick-initialized") && r.slick("destroy"), l = t.total, r.contents(".widget-slide").remove(), t.items.forEach(function(t, i) {
                r.append('<div class="item widget-slide">' + t + "</div>")
            }), n.removeClass("loading-container"), o()
        })
    }
    $(".auto-update-projects").on("click", ".project-filters li", function(t) {
        t.preventDefault(), $(".auto-update-projects .project-filters li").removeClass("active"), $(this).addClass("active");
        var e = $(this).data("status");
        $(this).closest(".section");
        if ("near" === e) {
            var i = function() {
                locator.getUserLocation(function(t, i) {
                    locator.trace("fallback user location", t, i), t && s(e, t.latitude, t.longitude)
                })
            };
            navigator.geolocation ? navigator.geolocation.getCurrentPosition(function(t) {
                locator.trace("browser info:", t.coords), s(e, t.coords.latitude, t.coords.longitude)
            }, function(t) {
                locator.trace("browser locator error", t), i()
            }) : i()
        } else s(e)
    }), o()
});