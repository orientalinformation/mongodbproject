$(document).ready(function() {
	$('#btn-save-keyword').click(function() {
		$.toast({
		    heading: 'Error',
		    text: 'You must enter a name',
		    showHideTransition: 'fade',
		    icon: 'error',
		    position: 'top-center',
		})
	})
})