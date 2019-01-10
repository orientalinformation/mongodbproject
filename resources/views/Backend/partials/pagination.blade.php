<?php
$flag = false;
$limitPage = 6;
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
?>

<div class="pagination-bar">
    <ul class="pagination">
        @if (!is_null($paginate['prev']))
            <li>
                <a href="{{ $paginate['prev'] }}" class="" >Previous</a>
            </li>
        @endif

        @for( $i = 1; $i <= $leftLimitPage; $i++)
            <li class="{{ ($paginate['page'] == $i) ? 'disabled' : '' }}">
                <a href="{{ $paginate['page'] == $i ? '#' : ($paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . $i) }}" class="" > {{ $i }}</a>
            </li>
        @endfor

        @if($flag)
            <li>...</li>
            <li>
                <a href="{{ $paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . ($paginate['page'] - 1) }}" class="" > {{ $paginate['page'] - 1 }}</a>
            </li>
            <li class="disabled">
                <a href="#" class="" > {{ $paginate['page']}}</a>
            </li>
            <li>
                <a href="{{ $paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . ($paginate['page'] + 1) }}" class="" > {{ $paginate['page'] + 1 }}</a>
            </li>
        @endif
            <li>...</li>
        @for( $i = $rightLimitPage; $i <= $paginate['pageNum']; $i++)
            <li class="{{ ($paginate['page'] == $i) ? 'disabled' : '' }}">
                <a href="{{ ($paginate['page']) == $i ? '#' : ($paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . $i) }}" class="" > {{ $i }}</a>
            </li>
        @endfor
        @if(!is_null($paginate['next']))
            <li>
                <a href="{{ $paginate['next'] }}" class="">Next</a>
            </li>
        @endif
    </ul>
</div>