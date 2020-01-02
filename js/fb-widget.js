/*global $, designfly_fbwidgetscript_vars*/
$( window ).bind( 'load', function() {
	$( '.fb_loader' ).hide();
} );

$( document ).ready( function() {
	const appid = designfly_fbwidgetscript_vars.app_id;
	const selectLang = 'en_US';

	( function( d, s, id ) {
		const fjs = d.getElementsByTagName( s )[ 0 ];

		if ( d.getElementById( id ) ) {
			return;
		}

		const js = d.createElement( s );
		js.id = id;
		js.src = '//connect.facebook.net/' + selectLang + '/sdk.js#xfbml=1&version=v2.4&appId=' + appid;
		fjs.parentNode.insertBefore( js, fjs );
	}( document, 'script', 'facebook-jssdk' ) );
} );
