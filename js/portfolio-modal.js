// Get the modal
var $ = jQuery;

$( document ).ready( function() {
    var modal = $( '#portfolio-modal' );
    var modalImg = $( '#portfolio-modal-img' );
    var titleSpan = $( '#portfolio-title-span' );
    var portfolioBlock = $( '.portfolio-block' );
    var currentBlock = false;
    
    var setModal = function( block ) {
        var img = block.find( '.portfolio-img' );

        modalImg.prop( 'src', img.prop( 'src' ) );
        titleSpan.html( img.prop( 'alt' ) );
        currentBlock = block;
    }

    $( '.portfolio-item' ).click( function() {
        modal.css( 'display', 'block' );
        setModal( $( this ) );
    } );

    var span = $( '.portfolio-close-span' );
    span.click( function() {
        modal.css( 'display', 'none' );
        currentBlock = false;
    } );

    modal.find( '.navigation-arrow-left' ).click( function() {
        var previousBlock = currentBlock.prev( '.portfolio-item' );

        if ( previousBlock.length > 0 ) {
            setModal( previousBlock );
        } else {
            var lastBlock = $( '.portfolio-block .portfolio-item' ).last();
            if ( lastBlock.length > 0 ) {
                setModal( lastBlock );
            }
        }
    } );

    modal.find( '.navigation-arrow-right' ).click( function() {
        var nextBlock = currentBlock.next( '.portfolio-item' );

        if ( nextBlock.length > 0 ) {
            setModal( nextBlock );
        } else {
            var firstBlock = $( '.portfolio-block .portfolio-item' ).first();
            if ( firstBlock.length > 0 ) {
                setModal( firstBlock );
            }
        }
    } );
} );

// var leftArrow = document.getElementsByClassName( 'navigation-arrow-left' )[0];
// leftArrow.onclick = function() {
//     nextBlock = currentBlock.nextSibling;
//     console.log(nextBlock);
    
//     if ( nextBlock && nextBlock.classList && nextBlock.classList.contains( 'portfolio-item' ) ) {
//         setModal( nextBlock );
//     }
// }

// var rightArrow = document.getElementsByClassName( 'navigation-arrow-right' )[0];
// rightArrow.onclick = function() {
//     previousBlock = currentBlock.previousSibling;
    
//     if ( previousBlock && previousBlock.classList && previousBlock.classList.contains( 'portfolio-item' ) ) {
//         setModal( previousBlock );
//     }
// }