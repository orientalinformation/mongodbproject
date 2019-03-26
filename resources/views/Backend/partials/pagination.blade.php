<?php
$flag = false;
$checkShowPage = false;
$limitPage = 6;

if ($paginate['pageNum'] > $limitPage) {
    $leftLimitPage =3;
    $rightLimitPage = $paginate['pageNum'] - 2;
    if ($paginate['page'] >= $leftLimitPage && $paginate['page'] <= $limitPage) {
        $leftLimitPage = $paginate['page'] + 1;
    }
    if (($paginate['pageNum'] - $paginate['page']) <= $limitPage) {
        $rightLimitPage = $paginate['page'] - 1;
    } elseif (($paginate['pageNum'] - $paginate['page']) > $limitPage && $paginate['page'] > $limitPage) {
        $flag = true;
    }
    $checkShowPage = true;
} else {
    $leftLimitPage = $paginate['pageNum'];
}
?>

<div class="ht-80 d-flex align-items-center justify-content-center float-right">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-basic mg-b-0">
            @if (!is_null($paginate['prev']))
                <li class="page-item">
                    <a class="page-link" href="{{ $paginate['prev'] }}" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                </li>
            @endif
            @if($leftLimitPage > 1)
                @for( $i = 1; $i <= $leftLimitPage; $i++)
                    <li class="page-item {{ ($paginate['page'] == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginate['page'] == $i ? '#' : ($paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . $i) }}" class="" > {{ $i }}</a>
                    </li>
                @endfor
            @endif

            @if($flag)
                <li class="page-item disabled"><span class="page-link">...</span></li>
                <li class="page-item">
                    <a class="page-link" href="{{ $paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . ($paginate['page'] - 1) }}" class="" > {{ $paginate['page'] - 1 }}</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#"> {{ $paginate['page']}}</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . ($paginate['page'] + 1) }}" class="" > {{ $paginate['page'] + 1 }}</a>
                </li>
            @endif
            @if($checkShowPage)
                <li class="page-item disabled"><span class="page-link">...</span></li>
                @for( $i = $rightLimitPage; $i <= $paginate['pageNum']; $i++)
                    <li class="page-item {{ ($paginate['page'] == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ ($paginate['page']) == $i ? '#' : ($paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . $i) }}" class="" > {{ $i }}</a>
                    </li>
                @endfor
            @endif
            @if(!is_null($paginate['next']))
                <li class="page-item">
                    <a class="page-link" href="{{ $paginate['next'] }}" aria-label="Next"><i class="fa fa-angle-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>
</div>