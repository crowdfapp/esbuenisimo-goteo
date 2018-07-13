$(function(){var r=function(t,e,a){if(!e||void 0===e.items&&!Object.keys(e).length||void 0!==e.items&&!e.items.length)t.html('<small class="text-danger">No data</small>');else if(t.hasClass("discrete-values")){var s=d3.goteo.discretevaluesChart(a);d3.select(t[0]).datum(e).call(s)}else if(t.hasClass("percent-pie")){var n=e.map(function(t){return{label:t.label,value:t.counter}}),i=d3.goteo.pieChart();d3.select(t[0]).datum(n).call(i)}else if(t.hasClass("time-metrics")){var c=e.items.map(function(t){return t.date=new Date(t.date),t});a.min_date=new Date(e.min_date),a.max_date=new Date(e.max_date);var l=d3.goteo.timemetricsChart(a);d3.select(t[0]).datum(c).call(l)}else t.html('<small class="text-danger">Chart not found</small>')},e=function(){var i={},c=!0,l=function(){c=!1;var e=$(this),a=e.data("source");i[a]||(i[a]={settings:e.data(),data:[]});var s=parseInt(i[a].settings.interval,10)||0,n=parseInt(i[a].settings["interval-delay"],10)||0;$.getJSON(a).done(function(t){i[a].data=t,r(e,t,e.data()),s&&(console.log("timeout at ",s,"delay at",n),setTimeout(function(){$('[data-source="'+a+'"]').length&&l.call(e)},1e3*((c?n:0)+s)))}).fail(function(t){console.log("Error fetching ",a,"ERROR:",t),e.html('<small class="text-danger">'+(t.responseJSON&&t.responseJSON.error||t.responseText||t)+"</small>")}).always(function(){e.removeClass("loading")})};$(".d3-chart").each(l),$(".d3-chart-updater").off("click"),$(".d3-chart-updater").on("click",function(t){t.preventDefault();var e=$(this).data("target"),a=$(e).data("source");i[a].settings=$.extend(i[a].settings,$(this).data()),r($(e),i[a].data,i[a].settings)}),$('input[type="checkbox"].d3-chart-updater').off("change"),$('input[type="checkbox"].d3-chart-updater').on("change",function(t){var e=$(this).data(),a=$(this).data("target"),s=$(a).data("source");$(this).prop("checked")?($(this).data("settings-backup",i[s].settings),i[s].settings=$.extend(i[s].settings,e)):$(this).data("settings-backup")&&(i[s].settings=$(this).data("settings-backup")),l.call($(a))}),$(".d3-chart.auto-enlarge").off("click"),$(".d3-chart.auto-enlarge").on("click",function(t){t.preventDefault(),$(this).closest(".chart-wrapper").toggleClass("d3-chart-wide")})};e(),$(window).on("pronto.render",function(t){e()}),$(window).on("autocharts.init",function(t){e()})});