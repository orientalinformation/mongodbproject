$('.menu-tooltips').click(function(){
	let type = $(this).data('type');
    let display = $(this).closest(".wrap").find(".content-panel");
    let bookID = $(this).closest(".wrap").find(".bookID").val();
    let heart = $(this).closest(".wrap").find(".likeIcon");
    let read = $(this).closest(".wrap").find(".readIcon");
    let share = $(this).closest(".wrap").find(".shareIcon");
    if(display.css("display") == "none"){
        display.css("display","block");
        $.ajax({
            url: "{{ URL::to('/') }}/check_liked",
            cache: false,
            type: "GET",
            data: {user_id: 1, book_id: bookID},
            success: function(result){
                result = JSON.parse(result);
                if(result.status == 1){
                    heart.removeClass("fa-heart-o");
                    heart.addClass("fa-heart");
                }else{
                    heart.addClass("fa-heart-o");
                    heart.removeClass("fa-heart");
                }
            }
        });
        $.ajax({
            url: "{{ URL::to('/') }}/check_read",
            cache: false,
            type: "GET",
            data: {user_id: 1, object_id: bookID},
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
            url: "{{ URL::to('/') }}/check_share",
            cache: false,
            type: "GET",
            data: {user_id: 1, book_id: bookID},
            success: function(result){
                result = JSON.parse(result);
                if(result.status == 1){
                    share.css('color','blue')
                }else{
                    share.css('color','black')
                }
            }
        });
    }else{
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
	let type = $(this).parent('content-panel').data('type');
    let bookID = $(this).closest(".wrap").find(".bookID").val();
    let heart = $(this).closest(".wrap").find(".likeIcon");
    $.ajax({
        url: "{{ URL::to('/') }}/check_liked",
        cache: false,
        type: "GET",
        data: {user_id: 1, book_id: bookID, change: 1},
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
	let type = $(this).parent('content-panel').data('type');
    let bookID = $(this).closest(".wrap").find(".bookID").val();
    let read = $(this).closest(".wrap").find(".readIcon");
    $.ajax({
        url: "{{ URL::to('/') }}/check_read",
        cache: false,
        type: "GET",
        data: {user_id: 1, object_id: bookID, change: 1},
        success: function(result){
            result = JSON.parse(result);
            if(result.status == 1){
                read.removeClass("fa-bookmark");
                read.addClass("fa-bookmark-o");
            }else if(result.status == 2) {
                read.removeClass("fa-bookmark-o");
                read.addClass("fa-bookmark");
            }
        }
    });
})
$('.list-line').click(function(){
	let type = $(this).parent('content-panel').data('type');
    let bookID = $(this).closest(".wrap").find(".bookID").val();
    let itemList = $('.itemList');
    $("#libraryList").find("#bookID-modal").val(bookID);
    // itemList.parent().remove();
    itemList.map(function(){
        let library_id = $(this).attr('attr-data');
        let library_item = $(this);
        $.ajax({
            url: "{{ URL::to('/') }}/check_list",
            cache: false,
            type: "GET",
            data: {library_id: library_id, object_id: bookID},
            success: function(result){
                result = JSON.parse(result);
                console.log(result);
                if(result.status == 1){
                    // itemList.parent().append('<input type="checkbok">');
                    library_item.attr('checked','checked');
                }
            }
        });
    })
})
$('.itemList').click(function(){
	let type = $(this).parent('content-panel').data('type');
    let bookID = $(this).closest(".modal-body").find("#bookID-modal").val();
    let library_id = $(this).attr('attr-data');
    $.ajax({
        url: "{{ URL::to('/') }}/update_list",
        cache: false,
        type: "GET",
        data: {library_id: library_id, object_id: bookID},
        success: function(result){
            result = JSON.parse(result);
        }
    });
})
$('.create-line').click(function(){
	let type = $(this).parent('content-panel').data('type');
    $('input').val('');
    $('.alertCreatelist').hide();
    $('.btnCreateLibrary').click(function(){
        let name = $('#nameLibrary').val();

        $.ajax({
            url: "{{ URL::to('/') }}/create_list",
            cache: false,
            type: "GET",
            data: {user_id: "1", name: name},
            success: function(result){
                result = JSON.parse(result);
                if(result.status == 1){
                    $('.alertCreatelist').text("create success");
                    $('.alertCreatelist').show();
                }else{
                    $('.alertCreatelist').text(result.data);
                    $('.alertCreatelist').show();
                }
            }
        });
    })
})
$('.share-line').click(function(){
	let type = $(this).parent('content-panel').data('type');
    let bookID = $(this).closest(".wrap").find(".bookID").val();
    let share = $(this).closest(".wrap").find(".shareIcon");
    $.ajax({
        url: "{{ URL::to('/') }}/check_share",
        cache: false,
        type: "GET",
        data: {user_id: 1, book_id: bookID, change: 1},
        success: function(result){
            result = JSON.parse(result);
            if(result.status == 1){
                share.css('color','black');
            }else if(result.status == 2) {
                share.css('color','blue');
            }
        }
    });
})