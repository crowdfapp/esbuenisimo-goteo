$(function() {
    var e = function() {
        var t = $(".dashboard-content>.inner-container"),
            n = t.find(".costs-bar"),
            o = opt = total = 0;
        t.find(".amount input").each(function() {
            var t = parseInt($(this).closest(".panel-body").find(".amount input").val(), 10),
                n = parseInt($(this).closest(".panel-body").find(".required select").val(), 10);
            total = total + amount;
            t && (n ? o += t : opt += t)
        }), n.find(".amount-min").html(o), n.find(".amount-opt").html(opt), n.find(".amount-total").html(total);
        var a = Math.round(100 * o / (o + opt)),
            i = Math.round(100 * opt / (o + opt)),
            e = parseInt(n.find(".min").css("width", "auto").width()),
            s = parseInt(n.find(".opt").css("width", "auto").width()),
            d = parseInt(n.find(".total").css("width", "auto").width());
        console.log("calc", o + "€", opt + "€", a + "%", i + "%", e + "px", s + "px", d + "px"), n.find(".min").css("width", a + "%").css({
            minWidth: e + "px",
            maxWidth: "calc(" + a + "% - " + (d + s) + "px)"
        }), n.find(".opt").css("width", .8 * i + "%").css({
            minWidth: s + "px",
            maxWidth: "calc(" + i + "% - " + (d + e) + "px)"
        }), n.find(".bar-min").css("width", a + "%").html(a + "%"), n.find(".bar-opt").css("width", i + "%").html(i + "%")
    };
    e(), $(".autoform").on("change", ".cost-item .required select", function() {
        var t = parseInt($(this).val(), 10),
            n = $(this).closest(".cost-item");
        t ? n.addClass("lilac") : n.removeClass("lilac"), e()
    }), $(".autoform").on("change", ".cost-item .amount input", e), $(".autoform").on("click", ".add-cost", function(t) {
        t.preventDefault();
        var n = $(this).closest("form"),
            o = n.find(".cost-list"),
            a = n.serialize() + "&" + encodeURIComponent($(this).attr("name")) + "=";
        console.log("add cost", a), $but = $(this).hide(), o.find(">.text-danger").remove(), o.append('<div class="loading"></div>'), $.ajax({
            type: n.attr("method"),
            url: n.attr("action"),
            data: a
        }).done(function(t) {
            var n = $(t);
            o.append(n.hide()), n.slideDown()
        }).fail(function(t) {
            o.append('<p class="text-danger">' + t.responseText + "</p>")
        }).always(function() {
            $but.show(), o.find(">.loading").remove()
        })
    }), $(".autoform").on("click", ".remove-cost", function(t) {
        if (t.isPropagationStopped()) return !1;
        t.preventDefault();
        var n = $(this),
            o = n.closest("form"),
            a = (o.find(".cost-list"), o.serialize() + "&" + encodeURIComponent(n.attr("name")) + "="),
            i = n.closest(".panel");
        n.hide().after('<div class="loading"></div>'), i.find(":input").attr("disabled", !0), $.ajax({
            type: o.attr("method"),
            url: o.attr("action"),
            data: a
        }).done(function() {
            i.slideUp(function() {
                $(this).remove(), e()
            })
        }).fail(function(t) {
            console.log("An error occurred.", t), alert(t.responseText)
        }).always(function() {
            n.show().next(".loading").remove()
        })
    })
});