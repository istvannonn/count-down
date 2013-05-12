// -------------------------------- //
// Setting up the count down timer
// -------------------------------- //
var date = $('.counter').data('date');
date = date.split('/');

$('.counter').countdown({
	until:  new Date(date[0], date[1] - 1, date[2]), format: 'DHMS' // format - DAY, HOURS, MINUTES, SECONDS
});
// -------------------------------- //

// -------------------------------- //
// Create animation for the contact form box by sliding up and down changing with the right mail
// -------------------------------- //
var check; // create a checking variable
$('.trigger').hide(); // hiding the contact form div element
$('h3.js').click(function(e) {
	if ($('.mail-icon').hasClass('mail-icon-close')) { // check the mail icon class it's close, ... 
		$('.mail-icon').removeClass('mail-icon-close').addClass('mail-icon-open'); // ... remove it and add the open mail. 
	
		$.getDocHeight = function(){ // grabbing the max height of the page
			return Math.max(			// it's usefull to scroll the page up and down when you toggle the contact form div element 
				$(document).height(),
				$(window).height(),
				/* For opera: */
				document.documentElement.clientHeight
			);
		};
		
		check = 1;

	} else {

		$('.mail-icon').removeClass('mail-icon-open').addClass('mail-icon-close'); // remove the open mail icon and put the close one
		setTimeout(function(){ $('html, body').animate({ scrollTop: 0 }, 500) }, 0); // scroll the page up
		check = 0;
	}

	var content = $(this).next('.trigger');
	e.preventDefault();
	$('.trigger:visible').not(content).slideToggle('slow'); // toggle the contact form div element
	content.slideToggle('slow');
	
	if (check == 1) { // check if the contact form div element is open
		$(document).ready(function() {
				setTimeout(function(){
					  $('html, body').animate({ scrollTop: $.getDocHeight() }, 1500); // scroll the page down 
				}, 0);
		});
	}
	
});
// -------------------------------- //

// -------------------------------- //
// Contact Form Processing ...
// -------------------------------- //
$('.contact-form form').submit(function(e) { // submit the contact form
	e.preventDefault(); // error handler
	
	$('.err-contactform').empty(); // delete all the error messages if the form was sent already
	
	var $form = $('.contact-form form'),
		url = $form.attr( 'action' ), // indicate the form action

		hasError = false;
		name = $.trim($('#name').val()), // get value from the name field
		email = $.trim($('#email').val()), // get value from the email field
		message = $('#message').val(), // get value from the message field
		emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
	if (name == "" || name == "name") { // check if the name field is empty or it's a default value	
      $('.err-contactform').append($('<p class="error">Fill out with your real name.</p>').fadeIn(500)); // Fade in the error message
      hasError = true; // we have an error
    }
	
	if(!emailReg.test(email)) { // check if the email field is valid
      $('.err-contactform').append($('<p class="error">Your e-mail address seems to be wrong. Try with your real e-mail address.</p>').fadeIn(500)); // Fade in the error message
      hasError = true; // we have an error
	}
	
	if (message == "" || message == "message") { // check if the message field is empty or it's a default value
      $('.err-contactform').append($('<p class="error">Leave us a nice message, please.</p>').fadeIn(500)); // Fade in the error message
      hasError = true; // we have an error
    }
	
	if(!hasError) { // if we don't have errors
		var fromInput = $form.serialize(); // grab the information from the fields and save to a variable
		$.post(url,fromInput,function(data){ // sending information with POST methode to the php file
			$form.slideUp(500, function() { // hide the contact form
				// inform the message was sent
				$('.err-contactform').append($('<p class="success">We catched your message. Thank you.</p>').fadeIn(500)); 
			});
		});
	}
	return false;
});
// -------------------------------- //

// -------------------------------- //
// Newsletter Subscriber Processing ...
// -------------------------------- //
	$('.newsletter-form').submit(function(e) { // submit the contact form
		e.preventDefault(); // error handler
		
		$('.err-newsletter').empty(); // delete all the error messages if the form was sent already
		
		var $form = $('.newsletter-form'),
			url = $form.attr( 'action' ), // indicate the form action
	
			hasError = false;
			email = $.trim($('.subscribeto').val()), // get value from the email field
			emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			
		if(!emailReg.test(email)) { // check if the email field is valid
		  $('.subscribeto').attr('value', 'Your e-mail address seems to be wrong. Try again.'); // Add error message
		  hasError = true; // we have an error
		}
		
		if(!hasError) { // if we don't have errors
			var fromInput = $form.serialize() + '&js=true'; // grab the information from the fields and save to a variable
			
			if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			} else { // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					//document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
					data = xmlhttp.responseText;
					$('.subscribeto').val(data);
				}
			}
			
			xmlhttp.open("POST","function.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(fromInput);
		}
		return false;
	});
// -------------------------------- //