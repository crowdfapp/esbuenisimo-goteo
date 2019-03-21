$(function(){
    // Intial page for auto-scroll
    $container = $('.auto-update-projects');
    $in_review = $('#include-in-review').length && $('#include-in-review');
    var total = $container.data('total');
    var query = {
        filter: $container.data('filter'),
        strict: true,
        pag: 1,
        limit: $container.data('limit'),
        location: goteo.urlParams['location'],
        latitude: goteo.urlParams['latitude'],
        longitude: goteo.urlParams['longitude'],
        category: goteo.urlParams['category'],
        q: goteo.urlParams['q']
    };
  
  var n = $("#projects-container"),
          r = n.contents(".projects-list"),
          l = $('.auto-update-projects').contents(".projects-list").data("total"),
          c = r.data("limit-add") || r.data("limit"),
          d = {
              filter: $(".auto-update-projects .project-filters li.active").data("status"),
              latitude: 0,
              longitude: 0,
              pag: 0,
              limit: r.data("limit")
          };  

//     // Auto paginate on reaching bottom page
    $(window).scroll(function() {
            
        if($container.find('.loading-container').length) return;
            
        if(query.limit * query.pag >= total) {
            console.log(query);
            console.log(total);
            return;
        } 

        var $last = $container.find('.widget-element:last');

        //console.log('windowScrollTop',$(window).scrollTop(), 'last offset', $last.offset(), 'last height', $last.height());
        if($(window).scrollTop() >= $last.offset().top - $last.height()) {
            // ajax call get data from server and append to the div
            $last.after('<div class="loading-container">' + goteo.texts['regular-loading'] + '</div>');

            // console.log('end reached, loading more. total', total, 'query', query);
            $.getJSON('/discover/ajax', query, function(result) {
                                                       
                total = result.total;
                query.limit = result.limit;
                result.items.forEach(function(html, index) {
                  var $new = $('<div class="col-sm-6 col-md-4 col-xs-12 spacer widget-element">' + html + '</div>');
                  $new.hide().insertAfter($last).fadeIn();
                });
                $container.find('.loading-container').remove();
                query.pag++;
            });
        }
    });
  
  function o(s, a, e) {
    n.addClass("loading-container"), d.filter = s, d.latitude = a, d.longitude = e, d.pag = 0, $.getJSON("/discover/ajax", d, function(s) {
      
        total = s.total, $container.attr('data-total', s.total),
        query.filter = s.filter, $container.attr('data-filter', s.filter),
        query.limit = s.limit,
        query.pag = s.pag + 1,
        r.contents(".container").contents(".row").html(''),
          
        s.items.forEach(function(s,a) {
          r.contents(".container").contents(".row").append('<div class="col-sm-6 col-md-4 col-xs-12 spacer widget-element">' + s + "</div>")
        }), n.removeClass("loading-container");
      })
    } 
  
$("#projects-container-title").on("click", ".project-filters li", function(s) {
        s.preventDefault(), $("#projects-container-title .project-filters li").removeClass("active"), $(this).addClass("active");
        var e = $(this).data("status");
        $(this).closest(".section");
        if ("near" === e) {
            var a = function() {
                locator.getUserLocation(function(s, a) {
                    locator.trace("fallback user location", s, a), s && o(e, s.latitude, s.longitude)
                })
            };
            navigator.geolocation ? navigator.geolocation.getCurrentPosition(function(s) {
                locator.trace("browser info:", s.coords), o(e, s.coords.latitude, s.coords.longitude)
            }, function(s) {
                locator.trace("browser locator error", s), a()
            }) : a()
        } else o(e)
    }) 
});

// $(function() {
//     $(".animate-number").animateNumber({
//         decimal: goteo && goteo.decimal || ".",
//         thousand: goteo && goteo.thousands || ",",
//         steps: 30
//     }), $('a[data-toggle="tab"]').on("shown.bs.tab", function(s) {
//         $(window).trigger("resize")
//     }), $(".slider-main").slick({
//         dots: !0,
//         infinite: !0,
//         autoplay: !1,
//         autoplaySpeed: 7e3,
//         speed: 1500,
//         fade: !0,
//         arrows: !0,
//         cssEase: "linear",
//         prevArrow: '<div class="custom-left-arrow"><span class="fa fa-angle-left"></span><span class="sr-only">Prev</span></div>',
//         nextArrow: '<div class="custom-right-arrow"><span class="fa fa-angle-right"></span><span class="sr-only">Prev</span></div>'
//     }), $(".slider-stories").slick({
//         dots: !0,
//         infinite: !0,
//         speed: 1e3,
//         fade: !0,
//         arrows: !0,
//         cssEase: "linear",
//         prevArrow: '<div class="custom-left-arrow"><span class="fa fa-angle-left"></span><span class="sr-only">Prev</span></div>',
//         nextArrow: '<div class="custom-right-arrow"><span class="fa fa-angle-right"></span><span class="sr-only">Prev</span></div>'
//     }), $(".slider-team").slick({
//         dots: !1,
//         autoplay: !0,
//         infinite: !0,
//         speed: 2e3,
//         autoplaySpeed: 3e3,
//         fade: !0,
//         arrows: !1,
//         cssEase: "linear"
//     }), $(".slider-channels").slick({
//         infinite: !0,
//         slidesToShow: 3,
//         slidesToScroll: 1,
//         arrows: !0,
//         dots: !0,
//         prevArrow: '<div class="custom-left-arrow"><span class="fa fa-angle-left"></span><span class="sr-only">Prev</span></div>',
//         nextArrow: '<div class="custom-right-arrow"><span class="fa fa-angle-right"></span><span class="sr-only">Prev</span></div>',
//         responsive: [{
//             breakpoint: 769,
//             settings: {
//                 slidesToShow: 2,
//                 arrows: !1
//             }
//         }, {
//             breakpoint: 500,
//             settings: {
//                 slidesToShow: 1
//             }
//         }]
//     })
// }), $(function() {
//     var n = $("#projects-container"),
//         r = n.contents(".slider-projects"),
//         l = r.data("total"),
//         c = r.data("limit-add") || r.data("limit"),
//         d = {
//             filter: $(".auto-update-projects .project-filters li.active").data("status"),
//             latitude: 0,
//             longitude: 0,
//             pag: 0,
//             limit: r.data("limit")
//         };

//     function t() {
//         var s = r.find('.widget-slide[aria-hidden="false"]');
//         s.css("opacity", 1), s.first().prev().css("opacity", 0)
//     }

//     function i() {
//         r.slick({
//             dots: !1,
//             arrows: !0,
//             slide: ".widget-slide",
//             slidesToShow: 3,
//             slidesToScroll: 0,
//             centerMode: !0,
//             centerPadding: "150px",
//             infinite: !0,
//             prevArrow: '<div class="custom-left-arrow"><span class="fa fa-angle-left"></span><span class="sr-only">Prev</span></div>',
//             nextArrow: '<div class="custom-right-arrow"><span class="fa fa-angle-right"></span><span class="sr-only">Prev</span></div>',
//             responsive: [{
//                 breakpoint: 769,
//                 settings: {
//                     arrows: !1,
//                     centerMode: !0,
//                     slidesToShow: 2,
//                     centerPadding: "100px"
//                 }
//             }, {
//                 breakpoint: 500,
//                 settings: {
//                     arrows: !1,
//                     centerMode: !0,
//                     slidesToShow: 1,
//                     centerPadding: "75px"
//                 }
//             }]
//         }), r.on("beforeChange", function(s, a, e, t) {
//             if (r.find(".widget-slide").css("opacity", 1), !n.hasClass("loading-container")) {
//                 var i = r.find(".widget-slide:not(.slick-cloned)").length;
//                 if (e + r.find('.widget-slide[aria-hidden="false"]').length + 1 === i && e < l && i < l) {
//                     d.pag++;
//                     var o = jQuery.extend({}, d);
//                     o.limit = c, o.strict = !0, n.addClass("loading-container"), $.getJSON("/discover/ajax", o, function(s) {
                      
//                         l = s.total;
//                         var e = "";
//                         s.items.forEach(function(s, a) {
//                             e += '<div class="item widget-slide">' + s + "</div>"
//                         }), r.slick("slickAdd", e), n.removeClass("loading-container")
//                     })
//                 }
//             }
//         }), r.slick("slickGoTo", 1), t(), r.on("afterChange", function(s, a, e) {
//             t()
//         })
//     }

//     function o(s, a, e) {
//         n.addClass("loading-container"), d.filter = s, d.latitude = a, d.longitude = e, d.pag = 0, $.getJSON("/discover/ajax", d, function(s) {
//             r.hasClass("slick-initialized") && r.slick("destroy"), l = s.total, r.contents(".widget-slide").remove(), s.items.forEach(function(s, a) {
//                 r.append('<div class="item widget-slide">' + s + "</div>")
//             }), n.removeClass("loading-container"), i()
//         })
//     }
//     $(".auto-update-projects").on("click", ".project-filters li", function(s) {
//         s.preventDefault(), $(".auto-update-projects .project-filters li").removeClass("active"), $(this).addClass("active");
//         var e = $(this).data("status");
//         $(this).closest(".section");
//         if ("near" === e) {
//             var a = function() {
//                 locator.getUserLocation(function(s, a) {
//                     locator.trace("fallback user location", s, a), s && o(e, s.latitude, s.longitude)
//                 })
//             };
//             navigator.geolocation ? navigator.geolocation.getCurrentPosition(function(s) {
//                 locator.trace("browser info:", s.coords), o(e, s.coords.latitude, s.coords.longitude)
//             }, function(s) {
//                 locator.trace("browser locator error", s), a()
//             }) : a()
//         } else o(e)
//     }), i()
// });