$(document).ready(function() {
	saveSearchKeyword();
	removeSearchKey();
	searchBibliotheque();
})

// save research
function saveSearchKeyword() {
	$('#btn_save_search_keyword').click(function(e) {
		$(this).prop('disabled', true);
		var keyword = $('input[name=q]').val();
		var name = $('input[name=research_name]').val();
		toastr.options = {
			"preventDuplicates": true
		};
		$.ajax({
			type: 'POST',
			url: $('form[name=frmSaveKeyword]').attr('action'),
			data: {'name':name, 'keyword':keyword, '_token':$('meta[name="csrf-token"]').attr('content')},
			success:function(result) {
				$('#btn_save_search_keyword').prop('disabled', false);
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
				$('#btn_save_search_keyword').prop('disabled', false);
				console.log(xhr)
				if (typeof xhr.responseJSON.errors != 'undefined') {
				    $.each(xhr.responseJSON.errors, function(key,value) {
				     	toastr['error'](value);
				    }); 
				}
			},
		})
	});
}
	
//destroy research
function removeSearchKey() {
	$('.keyword-action').click(function() {
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
}

function searchBibliotheque() {
	$('input.input-category-two').change(function() {
		var id = $(this).data('id');
		if (this.checked) {
			$('input.input-category-three-' + id).prop('checked', true);	
		} else {
			$('input.input-category-three-' + id).prop('checked', false);
		}
		
	});

	$('input.input-category-three').change(function() {
		var parentId = $(this).data('parent');
		if (!this.checked) {
			$('input#input-category-two-' + parentId).prop('checked', false);
		}
		
	});

	$('form[name=frmSearchbibliotheque]').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) { 
		e.preventDefault();
		return false;
		}
	});

	$('#btn_search_advance').click(function(e) {
		e.preventDefault();
		$(this).prop('disabled', true);
		toastr.options = {
			"preventDuplicates": true
		};
		var form = $('form[name=frmSearchbibliotheque]');
		var q = form.find('input[name=q]').val();

		if (q == '') {
			toastr['error']('Le champ de q est obligatoire.');
			form.find('input[name=q]').focus();
			$('#btn_search_advance').prop('disabled', false);
			return false;
		}

		$.ajax({
			type: 'POST',
			url: $('form[name=frmSearchbibliotheque]').attr('action'),
			data: form.serialize(),
			success:function(result) {
				$('#btn_search_advance').prop('disabled', false);
				if (result.code == 200) {
					setTimeout(function() {
        				window.location.href = result.url;
        			}, 800)
				}
				if (typeof result.errors != 'undefined') {
					$.each(result.errors, function(key,value) {
						 toastr['error'](value);
						 $('#btn_search_advance').prop('disabled', false);
				    }); 
				}
			},
			error: function (xhr) {
				$('#btn_search_advance').prop('disabled', false);
				console.log(xhr)
				if (typeof xhr.responseJSON.errors != 'undefined') {
				    $.each(xhr.responseJSON.errors, function(key,value) {
						 toastr['error'](value);
				    }); 
				}
			},
		})
	})
}