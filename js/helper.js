jQuery(document).ready(function ($) {



	$('select#formselector').on('change', function() {
		// $this.val().find('div');
		var myId = $('select#formselector option').filter(':selected').val()
		$('#gf-form-id input').val(myId);
		console.log( myId );
	  
	});

});// END #####################################    END