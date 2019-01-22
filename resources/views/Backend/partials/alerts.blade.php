@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-dismissible fade show alert-close" role="alert">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endforeach
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show alert-close" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
        <span aria-hidden="true">&times;</span>
    </button>
</div>            
@endif 