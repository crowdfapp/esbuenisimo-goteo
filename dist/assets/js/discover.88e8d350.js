$(function() {
    $container = $(".auto-update-projects"), $in_review = $("#include-in-review").length && $("#include-in-review");
    var e = $container.data("total"),
        n = {
            filter: $container.data("filter"),
            strict: !0,
            pag: 1,
            limit: $container.data("limit"),
            location: goteo.urlParams.location,
            latitude: goteo.urlParams.latitude,
            longitude: goteo.urlParams.longitude,
            category: goteo.urlParams.category,
            q: goteo.urlParams.q
        };
    $(window).scroll(function() {
        if (!($container.find(".loading-container").length || n.limit * n.pag >= e)) {
            var i = $container.find(".widget-element:last");
            $(window).scrollTop() >= i.offset().top - i.height() && (i.after('<div class="loading-container">' + goteo.texts["regular-loading"] + "</div>"), $.getJSON("/discover/ajax", n, function(t) {
                            
                e = t.total, n.limit = t.limit, t.items.forEach(function(t, e) {
                    $('<div class="col-sm-6 col-md-4 col-xs-12 spacer widget-element">' + t + "</div>").hide().insertAfter(i).fadeIn()
                }), $container.find(".loading-container").remove(), n.pag++
            }))
        }
    }), $("#main").on("submit", "form.form-search", function(t) {
        $in_review && $("<input>").attr("type", "hidden").attr("name", $in_review.attr("name")).attr("value", $in_review.prop("checked") ? 1 : 0).appendTo($(this))
    }), $("#main").on("change", "form.form-search select", function(t) {
        t.preventDefault(), $(this).closest("form").submit()
    })
});