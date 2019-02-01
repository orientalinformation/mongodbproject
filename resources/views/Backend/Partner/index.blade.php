@extends('Backend.layout.master')

@section('content-title')

@endsection

@section('content')
    <div class="br-section-wrapper">
        @include('Backend.partials.alerts')
        <div class="row">
            <div class="col-md-6 tx-left">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <i class="icon ion-person-stalker" aria-hidden="true"></i>
                    <span class="menu-item-label">{{ __('left-panel.partnerManagement') }}</span>
                </h1>
            </div>
            <div class="col-md-6 tx-right">
                <a href="{{ route('partners.create') }}" class="btn btn-teal mg-b-20 pd-r-20">
                    <i class="fa fa-plus mg-r-5"></i> {{ __('partner.addPartner') }}
                </a>
            </div>
        </div>
        <div class="table-responsive"> 
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-colored thead-primary">
                    <tr>
                        <th>{{ __('partner.number') }}</th>
                        <th>{{ __('partner.name') }}</th>
                        <th>{{ __('partner.address') }}</th>
                        <th>{{ __('partner.webPage') }}</th>
                        <th>{{ __('partner.date') }}</th>
                        <th>{{ __('partner.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 0; ?>
                    @foreach($partners as $partner)
                        <tr>
                            <th class="tx-right" scope="row"> {{ $index += 1 }}</th>
                            <td>{{ $partner->name }}</td>
                            <td>{{ $partner->address }}</td>
                            <td>{{ $partner->web }}</td>
                            <td>{{ date("Y/m/d H:i:s", strtotime($partner->updated_at)) }}</td>
                            <td>                       
                                <a href="{{ route('partners.edit', $partner->id) }}" data-url="" class="btn btn-primary" id="btn_edit" title="{{ __('Edit') }}">
                                    <i class="fa fa-pencil"  aria-hidden="true"></i>
                                </a>
                                &nbsp;
                                <a href="javascript:void(0)" data-id="{{ $partner->id }}" class="btn btn-danger delete"  id="btn-delete" title="{{ __('Delete') }}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="ht-80 d-flex align-items-center justify-content-center">
                {{ $partners->links() }}
            </div>            
        </div>
    </div><!-- br-section-wrapper -->
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
                    <form action="{{route('partners.index')}}" id="form_delete" method="POST">
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
@endsection

@section('script')
    <script>
        $('td').on('click', '.delete', function (e) {
            $('#form_delete')[0].action = '{{ route('partners.destroy', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));            
            $('#delete_modal').modal('show');
        });              
   </script>        
@endsection    