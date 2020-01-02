// Get the modal

/*global $*/
$( document ).ready( function() {
	const modal = $( '#portfolio-modal' );
	const modalImg = $( '#portfolio-modal-img' );
	const titleSpan = $( '#portfolio-title-span' );
	const portfolioBlock = $( '.portfolio-block' );
	let currentBlock = false;

	const setModal = function( block ) {
		const img = block.find( '.portfolio-img' );

		modalImg.prop( 'src', img.prop( 'src' ) );
		titleSpan.html( img.prop( 'alt' ) );
		currentBlock = block;
	};

	$( '.portfolio-item' ).click( function() {
		modal.css( 'display', 'block' );
		setModal( $( this ) );
	} );

	const span = $( '.portfolio-close-span' );
	span.click( function() {
		modal.css( 'display', 'none' );
		currentBlock = false;
	} );

	modal.find( '.navigation-arrow-left' ).click( function() {
		const previousBlock = currentBlock.prev( '.portfolio-item' );

		if ( previousBlock.length > 0 ) {
			setModal( previousBlock );
		} else {
			const lastBlock = portfolioBlock.find( '.portfolio-item' ).last();
			if ( lastBlock.length > 0 ) {
				setModal( lastBlock );
			}
		}
	} );

	modal.find( '.navigation-arrow-right' ).click( function() {
		const nextBlock = currentBlock.next( '.portfolio-item' );

		if ( nextBlock.length > 0 ) {
			setModal( nextBlock );
		} else {
			const firstBlock = portfolioBlock.find( '.portfolio-item' ).first();
			if ( firstBlock.length > 0 ) {
				setModal( firstBlock );
			}
		}
	} );
} );
