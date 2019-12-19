// Theme wide js file.

var $ = jQuery;

$( document ).ready( function() {
    var hash = window.location.hash;
    
    if ( hash ) {
        $( hash ).addClass( 'current-comment' );
    }
} );