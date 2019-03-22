$(document).ready(function() {
	targetKeyword();
	saveKeyword();
	destroyResearch();
	searchAdvance();
})

function targetKeyword() {
	var formSearchNormal = $('form[name=frmSearchNormal]');
	var formSearchAdvance = $('form[name=frmSearchAdvance]');
	
	formSearchNormal.find('input[name=q]').keyup(function() {
		var qValue = formSearchNormal.find('input[name=q]').val();
		formSearchAdvance.find('input[name=q]').val(qValue);
	})
}

// save research
function saveKeyword() {
	$('#btn-save-keyword').click(function(e) {
		var keyword = $('input[name=q]').val();
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
}
	
//destroy research
function destroyResearch() {
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
}

function searchAdvance() {
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

	$('form[name=frmSearchAdvance]').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) { 
		e.preventDefault();
		return false;
		}
	});

	$('#btn-search-advance').click(function(e) {
		e.preventDefault();
		var form = $('form[name=frmSearchAdvance]');

		$.ajax({
			type: 'POST',
			url: $('form[name=frmSearchAdvance]').attr('action'),
			data: form.serialize(),
			success:function(result) {
				if (result.code == 200) {
					setTimeout(function() {
        				window.location.href = result.url;
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
	})
}