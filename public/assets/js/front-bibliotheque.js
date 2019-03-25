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

// search advance action
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


$('.menu-tooltips').click(function() {
	let type = $(this).data('type');
	let display = $(this).closest(".wrap").find(".content-panel");
	let libraryId = $(this).closest(".wrap").find(".bibliotheque-id").val();
	let heart = $(this).closest(".wrap").find(".likeIcon");
	let read = $(this).closest(".wrap").find(".readIcon");
	let share = $(this).closest(".wrap").find(".shareIcon");
	let pin  = $(this).closest(".wrap").find(".pinkIcon");
	let url = '/' + type + '/';
	var pink = $(this).closest(".box-toolips").find(".pinkIcon");
	if(display.css("display") == "none") {
		display.css("display","block");
		$.ajax({
			url: url + 'check_liked',
			cache: false,
			type: "GET",
			data: {user_id: 1, library_id: libraryId},
			success: function(result) {
				result = JSON.parse(result);
				// console.log(result);
				if(result.status == 1) {
					heart.removeClass("fa-heart-o");
					heart.addClass("fa-heart");
				} else {
					heart.addClass("fa-heart-o");
					heart.removeClass("fa-heart");
				}
			}
		});

		$.ajax({
			url: url + "check_read",
			cache: false,
			type: "GET",
			data: {user_id: 1, library_id: libraryId},
			success: function(result){
				result = JSON.parse(result);
				if(result.status == 1){
					read.removeClass("fa-bookmark-o");
					read.addClass("fa-bookmark");
				}else{
					read.addClass("fa-bookmark-o");
					read.removeClass("fa-bookmark");
				}
			}
		});

		$.ajax({
            url: url + "check_share",
            cache: false,
            type: "GET",
            data: { object_id: libraryId },
            success: function(result) {
				console.log(result);
				
                if(result.status == 1) {
                    share.css('color','red')
                } else {
                    share.css('color','black')
                }
            }
		});
		
		$.ajax({
            url: url + "check_pin",
            cache: false,
            type: "GET",
            data: { object_id: libraryId },
            success: function(result) {
				console.log(result);
                if(result.status == 1) {
                    pin.css('color','red')
                } else {
                    pin.css('color','black')
                }
            }
		});
		
	} else {
		display.css("display","none");
	}
})
$(document).mouseup(function (e) {
	var popup = $(".content-panel");
	if (!$('.menu-tooltips').is(e.target) && !popup.is(e.target) && popup.has(e.target).length == 0) {
		popup.hide(500);
	}
});
$('.like-line').click(function(){
	let type = $(this).parent('.content-panel').data('type');
    let libraryId = $(this).closest(".wrap").find(".bibliotheque-id").val();
    let heart = $(this).closest(".wrap").find(".likeIcon");
	let url = '/' + type + '/';
	
	$.ajax({
		url: url + 'check_liked',
		cache: false,
		type: "GET",
		data: {user_id: 1, library_id: libraryId, change: 1},
		success: function(result){
			result = JSON.parse(result);
			if(result.status == 1){
				heart.removeClass("fa-heart");
				heart.addClass("fa-heart-o");
			}else if(result.status == 2) {
				heart.removeClass("fa-heart-o");
				heart.addClass("fa-heart");
			}
		}
	});
})
$('.read-line').click(function(){
	let type = $(this).parent('.content-panel').data('type');
	let libraryId = $(this).closest(".wrap").find(".bibliotheque-id").val();
	let read = $(this).closest(".wrap").find(".readIcon");
    let url = '/' + type + '/';
	$.ajax({
		url: url + "check_read",
		cache: false,
		type: "GET",
		data: {user_id: 1, library_id: libraryId, change: 1},
		success: function(result) {
			result = JSON.parse(result);
			console.log(result.status);
			if(result.status == 1) {
				read.removeClass("fa-bookmark");
				read.addClass("fa-bookmark-o");
			} else if(result.status == 2) {
				read.removeClass("fa-bookmark-o");
				read.addClass("fa-bookmark");
			}
		}
	});
})


$('.list-line').click(function(){
	let type = $(this).parent('.content-panel').data('type');
	let bookID = $(this).closest(".wrap").find("#bibliotheque_id").val();
	// let bookID = $(this).closest(".wrap").find(".bookID").val();
    let itemList = $('.itemList');
    let url = '/' + type + '/';
    $("#libraryList").find("#bookID-modal").val(bookID);
    // itemList.parent().remove();
    itemList.map(function() {
        let library_id = $(this).attr('attr-data');
        let library_item = $(this);
        $.ajax({
            url: url + "check_list",
            cache: false,
            type: "GET",
            data: {library_id: library_id, object_id: bookID},
            success: function(result){
                if(result.status == 1) {
                    // itemList.parent().append('<input type="checkbok">');
                    library_item.attr('checked','checked');
                }
            }
        });
    })
})

$('.itemList').click(function(){
	let type = $(this).data('type');
	let bookID = $(this).closest(".modal-body").find("#bookID-modal").val();
    let library_id = $(this).attr('attr-data');
	let url = '/' + type + '/';
	console.log(bookID);
	
    $.ajax({
        url  : url + 'update_list',
        cache: false,
        type : "GET",
        data : { library_id: library_id, object_id: bookID },
        success: function(result) {
            console.log(result);
        }
    });
})

// create a library
$('.create-line').click(function() {
	let type = $(this).parent('.content-panel').data('type');
    let url = '/' + type + '/';
    $('input').val('');
    $('.alertCreatelist').hide();
    $('.btnCreateLibrary').click(function() {
        let name = $('#nameLibrary').val();

        $.ajax({
            url: url + "create_list",
            cache: false,
            type: "GET",
            data: {name: name},
            success: function(result) {
                if(result.status == 1) {
                    $('.alertCreatelist').text("create success");
                    $('.alertCreatelist').show();
                } else {
                    $('.alertCreatelist').text(result.data);
                    $('.alertCreatelist').show();
                }
            }
        });
    })
})

$('.share-line').click(function() {
	let type   = $(this).parent('.content-panel').data('type');
    let bookID = $(this).closest(".wrap").find(".bibliotheque-id").val();
    let share  = $(this).closest(".wrap").find(".shareIcon");
    let url    = '/' + type + '/';
    $.ajax({
        url: url + "check_share",
        cache: false,
        type: "GET",
        data: { object_id: bookID, change: 1 },
        success: function(result) {
            if(result.status == 1) {
                share.css('color','black');
            } else if(result.status == 2) {
                share.css('color','red');
            }
        }
    });
})

$('.pink-line').click(function() {
	let type   = $(this).parent('.content-panel').data('type');
    let bookID = $(this).closest(".wrap").find(".bibliotheque-id").val();
    let pin  = $(this).closest(".wrap").find(".pinkIcon");
    let url    = '/' + type + '/';
    $.ajax({
        url: url + "check_pin",
        cache: false,
        type: "GET",
        data: { user_id: 1, object_id: bookID, change: 1 },
        success: function(result) {
            if(result.status == 1) {
                pin.css('color','black');
            } else if(result.status == 2) {
                pin.css('color','red');
            }
        }
    });
})
