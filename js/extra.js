// KLIFUR.IS

( function( $ ) {
// check if post has more than 6 images - if true: wrap them in content.gallery div

	

	// Function to stack floated elements without empty space (remove empty space between articles and divs)
	function compressit(sel, marg) {
		var selector = sel; // css selectors like 'p' or '.comments'
		var margin = marg;
		
	    var noOfElements = $(selector).length;
	    var left, top, height, above, aboveBottom, diff, back;
		var offsetObjects = [];
	    
		// just do something if there are more than two elements
	    if( noOfElements >= 2 ){
	        // add all offset data to array
	        $(selector).each(function( index ){
				offsetObjects[index] = $(this).offset();
				offsetObjects[index].height = $(this).outerHeight();
			});

			// stack the elements
			for(var i = 2; i < noOfElements; i++) {
				left 	= offsetObjects[i].left;
				top 	= offsetObjects[i].top;
				height  = offsetObjects[i].height;
				
				// find the element above
				back = i - 2;
				above = offsetObjects[back];
				
				// get bottom border of element above
				aboveBottom = above.top + above.height;
				//console.log('aboveBottom: '+ aboveBottom);
				
				// move current element up if needed
				if( top > aboveBottom ) {
					diff = top - aboveBottom;
					diff -= margin;
					$(selector + ':eq(' + i + ')').css( 'margin-top', -diff + 'px' );
				}
			}
	  }	
	} // function compressit()


	/* DOCUMENT READY */
	$(function(){ // klifur.is

		/* COMRESSIT */
		// use compressit() if browser window is < 999px
		if( $(window).width() >= 999){
			//setTimeout(compressit, 1000, '.hentry', 30); 
			setTimeout(compressit, 1000, 'body.single .post-section', 30);
			setTimeout(compressit, 1000, 'body.single .problem-section', 30);
			

		}


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


		/* REFRESH BROWSER ON WINDOW RESIZE (below 999px)
		*
		* Used because compressit() adds negative margin that break layout
		* when the layout changes to one column after the browser is resized
		*/
		var windowWidth = $(window).width();

		$(window).resize(function() {
		    if( windowWidth > 999 ) {
		    	if( $(window).width() <= 999 ) {
		    		location.reload();
		    		windowWidth = $(window).width();
		    		return;
		    	} 
		    
	    		windowWidth = $(window).width();
	    	}
		});


	}); // document.ready()
} )( jQuery );