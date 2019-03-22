<?php $url=strtok($_SERVER["REQUEST_URI"],'?'); ?>
<ul class="profile-menu-left menu-home menu-library">
    <?php if(sizeof($category) >0 ): ?>
        @foreach($category as $item)
        <?php $subCat = EnvatoCategory::getSubCategory($item['_id']); ?>
            <?php if(sizeof($subCat) > 0): ?>
            <li><a class="accordion-toggle" href="#colMenu<?= $item['_id'] ?>" data-toggle="collapse">{{ $item['name'] }}</a></li>
            <div id="colMenu<?= $item['_id'] ?>" class="panel-collapse collapse">
                <ul class="sub-menu-library">
                    @foreach($subCat as $subItem)
                        <?php $sub2Cat = EnvatoCategory::getSubCategory($subItem['_id']); ?>
                        <?php if(sizeof($sub2Cat) > 0): ?>
                            <li><a class="accordion-toggle-sub" href="#colMenuSub<?= $subItem['_id'] ?>" data-toggle="collapse">{{ $subItem['name'] }}</a></li>
                            <div id="colMenuSub<?= $subItem['_id'] ?>" class="panel-collapse collapse in">
                                <ul class="sub-menu-library">
                                    @foreach($sub2Cat as $sub2Item)
                                        <li><a href="<?= $url . '?catID=' . $subItem['_id'] ?>">{{ $sub2Item['name'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        <?php else: ?>
                            <li><a href="<?= $url . '?catID=' . $subItem['_id'] ?>">{{ $subItem['name'] }}</a></li>
                        <?php endif;?>
                    @endforeach
                </ul>
            </div>
            <?php else: ?>
            <li><a href="<?= $url . '?catID=' . $item['_id'] ?>">{{ $item['name'] }}</a></li>
            <?php endif;?>
        @endforeach
    <?php endif; ?>
    <li>
        <a href="#"><img src="{{ URL::to('/image/front/video-checked.png')}}" class="library-video-icon"></a>
        <a href="#"><img src="{{ URL::to('/image/front/video-remove.png')}}" class="library-video-icon"></a>
    </li>
    <li>
        <input type="hidden" id="slider_range" class="flat-slider" />
    </li>
    @if (isset($researches))
    <li><a class="accordion-toggle" href="#colMenu3" data-toggle="collapse">Mes Researches</a></li>
    <div id="colMenu3" class="panel-collapse collapse in">
        <ul class="sub-menu-library">
            @foreach($researches as $research)
            <li>{{ $research->name }}
                <span class="pin-icon"><a href="#" class="destroy-research" data-id="{{ $research->id }}" data-url="{{ route('frontResearchDestroy') }}"><i class="fa fa-trash" aria-hidden="true"></a></i></span>
            </li>
            @endforeach
        </ul>
        <div class="link-menu"><a href="#">voir plus</a></div>
    </div>
    @endif
    <?php if (!empty(Auth::user())): ?>
    <li><a class="accordion-toggle" href="#colMenu4" data-toggle="collapse">Mes bibliothèques</a></li>
    <div id="colMenu4" class="panel-collapse collapse in">
        <ul class="sub-menu-library">
            <li>À lire plus tard
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
            <li>Biblio 1
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
            <li>Biblio 2
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
            <li>Biblio 3
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
            <li>Biblio 4
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
        </ul>
        <div class="link-menu"><a href="#">voir plus</a></div>
    </div>
    <?php endif; ?>
</ul>

@section('script-left-menu')
<script type="text/javascript">
    jQuery(function() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var start_year = url.searchParams.get("start_year");
        var end_year = url.searchParams.get("end_year");
        var range = [2010, 2020];
        if(start_year > 0 && end_year > 0){
            range = [start_year, end_year]
        }
        jQuery( "#slider_range" ).flatslider({
            min: 1990, max: 2100,
            step: 1,
            values: range,
            range: true,
            einheit: '',
            stop: function( event, ui ) {
                currentMinValue = ui.values[ 0 ];
                currentMaxValue = ui.values[ 1 ];
                window.location.href = "{{ URL::to('/') . '/book' }}" + "?start_year=" + currentMinValue + "&end_year=" + currentMaxValue;
            }
        });
    });
</script>
@endsection