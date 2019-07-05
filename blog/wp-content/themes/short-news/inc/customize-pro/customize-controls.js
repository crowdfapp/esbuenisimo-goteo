( function( api ) {

	// Extends our custom "short-news-pro" section.
	api.sectionConstructor['short-news-pro'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
