goteo.trace = function() {
    try {
        goteo.debug && console.log([].slice.apply(arguments))
    } catch (t) {}
}, goteo.error = function() {
    try {
        goteo.debug && console.error([].slice.apply(arguments))
    } catch (t) {}
};
var transitionDeferred, prontoTarget = "#main-content",
    prontoScroll = "#main-content";

function getTransitionOutDeferred() {
    return transitionDeferred && (goteo.trace("rejecting current transition"), transitionDeferred.reject()), transitionDeferred = $.Deferred(), $(prontoTarget).addClass("pronto-loading"), $(prontoTarget).contents("*").length ? $(prontoTarget).contents("*").animate({
        opacity: 0
    }, 200, function() {
        transitionDeferred.resolve()
    }) : transitionDeferred.resolve(), transitionDeferred
}

function pageRequested(t) {
    goteo.trace("Request new page", t, "prontoTarget:", prontoTarget)
}

function pageLoadProgress(t, e) {
    goteo.trace("New page load progress", e, t, "prontoTarget:", prontoTarget)
}

function pageLoaded(t) {
    goteo.trace("Destroy old page", t, "prontoTarget:", prontoTarget)
}

function prontoLoad(t, e) {
    prontoScroll = prontoTarget = e = e || "#main-content", $.pronto("defaults", {
        target: {
            title: "title",
            content: prontoTarget
        }
    }), $.pronto("load", t)
}

function pageRendered(t) {
    void 0 !== t && (goteo.trace("Render new page", t, "prontoTarget:", prontoTarget), $(prontoTarget).contents("*").length ? $(prontoTarget).contents("*").animate({
        opacity: 1
    }, 200, function() {
        $(prontoTarget).removeClass("pronto-loading")
    }) : $(prontoTarget).removeClass("pronto-loading"), $("html, body").scrollTop() > $(prontoScroll).offset().top && $("html, body").animate({
        scrollTop: $(prontoScroll).offset().top
    }, 800))
}

function pageLoadError(t, e) {
    goteo.error("Error loading page", e), $(prontoTarget).html('<div class="alert alert-danger" style="margin: 1em;">' + goteo.texts["ajax-load-error"].replace("%ERROR%", e) + "</div>"), $(prontoTarget).removeClass("pronto-loading")
}
$(function() {
    $(window).on("pronto.request", pageRequested).on("pronto.progress", pageLoadProgress).on("pronto.load", pageLoaded).on("pronto.render", pageRendered).on("pronto.error", pageLoadError), $("#main").on("click", "a.pronto", function(t) {
        $(this).data("pronto-target") ? prontoTarget = $(this).data("pronto-target") : "#main-content" !== prontoTarget && (prontoTarget = "#main-content"), $(this).data("pronto-scroll-to") ? prontoScroll = $(this).data("pronto-scroll-to") : prontoScroll !== prontoTarget && (prontoScroll = prontoTarget), goteo.trace("pronto click", $(this).data("pronto-target"), prontoTarget, $(this).data("pronto-scroll-to"), prontoScroll), $.pronto("defaults", {
            target: {
                title: "title",
                content: prontoTarget
            }
        })
    }), $.pronto({
        selector: "a.pronto",
        transitionOut: getTransitionOutDeferred,
        jump: !1,
        target: {
            title: "title",
            content: prontoTarget
        }
    }), pageRendered(), $("table.footable").length && $("table.footable").footable()
});
var animationEnd = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";

function whichTransitionEvent() {
    var t, e = document.createElement("fakeelement"),
        o = {
            transition: "transitionend",
            OTransition: "oTransitionEnd",
            MozTransition: "transitionend",
            WebkitTransition: "webkitTransitionEnd"
        };
    for (t in o)
        if (void 0 !== e.style[t]) return o[t]
}
$.fn.extend({
        animateCss: function(t, e) {
            return this.off(), this.addClass("animated " + t).on(animationEnd, function() {
                $(this).removeClass("animated " + t), $.isFunction(e) && e.call(this), $(this).off()
            }), this
        }
    }),
    function(p) {
        var i = function(t, e) {
                var o = t < 0 ? "-" : "",
                    a = isNaN(a = Math.abs(e.rest)) ? 2 : e.rest,
                    n = void 0 === e.decimal ? "." : e.decimal,
                    r = void 0 === e.thousand ? "," : e.thousand,
                    i = String(parseInt(t = Math.abs(Number(t) || 0).toFixed(a))),
                    s = 3 < (s = i.length) ? s % 3 : 0;
                return o + (s ? i.substr(0, s) + r : "") + i.substr(s).replace(/(\d{3})(?=\d)/g, "$1" + r) + (a ? n + Math.abs(t - i).toFixed(a).slice(2) : "")
            },
            g = function(t, e, o, a) {
                a = a || 0;
                var n = o && o.prefix || "",
                    r = o && o.suffix || "";
                t.html(n + i(a, o) + r), a < e ? setTimeout(function() {
                    g(t, e, o, a + e / o.steps)
                }, o.velocity) : t.html(n + i(e, o) + r)
            };
        p.fn.extend({
            animateNumber: function(a) {
                return this.each(function() {
                    var r = p.extend({
                            decimal: ".",
                            thousand: ",",
                            rest: "auto",
                            steps: 50,
                            velocity: 100,
                            suffix: null,
                            prefix: null,
                            start: "onViewport"
                        }, a),
                        i = p(this),
                        e = i.html();
                    null === r.prefix && (r.prefix = e.match(/^[^0-9\.\,]*/), r.prefix = r.prefix ? r.prefix.join("") : "");
                    var s = e.match(/[0-9\.\,]+/);
                    if (s = s ? s.join("") : "", "auto" === r.rest) {
                        var o = ("" + s).split(r.decimal);
                        r.rest = 1 < o.length ? o[1].length : 0
                    }
                    null === r.suffix && (r.suffix = e.match(/[^0-9\.\,]*$/), r.suffix = r.suffix ? r.suffix.join("") : ""), s = function(e, o) {
                        d = void 0 === o.decimal ? "." : o.decimal, t = void 0 === o.thousand ? "," : o.thousand;
                        var a = new RegExp("\\" + t, "g"),
                            n = new RegExp("\\" + d, "g");
                        return +e.replace(a, "").replace(n, ".")
                    }(s, r);
                    var c = !1;
                    if ("onViewport" === r.start) {
                        var l = function() {
                            var t, e, o, a, n;
                            !c && (e = (t = i).offset().top, o = e + t.outerHeight(), a = p(window).scrollTop(), n = a + p(window).height(), a < o && e < n) && (c = !0, g(i, s, r), p(window).off("resize scroll", l))
                        };
                        p(window).on("resize scroll", l), l()
                    } else c = !0, g(i, s, r)
                }), this
            }
        })
    }(jQuery), $(function() {
        var d = function(t) {
                t && (t.stopPropagation(), t.preventDefault());
                var e = $(this),
                    o = e.data("target"),
                    a = $('.toggle-menu[data-target="' + o + '"]'),
                    n = $("#" + o),
                    r = e.find(".show-menu"),
                    i = e.find(".close-menu"),
                    s = "absolute" === n.css("position");
                !s && i.length && e.addClass("active");
                var c = "slideInRight",
                    l = "slideOutRight";
                s && (c = "foldInUp", l = "foldOutUp"), $('.top-menu.active:not([id="' + o + '"])').removeClass("active"), a.each(function() {
                    $(this)[0] !== e[0] && $(this).removeClass("active")
                }), $("#main-content").off(), n.hasClass("active") ? (s && i.animateCss("flipOutX", function() {
                    e.removeClass("active"), r.animateCss("flipInX")
                }), n.animateCss(l, function() {
                    n.removeClass("active"), n.find(".submenu.active").removeClass("active")
                })) : (s && r.animateCss("flipOutX", function() {
                    e.addClass("active"), i.animateCss("flipInX")
                }), n.addClass("active").animateCss(c, function() {
                    $("#main-content").on("click", function(t) {
                        d.call(e[0], t), $(this).off()
                    })
                }))
            },
            r = function(t) {
                t.stopPropagation(), t.preventDefault();
                var e = this,
                    o = $(this).next(".submenu"),
                    a = "slideInRight",
                    n = "slideOutRight";
                "absolute" === o.css("position") && (a = "foldInUp", n = "foldOutUp"), $(".top-menu.active").find(".submenu.active").not(o).removeClass("active"), o.hasClass("active") ? o.animateCss(n, function() {
                    o.removeClass("active")
                }) : (o.find("li a.back").on("click", function(t) {
                    r.call(e, t)
                }), o.addClass("active").animateCss(a))
            };
        $(".toggle-menu").on("click", d), $(".top-menu .toggle-submenu").on("click", r), $(".top-menu li > a:not(.toggle-submenu)").on("click", function() {
            d.call($(".navbar-always .toggle-menu.active")[0])
        }), $('a[href="#search"], a.global-search').on("click", function(t) {
            t.preventDefault(), $("#search").addClass("open"), $('#search > form > input[type="search"]').focus()
        }), $("#search, #search button.close").on("click keyup", function(t) {
            t.target !== this && "close" !== t.target.className && 27 !== t.keyCode || $(this).removeClass("open")
        }), $('a.scroller[href^="#"]').on("click", function(t) {
            t.preventDefault();
            var e = 0,
                o = this.hash;
            e = $(o).offset().top > $(document).height() - $(window).height() ? $(document).height() - $(window).height() : $(o).offset().top, $("html,body").animate({
                scrollTop: e
            }, 800, "swing", function() {
                window.location.hash = o
            })
        })
    });
var transitionEnd = whichTransitionEvent();
$(function() {
    $(window);
    var t = $("body"),
        n = $("#sidebar-menu"),
        e = $("#sidebar-menu .sidebar-wrap"),
        o = $("#sidebar-menu-toggle");
    $("#main"), $("#footer");
    setTimeout(function() {
        t.addClass("loaded")
    }, 500);
    var a = function() {
            return "absolute" === n.css("position") || "fixed" === n.css("position")
        },
        r = function() {
            t.hasClass("has-sidebar") && (t.hasClass("sidebar-opened") ? (n.animateCss("fadeOut"), o.css("opacity", 0), e.animateCss("slideOutLeft", function() {
                o.css({
                    opacity: 1
                }), t.removeClass("sidebar-opened")
            })) : (t.addClass("sidebar-opened"), n.animateCss("fadeIn"), o.css("opacity", 0), e.animateCss("slideInLeft", function() {
                o.css({
                    opacity: 1
                })
            })))
        };
    if ($("body.has-sidebar").on("click", ".toggle-sidebar", r), t.hasClass("has-sidebar")) {
        delete Hammer.defaults.cssProps.userSelect;
        var i = !1;
        t.on("mouseover", ".slider,.material-switch", function() {
            i = !0
        }), t.on("mouseout", ".slider,.material-switch", function() {
            i = !1
        }), t.on("touchstart", ".slider,.material-switch", function(t) {
            i = !0
        }), t.on("touchend", ".slider,.material-switch", function() {
            setTimeout(function() {
                i = !1
            })
        }), t.hammer().bind("swiperight", function() {
            i || a() && (t.hasClass("sidebar-opened") || r())
        }), t.hammer().bind("swipeleft", function() {
            i || a() && t.hasClass("sidebar-opened") && r()
        }), $("#sidebar-menu .toggle-submenu").on("click", function(t) {
            t.stopPropagation(), t.preventDefault();
            var e = $(this).closest("li"),
                o = $(this).next(".submenu"),
                a = n.find("li.active .submenu").not(o);
            a.slideUp(function() {
                a.closest("li.active").removeClass("active")
            }), e.hasClass("active") ? o.slideUp(function() {
                e.removeClass("active")
            }) : (e.addClass("active"), o.hide().slideDown())
        }), $("#sidebar-menu li > a[href^='#']:not(.toggle-submenu)").on("click", function(t) {
            r()
        }), o.affix && o.affix({
            offset: {
                top: parseInt(o.css("top"), 10)
            }
        })
    }
}), $(function() {
    $("body").on("click", ".flip-widget .flip", function(t) {
        t.stopPropagation(), t.preventDefault();
        var e = $(this);
        $widget = $(this).closest(".flip-widget"), $target = $(e.attr("href"));
        var o = "flipOutY";
        $target.hasClass("active") ? $target.animateCss(o, function() {
            $target.removeClass("active")
        }) : ($(".flip-widget .backside.active").animateCss(o, function(t) {
            $(this).removeClass("active")
        }), $target.addClass("active").animateCss("flipInY"))
    })
});
var locator = {
    trace: goteo.trace,
    map: null,
    autocomplete: null,
    getUserLocation: function(o) {
        "function" != typeof o && (o = function() {}), goteo.user_location ? (locator.trace("Location already defined", goteo.user_location), o(goteo.user_location)) : locator.setLocationFromFreegeoip("user", null, function(t, e) {
            locator.trace("Location from freegeoip", t), t ? (goteo.user_location = t, o(t)) : o(null, e)
        })
    },
    saveGeolocationData: function(t, e, o) {
        this.trace("Saving geolocation data, type:", t, " item:", e, " data:", o), $.post("/json/geolocate/" + t + (e ? "/" + e : ""), o, function(t) {
            locator.trace("Saved gelocation data result:", t)
        })
    },
    setLocationFromFreegeoip: function(e, o, a) {
        $.getJSON("//api.ipstack.com/186.116.207.169?access_key=0c9334c278a250179cab4748c1dc3f83&output=json&legacy=1?", function(t) {
            t.latitude && t.longitude ? (locator.trace("Freegeoip geolocated type:", e, " item:", o, " data:", t), locator.saveGeolocationData(e, o, {
                longitude: t.longitude,
                latitude: t.latitude,
                city: t.city,
                region: t.region_name,
                country: t.country_name,
                country_code: t.country_code,
                method: "ip"
            }), "function" == typeof a && a(t)) : (locator.trace("Freegeoip error"), "function" == typeof a && a(null, "Freegeoip error"))
        })
    },
    getLocationFromBrowser: function(n, t) {
        var r = !1,
            i = {};
        if ("undefined" == typeof google && !google.maps) return t || (t = 0), t++, this.trace("google.map client does not exists! [" + t + "]"), 10 < t && this.trace("Cancelled"), void setTimeout(function() {
            this.getLocationFromBrowser(n, t)
        }, 500);
        navigator.geolocation && navigator.geolocation.getCurrentPosition(function(t) {
            locator.trace("browser info:", t.coords.latitude, t.coords.longitude), i = {
                method: "browser",
                latitude: t.coords.latitude,
                longitude: t.coords.longitude
            }, (new google.maps.Geocoder).geocode({
                latLng: new google.maps.LatLng(t.coords.latitude, t.coords.longitude)
            }, function(t, e) {
                if (e === google.maps.GeocoderStatus.OK)
                    if (t[0]) {
                        for (var o in r = !0, t[0].address_components) {
                            var a = t[0].address_components[o];
                            "country" === a.types[0] && "political" === a.types[1] && (i.country = a.long_name, i.country_code = a.short_name), "locality" === a.types[0] && "political" === a.types[1] && (i.city = a.long_name), "administrative_area_level_1" !== a.types[0] && "administrative_area_level_2" !== a.types[0] || "political" !== a.types[1] || (i.region = a.long_name)
                        }
                        locator.trace("Geocoder data:", i)
                    } else locator.trace("Geocoder failed due to: " + e);
                    "function" == typeof n && n(r, i)
            })
        }, function(t) {
            switch (i = {
                locable: 1,
                info: ""
            }, t.code) {
                case t.PERMISSION_DENIED:
                    i.locable = 0, i.info = "User denied the request for Geolocation.";
                    break;
                case t.POSITION_UNAVAILABLE:
                    i.info = "Location information is unavailable.";
                    break;
                case t.TIMEOUT:
                    i.info = "The request to get user location timed out.";
                    break;
                case t.UNKNOWN_ERROR:
                    i.info = "An unknown error occurred."
            }
            locator.trace("Geocoder error:", t, " data:", i), "function" == typeof n && n(r, i)
        })
    },
    setLocationFromBrowser: function(o, a, n) {
        this.getLocationFromBrowser(function(t, e) {
            locator.trace("Browser geolocation result:", t, e), t ? locator.saveGeolocationData(o, a, e) : "function" == typeof n && n(o, a)
        })
    },
    geoCode: function(o, a, n) {
        (new google.maps.Geocoder).geocode(o, function(t, e) {
            e === google.maps.GeocoderStatus.OK ? (locator.trace("Got coordinates for", o, t[0].geometry.location), locator.map.setCenter(t[0].geometry.location), locator.marker.setPosition(t[0].geometry.location), locator.map.setZoom(12), a && a(t[0])) : (locator.trace("No address found for", o), n && n())
        })
    },
    setGoogleMapPoint: function(o, t) {
        if ("undefined" == typeof google || !google.maps) return t || (t = 0), t++, this.trace("google.maps client does not exists! [" + t + "]"), 10 < t && this.trace("Cancelled"), void setTimeout(function() {
            this.setGoogleMapPoint(o, t)
        }, 500);
        var e = $(o).attr("id");
        e || (e = "map");
        var a = $(o).data("autocomplete-target"),
            n = $($(o).data("autocomplete-error")).hide(),
            r = $($(o).data("autocomplete-success")).hide(),
            i = {
                center: new google.maps.LatLng(39.5858, 2.6411),
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
        if (this.map = new google.maps.Map(o, i), this.marker = new google.maps.Marker({
                map: this.map,
                draggable: !0,
                animation: google.maps.Animation.DROP
            }), google.maps.event.addListener(this.marker, "dragstart", function() {
                locator.trace("drag start"), n.hide(), r.hide()
            }), google.maps.event.addListener(this.marker, "dragend", function() {
                locator.trace("dragged marker", locator.marker.getPosition()), locator.geoCode({
                    latLng: locator.marker.getPosition()
                }, function(t) {
                    locator.trace("triggering changePlace", a), a && ($(a).val(t.formatted_address), locator.changePlace(a, t), r.show())
                }, function() {
                    n.show()
                })
            }), this.markers = [], $(o).is("[data-map-coords]")) {
            var s = $(o).data("map-coords");
            if ($.isArray(s)) {
                var c = new google.maps.LatLngBounds,
                    l = new google.maps.Geocoder;
                for (var d in s)
                    if (s[d].lat && s[d].lng) {
                        var p = new google.maps.Marker,
                            g = new google.maps.LatLng(s[d].lat, s[d].lng);
                        p.setMap(this.map), p.setPosition(g), c.extend(g), s[d].title && p.setTitle(s[d].title), this.markers[this.markers.length] = p
                    } else s[d].address && l.geocode({
                        address: s[d].address
                    }, function(t, e) {
                        if (e === google.maps.GeocoderStatus.OK) {
                            var o = new google.maps.Marker,
                                a = t[0].geometry.location;
                            o.setMap(locator.map), o.setPosition(a), c.extend(a), s[d].title && o.setTitle(s[d].title), locator.markers[locator.markers.length] = o
                        }
                    });
                this.map.fitBounds(c)
            }
        }
        if ($(o).is("[data-map-content]")) {
            var u = $(o).data("map-content");
            this.marker = new google.maps.InfoWindow, this.marker.setContent(u), this.marker.setPosition(i.center), this.marker.open(this.map), this.circle || (this.circle = new google.maps.Circle({
                strokeColor: "#FF0000",
                strokeOpacity: .8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: .35,
                map: this.map,
                center: i.center,
                radius: 0
            })), google.maps.event.addListener(this.map, "zoom_changed", function() {
                locator.marker.setContent(u), locator.marker.open(locator.map)
            })
        }
        var m = parseFloat($(o).data("map-latitude")) || 0,
            f = parseFloat($(o).data("map-longitude")) || 0,
            h = parseInt($(o).data("map-radius"), 10) || 0,
            v = $(o).data("map-address");
        if (m && f) {
            if (this.trace("Found printable geomap, map_id: ", e, " lat,lng: ", m, f, " radius;", h, " content", $(o).data("map-content")), m && f) {
                var y = new google.maps.LatLng(m, f);
                this.marker.setPosition(y), this.map.setCenter(y), this.map.setZoom(12)
            }
        } else v && locator.geoCode({
            address: v
        }, function(t) {
            m = t.geometry.location.lat(), f = t.geometry.location.lng();
            var e = locator.getGoogleAddressFromAutocomplete(t);
            $(o).is("[data-geocoder-type]") && locator.saveGeolocationData($(o).data("geocoder-type"), $(o).is("[data-geocoder-item]") ? $(o).data("geocoder-item") : "", e), locator.trace("triggering changePlace", a), a && locator.changePlace(a, t)
        });
        h && m && f && (this.circle = new google.maps.Circle({
            strokeColor: "#FF0000",
            strokeOpacity: .8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: .35,
            map: this.map,
            center: new google.maps.LatLng(m, f),
            radius: 1e3 * h
        }))
    },
    getGoogleAddressFromAutocomplete: function(t) {
        if (t) {
            if (this.trace("Geocoder by place, place object:", t), this.trace("place:", t), t && t.geometry && t.address_components) {
                var e = {
                    latitude: t.geometry.location.lat(),
                    longitude: t.geometry.location.lng(),
                    method: "manual",
                    formatted_address: t.formatted_address
                };
                for (var o in t.address_components) {
                    var a = t.address_components[o];
                    "country" === a.types[0] && "political" === a.types[1] && (e.country = a.long_name, e.country_code = a.short_name), "route" === a.types[0] && (e.route = a.long_name), "street_number" === a.types[0] && (e.number = a.long_name), "locality" === a.types[0] && "political" === a.types[1] && (e.city = a.long_name), "postal_code" === a.types[0] && (e.zipcode = a.long_name), "administrative_area_level_1" !== a.types[0] || "political" !== a.types[1] || e.region || (e.region = a.long_name), "administrative_area_level_2" === a.types[0] && "political" === a.types[1] && (e.region = a.long_name)
                }
                return e.route && (e.address = e.route), e.number && e.route && (e.address = e.route + ", " + e.number), this.trace("location data:", e), e
            }
            return []
        }
        this.trace("Geocoder error in getGoogleAddressFromplace, place not present")
    },
    changePlace: function(t, e) {
        var o = locator.getGoogleAddressFromAutocomplete(e);
        if (o) {
            locator.trace("Populating new place", e, o), $(t).is("[data-geocoder-type]") && locator.saveGeolocationData($(t).data("geocoder-type"), $(t).is("[data-geocoder-item]") ? $(t).data("geocoder-item") : "", o);
            var a = ["address", "city", "region", "zipcode", "country_code", "country", "latitude", "longitude", "formatted_address", "radius"];
            if ($(t).data("geocoder-skip-population")) {
                var n = $($(t).data("geocoder-populate-latitude")),
                    r = $($(t).data("geocoder-populate-longitude")),
                    i = n.is(":input") ? n.val() : n.text(),
                    s = r.is(":input") ? r.val() : r.text();
                if (i && s) return void locator.trace("Skipping population. Already populated to", i, s)
            }
            for (var c in a) {
                var l = a[c],
                    d = $(t).data("geocoder-populate-" + l);
                if (locator.trace("populate element", t, d, $(d).val()), d) {
                    var p = $(d).text();
                    $(d).is(":input") && (p = $(d).val()), locator.trace(d + ": " + l + "[" + o[l] + "] / " + p), o[l] && ($(d).is(":input") ? $(d).val(o[l]) : $(d).text(o[l]))
                }
            }
            if (locator.map && locator.marker && (locator.map.setCenter(e.geometry.location), locator.marker.setPosition(e.geometry.location), locator.circle && locator.circle.setCenter(e.geometry.location), o.formatted_address)) try {
                locator.marker.setContent(o.formatted_address)
            } catch (t) {}
        } else locator.trace("No data to populate for place", e)
    },
    setGoogleAutocomplete: function(t, e) {
        if ("undefined" == typeof google || !google.maps || !google.maps.places) return e || (e = 0), e++, this.trace("google.maps.places client does not exists! [" + e + "]"), 10 < e && this.trace("Cancelled"), void setTimeout(function() {
            this.setGoogleAutocomplete(t, e)
        }, 500);
        var o = {};
        $(t).is("[data-geocoder-filter]") && (o.types = [$(t).data("geocoder-filter")]), this.autocomplete || (this.autocomplete = []), this.autocomplete[t] || (this.trace("Setting autocomplete for id: ", t, " name: ", $(t).attr("name"), " element: ", $(t)[0]), this.autocomplete[t] = new google.maps.places.Autocomplete($(t)[0], o), google.maps.event.addListener(this.autocomplete[t], "place_changed", function() {
            locator.changePlace(t, locator.autocomplete[t].getPlace())
        }))
    }
};
$(function() {
    locator.getUserLocation(), $(".geo-map").each(function() {
        locator.setGoogleMapPoint(this)
    }), $("input.geo-autocomplete").each(function() {
        $(this).is("[id]") ? locator.setGoogleAutocomplete("#" + $(this).attr("id")) : locator.trace("Missing ID html element for input:", this), $(this).closest("li.element").bind("superform.dom.done", function(t, e, o) {
            locator.trace("dom update", o), $(o).find("input.geo-autocomplete").each(function() {
                locator.setGoogleAutocomplete("#" + $(this).attr("id"))
            })
        })
    }), $("input.geo-autocomplete-radius").change(function() {
        if (locator.map && locator.circle) {
            locator.circle.setRadius(1e3 * $(this).val());
            var t = $(this).data("geocoder-populate-radius");
            locator.trace("set radius", t, $(this).val()), t && $(t).val($(this).val())
        }
    })
});