$(document).ready(function() {
	// save research
	$('#btn-save-keyword').click(function(e) {
		var keyword = $('input[name=keyword]').val();
		var name = $('input[name=research_name]').val();

		$.ajax({
			type: 'POST',
			url: $('form[name=frmSaveKeyword]').attr('action'),
			data: {'name':name, 'keyword':keyword, '_token':$('meta[name="csrf-token"]').attr('content')},
			success:function(result) {
				if (result.code == 200) {
					toastr['success'](result.message);
					setTimeout(function() {
        				window.location.reload();
        			}, 800)
				}
				if (typeof result.errors != 'undefined') {
					$.each(result.errors, function(key,value) {
				     	toastr['error'](value);
				    }); 
				}
			},
			error: function (xhr) {
				console.log(xhr)
				if (typeof xhr.responseJSON.errors != 'undefined') {
				    $.each(xhr.responseJSON.errors, function(key,value) {
				     	toastr['error'](value);
				    }); 
				}
			},
		})
	});

	//destroy research
	$('.destroy-research').click(function() {
		var id = $(this).data('id');
		var url = $(this).data('url');

		$.ajax({
			type: 'DELETE',
			url: url,
			data: {'id':id, '_token':$('meta[name="csrf-token"]').attr('content')},
			success:function(result){
				if (result) {
					window.location.reload();
				}
			}
		})
	})
})