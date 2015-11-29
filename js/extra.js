// KLIFUR.IS

( function( $ ) {
// check if post has more than 6 images - if true: wrap them in content.gallery div

	/* DOCUMENT READY */
	$(function(){ // klifur.is

		/* IMAGE GALLERY */
		// activity indicator
		var activityIndicatorOn = function() {
				$( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo( 'body' );
			},
			activityIndicatorOff = function() {
				$( '#imagelightbox-loading' ).remove();
			},
			// caption
			captionOn = function() {
				var description = $( 'a[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"] img' ).attr( 'alt' );
				if( description.length > 0 ) {
					$( '<div id="imagelightbox-caption">' + description + '</div>' ).appendTo( 'body' );
				}
			},
			captionOff = function() {
				$( '#imagelightbox-caption' ).remove();
		};


		//	Activate caption and activity indication
		$( 'article.post a:has(img)' ).imageLightbox ( {
			onLoadStart: function() { captionOff(); activityIndicatorOn(); },
			onLoadEnd:	 function() { captionOn(); activityIndicatorOff(); },
			onEnd:		 function() { captionOff(); activityIndicatorOff(); }
		});


		/* ACTIVATE PLUGINS */
		/* Tablesorter */
		$("#myTable").tablesorter();
		/* Tooltipster */
		$('.tooltip').tooltipster();


		/* STICKY FOOTER */
		var docHeight = $(window).height();
		var footerHeight = $('.site-footer').height();
		var footerTop = $('.site-footer').position().top + footerHeight;

		if (footerTop < docHeight) {
			$('.site-footer').css('top', 10 + (docHeight - footerTop) + 'px');
			$('nav.navigation').css('top', 10 + (docHeight - footerTop) + 'px');
		}


		/* PROBLEM FORM */
		// hide submit button
		//$('.problem-form input[type=submit]').hide();

		// submit form on change
		$('.problem-form form').change(function() {
			this.submit();
		});

		$('.user-lists').change(function() {
			this.submit();
		});



	}); // document.ready()

	// wait for images to load
	$(window).load(function() {
		$('.site-content-masonry').masonry({
			columnWidth: '.grid-sizer',
			itemSelector: '.hentry',
			percentPosition: true,
			"gutter": 20
		});
	});

} )( jQuery );
