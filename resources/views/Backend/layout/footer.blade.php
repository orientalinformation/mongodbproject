<script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script>
<script src="{{ asset('/assets/lib/popper.js/popper.js') }}"></script>
<script src="{{ asset('/assets/lib/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('/assets//lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
<script src="{{ asset('/assets/lib/moment/moment.js') }}"></script>
<script src="{{ asset('/assets/lib/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('/assets/lib/jquery-switchbutton/jquery.switchButton.js') }}"></script>
<script src="{{ asset('/assets/lib/peity/jquery.peity.js') }}"></script>
<script src="{{ asset('/assets/lib/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('/assets/lib/medium-editor/medium-editor.js') }}"></script>
<script src="{{ asset('/assets/lib/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('/js/plugins/bootstrap-alert.js') }}"></script>
<!-- Plugins -->

<script src="{{ asset('/assets/js/jquery.safeform.js') }}"></script>
<script src="{{ asset('/assets/js/sfunction.js') }}"></script>
<script src="{{ asset('/js/alert-close.js') }}"></script>
<script src="{{ asset('/assets/js/bracket.js') }}"></script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        // Datepicker
        $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });            
    });

    // $(document).on('click', '#btn_sub_update_profile', function(e) {

    //         $('#form_update_profile').find(".error").remove();

    //         var form = $('#form_update_profile');
    //         var profileFullname = form.find("#profile_fullname").val();
    //         var profileEmail = form.find("#profile_email").val();
    //         form.find("#fullname").removeClass('is-invalid');
    //         form.find("#email").removeClass('is-invalid');
    //         form.find(".error").remove();

    //         if (profileFullname.length < 1 || !profileFullname.trim()) {
    //             form.find("#profile_fullname").addClass('is-invalid');
    //             form.find("#profile_fullname").after('<p class="error text-danger">This field is required.</p>');
    //             return false;
    //         }

    //         if (profileEmail.length < 1 || !profileEmail.trim()) {
    //             form.find("#profile_email").addClass('is-invalid');
    //             form.find("#profile_email").after('<p class="error text-danger">This field is required.</p>');
    //             return false;
    //         }

    //         if (IsEmail(profileEmail) == false) {
    //             form.find("#profile_email").addClass('is-invalid');
    //             form.find("#profile_email").after('<p class="error text-danger">Email is invalid.</p>');
    //             return false;
    //         }

    //         $.ajax({
    //             type: 'PUT',
    //             url: $("#form_update_profile").attr("action"),
    //             data: $("#form_update_profile").serialize(), 
    //             success: function(response) {
    //                 var response = JSON.parse(JSON.stringify(response))

    //                 if (response.type == 'error') {
    //                     $('#profile_error_text_modal').text('Error: ' + response.messages);
    //                     $('#profile_error_modal').modal('show');
    //                 } else {
    //                     window.location.reload();
    //                 } 
    //             },
    //         });

    //         // $('#form_update_profile').submit();        
    // }); 

    // function IsEmail(email) {
    //     var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    //     if  (!regex.test(email)) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
</script>