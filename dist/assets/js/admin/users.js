$(function(){var i=function(a,o){var s=$("input#autoform_email"),r=$("input#autoform_userid"),t=$("input#autoform_"+a),e={seed:[s.val(),r.val()]};e[a]=t.val(),t.addClass("loading"),$.getJSON("/api/login/check",e,function(a){console.log(a),t.removeClass("loading"),a&&(a.available?t.closest(".form-group").removeClass("has-error").addClass("has-success"):t.closest(".form-group").removeClass("has-success").addClass("has-error"),"function"==typeof o&&o(a))})};$("#main").on("change","input#autoform_email,input#autoform_name,input#autoform_userid",function(a){var o,s,r=$(this).attr("id").substr(9),t=$("input#autoform_userid"),e=$("input#autoform_name"),u=$("input#autoform_password");i(r),"email"===r&&(s=(o=$(this).val().split("@"))[0].charAt(0).toUpperCase()+o[0].substr(1),""==e.val().trim()&&e.val(s),""==t.val().trim()&&i("userid",function(a){t.val(a.suggest[0]),t.closest(".form-group").removeClass("has-error").addClass("has-success")})),""==u.val().trim()&&u.val(function(){for(var a="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",o="",s=0,r=a.length;s<8;++s)o+=a.charAt(Math.floor(Math.random()*r));return o}())})});