/**
 * Created by TRIEU NGUYEN on 18/01/2019.
 */

function submit_from_data() {
    $('.submit-form').safeform({
        timeout:2000,
        submit:function (event) {
            event.preventDefault();
            var $form = $(this);
            var action = $form.attr('action');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'html',
                data: formData,
                processData: false,
                contentType: false,

            }).done(function (response) {
                console.log(response);
                // var message = JSON.parse(response);
                // $.each(message, function () {
                //
                // });
                window.location.reload();
            }).fail(function (messages) {
                var errors = $.parseJSON(messages.responseText);

                $.each(errors.errors, function(index, value) {
                   $('.' + index).text(value);
                });
            })

        }
    });
}


