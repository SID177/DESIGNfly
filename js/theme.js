// Theme wide js file.

/*global jQuery*/
const $ = jQuery;

$( document ).ready( function() {
	const hash = window.location.hash;

	if ( hash ) {
		$( hash ).addClass( 'current-comment' );
	}
} );
