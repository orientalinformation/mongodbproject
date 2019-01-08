<?php //dd($paginator)?>

@if ($paginator['last_page'] > 1)
    <div class="pagination-bar">
        <ul class="pagination">
            <li class="{{ ($paginator['current_page'] == 1) ? ' disabled' : '' }}">
                <a href="{{ url($paginator['path']) }}">First</a>
            </li>
            <?php
                $number = intval($paginator['limitPage'] / 2);

                if($paginator['current_page'] + $number < $paginator['last_page']):
                    $limitPage = $paginator['current_page'] + $number;
                else:
                    $limitPage = $paginator['last_page'];
                endif;

                if($paginator['current_page'] - $number > 0)
                    $offsetPage = $paginator['current_page'] - $number;
                else if($paginator['current_page'] - $number < 0)
                    $offsetPage = $paginator['current_page'];
                else if($paginator['current_page'] - $number = 0)
                    $offsetPage = 1;
            ?>
            @if($offsetPage > $number && $offsetPage > 1)
                <li>...</li>
            @endif
            @for ($i = $offsetPage; $i <= $limitPage; $i++)
                <li class="{{ ($paginator['current_page'] == $i) ? ' active' : '' }}">
                    <a href="{{ url($paginator['path']) . '?page=' .$i }}">{{ $i }}</a>
                </li>
                <?php
                if ($i )
                ?>
            @endfor
            @if($paginator['current_page'] < $paginator['last_page'] && ($paginator['current_page'] + $number) < $paginator['last_page'])
                <li>...</li>
            @endif
            <li class="{{ ($paginator['current_page'] == $paginator['last_page']) ? ' disabled' : '' }}">
                <a href="{{ url($paginator['last_page_url']) }}" >Last</a>
            </li>
        </ul>
    </div>
@endif