$('.menu-tooltips').click(function(){
    $('.alert-success-library').hide();
    $('.alert-success-library').text("");
    $('.alert-danger-library').hide();
    $('.alert-danger-library').text("");

    var type = $(this).closest('.box-toolips').data('type');
    var id = $(this).closest('.box-toolips').data('id');
    var display = $(this).closest(".box-toolips").find(".content-panel");
    var heart = $(this).closest(".box-toolips").find(".likeIcon");
    var read = $(this).closest(".box-toolips").find(".readIcon");
    var share = $(this).closest(".box-toolips").find(".shareIcon");
    var pink = $(this).closest(".box-toolips").find(".pinkIcon");
    $('.content-panel').hide();
    heart.addClass("fa-heart-o");
    read.addClass("fa-bookmark-o");
    share.css('color','black');
    pink.css('color','black');
    if(display.hide()){
        display.show();
    } else {
        display.hide();
    }

    $.ajax({
        type: 'POST',
        url: '/ajax/getObjectDataDetail',
        data: {'id':id, 'type':type, '_token':$('meta[name="csrf-token"]').attr('content')},
        success:function(result) {
            if (result.like == 1) {
                heart.removeClass("fa-heart-o");
                heart.addClass("fa-heart");
            }

            if (result.read == 1) {
                read.removeClass("fa-bookmark-o");
                read.addClass("fa-bookmark");
            }

            if (result.share == 1) {
                share.css('color','red');
            }

            if (result.pink == 1) {
                pink.css('color','red');
            }
        }
    });
});

$('.object-tooltip').click(function() {
    var type = $(this).closest('.box-toolips').data('type');
    var id = $(this).closest('.box-toolips').data('id');
    var element = $(this).data('element');
    var heart = $(this).closest(".box-toolips").find(".likeIcon");
    var read = $(this).closest(".box-toolips").find(".readIcon");
    var share = $(this).closest(".box-toolips").find(".shareIcon");
    var pink = $(this).closest(".box-toolips").find(".pinkIcon");

    $.ajax({
        type: 'POST',
        url: '/ajax/setObjectDataDetail',
        data: {'id':id, 'type':type, 'element':element, '_token':$('meta[name="csrf-token"]').attr('content')},
        success:function(result) {
            if (result.status == 1) {
                switch (element) {
                    case 'like':
                        heart.removeClass("fa-heart-o");
                        heart.addClass("fa-heart");
                        break;

                    case 'read':
                        read.removeClass("fa-bookmark-o");
                        read.addClass("fa-bookmark");
                        break;

                    case 'share':
                        share.css('color','red');
                        break;

                    case 'pink':
                        pink.css('color','red');
                        break;
                }
            } else {
                switch (element) {
                    case 'like':
                        heart.removeClass("fa-heart");
                        heart.addClass("fa-heart-o");
                        break;

                    case 'read':
                        read.removeClass("fa-bookmark");
                        read.addClass("fa-bookmark-o");
                        break;

                    case 'share':
                        share.css('color','black');
                        break;

                    case 'pink':
                        pink.css('color','black');
                        break;
                }
            }
        }
    });
})


$(document).mouseup(function (e) {
    var popup = $(".content-panel");
    if (!$('.menu-tooltips').is(e.target) && !popup.is(e.target) && popup.has(e.target).length == 0) {
        popup.hide(500);
    }
});

function updateList(library_id,bookID){
    // let bookID = $(obj).closest(".modal-body").find("#bookID-modal").val();
    // let library_id = $(obj).attr('attr-data');
    console.log(bookID);
    console.log(library_id);
    $.ajax({
        url  : '/update_list',
        cache: false,
        type : "GET",
        data : { library_id: library_id, object_id: bookID },
        success: function(result) {
            console.log(result);
        }
    });
}

$('.list-line').click(function(){
    let bookID = $(this).closest(".wrap").find(".bookID").val();
    $.ajax({
        url: "/library_checked_list",
        cache: false,
        type: "GET",
        data: {object_id: bookID},
        success: function(result){
            result = JSON.parse(result);
            if(result['status'] == 1) {
                let data = result['data'];
                let data_html = "";
                data.map(function(item){
                    let checked = '';
                    if(item['checked'] == 1){
                        checked = 'checked';
                    }
                    data_html += '<div class="input-group listWrap">';
                    data_html += '<input onclick="updateList(\'' + item['id'] + '\',\'' + bookID + '\')" type="checkbox" name="itemList" class="itemList" attr-data="' + item['id'] + '" ' + checked + '><label>' + item['title'] + '</label>';
                    data_html += '</div>';
                })
                $('#body-libraryList').html(data_html);
            }
        }
    });
})

