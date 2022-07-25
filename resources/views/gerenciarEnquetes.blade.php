@extends('master')

@section('content')

<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Gerencie suas enquetes</h3>
                        <div class="nk-block-des text-soft">
                            <p>Visualize e gerencie suas enquetes.</p>
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormCadastroEnquete">Cadastrar Nova Enquete</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->


            <div class="nk-block">
                <div class="row g-gs">
                    <?php foreach($ENQUETES as $ENQUETE): ?>
                        <div class="col-sm-6 col-xl-4">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="project">
                                        <div class="project-head">
                                            <a href="html/apps-kanban.html" class="project-title">
                                                <div class="user-avatar sq bg-purple"><span><?= $ENQUETE->ID; ?></span></div>
                                                <div class="project-info">
                                                    <h6 class="title"><?= $ENQUETE->TITULO; ?></h6>
                                                    <span class="sub-text">Criado por Signo Web</span>
                                                </div>
                                            </a>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 me-n1" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="http://127.0.0.1:8000/enquete-<?= $ENQUETE->ID; ?>" target="_blank"><em class="icon ni ni-eye"></em><span>Visualizar Enquete</span></a></li>
                                                        <!-- <li><a class="js_editar_enquete" data-id="<?= $ENQUETE->ID; ?>" data-bs-toggle="modal" data-bs-target="#modalFormEditarEnquete"><em class="icon ni ni-edit"></em><span>Editar Enquete</span></a></li> -->
                                                        <li><a href="#"><em class="icon ni ni-check-round-cut"></em><span>Antecipar Término</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="project-details">
                                            <p><?= $ENQUETE->DESCRICAO; ?></p>
                                        </div>
                                        <div class="project-progress">
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span><?= Helpers::QntTotalVotos($ENQUETE->ID)->VOTOS; ?> Votos</span></div>
                                                <!-- <div class="project-progress-percent">93.5%</div> -->
                                            </div>
                                            <div class="progress progress-pill progress-md bg-light">
                                                <div class="progress-bar" data-progress="50"></div>
                                            </div>
                                        </div>
                                        <div class="project-meta">
                                            <span class="badge badge-dim bg-warning"><em class="icon ni ni-clock"></em><span>Faltam <?= Helpers::diasDatas(date('Y-m-d'), $ENQUETE->DATAFIM); ?> dias</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div><!-- .nk-block -->

        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalFormCadastroEnquete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova Enquete</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="d-flex mb-2">
                    <h5 class="card-title text-secondary">Dados da enquete</h5>
                </div>
                <form action="/form-cadastro-enquete" class="form-validate is-alter" method="post" name="FormCadastroEnquete" autocomplete="off">
                    <div class="row gy-2 ">
                        <div class="col-md-12 mt-0">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input name="TITULO" type="text" class="form-control mt-3 form-control-outlined" id="outlined-nome-mpc">
                                    <label class="form-label-outlined" for="outlined-nome-mpc">Título</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-0">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input name="DATAINICIO" type="text" class="js-mask-data form-control mt-3 form-control-outlined" for="outlined-dt-nascimento-mpc">
                                    <label class="form-label-outlined" for="outlined-dt-nascimento-mpc">Data de início</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-0">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input name="DATAFIM" type="text" class="js-mask-data form-control form-control-outlined mt-3 form-control-outlined" id="outlined-telefone-mpc">
                                    <label class="form-label-outlined" for="outlined-telefone-mpc">Data de fim</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-0 mb-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <textarea name="DESCRICAO" class="form-control no-resize mt-3 form-control-outlined" id="default-observacoes-mcc"></textarea>
                                    <label class="form-label-outlined" for="outlined-observacoes-mcc">Descrição</label>
                                </div>
                            </div>
                        </div>
                        <span class="preview-title-lg overline-title">RESPOSTAS PARA A ENQUETE</span>
                            <li class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="PRIMEIRARESPOSTA" type="text" class="form-control form-control form-control-outlined" id="outlined-normal">
                                        <label class="form-label-outlined" for="outlined-normal">Primeira Resposta</label>
                                    </div>
                                </div>
                            </li>
                            <li class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="SEGUNDARESPOSTA" type="text" class="form-control form-control form-control-outlined" id="outlined-normal">
                                        <label class="form-label-outlined" for="outlined-normal">Segunda Resposta</label>
                                    </div>
                                </div>
                            </li>
                            <li class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="TERCEIRARESPOSTA" type="text" class="form-control form-control form-control-outlined" id="outlined-normal">
                                        <label class="form-label-outlined" for="outlined-normal">Terceira Resposta</label>
                                    </div>
                                </div>
                            </li>
                            <li class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="QUARTARESPOSTA" type="text" class="form-control form-control form-control-outlined" id="outlined-normal">
                                        <label class="form-label-outlined" for="outlined-normal">Quarta Resposta (Opcional)</label>
                                    </div>
                                </div>
                            </li>
                            <li class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="QUINTARESPOSTA" type="text" class="form-control form-control form-control-outlined" id="outlined-normal">
                                        <label class="form-label-outlined" for="outlined-normal">Quinta Resposta (Opcional)</label>
                                    </div>
                                </div>
                            </li>
                        <div class="form-group d-flex flex-row-reverse">
                            <button id="adicionarLinha" type="submit" class="btn btn-lg btn-primary">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection             