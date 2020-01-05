// Theme wide js file.

/*global jQuery*/
const $ = jQuery;

$( document ).ready( function() {
	const hash = window.location.hash;

	if ( hash ) {
		$( hash ).addClass( 'current-comment' );
	}

	const offlineText = $( '#offlineText' );

	if ( ! navigator.onLine ) {
		offlineText.css( 'display', 'block' );
	}

	window.addEventListener( 'online', () => {
		offlineText.css( 'display', 'none' );
	} );

	window.addEventListener( 'offline', () => {
		offlineText.css( 'display', 'block' );
	} );

	offlineText.click( () => {
		offlineText.css( 'display', 'none' );
	} );
} );
