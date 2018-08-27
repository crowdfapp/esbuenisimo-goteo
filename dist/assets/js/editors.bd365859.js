goteo.typeahead_engines = goteo.typeahead_engines || {}, goteo.typeahead_engines.project = function(e) {
    var t = e && e.prefetch_statuses || "3",
        a = e && e.remote_statuses || "3,4,5,6",
        o = e && e.defaults || !1,
        i = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("id", "name", "subtitle"),
            identify: function(e) {
                return e.id
            },
            dupDetector: function(e, t) {
                return e.id === t.id
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: "/api/projects?status=" + t,
                filter: function(e) {
                    return e.list
                }
            },
            remote: {
                url: "/api/projects?status=" + a + "&q=%QUERY",
                wildcard: "%QUERY",
                filter: function(e) {
                    return e.list
                }
            }
        });
    i.initialize();
    return {
        name: "project",
        displayKey: "name",
        source: function(e, t, a) {
            "" === e && o ? (t(i.index.all()), a([])) : i.search(e, t, a)
        },
        templates: {
            header: "<h3>" + (goteo.texts && goteo.texts["admin-projects"] || "Projects") + "</h3>",
            suggestion: function(e) {
                var t = "default";
                2 === e.status && (t = "info"), 3 === e.status && (t = "orange"), 4 === e.status && (t = "success"), 5 === e.status && (t = "success"), 6 === e.status && (t = "danger");
                var a = "<div>";
                return e.image && (a += '<img src="' + e.image + '" class="img-circle"> '), a += '<span class="label label-' + t + '">' + e.status_desc + "</span> ", a += e.name + "</div>"
            }
        }
    }
}, goteo.typeahead_engines = goteo.typeahead_engines || {}, goteo.typeahead_engines.call = function(e) {
    var t = e && e.prefetch_statuses || "3,4,5",
        a = e && e.remote_statuses || "3,4,5,6",
        o = e && e.defaults || !1,
        i = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("id", "name", "subtitle"),
            identify: function(e) {
                return e.id
            },
            dupDetector: function(e, t) {
                return e.id === t.id
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: "/api/calls?status=" + t,
                filter: function(e) {
                    return e.list
                }
            },
            remote: {
                url: "/api/calls?status=" + a + "&q=%QUERY",
                wildcard: "%QUERY",
                filter: function(e) {
                    return e.list
                }
            }
        });
    i.initialize();
    return {
        name: "call",
        displayKey: "name",
        source: function(e, t, a) {
            "" === e && o ? (t(i.index.all()), a([])) : i.search(e, t, a)
        },
        templates: {
            header: "<h3>" + (goteo.texts && goteo.texts["admin-calls"] || "Calls") + "</h3>",
            suggestion: function(e) {
                var t = "default";
                2 === e.status && (t = "warning"), 3 === e.status && (t = "info"), 4 === e.status && (t = "orange"), 5 === e.status && (t = "success"), 6 === e.status && (t = "danger");
                var a = "<div>";
                return e.image && (a += '<img src="' + e.image + '" class="img-circle"> '), a += '<span class="label label-' + t + '">' + e.status_desc + "</span> ", a += e.name + "</div>"
            }
        }
    }
}, goteo.typeahead_engines = goteo.typeahead_engines || {}, goteo.typeahead_engines.user = function(e) {
    var o = e && e.defaults || !1,
        i = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("id", "name", "email"),
            identify: function(e) {
                return e.id
            },
            dupDetector: function(e, t) {
                return e.id === t.id
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: "/api/users?q=%QUERY",
                wildcard: "%QUERY",
                filter: function(e) {
                    return e.list
                }
            }
        });
    i.initialize();
    return {
        name: "user",
        displayKey: "name",
        source: function(e, t, a) {
            "" === e && o ? (t(i.index.all()), a([])) : i.search(e, t, a)
        },
        templates: {
            header: "<h3>" + (goteo.texts && goteo.texts["admin-users"] || "users") + "</h3>",
            suggestion: function(e) {
                var t = "<div>";
                return e.image && (t += '<img src="' + e.image + '" class="img-circle"> '), t += e.name + (e.email && " (" + e.email + ")") + "</div>"
            }
        }
    }
}, goteo.typeahead_engines = goteo.typeahead_engines || {}, goteo.typeahead_engines.consultant = function(e) {
    var o = e && e.defaults || !1,
        i = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("id", "name", "email"),
            identify: function(e) {
                return e.id
            },
            dupDetector: function(e, t) {
                return e.id === t.id
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: "/api/users?role=consultant",
                filter: function(e) {
                    return e.list
                }
            },
            remote: {
                url: "/api/users?role=consultant&q=%QUERY",
                wildcard: "%QUERY",
                filter: function(e) {
                    return e.list
                }
            }
        });
    i.initialize();
    return {
        name: "consultant",
        displayKey: "name",
        source: function(e, t, a) {
            "" === e && o ? (t(i.index.all()), a([])) : i.search(e, t, a)
        },
        templates: {
            header: "<h3>" + (goteo.texts && goteo.texts["admin-consultants"] || "consultants") + "</h3>",
            suggestion: function(e) {
                var t = "<div>";
                return e.image && (t += '<img src="' + e.image + '" class="img-circle"> '), t += e.name + "</div>"
            }
        }
    }
}, goteo.typeahead_engines = goteo.typeahead_engines || {}, goteo.typeahead_engines.channel = function(e) {
    var o = e && e.defaults || !1,
        i = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("id", "name", "subtitle"),
            identify: function(e) {
                return e.id
            },
            dupDetector: function(e, t) {
                return e.id === t.id
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: "/api/channels",
                filter: function(e) {
                    return e.list
                }
            },
            remote: {
                url: "/api/channels?q=%QUERY",
                wildcard: "%QUERY",
                filter: function(e) {
                    return e.list
                }
            }
        });
    i.initialize();
    return {
        name: "channel",
        displayKey: "name",
        source: function(e, t, a) {
            "" === e && o ? (t(i.index.all()), a([])) : i.search(e, t, a)
        },
        templates: {
            header: "<h3>" + (goteo.texts && goteo.texts["admin-channels"] || "channels") + "</h3>",
            suggestion: function(e) {
                var t = "<div>";
                return e.logo && (t += '<img src="' + e.logo + '" class="img-circle"> '), t += e.name + "</div>"
            }
        }
    }
}, goteo.typeahead_engines = goteo.typeahead_engines || {}, goteo.typeahead_engines.matcher = function(e) {
    var t = e && e.prefetch_statuses || "3,4,5",
        a = e && e.remote_statuses || "3,4,5,6",
        o = e && e.defaults || !1,
        i = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("id", "name", "subtitle"),
            identify: function(e) {
                return e.id
            },
            dupDetector: function(e, t) {
                return e.id === t.id
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: "/api/matchers?status=" + t,
                filter: function(e) {
                    return e.list
                }
            },
            remote: {
                url: "/api/matchers?status=" + a + "&q=%QUERY",
                wildcard: "%QUERY",
                filter: function(e) {
                    return e.list
                }
            }
        });
    i.initialize();
    return {
        name: "matcher",
        displayKey: "name",
        source: function(e, t, a) {
            "" === e && o ? (t(i.index.all()), a([])) : i.search(e, t, a)
        },
        templates: {
            header: "<h3>" + (goteo.texts && goteo.texts["admin-matchers"] || "matchers") + "</h3>",
            suggestion: function(e) {
                var t = "<div>";
                return t += e.name + "</div>"
            }
        }
    }
};
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
                r = $(this).data("url"),
                n = a.call(o[0]);
            r && o.is("input") && o.on("change", function(e) {
                var t = a.call(o[0]);
                $.ajax({
                    url: r,
                    type: "PUT",
                    data: {
                        value: t
                    }
                }).success(function(e) {
                    n = i.call(o[0], e.value), $(document).trigger("form-boolean-changed", [o[0]]), e.message && alert(e.message)
                }).fail(function(e) {
                    var t = JSON.parse(e.responseText),
                        a = t && t.error;
                    i.call(o[0], n), alert(a || (e.responseText ? e.responseText : e))
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
                r = {
                    tagClass: "label label-lilac"
                };
            if (t) {
                var n = new Bloodhound({
                    datumTokenizer: function(e) {
                        return Bloodhound.tokenizers.whitespace(e.tag)
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        wildcard: i,
                        url: t
                    }
                });
                n.initialize(), r.typeaheadjs = [{
                    highlight: !0
                }, {
                    name: "tags",
                    displayKey: a,
                    valueKey: o,
                    source: n.ttAdapter()
                }]
            }
            e.tagsinput(r)
        });
        var a = function(e) {
            var t = $(this).val();
            if (t) {
                var a = parseVideoURL(t),
                    o = $(this).closest(".media-container"),
                    i = (o.find(".video-holder"), o.find(".embed-responsive"));
                o.removeClass("loaded").removeClass("playing").addClass("loading");
                var r = function(e) {
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
                "youtube" === a.type ? r("https://img.youtube.com/vi/" + a.id + "/maxresdefault.jpg") : "vimeo" === a.type && $.getJSON("https://vimeo.com/api/v2/video/" + a.id + ".json").success(function(e) {
                    r(e[0].thumbnail_large)
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
            var u = $(this),
                m = u.find(".error-msg"),
                f = $(this).find(".image-list-sortable"),
                g = $(this).find(".dragndrop"),
                o = u.closest("form"),
                e = !!u.data("multiple"),
                p = parseInt(u.data("limit")),
                t = u.data("url") || null,
                h = u.data("accepted-files") ? u.data("accepted-files") : null,
                v = o.find("script.dropfile_item_template");
            e && 1 < p && Sortable.create(f[0], {
                onStart: function(e) {
                    g.hide()
                },
                onEnd: function(e) {
                    g.show(), f.removeClass("over")
                },
                onMove: function(e) {
                    f.removeClass("over"), $(e.to).addClass("over")
                }
            }), f.find("li").length >= p && g.hide();
            var x = function(e, t, a) {
                    var o = a || "/img/300x300c/" + t;
                    e.css({
                        backgroundImage: "url(" + o + ")",
                        backgroundSize: "cover"
                    })
                },
                y = new Dropzone(g.contents("div")[0], {
                    url: t || o.attr("action"),
                    uploadMultiple: e,
                    createImageThumbnails: !0,
                    maxFiles: p,
                    maxFilesize: MAX_FILE_SIZE,
                    autoProcessQueue: !!t,
                    dictDefaultMessage: u.data("text-upload"),
                    acceptedFiles: h
                }).on("error", function(e, t) {
                    m.html(t.error ? t.error : t), m.removeClass("hidden"), y.removeFile(e)
                }).on("thumbnail", function(e, t) {
                    var a = o.find('li[data-name="' + e.name + '"] .image');
                    x(a, e.name, t)
                }).on(t ? "success" : "addedfile", function(e, t) {
                    var a = f.find("li").length;
                    if (p <= a) return m.html(u.data("text-max-files-reached")), m.removeClass("hidden"), y.removeFile(e), !1;
                    if (!Dropzone.isValidFile(e, h)) return m.html(u.data("text-file-type-error")), y.removeFile(e), !1;
                    var o, i = e.name,
                        r = "",
                        n = "";
                    if (m.addClass("hidden"), t) {
                        if (!t.success)
                            for (o in m.html(t.msg), m.removeClass("hidden"), t.files) t.files[o].success || m.append("<br>" + t.files[o].msg);
                        for (o in t.files) t.files[o].originalName === i && (i = t.files[o].name, r = t.files[o].regularFile && t.files[o].type, n = t.files[o].downloadUrl)
                    }
                    var s = $(v.html().replace("{NAME}", i)),
                        l = s.find(".image"),
                        d = /(?:\.([^.]+))?$/.exec(i)[1];
                    if (l.addClass("file-type-" + d), t && (s.append('<input type="hidden" name="' + u.data("current") + '" value="' + i + '">'), u.data("markdown-link") && (s.find(".add-to-markdown").data("target", u.data("markdown-link")), s.find(".add-to-markdown").removeClass("hidden")), n && (s.find(".download-url").attr("href", n), s.find(".download-url").removeClass("hidden")), r ? l.addClass("file-type-" + r) : x(l, i)), f.append(s), p - 1 <= a && g.hide(), t) y.removeFile(e);
                    else {
                        var c = this.hiddenFileInput;
                        setTimeout(function() {
                            c.name = u.data("name"), c.files && c.files.length ? s.append(c) : (alert(goteo.texts["form-dragndrop-unsupported"]), s.remove(), g.show()), y.removeFile(e)
                        }, 0)
                    }
                });
            i[$(this).attr("id")] = y
        }), $(".autoform").on("click", ".image-list-sortable .delete-image", function(e) {
            e.preventDefault(), e.stopPropagation();
            var t = $(this).closest("li"),
                a = $(this).closest(".dropfiles"),
                o = $(this).closest(".image-zone"),
                i = $(this).closest(".image-list-sortable"),
                r = $(this).closest("form"),
                n = o.next();
            t.remove(), n.addClass("hidden");
            var s = parseInt(a.data("limit"));
            i.find("li").length < s && r.find(".dragndrop").show()
        }), $(".autoform").on("click", ".image-list-sortable .add-to-markdown", function(e) {
            e.preventDefault(), e.stopPropagation();
            var t = $(this).closest("li").data("name"),
                a = $(this).closest("form");
            a.find(".dragndrop").show();
            var o = a.attr("name") + "_" + $(this).data("target"),
                i = r[o];
            i && i.value(i.value().replace(/\s+$/g, "") + "\n\n![](" + IMG_URL + "/600x600/" + t + ")")
        }), $(".autoform").on("click", ".exact-location", function(e) {
            var r, n, s, l;
            e.preventDefault();
            var t = $(this).closest("form"),
                a = $("#modal-map-" + t.attr("name")),
                o = a.find(".map"),
                i = a.find(".input-block"),
                d = a.find(".geo-autocomplete"),
                c = a.find(".geo-autocomplete-radius"),
                u = $($(this).attr("href")),
                m = u.closest(".form-group").find("label:first").text();
            a.find(".modal-title").text(m), $(["address", "city", "region", "zipcode", "country_code", "country", "latitude", "longitude", "formatted_address", "radius"]).each(function(e, t) {
                var a = u.data("geocoder-populate-" + t),
                    o = $(a),
                    i = o.text();
                o.is(":input") && (i = o.val()), "radius" === t ? (l = parseInt(i, 10) || 0, c.data("geocoder-populate-" + t, a)) : d.data("geocoder-populate-" + t, a), "latitude" === t && (r = parseFloat(i) || 0), "longitude" === t && (n = parseFloat(i) || 0), "formatted_address" === t && (s = i)
            }), o.data("map-latitude", r), o.data("map-longitude", n), r && n || o.data("map-address", u.val()), l && (o.data("map-radius", l), c.val(l), i.addClass("show-radius")), d.val(r && n ? s : u.val()), a.modal("show"), locator.setGoogleMapPoint(o[0]), locator.setGoogleAutocomplete("#" + d.attr("id"))
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
}), d3.goteo = d3.goteo || {}, d3.goteo.discretevaluesChart = function(e) {
    var v = e && e.width || 64,
        x = e && e.height || 64,
        y = e && e.color || "black",
        w = e && e["flash-color"] || "orange",
        b = e && e["flash-time"] || 10,
        k = e && e.delay || 200,
        $ = function(e, t) {
            var a = t.split("."),
                o = e;
            return a.forEach(function(e) {
                if (!o.hasOwnProperty(e)) return null;
                o = o[e]
            }), o != e ? o : null
        };
    return function(e) {
        e.each(function(h) {
            console.log("discret values graph dataset", h), d3.select(this).selectAll("[data-property]").each(function(e, t) {
                var a = d3.select(this),
                    o = a.attr("data-property"),
                    i = a.attr("data-title"),
                    r = a.attr("data-tooltip"),
                    n = $(h, o);
                if (i = $(h, i) || i, null !== n) {
                    n = n.toString();
                    var s = !1,
                        l = d3.select(this).select("svg");
                    if (!l.empty()) {
                        if (l.select("g").select("text").text() == n) return;
                        l.remove(), s = !0
                    }
                    var d = (l = d3.select(this).append("svg").attr("viewBox", "0 0 " + v + " " + x).attr("preserveAspectRatio", "xMinYMin meet")).append("g"),
                        c = Math.min(1, Math.round(80 / n.length) / 10),
                        u = y;
                    if (-1 !== n.indexOf("%") ? u = -1 === n.indexOf("-") ? "green" : "#b00" : -1 !== n.indexOf("-") && (u = "#b00"), d.append("text").text(n).attr("text-anchor", "middle").attr("font-size", c + "em").attr("x", v / 2).attr("y", x / 3).attr("fill", s ? w : u).style("opacity", 0).transition().delay(k * t).style("opacity", 1).transition().duration(1e3 * b).attr("fill", u), r) {
                        var m = d3.select("body").append("div").attr("class", "tooltip top").style("opacity", 0);
                        m.append("div").attr("class", "tooltip-arrow");
                        var f = $(h, r).toString() || r;
                        m.append("div").attr("class", "tooltip-inner").html(f), l.on("mouseover", function(e) {
                            var t = this.getScreenCTM().translate(+this.getAttribute("cx"), +this.getAttribute("cy"));
                            m.attr("transform", "translate(" + t.e + "," + (t.f - x / 3) + ")").style("left", window.pageXOffset + t.e + v / 2 + "px").style("top", window.pageYOffset + t.f + "px"), m.transition().duration(200).style("opacity", .9).style("left", window.pageXOffset + t.e + v / 2 + "px").style("top", window.pageYOffset + t.f - x / 3 + "px")
                        }).on("mouseout", function(e) {
                            m.transition().duration(500).style("opacity", 0)
                        })
                    }
                    var g = v,
                        p = x / 2;
                    d.append("foreignObject").attr("x", 0).attr("y", x - p).attr("width", g).attr("height", p).append("xhtml:div").style("width", g + "px").style("height", p + "px").style("font-size", "8px").style("line-height", "1").style("text-align", "center").html(i)
                }
            })
        })
    }
}, d3.goteo = d3.goteo || {}, d3.goteo.pieChart = function(e) {
    var l = e && e.width || 450,
        d = e && e.height || 300,
        c = e && e.outerRadius || 150,
        u = e && e.innerRadius || 15,
        o = d3.scaleOrdinal(d3.schemeCategory20c),
        m = function(e, t) {
            var a = e.label || e.data.label;
            return "Other" == a || "Unknown" == a ? "#BCBCBC" : o(t)
        };
    return function(e) {
        e.each(function(e) {
            var t = d3.pie().value(function(e) {
                    return e.value
                }),
                a = 0;
            e.forEach(function(e) {
                a += e.value
            });
            var o = "0 0 " + l + " " + d,
                i = d3.select(this).append("svg").attr("viewBox", o).attr("preserveAspectRatio", "xMinYMin meet"),
                r = d3.arc().innerRadius(u).outerRadius(c),
                n = i.selectAll("g.arc").data(t(e)).enter().append("g").attr("class", "arc").attr("transform", "translate(" + c + ", " + c + ")");
            n.append("path").attr("fill", m).attr("d", r).on("mouseover", function(e) {
                d3.select(this).attr("fill-opacity", ".8").style("stroke", "white").style("stroke-width", "1px")
            }).on("mouseout", function(e) {
                d3.select(this).attr("fill-opacity", "1").style("stroke-width", "0px")
            }).transition().duration(1e3).attrTween("d", function(e) {
                var t = d3.interpolate({
                    startAngle: 0,
                    endAngle: 0
                }, e);
                return function(e) {
                    return r(t(e))
                }
            }), n.append("svg:title").text(function(e) {
                return e.data.label
            }), n.append("svg:text").attr("transform", function(e) {
                var t = r.centroid(e);
                return "translate(" + 1.5 * t[0] + "," + 1.5 * t[1] + ")"
            }).attr("text-anchor", "middle").text(function(e, t) {
                return 1 < e.data.value / a * 100 ? (e.data.value / a * 100).toFixed(1) + "%" : ""
            }).attr("fill", "#fff").classed("slice-label", !0);
            var s = i.append("g").attr("font-family", "sans-serif").attr("font-size", 10).attr("text-anchor", "end").selectAll("g").data(e).enter().append("g").attr("transform", function(e, t) {
                return "translate(0," + 20 * t + ")"
            });
            s.append("rect").attr("x", l - 19).attr("width", 19).attr("height", 19).attr("fill", m), s.append("text").attr("x", l - 24).attr("y", 9.5).attr("dy", "0.32em").text(function(e) {
                return (e.value / a * 100).toFixed(1) + "% " + e.label
            })
        })
    }
}, d3.goteo = d3.goteo || {}, d3.goteo.timemetricsChart = function(e) {
    var t = e && e.width || 600,
        a = e && e.height || 300,
        o = e && e.title || "Time series",
        r = e && e.description || "Show events in a timeline",
        n = e && e.min_date,
        s = e && e.max_date,
        l = e && e.format || "%VALUE%",
        d = e && e.field || "value";
    return console.log("settings", e),
        function(e) {
            e.each(function(e) {
                console.log("dataset", e);
                var i = this;
                MG.data_graphic({
                    title: o,
                    description: r,
                    data: e,
                    y_accessor: d,
                    width: t,
                    height: a,
                    interpolate: d3.curveLinear,
                    min_x: n,
                    max_x: s,
                    target: i,
                    linked: !0,
                    mouseover: function(e, t) {
                        var a = d3.timeFormat("%b %d, %Y")(e.date),
                            o = l.replace("%VALUE%", e[d]).replace("%TOTAL%", e.count);
                        d3.select(i).select("svg .mg-active-datapoint").text(a + "   " + o)
                    }
                }), d3.select(i).select("svg").attr("width", null), d3.select(i).select("svg").attr("height", null), d3.select(i).select("svg").attr("viewBox", "0 0 " + t + " " + a), d3.select(i).select("svg").attr("preserveAspectRatio", "xMinYMin meet")
            })
        }
};