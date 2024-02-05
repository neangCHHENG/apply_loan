<footer>
    <div class="container-fluid copy-right">
        <div class="container-xl">
            <div class="row p-3">
                <div class="col-md-6 col-sm-12">
                    <a href="{{ url(App::getLocale() == 'en' ? 'en' : '') }}">
                        <?php
                        $logo = '';
                        foreach ($menuFooterItems as $key => $value) {
                            if ($value->key == 'logo') {
                                $logo = $value->image;
                            }
                        }
                        ?>
                        <img src="{{ $logo }}" alt="AIS_Logo_Final-21.png" style="height: 50px;">
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 pt-4 text-end">
                    @foreach ($menuFooterItems as $key => $menuFooterItem)
                        @if ($menuFooterItem->key == 'copyright')
                            <p>
                                <?php echo date('Y'); ?>
                                {{ App::getLocale() == 'en' ? $menuFooterItem->value_en : $menuFooterItem->value_kh }}
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>
