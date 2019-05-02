var form = {};

function parseVideoURL(e) {
    var t, a;
    return e.match(/(http:|https:|)\/\/(player.|www.|m.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/), -1 < RegExp.$3.indexOf("youtu") ? (t = "youtube", a = "//youtube.com/embed/" + RegExp.$6 + "?wmode=Opaque&autoplay=1") : -1 < RegExp.$3.indexOf("vimeo") && (t = "vimeo", a = "//player.vimeo.com/video/" + RegExp.$6 + "?title=0&byline=0&portrait=0&autoplay=1"), {
        type: t,
        src: a,
        id: RegExp.$6
    }
}
$(function() {
    var t = function() {
        $(".material-switch").on("click", function(e) {
            e.preventDefault();
            var t = $(this).find('input[type="checkbox"]');
            if (!t.prop("disabled")) {
                var a = $(this).data("confirm-yes"),
                    o = $(this).data("confirm-no"),
                    i = t.prop("checked");
                if (i && o && !confirm(o)) return !1;
                if (!i && a && !confirm(a)) return !1;
                t.prop("checked", !i), t.change()
            }
        }), $(".material-switch").hammer().bind("swiperight", function() {
            $(this).find('input[type="checkbox"]').prop("checked", !0)
        }), $(".material-switch").hammer().bind("swipeleft", function() {
            $(this).find('input[type="checkbox"]').prop("checked", !1)
        }), $(".auto-save-property").each(function() {
            var o = $(this);
            o.is("input") || (o = o.find("input")).length && $(this).contents("label").css("cursor", "pointer");
            var t = $(this).data("type"),
                a = function() {
                    return "boolean" === t ? $(this).prop("checked") : $(this).val()
                },
                i = function(e) {
                    "boolean" === t ? $(this).prop("checked", e) : $(this).val(e)
                },
                n = $(this).data("url"),
                r = a.call(o[0]);
            n && o.is("input") && o.on("change", function(e) {
                var t = a.call(o[0]);
                $.ajax({
                    url: n,
                    type: "PUT",
                    data: {
                        value: t
                    }
                }).success(function(e) {
                    r = i.call(o[0], e.value), $(document).trigger("form-boolean-changed", [o[0]]), e.message && alert(e.message)
                }).fail(function(e) {
                    var t = JSON.parse(e.responseText),
                        a = t && t.error;
                    i.call(o[0], r), alert(a || (e.responseText ? e.responseText : e))
                })
            })
        }), $(".autoform .datepicker, .autoform .datepicker > input").datetimepicker({
            format: "DD/MM/YYYY",
            extraFormats: ["YYYY-MM-DD"],
            locale: goteo.locale
        }).on("dp.change", function(e) {}), $(".autoform .datepicker-full, .autoform .datepicker-full > input").datetimepicker({
            locale: goteo.locale
        }).on("dp.change", function(e) {}), $(".autoform .datepicker-year, .autoform .datepicker-year > input").datetimepicker({
            format: "YYYY",
            locale: goteo.locale,
            viewMode: "years"
        }), $(".autoform .tagsinput").each(function() {
            var e = $(this),
                t = e.data("url"),
                a = e.data("display-key") || "tag",
                o = e.data("display-value") || "tag",
                i = e.data("wilcard") || "%QUERY",
                n = {
                    tagClass: "label label-lilac"
                };
            if (t) {
                var r = new Bloodhound({
                    datumTokenizer: function(e) {
                        return Bloodhound.tokenizers.whitespace(e.tag)
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        wildcard: i,
                        url: t
                    }
                });
                r.initialize(), n.typeaheadjs = [{
                    highlight: !0
                }, {
                    name: "tags",
                    displayKey: a,
                    valueKey: o,
                    source: r.ttAdapter()
                }]
            }
            e.tagsinput(n)
        });
        var a = function(e) {
            var t = $(this).val();
            if (t) {
                var a = parseVideoURL(t),
                    o = $(this).closest(".media-container"),
                    i = (o.find(".video-holder"), o.find(".embed-responsive"));
                o.removeClass("loaded").removeClass("playing").addClass("loading");
                var n = function(e) {
                    o.find(".cover-image").attr("src", e), o.removeClass("loading").addClass("loaded");
                    var t = $("<iframe>", {
                        src: a.src,
                        frameborder: 0,
                        allowfullscreen: !0,
                        width: "100%",
                        height: "100%"
                    });
                    o.find(".video-button").one("click", function() {
                        i.html(t), o.addClass("playing")
                    })
                };
                "youtube" === a.type ? n("https://img.youtube.com/vi/" + a.id + "/maxresdefault.jpg") : "vimeo" === a.type && $.getJSON("https://vimeo.com/api/v2/video/" + a.id + ".json").success(function(e) {
                    n(e[0].thumbnail_large)
                }).fail(function(e) {})
            }
        };
        $(".autoform input.online-video").on("paste", function(e) {
            var t = this;
            setTimeout(function() {
                a.call(t, e)
            }, 100)
        }), $(".autoform input.online-video").each(a), $(".autoform .summernote > textarea").summernote({
            height: 300,
            toolbar: [
                ["tag", ["style"]],
                ["style", ["bold", "italic", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["insert", ["link", "picture", "video", "hr", "table"]],
                ["misc", ["fullscreen", "codeview", "help"]]
            ],
            callbacks: {
                onFocus: function() {
                    $(this).closest(".summernote").addClass("focused")
                },
                onBlur: function() {
                    $(this).closest(".summernote").removeClass("focused")
                }
            }
        });
      
        //If SimpleMDE is already configured.
        if(!$('.CodeMirror').length) {
          var n = form.markdowns = {};
          $(".autoform .markdown > textarea").each(function() {
              var e = new SimpleMDE({
                  element: this,
                  forceSync: !0,
                  autosave: !1,
                  promptURLs: !0,
                  spellChecker: !1,
                  toolbar: [{
                      name: "close",
                      action: function(e) {
                          e.codemirror.getOption("fullScreen") && SimpleMDE.toggleFullScreen(e)
                      },
                      className: "fa fa-close exit-fullscreen",
                      title: goteo.texts["form-editor-close"] ? goteo.texts["form-editor-close"] : "Close"
                  }, {
                      name: "bold",
                      action: SimpleMDE.toggleBold,
                      className: "fa fa-bold",
                      title: goteo.texts["form-editor-bold"] ? goteo.texts["form-editor-bold"] : "Bold"
                  }, {
                      name: "italic",
                      action: SimpleMDE.toggleItalic,
                      className: "fa fa-italic",
                      title: goteo.texts["form-editor-italic"] ? goteo.texts["form-editor-italic"] : "Italic"
                  }, {
                      name: "strikethrough",
                      action: SimpleMDE.toggleStrikethrough,
                      className: "fa fa-strikethrough",
                      title: goteo.texts["form-editor-strikethrough"] ? goteo.texts["form-editor-strikethrough"] : "Strikethrough"
                  }, {
                      name: "heading",
                      action: SimpleMDE.toggleHeadingSmaller,
                      className: "fa fa-header",
                      title: goteo.texts["form-editor-heading"] ? goteo.texts["form-editor-heading"] : "Heading"
                  }, {
                      name: "heading-smaller",
                      action: SimpleMDE.toggleHeadingSmaller,
                      className: "fa fa-header fa-header-x fa-header-smaller",
                      title: goteo.texts["form-editor-smaller_heading"] ? goteo.texts["form-editor-smaller_heading"] : "Smaller Heading"
                  }, {
                      name: "heading-bigger",
                      action: SimpleMDE.toggleHeadingBigger,
                      className: "fa fa-header fa-header-x fa-header-bigger",
                      title: goteo.texts["form-editor-bigger_heading"] ? goteo.texts["form-editor-bigger_heading"] : "Bigger Heading"
                  }, "|", {
                      name: "code",
                      action: SimpleMDE.toggleCodeBlock,
                      className: "fa fa-code",
                      title: goteo.texts["form-editor-code"] ? goteo.texts["form-editor-code"] : "Code"
                  }, {
                      name: "quote",
                      action: SimpleMDE.toggleBlockquote,
                      className: "fa fa-quote-left",
                      title: goteo.texts["form-editor-quote"] ? goteo.texts["form-editor-quote"] : "Quote"
                  }, {
                      name: "unordered-list",
                      action: SimpleMDE.toggleUnorderedList,
                      className: "fa fa-list-ul",
                      title: goteo.texts["form-editor-generic_list"] ? goteo.texts["form-editor-generic_list"] : "Generic List"
                  }, {
                      name: "ordered-list",
                      action: SimpleMDE.toggleOrderedList,
                      className: "fa fa-list-ol",
                      title: goteo.texts["form-editor-numbered_list"] ? goteo.texts["form-editor-numbered_list"] : "Numbered List"
                  }, "|", {
                      name: "link",
                      action: SimpleMDE.drawLink,
                      className: "fa fa-link",
                      title: goteo.texts["form-editor-create_link"] ? goteo.texts["form-editor-create_link"] : "Create Link"
                  }, {
                      name: "image",
                      action: SimpleMDE.drawImage,
                      className: "fa fa-picture-o",
                      title: goteo.texts["form-editor-insert_image"] ? goteo.texts["form-editor-insert_image"] : "Insert Image"
                  }, {
                      name: "table",
                      action: SimpleMDE.drawTable,
                      className: "fa fa-table",
                      title: goteo.texts["form-editor-insert_table"] ? goteo.texts["form-editor-insert_table"] : "Insert Table"
                  }, {
                      name: "horizontal-rule",
                      action: SimpleMDE.drawHorizontalRule,
                      className: "fa fa-minus",
                      title: goteo.texts["form-editor-insert_horizontal_line"] ? goteo.texts["form-editor-insert_horizontal_line"] : "Insert Horizontal Line"
                  }, "|", {
                      name: "preview",
                      action: SimpleMDE.togglePreview,
                      className: "fa fa-eye no-disable",
                      title: goteo.texts["form-editor-toggle_preview"] ? goteo.texts["form-editor-toggle_preview"] : "Toggle Preview"
                  }, {
                      name: "side-by-side",
                      action: SimpleMDE.toggleSideBySide,
                      className: "fa fa-columns no-disable no-mobile",
                      title: goteo.texts["form-editor-toggle_side_by_side"] ? goteo.texts["form-editor-toggle_side_by_side"] : "Toggle Side by Side"
                  }, {
                      name: "fullscreen",
                      action: SimpleMDE.toggleFullScreen,
                      className: "fa fa-arrows-alt no-disable no-mobile",
                      title: goteo.texts["form-editor-toggle_fullscreen"] ? goteo.texts["form-editor-toggle_fullscreen"] : "Toggle Fullscreen"
                  }, "|", {
                      name: "guide",
                      action: "https://simplemde.com/markdown-guide",
                      className: "fa fa-question-circle",
                      title: goteo.texts["form-editor-markdown_guide"] ? goteo.texts["form-editor-markdown_guide"] : "Markdown Guide"
                  }, "|", {
                      name: "undo",
                      action: SimpleMDE.undo,
                      className: "fa fa-undo no-disable",
                      title: goteo.texts["form-editor-undo"] ? goteo.texts["form-editor-undo"] : "Undo"
                  }, {
                      name: "redo",
                      action: SimpleMDE.redo,
                      className: "fa fa-repeat no-disable",
                      title: goteo.texts["form-editor-redo"] ? goteo.texts["form-editor-redo"] : "Redo"
                  }]
              });
              n[$(this).attr("id")] = e
          });
        }

        var i = form.dropzones = {};
        $(".autoform .dropfiles").each(function() {
            var m = $(this),
                f = m.find(".error-msg"),
                u = $(this).find(".image-list-sortable"),
                p = $(this).find(".dragndrop"),
                o = m.closest("form"),
                e = !!m.data("multiple"),
                h = parseInt(m.data("limit")),
                t = m.data("url") || null,
                g = m.data("accepted-files") ? m.data("accepted-files") : null,
                v = o.find("script.dropfile_item_template");
            e && 1 < h && Sortable.create(u[0], {
                onStart: function(e) {
                    p.hide()
                },
                onEnd: function(e) {
                    p.show(), u.removeClass("over")
                },
                onMove: function(e) {
                    u.removeClass("over"), $(e.to).addClass("over")
                }
            }), u.find("li").length >= h && p.hide();
            var x = function(e, t, a) {
                    var o = a || "/img/300x300c/" + t;
                    e.css({
                        backgroundImage: "url(" + o + ")",
                        backgroundSize: "cover"
                    })
                },
                b = new Dropzone(p.contents("div")[0], {
                    url: t || o.attr("action"),
                    uploadMultiple: e,
                    createImageThumbnails: !0,
                    maxFiles: h,
                    maxFilesize: MAX_FILE_SIZE,
                    autoProcessQueue: !!t,
                    dictDefaultMessage: m.data("text-upload"),
                    acceptedFiles: g
                }).on("error", function(e, t) {
                    f.html(t.error ? t.error : t), f.removeClass("hidden"), b.removeFile(e)
                }).on("thumbnail", function(e, t) {
                    var a = o.find('li[data-name="' + e.name + '"] .image');
                    x(a, e.name, t)
                }).on(t ? "success" : "addedfile", function(e, t) {
                    var a = u.find("li").length;
                    if (h <= a) return f.html(m.data("text-max-files-reached")), f.removeClass("hidden"), b.removeFile(e), !1;
                    if (!Dropzone.isValidFile(e, g)) return f.html(m.data("text-file-type-error")), b.removeFile(e), !1;
                    var o, i = e.name,
                        n = "",
                        r = "";
                    if (f.addClass("hidden"), t) {
                        if (!t.success)
                            for (o in f.html(t.msg), f.removeClass("hidden"), t.files) t.files[o].success || f.append("<br>" + t.files[o].msg);
                        for (o in t.files) t.files[o].originalName === i && (i = t.files[o].name, n = t.files[o].regularFile && t.files[o].type, r = t.files[o].downloadUrl)
                    }
                    var s = $(v.html().replace("{NAME}", i)),
                        l = s.find(".image"),
                        d = /(?:\.([^.]+))?$/.exec(i)[1];
                    if (l.addClass("file-type-" + d), t && (s.append('<input type="hidden" name="' + m.data("current") + '" value="' + i + '">'), m.data("markdown-link") && (s.find(".add-to-markdown").data("target", m.data("markdown-link")), s.find(".add-to-markdown").removeClass("hidden")), r && (s.find(".download-url").attr("href", r), s.find(".download-url").removeClass("hidden")), n ? l.addClass("file-type-" + n) : x(l, i)), u.append(s), h - 1 <= a && p.hide(), t) b.removeFile(e);
                    else {
                        var c = this.hiddenFileInput;
                        setTimeout(function() {
                            c.name = m.data("name"), c.files && c.files.length ? s.append(c) : (alert(goteo.texts["form-dragndrop-unsupported"]), s.remove(), p.show()), b.removeFile(e)
                        }, 0)
                    }
                });
            i[$(this).attr("id")] = b
        }), $(".autoform").on("click", ".image-list-sortable .delete-image", function(e) {
            e.preventDefault(), e.stopPropagation();
            var t = $(this).closest("li"),
                a = $(this).closest(".dropfiles"),
                o = $(this).closest(".image-zone"),
                i = $(this).closest(".image-list-sortable"),
                n = $(this).closest("form"),
                r = o.next();
            t.remove(), r.addClass("hidden");
            var s = parseInt(a.data("limit"));
            i.find("li").length < s && n.find(".dragndrop").show()
        }), $(".autoform").on("click", ".image-list-sortable .add-to-markdown", function(e) {
            e.preventDefault(), e.stopPropagation();
            var t = $(this).closest("li").data("name"),
                a = $(this).closest("form");
            a.find(".dragndrop").show();
            var o = a.attr("name") + "_" + $(this).data("target"),
                i = n[o];
            i && i.value(i.value().replace(/\s+$/g, "") + "\n\n![](" + IMG_URL + "/600x600/" + t + ")")
        }), $(".autoform").on("click", ".exact-location", function(e) {
            var n, r, s, l;
            e.preventDefault();
            var t = $(this).closest("form"),
                a = $("#modal-map-" + t.attr("name")),
                o = a.find(".map"),
                i = a.find(".input-block"),
                d = a.find(".geo-autocomplete"),
                c = a.find(".geo-autocomplete-radius"),
                m = $($(this).attr("href")),
                f = m.closest(".form-group").find("label:first").text();
            a.find(".modal-title").text(f), $(["address", "city", "region", "zipcode", "country_code", "country", "latitude", "longitude", "formatted_address", "radius"]).each(function(e, t) {
                var a = m.data("geocoder-populate-" + t),
                    o = $(a),
                    i = o.text();
                o.is(":input") && (i = o.val()), "radius" === t ? (l = parseInt(i, 10) || 0, c.data("geocoder-populate-" + t, a)) : d.data("geocoder-populate-" + t, a), "latitude" === t && (n = parseFloat(i) || 0), "longitude" === t && (r = parseFloat(i) || 0), "formatted_address" === t && (s = i)
            }), o.data("map-latitude", n), o.data("map-longitude", r), n && r || o.data("map-address", m.val()), l && (o.data("map-radius", l), c.val(l), i.addClass("show-radius")), d.val(n && r ? s : m.val()), a.modal("show"), locator.setGoogleMapPoint(o[0]), locator.setGoogleAutocomplete("#" + d.attr("id"))
        })
    };
    t(), $(window).on("pronto.render", function(e) {
        t()
    }), $(".autoform .modal-map").on("shown.bs.modal", function() {
        goteo.trace("shown locator map", locator), google.maps.event.trigger(locator.map, "resize"), locator.map.setCenter(locator.marker.getPosition())
    }), $("form.autoform").on("click", "button[data-confirm]", function(e) {
        if (!confirm($(this).data("confirm"))) return e.preventDefault(), e.stopPropagation(), !1
    });
    var e = !1;
    $("form[data-confirm]").on("change", ":input", function() {
        e = $(this).closest("form").data("confirm")
    }), $("form[data-confirm]").on("submit", function() {
        e = !1
    }), $(window).on("beforeunload", function() {
        if (e) return e
    })
}), $(function() {
    var n = function() {
        var e = $(".dashboard-content>.inner-container"),
            t = e.find(".costs-bar"),
            a = opt = 0;
        e.find(".amount input").each(function() {
            var e = parseInt($(this).closest(".panel-body").find(".amount input").val(), 10),
                t = parseInt($(this).closest(".panel-body").find(".required select").val(), 10);
            e && (t ? a += e : opt += e)
        }), t.find(".amount-min").html(a), t.find(".amount-opt").html(opt), t.find(".amount-total").html(a + opt);
        var o = Math.round(100 * a / (a + opt)),
            i = Math.round(100 * opt / (a + opt)),
            n = parseInt(t.find(".min").css("width", "auto").width()),
            r = parseInt(t.find(".opt").css("width", "auto").width()),
            s = parseInt(t.find(".total").css("width", "auto").width());
        console.log("calc", a + "€", opt + "€", o + "%", i + "%", n + "px", r + "px", s + "px"), t.find(".min").css("width", o + "%").css({
            minWidth: n + "px",
            maxWidth: "calc(" + o + "% - " + (s + r) + "px)"
        }), t.find(".opt").css("width", .8 * i + "%").css({
            minWidth: r + "px",
            maxWidth: "calc(" + i + "% - " + (s + n) + "px)"
        }), t.find(".bar-min").css("width", o + "%").html(o + "%"), t.find(".bar-opt").css("width", i + "%").html(i + "%")
    };
    n(), $(".autoform").on("change", ".cost-item .required select", function() {
        var e = parseInt($(this).val(), 10),
            t = $(this).closest(".cost-item");
        e ? t.addClass("lilac") : t.removeClass("lilac"), n()
    }), $(".autoform").on("change", ".cost-item .amount input", n), $(".autoform").on("click", ".add-cost", function(e) {
        e.preventDefault();
        var t = $(this).closest("form"),
            a = t.find(".cost-list"),
            o = t.serialize() + "&" + encodeURIComponent($(this).attr("name")) + "=";
        console.log("add cost", o), $but = $(this).hide(), a.find(">.text-danger").remove(), a.append('<div class="loading"></div>'), $.ajax({
            type: t.attr("method"),
            url: t.attr("action"),
            data: o
        }).done(function(e) {
            var t = $(e);
            a.append(t.hide()), t.slideDown()
        }).fail(function(e) {
            a.append('<p class="text-danger">' + e.responseText + "</p>")
        }).always(function() {
            $but.show(), a.find(">.loading").remove()
        })
    }), $(".autoform").on("click", ".remove-cost", function(e) {
        if (e.isPropagationStopped()) return !1;
        e.preventDefault();
        var t = $(this),
            a = t.closest("form"),
            o = (a.find(".cost-list"), a.serialize() + "&" + encodeURIComponent(t.attr("name")) + "="),
            i = t.closest(".panel");
        t.hide().after('<div class="loading"></div>'), i.find(":input").attr("disabled", !0), $.ajax({
            type: a.attr("method"),
            url: a.attr("action"),
            data: o
        }).done(function() {
            i.slideUp(function() {
                $(this).remove(), n()
            })
        }).fail(function(e) {
            console.log("An error occurred.", e), alert(e.responseText)
        }).always(function() {
            t.show().next(".loading").remove()
        })
    })
}), $(function() {
    $(".autoform").on("click", ".add-reward", function(e) {
        e.preventDefault();
        var t = $(this).closest("form"),
            a = t.find(".reward-list"),
            o = t.serialize() + "&" + encodeURIComponent($(this).attr("name")) + "=";
        $but = $(this).hide(), a.find(">.text-danger").remove(), a.append('<div class="loading"></div>'), $.ajax({
            type: t.attr("method"),
            url: t.attr("action"),
            data: o
        }).done(function(e) {
            var t = $(e);
            a.append(t.hide()), t.slideDown()
        }).fail(function(e) {
            a.append('<p class="text-danger">' + e.responseText + "</p>")
        }).always(function() {
            $but.show(), a.find(">.loading").remove()
        })
    }), $("form.autoform").on("click", ".remove-reward", function(e) {
        if (e.isPropagationStopped()) return !1;
        e.preventDefault();
        var t = $(this),
            a = t.closest("form"),
            o = (a.find(".reward-list"), a.serialize() + "&" + encodeURIComponent(t.attr("name")) + "="),
            i = t.closest(".panel");
        t.hide().after('<div class="loading"></div>'), i.find(":input").attr("disabled", !0), $.ajax({
            type: a.attr("method"),
            url: a.attr("action"),
            data: o
        }).done(function() {
            i.slideUp(function() {
                $(this).remove()
            })
        }).fail(function(e) {
            console.log("An error occurred.", e), alert(e.responseText)
        }).always(function() {
            t.show().next(".loading").remove()
        })
    }), $("form.autoform").on("click", ".reward-item .unlimited .material-switch", function() {
        var e = $(this).closest(".reward-item"),
            t = e.find('input[type="checkbox"]');
        if (!t.prop("disabled")) {
            var a = e.find(".units");
            t.prop("checked") ? a.addClass("out").removeClass("in") : (a.addClass("in").removeClass("out"), a.find('input[type="text"]').select())
        }
    }), $("form.autoform").on("change", ".reward-item .units input", function() {
        $(this).closest(".reward-item").find(".material-switch").find('input[type="checkbox"]').prop("checked", 0 == $(this).val())
    })
}), $(function() {
    $(".auto-hide .more").on("click", function(e) {
        e.preventDefault(), $(this).closest(".auto-hide").toggleClass("show")
    }), $(".auto-update-projects").on("change", ".interest", function(e) {
        var t = $(this).is(":checked") ? 1 : 0,
            a = $(this).attr("id"),
            o = $(this).closest(".auto-update-projects"),
            i = o.find(".more-projects-button"),
            n = o.data("url"),
            r = o.data("limit") || 6;
        $.post(n + "?" + $.param({
            limit: r
        }), {
            id: a,
            value: t
        }, function(e) {
            e.offset + e.limit >= e.total ? i.addClass("hidden") : i.removeClass("hidden"), o.contents(".elements-container").html(e.html)
        })
    }), $(".auto-update-projects").on("click", ".more-projects-button", function(e) {
        e.preventDefault();
        var t = $(this).closest(".auto-update-projects"),
            a = t.find(".more-projects-button"),
            o = t.find(".widget-element").length,
            i = t.data("url"),
            n = (t.data("total"), t.data("limit") || 6);
        $.get(i, {
            offset: o,
            limit: n
        }, function(e) {
            e.offset + e.limit >= e.total ? a.addClass("hidden") : a.removeClass("hidden"), t.contents(".elements-container").append(e.html)
        })
    }), $(".ajax-comments").on("click", ".send-comment", function(e) {
        e.preventDefault();
        var t = $(this).closest(".ajax-comments"),
            a = $(t.data("list")),
            o = t.data("url"),
            i = t.find(".error-message"),
            n = t.find('[name="message"]'),
            r = $(".ajax-comments .recipients"),
            s = [];
        r.find(".label").each(function() {
            s.push($(this).data("user"))
        });
        var l = {
            message: n.val(),
            recipients: s,
            thread: t.data("thread"),
            project: t.data("project"),
            admin: t.data("admin"),
            view: "dashboard"
        };
        i.addClass("hidden").html(""), $.post(o, l, function(e) {
            a.append(e.html), n.val(""), r.find(".text").html(r.data("public"))
        }).fail(function(t) {
            var a;
            try {
                a = JSON.parse(t.responseText).error
            } catch (e) {
                a = t.statusText
            }
            i.removeClass("hidden").html(a)
        })
    }), $(".comments-list").on("click", ".delete-comment", function(e) {
        e.preventDefault();
        var t = $(this).data("confirm"),
            a = $(this).data("url"),
            o = $(this).closest(".comment-item"),
            i = o.find(".error-message");
        confirm(t) && $.ajax({
            url: a,
            type: "DELETE",
            success: function(e) {
                o.remove()
            }
        }).fail(function(e) {
            var t = JSON.parse(e.responseText);
            i.removeClass("hidden").html(t.error)
        })
    });
    var i = function(e, t, a) {
        e.find(".text").html(e.data("private")), e.find('[data-user="' + t + '"]').length || e.append(' <span class="label label-lilac" data-user="' + t + '">' + a + ' <i class="fa fa-close"></i></span>')
    };
    $(".comments-list").on("click", ".send-private", function(e) {
        e.preventDefault();
        var t = $(this).data("user"),
            a = $(this).data("name"),
            o = $(this).closest(".comments").find(".recipients");
        i(o, t, a)
    }), $(".ajax-comments .recipients").on("click", ".label>i", function(e) {
        var t = $(this).closest(".recipients"),
            a = $('.ajax-comments input[name="private"]');
        $(this).parent().remove(), t.find(".label").length || (t.find(".text").html(t.data("public")), a.prop("checked", !1))
    }), $(".ajax-comments").on("click", 'input[name="private"]', function(e) {
        e.preventDefault();
        var t = $(this).closest(".ajax-comments").find(".recipients"),
            a = $(this).closest(".comments").find(".comments-list");
        $(this).prop("checked", !0), a.find(".send-private").each(function() {
            i(t, $(this).data("user"), $(this).data("name"))
        })
    }), $(".ajax-message").on("click", ".send-message", function(e) {
        e.preventDefault();
        var t = $(this).closest(".ajax-message"),
            a = t.data("url"),
            o = t.find(".error-message"),
            i = t.find('[name="subject"]'),
            n = t.find('[name="body"]'),
            r = t.find('[name="reward"]'),
            s = t.find('[name="filter"]'),
            l = t.find('[name="users"]'),
            d = {
                subject: i.val(),
                body: n.val(),
                thread: t.data("thread"),
                reward: r.val(),
                filter: s.val(),
                users: l.val().split(","),
                project: t.data("project")
            };
        o.addClass("hidden").html(""), $.post(a, d, function(e) {
            $(document).trigger("message-sent", [d, e])
        }).fail(function(t) {
            var a;
            try {
                a = JSON.parse(t.responseText).error
            } catch (e) {
                a = t.statusText
            }
            o.removeClass("hidden").html(a)
        })
    })
}), $(function() {
    var l = function(e, t, a) {
            if (!t || void 0 === t.items && !Object.keys(t).length || void 0 !== t.items && !t.items.length) e.html('<small class="text-danger">No data</small>');
            else if (e.hasClass("discrete-values")) {
                var o = d3.goteo.discretevaluesChart(a);
                d3.select(e[0]).datum(t).call(o)
            } else if (e.hasClass("percent-pie")) {
                var i = t.map(function(e) {
                        return {
                            label: e.label,
                            value: e.counter
                        }
                    }),
                    n = d3.goteo.pieChart();
                d3.select(e[0]).datum(i).call(n)
            } else if (e.hasClass("time-metrics")) {
                var r = t.items.map(function(e) {
                    return e.date = new Date(e.date), e
                });
                a.min_date = new Date(t.min_date), a.max_date = new Date(t.max_date);
                var s = d3.goteo.timemetricsChart(a);
                d3.select(e[0]).datum(r).call(s)
            } else e.html('<small class="text-danger">Chart not found</small>')
        },
        t = function() {
            var n = {},
                r = !0,
                s = function() {
                    r = !1;
                    var t = $(this),
                        a = t.data("source");
                    n[a] || (n[a] = {
                        settings: t.data(),
                        data: []
                    });
                    var o = parseInt(n[a].settings.interval, 10) || 0,
                        i = parseInt(n[a].settings["interval-delay"], 10) || 0;
                    $.getJSON(a).done(function(e) {
                        n[a].data = e, l(t, e, t.data()), o && (console.log("timeout at ", o, "delay at", i), setTimeout(function() {
                            $('[data-source="' + a + '"]').length && s.call(t)
                        }, 1e3 * ((r ? i : 0) + o)))
                    }).fail(function(e) {
                        console.log("Error fetching ", a, "ERROR:", e), t.html('<small class="text-danger">' + (e.responseJSON && e.responseJSON.error || e.responseText || e) + "</small>")
                    }).always(function() {
                        t.removeClass("loading")
                    })
                };
            $(".d3-chart").each(s), $(".d3-chart-updater").off("click"), $(".d3-chart-updater").on("click", function(e) {
                e.preventDefault();
                var t = $(this).data("target"),
                    a = $(t).data("source");
                n[a].settings = $.extend(n[a].settings, $(this).data()), l($(t), n[a].data, n[a].settings)
            }), $('input[type="checkbox"].d3-chart-updater').off("change"), $('input[type="checkbox"].d3-chart-updater').on("change", function(e) {
                var t = $(this).data(),
                    a = $(this).data("target"),
                    o = $(a).data("source");
                $(this).prop("checked") ? ($(this).data("settings-backup", n[o].settings), n[o].settings = $.extend(n[o].settings, t)) : $(this).data("settings-backup") && (n[o].settings = $(this).data("settings-backup")), s.call($(a))
            }), $(".d3-chart.auto-enlarge").off("click"), $(".d3-chart.auto-enlarge").on("click", function(e) {
                e.preventDefault(), $(this).closest(".chart-wrapper").toggleClass("d3-chart-wide")
            })
        };
    t(), $(window).on("pronto.render", function(e) {
        t()
    }), $(window).on("autocharts.init", function(e) {
        t()
    })
});

$(window).load(function(e) {
          $('#autoform_webs').selectize({
            delimiter: ';',
            plugins: ['restore_on_backspace', 'remove_button'],
            persist: false,
            createOnBlur: true,
            create: true
          })
});
