<!DOCTYPE html>
<!--
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.5.1
Author: Sunnyat A.
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0?ref=myorange
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MJQ Job </title>
    <meta name="description" content="Page Title">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/vendors.bundle.css') }}" />
    <link id="appbundle" rel="stylesheet" media="screen, print" href="{{ asset('plugin/css/app.bundle.css') }}">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="{{ asset('plugin/css/skins/skin-master.css') }}">

    <!-- Place favicon.ico in the root directory -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('FrontEnd/Image/favicon-mjqjobs-02-01.png') }}">
    <link rel="mask-icon" href="{{ asset('plugin/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('plugin/css/notifications/toastr/toastr.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/formplugins/select2/select2.bundle.css') }}">

    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}">

    <link rel="stylesheet" media="screen, print" href="{{ asset('plugin/css/blockui.css') }}" />
    <link rel="stylesheet" media="screen, print" href="{{ asset('plugin/css/spinkit.css') }}" />
    <link rel="stylesheet" media="screen, print" href="{{ asset('plugin/css/font/khmer_fonts.css') }}" />

    <link rel="stylesheet" media="screen, print" href="{{ asset('plugin/css/fa-brands.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('plugin/css/fa-solid.css') }}">

    <!--for dashboard-->
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/miscellaneous/reactions/reactions.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('plugin/css/miscellaneous/jqvmap/jqvmap.bundle.css') }}">
    <!--for dashboard-->
    {{-- jquery --}}
    <script src="{{ asset('plugin/js/vendors.bundle.js') }}"></script>
    <style>
        .switch {
            position: relative !important;
            display: inline-block !important;
            width: 40px !important;
            height: 20px !important;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px !important;
            width: 17px !important;
            left: 2px !important;
            bottom: 2px !important;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(20px) !important;
            -ms-transform: translateX(20px !important);
            transform: translateX(20px) !important;
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 12px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .swal2-container {
            z-index: 10000;
        }

        th.dt-center,
        td.dt-center {
            text-align: center;
        }

        td.dt-color {
            color: blue !important;
        }

        td.dt-right {
            text-align: right;
        }

        th.dt-left,
        td.dt-left {
            text-align: left;
        }

        .thumbnail {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>

    <!-- You can add your own stylesheet here to override any styles that comes before it
  <link rel="stylesheet" media="screen, print" href="css/your_styles.css">-->

    <script>
        function getPlatform() {
            var platform = ["Win32", "Android", "iOS"];

            for (var i = 0; i < platform.length; i++) {

                if (navigator.platform.indexOf(platform[i]) > -1) {

                    return platform[i];
                }
            }
        }

        var AuthToken = "{{ session('AuthToken') }}";
        var formToken = "{{ session('_token') }}";
        var appuserid = "{{ session('userid') }}";
        var appisGuardian = false;
        var appusername = "{{ session('username') }}";
        var appuserloginname = "{{ session('userloginname') }}";
        var SessionEnd = "{{ session('SessionEnd') }}";

        var appuserphoto = "";
        var appurladdress = "{{ url('/') }}"; //url to access in javascript file
        var enviromentOS = getPlatform();
    </script>

</head>
<!-- BEGIN Body -->
<!-- Possible Classes

  * 'header-function-fixed'         - header is in a fixed at all times
  * 'nav-function-fixed'            - left panel is fixed
  * 'nav-function-minify'			  - skew nav to maximize space
  * 'nav-function-hidden'           - roll mouse on edge to reveal
  * 'nav-function-top'              - relocate left pane to top
  * 'mod-main-boxed'                - encapsulates to a container
  * 'nav-mobile-push'               - content pushed on menu reveal
  * 'nav-mobile-no-overlay'         - removes mesh on menu reveal
  * 'nav-mobile-slide-out'          - content overlaps menu
  * 'mod-bigger-font'               - content fonts are bigger for readability
  * 'mod-high-contrast'             - 4.5:1 text contrast ratio
  * 'mod-color-blind'               - color vision deficiency
  * 'mod-pace-custom'               - preloader will be inside content
  * 'mod-clean-page-bg'             - adds more whitespace
  * 'mod-hide-nav-icons'            - invisible navigation icons
  * 'mod-disable-animation'         - disables css based animations
  * 'mod-hide-info-card'            - hides info card from left panel
  * 'mod-lean-subheader'            - distinguished page header
  * 'mod-nav-link'                  - clear breakdown of nav links

  >>> more settings are described inside documentation page >>>
 -->

<body class="mod-bg-1 mod-nav-link" style="font-family:KhmerOScontent!important;font-size:14px!important">
    <!-- DOC: script to save and load page settings -->
    <script>
        /**
         *	This script should be placed right after the body tag for fast execution
         *	Note: the script is written in pure javascript and does not depend on thirdparty library
         **/
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /**
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';
        /**
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);

        } else if (themeSettings.themeURL && document.getElementById('mytheme')) {
            document.getElementById('mytheme').href = themeSettings.themeURL;
        }
        /**
         * Save to localstorage
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|footer|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /**
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            @include('layouts/leftpanel')
            <!-- END Left Aside -->

            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                @include('layouts/header')

                <!-- BEGIN Page Content -->
                <!-- the #js-page-content id is needed for some plugins to initialize -->
                <main id="js-page-content" role="main" class="page-content">
                    <!-- Your main content goes below here: -->
                    <div class="row">
                        <div class="col-xl-12">
                            @yield('content')
                        </div>
                    </div>
                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">Copyright © {{ date('Y') }} <label
                                class='text-primary fw-500' title='Aii'>Design and Develop by ITD</label></span>
                    </div>
                    {{-- <div>
                        <ul class="list-table m-0">
                            <li><span class="js-get-date"></span></li>
                        </ul>
                    </div> --}}
                </footer>
                <!-- END Page Footer -->

                <!-- BEGIN Color profile -->
                <!-- this area is hidden and will not be seen on screens or screen readers -->
                <!-- we use this only for CSS color refernce for JS stuff -->
                <p id="js-color-profile" class="d-none">
                    <span class="color-primary-50"></span>
                    <span class="color-primary-100"></span>
                    <span class="color-primary-200"></span>
                    <span class="color-primary-300"></span>
                    <span class="color-primary-400"></span>
                    <span class="color-primary-500"></span>
                    <span class="color-primary-600"></span>
                    <span class="color-primary-700"></span>
                    <span class="color-primary-800"></span>
                    <span class="color-primary-900"></span>
                    <span class="color-info-50"></span>
                    <span class="color-info-100"></span>
                    <span class="color-info-200"></span>
                    <span class="color-info-300"></span>
                    <span class="color-info-400"></span>
                    <span class="color-info-500"></span>
                    <span class="color-info-600"></span>
                    <span class="color-info-700"></span>
                    <span class="color-info-800"></span>
                    <span class="color-info-900"></span>
                    <span class="color-danger-50"></span>
                    <span class="color-danger-100"></span>
                    <span class="color-danger-200"></span>
                    <span class="color-danger-300"></span>
                    <span class="color-danger-400"></span>
                    <span class="color-danger-500"></span>
                    <span class="color-danger-600"></span>
                    <span class="color-danger-700"></span>
                    <span class="color-danger-800"></span>
                    <span class="color-danger-900"></span>
                    <span class="color-warning-50"></span>
                    <span class="color-warning-100"></span>
                    <span class="color-warning-200"></span>
                    <span class="color-warning-300"></span>
                    <span class="color-warning-400"></span>
                    <span class="color-warning-500"></span>
                    <span class="color-warning-600"></span>
                    <span class="color-warning-700"></span>
                    <span class="color-warning-800"></span>
                    <span class="color-warning-900"></span>
                    <span class="color-success-50"></span>
                    <span class="color-success-100"></span>
                    <span class="color-success-200"></span>
                    <span class="color-success-300"></span>
                    <span class="color-success-400"></span>
                    <span class="color-success-500"></span>
                    <span class="color-success-600"></span>
                    <span class="color-success-700"></span>
                    <span class="color-success-800"></span>
                    <span class="color-success-900"></span>
                    <span class="color-fusion-50"></span>
                    <span class="color-fusion-100"></span>
                    <span class="color-fusion-200"></span>
                    <span class="color-fusion-300"></span>
                    <span class="color-fusion-400"></span>
                    <span class="color-fusion-500"></span>
                    <span class="color-fusion-600"></span>
                    <span class="color-fusion-700"></span>
                    <span class="color-fusion-800"></span>
                    <span class="color-fusion-900"></span>
                </p>
                <!-- END Color profile -->
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->
    <!-- BEGIN Quick Menu -->

    <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
    @include('layouts/quickmenu')
    <!-- END Quick Menu -->

    <!-- BEGIN Messenger -->
    @include('layouts/messenger')
    <!-- END Messenger -->

    <!-- BEGIN Page Settings -->
    @include('layouts/setting')

    @yield('footer')

    <!-- END Page Settings -->
    <!-- base vendor bundle:
   DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
      + pace.js (recommended)
      + jquery.js (core)
      + jquery-ui-cust.js (core)
      + popper.js (core)
      + bootstrap.js (core)
      + slimscroll.js (extension)
      + app.navigation.js (core)
      + ba-throttle-debounce.js (core)
      + waves.js (extension)
      + smartpanels.js (extension)
      + src/../jquery-snippets.js (core) -->


    {{-- <script src="{{ asset('plugin/js/vendors.bundle.js') }}"></script> --}}
    <script src="{{ asset('plugin/js/app.bundle.js') }}"></script>
    <script type="text/javascript">
        /* Activate smart panels */
        $('#js-page-content').smartPanel();
    </script>
    <script src="{{ asset('plugin/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('plugin/js/notifications/toastr/toastr.js') }}"></script>
    <script src="{{ asset('plugin/js/datagrid/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('plugin/js/dependency/moment/moment.js') }}"></script>
    <script src="{{ asset('plugin/js/datable-datetime-plugin.js') }}"></script>
    <script src="{{ asset('plugin/js/formplugins/select2/select2.bundle.js') }}"></script>
    <script src="{{ asset('plugin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugin/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('plugin/js/block-ui.js') }}"></script>
    <script src="{{ asset('plugin/js/misc_blockui.js') }}"></script>
    <script src="{{ asset('plugin/js/myapp.js') }}"></script>
    <script src="{{ asset('plugin/js/statistics/flot/flot.bundle.js') }}"></script>
    <script src="{{ asset('plugin/js/statistics/peity/peity.bundle.js') }}"></script>


    <!--for dashboard-->
    <script src="{{ asset('plugin/js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('plugin/js/statistics/sparkline/sparkline.bundle.js') }}"></script>
    <script src="{{ asset('plugin/js/statistics/easypiechart/easypiechart.bundle.js') }}"></script>
    <script src="{{ asset('plugin/js/miscellaneous/jqvmap/jqvmap.bundle.js') }}"></script>

    {{-- add js Ckeditor --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
    {{-- add js Ckeditor --}}
    {{-- button image with file manager --}}
    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    </script>
    {{-- button image with file manager --}}

    <!--for dashboard-->

    <script src="{{ asset('plugin/js/datagrid/datatables/datatables.export.js') }}"></script>
    <script src="{{ asset('plugin/js/statistics/chartjs/chartjs.bundle.js') }}"></script>

    <!--for dashboard-->

    <!--This page contains the basic JS and CSS files to get started on your project. If you need aditional addon's or plugins please see scripts located at the bottom of each page in order to find out which JS/CSS files to add.-->

    @yield('script')
</body>
<!-- END Body -->

</html>

<script>
    $(document).ready(function() {
        getSocialUserImage();
        displayPanelMenu(); //in myapp.js in public plugin

        /*const urlParams = new URLSearchParams(window.location.search);
        const AssetId = urlParams.get('AssetId');

        if (AssetId != null) {
            LayoutAssetDetailIndex(AssetId);
        }*/


        logOutTimer();
    });


    function logOutTimer() {
        setInterval(function() {
            var end = moment(SessionEnd, "YYYY-MM-DD HH:mm:ss"); //ending time
            var duration = moment.duration(end.diff(moment())).asMilliseconds();
            if (duration <= 0) {
                logOut();
            }
        }, 1500);
    }

    function logOut() {
        $.ajax({
            url: "{{ url('api/logout') }}",
            type: "POST",
            data: {
                _token: formToken,
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            headers: {
                'Accept': 'application/json'
            },
            success: function(response) {
                window.location.replace("{{ url('/login') }}");
                Msg('log out Success', 'success');
            },
            error: function(xhr) {
                Msg('Error logout", "error');
            }
        });
    }

    function getSocialUserImage() {
        $.ajax({
            url: "{{ url('api/admin/getUserImage') }}",
            type: "POST",
            data: {
                _token: formToken,
                userid: appuserid
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            headers: {
                'Accept': 'application/json'
            },
            success: function(response) {
                appuserphoto = response.data;
                $("#leftpaneluserphoto").prop("src", "data:image/jpeg;base64," + appuserphoto);
                $("#leftpaneluserphoto").attr("title", appusername);
                $("#leftpanelusername").html(appusername);
                $("[name='headeruserphoto']").prop("src", "data:image/jpeg;base64," + appuserphoto)
                $("[name='headeruserphoto']").attr("title", appusername);
                $("[name='headerusername']").html(appusername);
            },
            error: function(xhr) {
                Msg('Error get user photo', 'error');
            }
        });
    }
</script>

<script>
    function blockagePage(action) {
        $.blockUI({
            message: '<div class="sk-folding-cube sk-primary"><div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div><h5 style="color: #444" id="blockuiCenterCaption">' +
                action + '</h5>',
            css: {
                backgroundColor: 'transparent',
                border: '0',
                zIndex: 9999999
            },
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                zIndex: 9999990
            }
        });
    }

    function unblockagePage() {
        $(document).ajaxStop($.unblockUI);
    }
</script>
