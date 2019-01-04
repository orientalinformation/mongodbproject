<?php //dd($paginator)?>

@if ($paginator['last_page'] > 1)
    <ul class="pagination">
        <li class="{{ ($paginator['current_page'] == 1) ? ' disabled' : '' }}">
            <a href="{{ url($paginator['path']) }}">Previous</a>
        </li>
        <?php
            if($paginator['last_page'] > 5):
                $number = 5;
                $flag = 1;
            else:
                $number = $paginator['last_page'];
                $flag = 0;
            endif;
        ?>
        @for ($i = 1; $i <= $number; $i++)
            <li class="{{ ($paginator['current_page'] == $i) ? ' active' : '' }}">
                <a href="{{ url($paginator['path']) . '?page=' .$i }}">{{ $i }}</a>
            </li>
            @if($flag == 1)
                <li>...</li>
            @endif
        @endfor
        <li class="{{ ($paginator['current_page'] == $paginator['last_page']) ? ' disabled' : '' }}">
            <a href="{{ url($paginator['last_page_url']) }}" >Last</a>
        </li>
    </ul>
@endif