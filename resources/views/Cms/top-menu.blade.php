<div class="top-nav">
    <!-- 01 -->
    <div class="first-topnav">
        <div class="container-xl">
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
                    ?>

                    <div class="icon-group">
                        @foreach ($menuFooterItems as $key => $menuFooterItem)
                            @if ($menuFooterItem->type == 'socailMedia')
                                <li><a href="{{ App::getLocale() == 'en' ? $menuFooterItem->value_en : $menuFooterItem->value_kh }}"
                                        target="_blank"><img src="{{ $menuFooterItem->image }}" alt="icon"></a>
                                </li>
                            @endif
                        @endforeach
                    </div>

                    <?php
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


    <!-- 03 -->
    <div class="container-xl p-4 p-xs-1">
        <div class="row">
            <?php
            $logo = '';
            $longitude = '';
            foreach ($menuFooterItems as $key => $value) {
                if ($value->key == 'logo') {
                    $logo = $value->image;
                }
                if ($value->key == 'longitude') {
                    $longitude = $value->image;
                }
            }
            ?>
            <div div class="col-md-12 col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="container-xl p-0" style="border-radius: 4px 4px 0 0;">
                        <a class="navbar-brand" href="{{ url(App::getLocale() == 'kh' ? '/' : 'en') }}">
                            <img src="{{ $longitude }}" alt="AIS_Logo_Final-21.png" style="height: 40px;">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon" style="font-size: 20px"></span>
                        </button>
                        <!-- <div class="offcanvas offcanvas-start overflow-scroll" id="navbarSupportedContent"> -->
                        <!-- collapse navbar-collapse -->
                        <div id="navbarSupportedContent" class="collapse navbar-collapse">
                            <div class="offcanvas-header">
                                <a href="{{ url(App::getLocale() == 'kh' ? '/' : 'en') }}">
                                    <img src="{{ $longitude }}" alt="AIS_Logo_Final-21.png" style="height: 40px;">
                                </a>
                                <button type="button" class="btn-close p-3" data-bs-dismiss="offcanvas"
                                    style="background: transparent!important"><i class="fas fa-times"
                                        style="font-size: 20px; color: #fff"></i></button>
                            </div>
                            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 w-100 mobile-menu">

                                <?php
                                $str = "<ul class='navbar-nav mx-auto mb-2 mb-lg-0 w-100 mobile-menu'>";
                                foreach ($mainMenu as $i => $item) {
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
                                        $str = $str . " <a class='nav-link' href='" . url($slugLanguage) . "'> " . $menuName . '</a>';
                                    }
                                    if ($changeLanguage && $item->slug == 'english') {
                                        $str = $str . " <a class='nav-link' href='" . $urlEn . "'> " . $menuName . '</a>';
                                    }
                                    if ($hasExternalUrl && !$changeLanguage) {
                                        $externalLink = $item->link;
                                        $str = $str . " <a class='dropdown-item $aClass ' href='" . $externalLink . "' target='_blank'> " . $menuName . '</a>';
                                    }
                                    if (!$hasExternalUrl && !$changeLanguage) {
                                        $slug = $item->slug;
                                        if (App::getLocale() == 'en') {
                                            $str = $str . " <a class='dropdown-item $aClass ' href='" . url('/') . '/' . 'en/' . $item->slug . "' $aDropdown> " . $menuName . '</a>';
                                        } else {
                                            $str = $str . " <a class='dropdown-item $aClass ' href='" . url('/') . '/' . $item->slug . "' $aDropdown> " . $menuName . '</a>';
                                        }
                                    }
                                    if ($item->deeper) {
                                        $str = $str . "<ul class='deeper dropend dropdown-menu submenu drop-fade-up border-0 shadow' aria-labelledby='navbarDropdown'>";
                                    } elseif ($item->shallower) {
                                        $str = $str . '</li>';
                                        $str = $str . str_repeat('</ul></li>', $item->level_diff);
                                    } else {
                                        $str = $str . '</li>';
                                    }
                                }
                                $str =
                                    $str .
                                    '<li class="nav-item dropdown"><a type="button" class="btn btn-signup btn-top-style" data-bs-toggle="modal" data-bs-target="#signUpModal">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Join Us</a></li> <li class="nav-item dropdown"><a href="/login" class="btn btn-outline-signin btn-top-style">Sign In</a></li></ul>';
                                echo $str;
                                ?>

                                <?php
                                $str = "<ul class='navbar-nav mx-auto mb-2 mb-lg-0 w-100 mobile-menu displayNone'>";
                                foreach ($topMenu as $i => $item) {
                                    $aClass = '';
                                    $aDropdown = '';
                                    $externalLink = '';
                                    $slug = '';
                                    $hasChild = $item->right - $item->left > 1;
                                    $hasExternalUrl = $item->link != null;
                                    $changeLanguage = $item->menu_type == 'change_language';
                                    $menuName = App::getLocale() == 'en' ? $item->menu_en : $item->menu_kh;
                                    // $hasIconLanguage = ($item->param1 !='' && $item->menu_type == 'change_language');
                                    $urlEn = url('en/' . $slugLanguage);
                                    $str = $str . "<li class='nav-item'>";
                                
                                    if ($hasChild) {
                                        $aClass = 'dropdown-toggle';
                                        $aDropdown = "id='navbarDropdown' role='button' data-bs-toggle='dropdown' data-bs-auto-close='outside'";
                                    }
                                    if ($changeLanguage && $item->slug == 'khmer') {
                                        $str = $str . " <a class='dropdown-item' href='" . url($slugLanguage) . "'><img src='" . json_decode($item->param1)->khmer->file_icon . "' width='20'> " . $menuName . '</a>';
                                    }
                                    if ($changeLanguage && $item->slug == 'english') {
                                        $str = $str . " <a class='dropdown-item' href='" . $urlEn . "'> <img src='" . json_decode($item->param1)->english->file_icon . "' width='20'>" . ' ' . $menuName . '</a>';
                                    }
                                    if ($hasExternalUrl && !$changeLanguage) {
                                        $externalLink = $item->link;
                                        $str = $str . " <a class='dropdown-item $aClass ' target='_blank' href='" . $externalLink . "'> " . $menuName . '</a>';
                                    }
                                    if (!$hasExternalUrl && !$changeLanguage) {
                                        $slug = $item->slug;
                                        if (App::getLocale() == 'en') {
                                            $str = $str . " <a class='dropdown-item $aClass ' href='" . url('/') . '/' . 'en/' . $item->slug . "' $aDropdown> " . $menuName . '</a>';
                                        } else {
                                            $str = $str . " <a class='dropdown-item $aClass ' href='" . url('/') . '/' . $item->slug . "' $aDropdown> " . $menuName . '</a>';
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

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <!--create token-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
                </div>
                <div class="modal-body row">
                    <div class="col-md-4 col-sm-3">
                        <i class="fa fa-user " aria-hidden="true"></i> Username :
                    </div>
                    <div class="col-md-8 col-sm-9">
                        <input type="text" class="form-control" id="name" name='name' autocomplete="off"
                            placeholder="Username" />
                    </div><br><br>
                    <div class="col-md-4 col-sm-3">
                        <i class="fa fa-envelope " aria-hidden="true"></i> Email :
                    </div>
                    <div class="col-md-8 col-sm-9">
                        <input type="email" class="form-control" id="email" name='email' autocomplete="off"
                            placeholder="Email" />
                    </div><br><br>
                    <div class="col-md-4 col-sm-3">
                        <i class="fa fa-phone " aria-hidden="true"></i> Phone :
                    </div>
                    <div class="col-md-8 col-sm-9">
                        <input type="phone" class="form-control" id="phone" name='phone' autocomplete="off"
                            placeholder="Phone Number" />
                    </div><br><br>
                    <div class="col-md-4 col-sm-3 pe-0">
                        <i class="fa fa-list " aria-hidden="true"></i> Specialism :
                    </div>
                    <div class="col-md-8 col-sm-9">
                        <select class="form-control select2" id="position" name='position'
                            data-placeholder="All specialisms">

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn-send btn"
                        style="min-width: 100px;
            justify-content: center;">
                        {{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}
                </div>
            </div>
        </form>
    </div>
</div>
{{-- signup --}}
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <!--create token-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 20px">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-3 col-sm-3">
                        <i class="fa fa-user " aria-hidden="true"></i> Username :
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <input type="text" class="form-control" id="name" name='name' autocomplete="off"
                            placeholder="Username" />
                    </div><br><br>
                    <div class="col-md-3 col-sm-3">
                        <i class="fa fa-envelope " aria-hidden="true"></i> Email :
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <input type="email" class="form-control" id="email" name='email' autocomplete="off"
                            placeholder="Email" />
                    </div><br><br>
                    <div class="col-md-3 col-sm-3">
                        <i class="fa fa-phone " aria-hidden="true"></i> Phone :
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <input type="phone" class="form-control" id="phone" name='phone' autocomplete="off"
                            placeholder="Phone Number" />
                    </div><br><br>
                    <div class="col-md-3 col-sm-3 pe-0">
                        <i class="fa fa-list " aria-hidden="true"></i> Specialism :
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <select class="form-control select2" id="position" name='position'
                            data-placeholder="All specialisms">

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn-send btn"
                        style="min-width: 100px;
            justify-content: center;">
                        {{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}
                </div>
            </div>
        </form>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function(e) {
            $('li.active').parents('li').addClass('active');
            getSpecialismSignUpList();
        });

        function getSpecialismSignUpList() {
            $.ajax({
                url: "{{ url('/admin/searchSpecialism/getSpecialismList') }}",
                type: "GET",
                success: function(response) {
                    if (response.result == "error") {
                        sweetToast(response.msg, response.result);
                        return;
                    }
                    var typeStr = "<option><span>Select specialisms</span></option>";
                    for (var i = 0; i < response.data.length; i++) {
                        typeStr +=
                            '<option value="' +
                            response.data[i].id +
                            '">' +
                            response.data[i].title_kh +
                            "-" +
                            response.data[i].title_en +
                            "</option>";
                    }
                    $("#position").html(typeStr);
                },
                error: function(e) {
                    if (e.status == 401) {
                        //unauthenticate not login
                        Msg("Login is Required", "error");
                    }
                },
            });
        }

        function valueFil(val = null) {
            let name;
            let email;
            let phone;
            let position;
            if (val === null) {
                name = $('#name').val();
                email = $('#email').val();
                phone = $('#phone').val();
                position = $('#position').val();
            }
            if (val === 'clear') {
                $('#name').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#position').val('');

            }

            return {
                'name': name,
                'email': email,
                'phone': phone,
                'position': position,

            };
        }

        function closeModal() {
            $('#signUpModal').hide();
            $('.fade').hide(); // Close the modal on successful save
        }

        var btnSave = true;
        $('#btnSave').on('click', () => {
            $.ajax({
                url: "{{ url('/admin/saveUser/saveUserFontEnd') }}/",
                type: "POST",
                data: valueFil(),
                headers: {
                    'X-CSRF-TOKEN': $("#csrf").val()
                },
                beforeSend: function() {
                    $('#btnSave').text(
                        "{{ App::getLocale() == 'en' ? 'Sending...' : 'កំពុងផ្ញើ...' }}")
                    $('#btnSave').attr("disabled", true);

                },
                success: function(response) {
                    if (response.status == "error") {
                        valueFil('clear');
                        validationMgs(response);
                        $('#btnSave').text("{{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}");
                        $('#btnSave').removeAttr("disabled");
                    } else {
                        valueFil('clear');
                        showspecialismSignUp('success', 'Sent Successfully');
                        $('#btnSave').text("{{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}");
                        $('#btnSave').removeAttr("disabled");
                        closeModal();
                    }
                    btnSave = true;
                    $('.btn-send-contact').text('{{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}');
                },

                error: function(e) {
                    showspecialismSignUp('Error Saving User', 'error');
                }
            });
        });

        function sweetToast(specialismSignUp, icon) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: icon,
                title: specialismSignUp,
            });
        }

        function validationMgs(response) {
            let msg = '';
            for (let x in response.result) {
                msg += response.result[x][0];
            }
            return sweetToast(msg, response.icon);
        }

        function showspecialismSignUp(type, specialismSignUp) {
            Swal.fire({
                position: "top-end",
                icon: type,
                title: specialismSignUp,
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endsection
