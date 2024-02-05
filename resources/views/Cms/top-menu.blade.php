<div class="top-nav">
    <!-- 01 -->
    <div class="first-topnav">
        <div class="container-xl p-1">
            <div class="row">
                <ul class="nav">
                    <?php
                    foreach ($menuFooterItems as $menuFooterItem) {
                        if ($menuFooterItem->type == 'phone' || $menuFooterItem->type == 'email') {
                            $value = App::getLocale() == 'en' ? $menuFooterItem->value_en : $menuFooterItem->value_kh;
                            $str = '<li class="nav-item"><a class="nav-link" href="' . $value . '">' . $value . '</a></li>';
                            echo $str;
                        }
                    }

                    $str = '';
                    foreach ($topMenu as $i => $item) {
                        $aClass = '';
                        $aDropdown = '';
                        $externalLink = '';
                        $slug = '';
                        $hasChild = $item->right - $item->left > 1;
                        $hasExternalUrl = $item->link != null;
                        $changeLanguage = $item->menu_type == 'change_language';
                        $menuName = App::getLocale() == 'en' ? $item->menu_en : $item->menu_kh;
                        $menuSlug = App::getLocale() == 'en' ? $item->slug : $item->slug;
                        $urlEn = url('en/' . $slugLanguage);
                        $str = $str . "<li class='nav-item'>";
                        if ($slugLanguage == $menuName || $slugLanguage == $menuSlug) {
                            $menuActive = 'active';
                        } elseif (($slugLanguage == '/' || $slugLanguage == '/en') && $item->menu_type == 'main_page') {
                            // if it's home
                            $menuActive = 'active';
                        } else {
                            $menuActive = '';
                        }
                        $str = $str . "<li class='nav-item dropdown " . $menuActive . " '>";
                        if ($hasChild) {
                            $aClass = 'dropdown-toggle';
                            $aDropdown = "id='navbarDropdown' role='button' data-bs-toggle='dropdown' data-bs-auto-close='outside'";
                        }
                        if ($changeLanguage && $item->slug == 'khmer') {
                            $str =
                                $str .
                                " <a class='nav-link' href='" .
                                url($slugLanguage) .
                                "'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <img src='" .
                                json_decode($item->param1)->khmer->file_icon .
                                "' alt='flag_khmer.png' width='20'> " .
                                $menuName .
                                '</a>';
                        }
                        if ($changeLanguage && $item->slug == 'english') {
                            $str =
                                $str .
                                " <a class='nav-link' href='" .
                                url($urlEn) .
                                "'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <img src='" .
                                json_decode($item->param1)->english->file_icon .
                                "' alt='flag_english.png' width='20'> " .
                                $menuName .
                                '</a>';
                        }
                        if ($hasExternalUrl && !$changeLanguage) {
                            $externalLink = $item->link;
                            $str = $str . " <a class='nav-link $aClass ' target='_blank' href='" . $externalLink . "'> " . $menuName . '</a>';
                        }
                        if (!$hasExternalUrl && !$changeLanguage) {
                            $slug = $item->slug;
                            if (App::getLocale() == 'en') {
                                $str = $str . " <a class='nav-link $aClass ' href='" . url('/') . '/' . 'en/' . $item->slug . "' $aDropdown> " . $menuName . '</a>';
                            } else {
                                $str = $str . " <a class='nav-link $aClass ' href='" . url('/') . '/' . $item->slug . "' $aDropdown> " . $menuName . '</a>';
                            }
                        }
                        if ($item->deeper) {
                            $str = $str . "<ul class='deeper dropend dropdown-menu drop-fade-down border-0 shadow' aria-labelledby='navbarDropdown'>";
                        } elseif ($item->shallower) {
                            $str = $str . '</li>';
                            $str = $str . str_repeat('</ul></li>', $item->level_diff);
                        } else {
                            $str = $str . '</li>';
                        }
                    }
                    echo $str;
                    ?>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function(e) {
            $('li.active').parents('li').addClass('active');
        });
    </script>
@endsection
