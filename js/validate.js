
jQuery(document).ready(function ($) {
	$('#submit').click(function () {		
		
		//Get the data from all the fields
		var name = $('input[name=name]');
		var email = $('input[name=email]');
		var regx = /^([a-z0-9_\-\.])+\@([a-z0-9_\-\.])+\.([a-z]{2,4})$/i;
		var comment = $('textarea[name=comment]');
		var returnError = false;
		
		//Simple validation to make sure user entered something
		//Add your own error checking here with JS, but also do some error checking with PHP.
		//If error found, add hightlight class to the text field
		if (name.val()=='') {
			name.addClass('error');
			returnError = true;
		} else name.removeClass('error');
		
		if (email.val()=='') {
			email.addClass('error');
			returnError = true;
		} else email.removeClass('error');		
		
		if(!regx.test(email.val())){
          email.addClass('error');
          returnError = true;
		} else email.removeClass('error');
		
		
		if (comment.val()=='') {
			comment.addClass('error');
			returnError = true;
		} else comment.removeClass('error');
		
		// Highlight all error fields, then quit.
		if(returnError == true){

			return false;	
		}
		
		//organize the data
		
		var data = 'name=' + name.val() + '&email=' + email.val() + '&comment='  + encodeURIComponent(comment.val());

		//disabled all the text fields
		$('.text').attr('disabled','true');
		
		//show the loading sign
		$('.loading').show();
		
		//start the ajax
		$.ajax({
			//this is the php file that processes the data and sends email
			url: "contact.php",	
			
			//GET method is used
			type: "GET",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {				
				//if contact.php returned 1/true (send mail success)
				if (html==1) {
				
					//show the success message
					$('.done').fadeIn('slow');
					
					$(".form").find('input[type=text], textarea').val("");
					
				//if contact.php returned 0/false (send mail failed)
				} else alert('Sorry, unexpected error. Please try again later.');				
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
	});
	$('#login').click(function () {		
		
		var name = $('input[name=Username]');
		var password = $('input[name=Password]');
		var returnError = false;
		
		if (name.val()=='') {
			name.addClass('error');
			returnError = true;
		} else name.removeClass('error');
		
		if (password.val()=='') {
			password.addClass('error');
			returnError = true;
		} else password.removeClass('error');		
		
		if(returnError == true){
			return false;	
		}
		
		return true;
	});
	$('#register').click(function () {		
		
		var firstName = $('input[name=FName]');
		var lastName = $('input[name=LName]');
		var contact = $('input[name=Contact]');
		var email = $('input[name=Email]');
		var regx = /^([a-z0-9_\-\.])+\@([a-z0-9_\-\.])+\.([a-z]{2,4})$/i;
		var gender = $('input[name=Gender]');
		var role = $('input[name=Role]');
		var password = $('input[name=Password]');
		var confirmPassword = $('input[name=ConfirmPassword]');
		var BD = $('input[name=DOB]');
		var Profession = $('input[name=Profession]');
		var address = $('textarea[name=Address]');


		var returnError = false;
		
		if (firstName.val()=='') {
			firstName.addClass('error');
			returnError = true;
		} else firstName.removeClass('error');

		if (lastName.val()=='') {
			lastName.addClass('error');
			returnError = true;
		} else lastName.removeClass('error');
		
		if (email.val()=='') {
			email.addClass('error');
			returnError = true;
		} else email.removeClass('error');		
		
		if(!regx.test(email.val())){
          email.addClass('error');
          returnError = true;
		} else email.removeClass('error');

		if (contact.val()=='') {
			contact.addClass('error');
			returnError = true;
		} else contact.removeClass('error');

		if (gender.val()=='') {
			gender.addClass('error');
			returnError = true;
		} else gender.removeClass('error');

		if (role.val()=='') {
			role.addClass('error');
			returnError = true;
		} else role.removeClass('error');

		if (password.val()=='') {
			password.addClass('error');
			returnError = true;
		} else password.removeClass('error');

		if (confirmPassword.val()=='') {
			confirmPassword.addClass('error');
			returnError = true;
		} else confirmPassword.removeClass('error');

		if(confirmPassword.val() != password.val()){
			confirmPassword.addClass('error');
			returnError = true;
		} else confirmPassword.removeClass('error');

		if (BD.val()=='') {
			BD.addClass('error');
			returnError = true;
		} else BD.removeClass('error');

		if (Profession.val()=='') {
			Profession.addClass('error');
			returnError = true;
		} else Profession.removeClass('error');

		if (address.val()=='') {
			address.addClass('error');
			returnError = true;
		} else address.removeClass('error');
		
		if(returnError == true){
			return false;	
		}
		
		return true;
	});
	$('BIT').click(function(){
		var price = $('input[name=Price]');


		if (price.val()=='') {
			price.addClass('error');
			returnError = true;
		} else price.removeClass('error');

		return true;
	});
});	