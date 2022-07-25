<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base" content="<?=env('APP_URL');?>">

    <!-- Page Title  -->
    <title>SignoWeb | Enquetes</title>

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="./assets/css/dashlite.css?ver=3.0.2">
    <link id="skin-default" rel="stylesheet" href="./assets/css/theme.css?ver=3.0.2">

    <!--Toastr CSS -->
    <link type="text/css" href="{{ asset('/assets/css/toastr.min.css') }}" rel="stylesheet">

    <!--SeetAlert2-->
    <link type="text/css" href="{{ asset('/assets/css/sweetalert2.min.css') }}" rel="stylesheet">
</head>

<body class="nk-body bg-white has-sidebar dark-mode">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
                <!-- <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div> -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-body" data-simplebar>
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu">
                                <ul class="nk-menu">
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title text-primary-alt">MENU</h6>
                                    </li>
                                    <?php foreach($MENU as $Menu): ?>
                                    <li class="nk-menu-item">
                                        <a href="http://127.0.0.1:8000/<?= $Menu->CAMINHO; ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><?= $Menu->ICONE; ?></span>
                                            <span class="nk-menu-text"><?= $Menu->NOME; ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title text-primary-alt">ENQUETES ATIVAS</h6>
                                    </li>
                                    <?php foreach($ENQUETES as $ENQUETE): ?>
                                    <li class="nk-menu-item">
                                        <a href="http://127.0.0.1:8000/enquete-<?= $ENQUETE->ID; ?>" target="_blank" class="nk-menu-link">
                                            <span class="nk-menu-icon"><?= $ENQUETE->ICONE; ?></span>
                                            <span class="nk-menu-text"><?= $ENQUETE->TITULO; ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul><!-- .nk-menu -->
                            </div><!-- .nk-sidebar-menu -->
                        </div><!-- .nk-sidebar-content -->
                    </div><!-- .nk-sidebar-body -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <!-- <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    
                                </a>
                            </div> -->
                            <div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">
                                    <a class="nk-news-item" href="https://github.com/slaython/TesteSignoWeb" target="_blank">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-card-view"></em>
                                        </div>
                                        <div class="nk-news-text">
                                            <p>Quer ver o código? <span> Acesse pelo github.......</span></p>
                                            <em class="icon ni ni-external"></em>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">Administrator</div>
                                                    <div class="user-name">Signo Web</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                @yield('content')
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; 2022 Slaython Gleyson, teste Signo Web.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=3.0.2"></script>
    <script src="./assets/js/scripts.js?ver=3.0.2"></script>
    <script src="./assets/js/charts/gd-default.js?ver=3.0.2"></script>
    
    <!-- Jquery -->
    <script src="{{ asset('/assets/js/jquery.form.js') }}?nocache=<?=time();?>"></script>
    <script src="{{ asset('/assets/js/jquery.mask.min.js') }}"></script>
    
    <script src="{{ asset('/widgets/signoweb.js') }}?nocache=<?=time();?>"></script>

    <!-- DOM Factory -->
    <script src="{{ asset('/assets/js/dom-factory.js') }}"></script>

    <!-- Toastr.js -->
    <script src="{{ asset('/assets/js/toastr.min.js') }}"></script>

    <!--SweetAler2-->
    <script src="{{ asset('/assets/js/sweetalert2.all.min.js') }}?nocache=<?=time();?>"></script>
</body>

</html>