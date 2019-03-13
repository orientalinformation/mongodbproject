<ul class="profile-menu-left menu-home menu-library">
    <?php if(sizeof($category) >0 ): ?>
        @foreach($category as $item)
        <li><a class="accordion-toggle" href="#colMenu<?= $item['_id'] ?>" data-toggle="collapse">{{ $item['name'] }}</a></li>
        <?php $subCat = EnvatoCategory::getSubCategory($item['_id']); ?>
            <?php if(sizeof($subCat) > 0): ?>
            <div id="colMenu<?= $item['_id'] ?>" class="panel-collapse collapse">
                <ul class="sub-menu-library">
                    @foreach($subCat as $subItem)
                        <?php $sub2Cat = EnvatoCategory::getSubCategory($subItem['_id']); ?>
                        <?php if(sizeof($sub2Cat) > 0): ?>
                            <li><a class="accordion-toggle-sub" href="#colMenuSub<?= $subItem['_id'] ?>" data-toggle="collapse">{{ $subItem['name'] }}</a></li>
                            <div id="colMenuSub<?= $subItem['_id'] ?>" class="panel-collapse collapse in">
                                <ul class="sub-menu-library">
                                    @foreach($sub2Cat as $sub2Item)
                                        <li>{{ $sub2Item['name'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        <?php else: ?>
                            <li>{{ $subItem['name'] }}</li>
                        <?php endif;?>
                    @endforeach
                </ul>
            </div>
            <?php endif;?>
        @endforeach
    <?php endif; ?>
    <li>
        <img src="{{ URL::to('/image/front/video-checked.png')}}" class="library-video-icon">
        <img src="{{ URL::to('/image/front/video-remove.png')}}" class="library-video-icon">
    </li>
    <li>
        <input type="hidden" id="slider_range" class="flat-slider" />
        <script type="text/javascript">
            jQuery(function() {
                jQuery( "#slider_range" ).flatslider({
                    min: 1990, max: 2100,
                    step: 1,
                    values: [2010, 2020],
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
    </li>
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
    <li><a class="accordion-toggle" href="#colMenu5" data-toggle="collapse">Bibliothèques publiques</a></li>
    <div id="colMenu5" class="panel-collapse collapse in">
        <ul class="sub-menu-library">
            <li>Nom de la bibio par rene
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
            <li>Nom de la bibio2 par @rene
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
            <li>Nom de la bibio par Pierre badin
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
            <li>Nom de la bibio par rene
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
            <li>Nom de la bibio par rene
                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
            </li>
        </ul>
        <div class="link-menu"><a href="#">voir plus</a></div>
    </div>
</ul>