/*global workbox*/

const offlinePage = '/wp-content/themes/DESIGNfly/offline.html';
const offlineImage = '/wp-content/themes/DESIGNfly/img/noimagefound.png';

workbox.precaching.precacheAndRoute( [
	offlinePage,
	offlineImage,
] );

self.addEventListener( 'fetch', ( event ) => {
	// Page caching.
	if ( event.request.url.match( /^((?!wp-admin)(?!.*\.[a-zA-Z0-9]).)*$/ ) ) {
		event.respondWith(
			caches.open( 'designfly-page-cache' ).then( ( cache ) => {
				return fetch( event.request ).then( ( response ) => {
					if ( ! response ) {
						return cache.match( event.request ).then( ( response1 ) => {
							if ( ! response1 ) {
								return caches.match( offlinePage );
							}

							return response;
						} );
					}

					cache.put( event.request, response.clone() );

					return response;
				} ).catch( () => {
					return cache.match( event.request ).then( ( response ) => {
						if ( ! response ) {
							return caches.match( offlinePage );
						}

						return response;
					} );
				} );
			} ),
		);
		// Image caching.
	} else if ( event.request.url.match( /^(((?!wp-admin).)*\.(?:png|gif|jpg|jpeg|svg|webp)(\?.*)?$)*$/ ) ) {
		event.respondWith(
			caches.open( 'designfly-image-cache' ).then( ( cache ) => {
				return fetch( event.request ).then( ( response ) => {
					if ( ! response ) {
						return cache.match( event.request ).then( ( response1 ) => {
							if ( ! response1 ) {
								return caches.match( offlineImage );
							}

							return response1;
						} );
					}

					cache.put( event.request, response.clone() );

					return response;
				} ).catch( () => {
					return cache.match( event.request ).then( ( response ) => {
						if ( ! response ) {
							return caches.match( offlineImage );
						}

						return response;
					} );
				} );
			} ),
		);
	}
} );

workbox.routing.registerRoute(
	// Cache image files.
	/^(((?!wp-admin).)*\.(?:css|js)(\?.*)?$)*$/,
	// Use the cache if it's available.
	new workbox.strategies.NetworkFirst( {
		// Use a custom cache name.
		cacheName: 'designfly-asset-cache',
		plugins: [
			new workbox.expiration.Plugin( {
				// Cache only 20 images.
				maxEntries: 50,
			} ),
		],
	} ),
);

workbox.routing.registerRoute(
	// Cache image files.
	/^https:\/\/fonts.gstatic.com(.*)$/,
	// Use the cache if it's available.
	new workbox.strategies.NetworkFirst( {
		// Use a custom cache name.
		cacheName: 'designfly-fonts-cache',
		plugins: [
			new workbox.expiration.Plugin( {
				// Cache only 20 images.
				maxEntries: 10,
			} ),
		],
	} ),
);
