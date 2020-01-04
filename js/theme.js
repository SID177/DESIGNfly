// Theme wide js file.

/*global jQuery*/
const $ = jQuery;

$( document ).ready( function() {
	const hash = window.location.hash;

	if ( hash ) {
		$( hash ).addClass( 'current-comment' );
	}

	const screenFitter = $( '#screenFiller' );
	const offlineText = $( '#offlineText' );

	if ( ! navigator.onLine ) {
		screenFitter.css( 'border', '5px solid red' );
		offlineText.css( 'display', 'block' );
	}

	window.addEventListener( 'online', () => {
		screenFitter.css( 'border', 'none' );
		offlineText.css( 'display', 'none' );
	} );

	window.addEventListener( 'offline', () => {
		screenFitter.css( 'border', '5px solid red' );
		offlineText.css( 'display', 'block' );
	} );

	offlineText.click( () => {
		offlineText.css( 'display', 'none' );
	} );
} );
