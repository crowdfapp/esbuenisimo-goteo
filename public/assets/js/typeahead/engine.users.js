goteo.typeahead_engines = goteo.typeahead_engines || {};

goteo.typeahead_engines.user = function (settings) {
    var defaults = settings && settings.defaults || false;

    var engine = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id', 'name', 'email'),
        identify: function (o) { return o.id; },
        dupDetector: function (a, b) { return a.id === b.id; },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/api/users?q=%QUERY',
            wildcard: '%QUERY',
            filter: function (response) {
                // console.log('remote hit', response);
                return response.list;
            }
        }
    });

    // initialize the bloodhound suggestion engine
    engine.initialize();

    var engineWithDefaults = function (q, sync, async) {
        if (q === '' && defaults) {
            // console.log('get defaults');
            sync(engine.index.all());
            async([]);
        }
        else {
            engine.search(q, sync, async);
        }
    };

    // Engine
    return {
        name: 'user',
        displayKey: 'name',
        source: engineWithDefaults,
        templates: {
            header: '<h3>' + (goteo.texts && goteo.texts['admin-users'] || 'users') + '</h3>',
            suggestion: function (datum) {
                // console.log('user suggestion',datum);
                var t = '<div>';
                if(datum.image) t += '<img src="' + datum.image + '" class="img-circle"> ';
                t += datum.name + (datum.email && (' (' + datum.email + ')')) + '</div>';
                return t;
            }
        }
    }
};
