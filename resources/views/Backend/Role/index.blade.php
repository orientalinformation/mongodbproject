@extends('Backend.layout.master')

@section('content-title')

@endsection

@section('content')
    <div class="br-section-wrapper">
        @include('Backend.partials.alerts')
        <div class="row">
            <div class="col-md-6 tx-left">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <i class="fa fa-inbox" aria-hidden="true"></i>
                    <span class="menu-item-label">{{ __('List Roles') }}</span>
                </h1>
            </div>
            <div class="col-md-6 tx-right">
                <button class="btn btn-teal mg-b-20 pd-r-20" data-toggle="modal" data-target="#create_role_modal">
                    <i class="fa fa-plus mg-r-5"></i> {{ __('Add role') }}
                </button>
            </div>
        </div>
        <div class="table-responsive"> 
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-colored thead-primary">
                    <tr>
                        <th>{{ __('No.') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Display Name') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th>{{ __('Updated at') }}</th>
                        <th class="tx-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 0; ?>
                    @foreach($roles as $role)
                        <tr>
                            <th class="tx-right" scope="row"> {{ $index += 1 }}</th>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ date("Y/m/d", strtotime($role->created_at)) }}</td>
                            <td>{{ date("Y/m/d", strtotime($role->updated_at)) }}</td>
                            <td class="tx-18 tx-center">
                                <a href="{{ route('roles.choosePermission', $role->id) }}" class="btn btn-warning" id="btn_choose_permission" title="{{ __('Choose permission') }}">
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                </a>
                                &nbsp;                            
                                <a href="javascript:void(0)" data-url="{{ route('roles.edit', $role->id) }}" class="btn btn-primary" id="btn_edit" title="{{ __('Edit') }}">
                                    <i class="fa fa-pencil"  aria-hidden="true"></i>
                                </a>
                                &nbsp;
                                <a href="javascript:void(0)" data-id="{{ $role->id }}" class="btn btn-danger delete"  id="btn-delete" title="{{ __('Delete') }}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="ht-80 d-flex align-items-center justify-content-center">
                {{ $roles->links() }}
            </div>            
        </div>
    </div><!-- br-section-wrapper -->

    <!-- Create modal -->
    <div id="create_role_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-vertical-center" role="document">
            <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{ __('Create Role') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-25">
                    <form id="form_create" action="{{route('roles.store')}}" method="POST">
                        {{ method_field("POST") }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label tx-bold">{{ __('Name') }}</label>
                                    <input type="text" id="name" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label tx-bold">{{ __('Display Name') }}</label>
                                    <input type="text" id="display_name" class="form-control" name="display_name" required>
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>
                <div class="modal-footer">
                    <button id="btn_sub_create" type="button" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
                        {{ __('Create') }}
                    </button>
                    <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- END Create modal -->    

    <!-- Edit modal -->
    <div id="update_role_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-vertical-center" role="document">
            <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{ __('Update Role') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-25">
                    <form id="form_update" action="{{route('roles.index')}}" method="POST">
                        {{ method_field("PUT") }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label tx-bold">{{ __('Name') }}</label>
                                    <input type="text" id="name" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label tx-bold">{{ __('Display Name') }}</label>
                                    <input type="text" id="display_name" class="form-control" name="display_name" required>
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>
                <div class="modal-footer">
                    <button id="btn_sub_update" type="button" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
                        {{ __('Update') }} 
                    </button>
                    <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- END Edit modal -->

    <!-- Single delete modal -->
    <div class="modal fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content bd-0">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h4 class="tx-16 mg-b-0 tx-uppercase tx-inverse tx-bold">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        {{ __('Are you sure you want to delete this ?') }}
                    </h4>
                </div>
                <div class="modal-footer">
                    <form action="{{route('roles.index')}}" id="form_delete" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger float-right delete-confirm" value="{{ __('Yes, Delete it!') }}">
                    </form>
                    <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->    

    <!-- Error modal -->
    <div id="error_modal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger tx-semibold mg-b-20" id="error_text_modal"></h4>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- END Error modal -->
@endsection

@section('script')
    <script>
        $(document).on('click', '#btn_sub_create', function(e) {
            $('#form_create').find(".error").remove();
            submitFormCreateOrUpdate('form_create');
        });

        $(document).on('click', '#btn_sub_update', function(e) {
            $('#form_update').find(".error").remove();
            submitFormCreateOrUpdate('form_update');
        });        

        $('td').on('click', '.delete', function (e) {
            $('#form_delete')[0].action = '{{ route('roles.destroy', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));            
            $('#delete_modal').modal('show');
        });

        $(document).on('click', '#btn_edit', function() {
            var url = $(this).data().url;
            var form = $('#form_update');
            form.find("#name").val('').removeClass('is-invalid');
            form.find("#display_name").val('').removeClass('is-invalid');
            form.find(".error").remove();

            $.ajax({
                url : url,
                method : "GET",
                data : {_token:"{{csrf_token()}}" },
                dataType : "text",
                success : function (data) {
                    var data = JSON.parse(data);

                    if (data.type == 'error') {
                        $('#error_text_modal').text('Error: ' + data.messages);
                        $('#error_modal').modal('show');
                    } else {
                        var action = form[0].action;
                        form[0].action = '{{ route('roles.update', ['id' => '__id']) }}'.replace('__id', data.data['id']);
                        form.find("#name").val(data.data['name']);
                        form.find("#display_name").val(data.data['display_name']);
                        $('#update_role_modal').modal('show');
                    }
                }
            });
        });

        function submitFormCreateOrUpdate(idForm) {
            var form = $('#'+idForm);
            var name = form.find("#name").val();
            var displayName = form.find("#display_name").val();
            form.find("#name").removeClass('is-invalid');
            form.find("#display_name").removeClass('is-invalid');
            form.find(".error").remove();

            if (name.length < 1 || !name.trim()) {
                form.find("#name").addClass('is-invalid');
                form.find("#name").after('<p class="error text-danger">This field is required</p>');
                return false;
            }

            if (displayName.length < 1 || !displayName.trim()) {
                form.find("#display_name").addClass('is-invalid');
                form.find("#display_name").after('<p class="error text-danger">This field is required</p>');
                return false;
            }

            $('#'+idForm).submit();
        }                 
   </script>        
@endsection    