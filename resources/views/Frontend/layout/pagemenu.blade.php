<ul class="horizontal-menu-library pull-left">
    <li> <a href="#">Toutes</a></li>
    <li@php if ($controller == 'WebController') echo ' class="active"'; @endphp> <a href="/web">Web</a></li>
    <li@php if ($controller == 'BookController') echo ' class="active"'; @endphp> <a href="/book">Étude/Synthese</a></li>
    <li@php if ($controller == 'ProductController') echo ' class="active"'; @endphp> <a href="{{ route('frontProduct') }}">Produit</a></li>
    <li> <a href="#">Preporting/Evenement</a></li>
    <li@php if ($controller == 'LibraryController') echo ' class="active"'; @endphp> <a href="{{ route('frontBibliotheque') }}">Librairie Compagnons</a></li>
</ul>
@if (app('request')->input('q') != '')
<div class="btn-research pull-right">
    <a href="#" class="btn btn-warning text-uppercase" data-toggle="modal" data-target=".bd-save-keyword-modal-md"><i class="fa fa-level-down" aria-hidden="true"></i> @lang('common.saveSearch')</a>
</div>
@endif