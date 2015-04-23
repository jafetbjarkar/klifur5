// KLIFUR.IS

( function( $ ) {
// check if post has more than 6 images - if true: wrap them in content.gallery div

	// Call the .notification dic
	var active;
	function notification(the_message, time) {
		if( active ) { return; }
		if( !time ) { time = 5000; }
		active = true;
		$('.notification')
			.html(the_message)
			.animate({ left: "+=332px", opacity: 1 }, 500)
			.delay(time)
			.animate({ left: "-=332px", opacity: 0 }, 500, function(){
				active = false;
			});
	}

	function random_messages(list_number) {
		var fav_messages = [
			"Successfully added to your list.",
			"I like this one also!",
			"I remember this one.",
			"You are my favourite <3",
			"Its like... this problem choose me.",
			"Fuck yeah I love this problem!",
			"You look good today!",
		];
		var fin_messages = [
			"Successfully added to your list.",
			"Super sweet!",
			"Well done!",
			"You are on fire!",
			"Will there be anything left?",
			"The sun is there, the rock is there, you just have to climb.",
			"WOHOO!",
			"So rad!",
			"Great!, I will add this problem to you list.",
		];
		var pro_messages = [
			"Successfully added to your list.",
			"Nice. Super cool problem!",
			"Are you sure?",
			"Good project! Has been added to your list.",
			"Oh dear!",
			"I feel so excited!",
			"You are so awesome.",
			"Like your hair today.",

		];
		
		if( list_number === "1" ) {
			return fav_messages[Math.floor(Math.random() * fav_messages.length)];
		} else if( list_number === "2" ) {
			return fin_messages[Math.floor(Math.random() * fav_messages.length)];
		} else if( list_number === "3" ) {
			return pro_messages[Math.floor(Math.random() * fav_messages.length)];
		}

	} 

	/* DOCUMENT READY */
	$(function(){ // klifur.is

		
		/* UPDATE USER LISTS
		*
		* To update favorites, finished and project lists
		* Calls the function user_lists() in funcitons_klifur.php
		*/
		$('.btn-icons a').on('click', function(){
		    // We'll pass this variable to the PHP function user_lists()
		    	var user_ID = $(this).closest('[data-user-id]').attr('data-user-id');
				var post_ID = $(this).closest('[data-post-id]').attr('data-post-id');
				var list_no = $(this).attr('data-list-no');
				var current = this;
		     	
		     	window.console.log(user_ID, post_ID, list_no);

		     	if( user_ID === "0" ) {
		     		notification("Pling! <br> Try logging in. See top left corner.");
		     		return;
		     	}
		    // This does the ajax request
		    $.ajax({
		        url: MyAjax.ajaxurl,
		        data: {
		            'action':'user_lists',
		            'user_ID' : user_ID,
		            'post_ID' : post_ID,
		            'list_no' : list_no
		        },
		        success:function(data) {
		        	var obj = JSON.parse(data);
		        	if( obj.type === 'success' ) { // update HTML icons
		        		//window.console.log(data);

	        			if( obj.new_value === 1 ) { 
	        				//window.console.log('addClass');
        					$(current).addClass('on');
        					
        					notification( random_messages(list_no), 1500 );
        				} else { 
        					//window.console.log('removeClass');
        					$(current).removeClass('on');
        					notification("Pling! <br>Your list was updated.", 1500);
        				}
		        		
		        	} else {
		        		//window.console.log(data);	
		        		window.console.log(obj.type + ' query failed');	
		        		notification("This did not work for some reason :( Try later or contact me at jafetbjarkar@gmail.com");
		        	}
		            // This outputs the result of the ajax request
		        },
		        error: function() { // original: function(errorThrown)
		            //window.console.log(errorThrown);
		            notification("Something went wrong. Try later or contact me at jafetbjarkar@gmail.com");
		        }
		    });  
		              
		}); // on click function


	}); // document.ready()
} )( jQuery );