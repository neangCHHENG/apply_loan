<footer>
    <!-- Back to top button -->
    <a id="backToTopBtn">
        <i class="fa-solid fa-angle-up"></i>
    </a>
    <div class="container-fluid" style="background: #124165;">
        <div class="container-xl pt-5">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 px-0">
                    <ul style="display: grid;">
                        <li class="nav-item dropdown">
                            <strong
                                class="footer dropdown-item dropdown-toggle">{{ App::getLocale() == 'en' ? 'CONTACT US' : 'ទំនាក់ទំនង' }}</strong>
                        </li>
                        <?php
                        foreach ($menuFooterItems as $menuFooterItem) {
                            if ($menuFooterItem->type == 'address' || $menuFooterItem->type == 'phone' || $menuFooterItem->type == 'email') {
                                $value = App::getLocale() == 'en' ? $menuFooterItem->value_en : $menuFooterItem->value_kh;
                                $str = '';
                                echo $str = $str . '<ul><li>' . $value . '</li></ul>';
                            }
                        }
                        ?>

                    </ul>
                    <ul>

                        <ul class="icon-group">
                            @foreach ($menuFooterItems as $key => $menuFooterItem)
                                @if ($menuFooterItem->type == 'socailMedia')
                                    <li><a href="{{ App::getLocale() == 'en' ? $menuFooterItem->value_en : $menuFooterItem->value_kh }}"
                                            target="_blank"><img src="{{ $menuFooterItem->image }}" alt="icon"></a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </ul>
                </div>
                <?php
                $countParent = null;
                $str = "<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'> <ul>";
                foreach ($bottomMenu as $i => $item) {
                    $externalLink = '';
                    $aClass = '';
                    $lClass = '';
                    $hasChild = $item->right - $item->left > 1;
                    $hasExternalUrl = $item->link != null;
                    if ($item->level == 1) {
                        $countParent = $countParent + 1;
                    }
                    if (App::getLocale() == 'en') {
                        $menuName = $item->menu_en;
                        $language = 'en/';
                    } else {
                        $menuName = $item->menu_kh;
                        $language = '';
                    }
                    if ($hasChild) {
                        $lClass = 'dropdown';
                        $aClass = 'footer dropdown-item dropdown-toggle';
                        $aDropdown = "id='navbarDropdown' role='button' data-bs-toggle='dropdown' data-bs-auto-close='outside'";
                    }
                    if ($countParent == 2) {
                        $str = $str . "</div> <div class='col-lg-2 col-md-2 col-sm-6 col-xs-12 px-0'> <ul>";
                        $countParent++;
                    }
                    $str = $str . "<li class='nav-item $lClass'>";
                    if ($hasExternalUrl) {
                        $externalLink = $item->link;
                        $str = $str . " <a class='$aClass' target='_blank' href='" . $externalLink . "'> " . $menuName . '</a>';
                    }
                    if (!$hasExternalUrl) {
                        $slug = $item->slug;
                        if ($item->level == 1) {
                            $str = $str . " <strong class='$aClass'> " . $menuName . '</strong>';
                        } else {
                            $str = $str . " <a class='$aClass' href='" . url('/') . '/' . $language . $item->slug . "'> " . $menuName . '</a>';
                        }
                    }
                    if ($item->deeper) {
                        $str = $str . '<ul>';
                    } elseif ($item->shallower) {
                        $str = $str . '</li>';
                        $str = $str . str_repeat('</ul></li>', $item->level_diff);
                    } else {
                        $str = $str . '</li>';
                    }
                }
                $str = $str . '</ul></div>';
                echo $str;
                ?>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 px-0">
                    <ul style="display: grid;">
                        <li class="nav-item dropdown">
                            <label class="footer dropdown-item dropdown-toggle">
                                <?php
                                $str = '';
                                if (App::getLocale() == 'en') {
                                    $menuName = 'VISITOR';
                                    $language = 'en';
                                } else {
                                    $menuName = 'អ្នកទស្សនា';
                                    $language = '';
                                }
                                echo $str = $str . $menuName;
                                ?>
                            </label>
                        </li>

                        <ul>
                            <li><i class="fa-solid fa-user"></i>
                                {{ App::getLocale() == 'en' ? 'Visit Today' : 'ទស្សនាថ្ងៃនេះ' }}:
                                <strong>{{ $countDate['day'] }}</strong>
                            </li>
                            <li><i class="fa-solid fa-user"></i>
                                {{ App::getLocale() == 'en' ? 'Visit Yesterday' : 'ទស្សនាពីម្សិលមិញ' }}:
                                <strong>{{ $countDate['yesterday'] }}</strong>
                            </li>
                            <li><i class="fa-solid fa-calendar-days"></i>
                                {{ App::getLocale() == 'en' ? 'This Month' : 'ទស្សនាខែនេះ' }}:
                                <strong>{{ $countDate['month'] }}</strong>
                            </li>
                            <li><i class="fa-solid fa-calendar-days"></i>
                                {{ App::getLocale() == 'en' ? 'This Year' : 'ទស្សនាឆ្នាំនេះ' }}:
                                <strong>{{ $countDate['year'] }}</strong>
                            </li>
                            <li><i class="fa-solid fa-calendar-days"></i>
                                {{ App::getLocale() == 'en' ? 'Total Visit' : 'ទស្សនាសរុប' }}:
                                <strong>{{ $countDate['all'] }}</strong>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
            <div class="row"><br>

            </div>
        </div>
    </div>
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
