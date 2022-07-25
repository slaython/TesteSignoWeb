<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base" content="<?=env('APP_URL');?>">

    <!-- Page Title  -->
    <title>Enquete | SignoWeb</title>

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
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="content-page wide-md m-auto">
                                <div class="nk-block-head nk-block-head-lg wide-sm mx-auto">
                                    <div class="nk-block-head-content text-center">
                                        <h2 class="nk-block-title fw-normal"><?= $ENQUETE->TITULO; ?></h2>
                                        <div class="nk-block-des">
                                            <p class="lead"><?= $ENQUETE->DESCRICAO; ?></p>
                                            <p class="text-soft ff-italic">Período de votação: <?= $ENQUETE->DATAINICIO; ?>, <?= $ENQUETE->DATAFIM; ?></p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->



                                <div class="card card-bordered card-preview">
                                    <form action="/form-votacao" name="FormVotacao" method="post">
                                        <input type="hidden" name="IDENQUETE" value="<?= $ENQUETE->ID; ?>">
                                        <div class="card-inner">
                                            <div class="row g-gs">
                                                <span class="preview-title overline-title">Escolha uma das opções</span>
                                                <ul class="custom-control-group custom-control-vertical w-100">
                                                    <?php foreach ($RESPOSTAS as $RESPOSTA): ?>
                                                        <?php if(!empty($RESPOSTA->RESPOSTA)): ?>
                                                            <li class="d-flex justify-content-between align-items-center">
                                                                <div class="custom-control custom-control-sm custom-radio custom-control-pro w-100">
                                                                    <input type="radio" class="custom-control-input" name="IDRESPOSTA" value="<?= $RESPOSTA->IDRESPOSTA; ?>" id="<?= $RESPOSTA->IDRESPOSTA; ?>">
                                                                    <label class="custom-control-label" for="<?= $RESPOSTA->IDRESPOSTA; ?>">
                                                                        <span><?= $RESPOSTA->RESPOSTA; ?></span>
                                                                    </label>
                                                                </div>
                                                                <h3 class="ms-2"><?= Helpers::QntVotos($ENQUETE->ID, $RESPOSTA->IDRESPOSTA)->VOTOS; ?></h3>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <li class="w-100">
                                                        <button type="submit" class="btn btn-xl btn-outline-primary w-100 d-flex justify-content-center">VOTAR</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- .card-preview -->
                            </div><!-- .content-page -->
                        </div>
                    </div>
                </div>
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