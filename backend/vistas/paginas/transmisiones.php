<?php

    $estructurasVideo = ControladorEstructura::ctrMostrarEstructura(null, null);
    $catalogoVideo = ControladorCatalogo::ctrMostrarCatalogoPorCodigo('CTGV');

?>

<div class="content-wrapper" style="min-height: 1148.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="pantalla">Transmisiones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Transmisiones</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#crearTransmision">Agregar
                                una nueva Transmisión</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaTransmision"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Titulo</th>
                                        <th style="width: 200px;">Hora Aprox. Finalización</th>
                                        <th style="width: 100px;">Estado</th>
                                        <th style="width: 100px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<!-- ====================================================== -->
<!-- =============== Modal Nueva Transmisión ============== -->
<!-- ====================================================== -->

<div class="modal fade" id="crearTransmision">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_registro_transmision" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Nueva Transmisión</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalRegistroTransmision">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="form-control" id="registroTitulo" name="registroTitulo"
                            placeholder="Escriba el titulo de la transmisión" required>
                    </div>

                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Hora Aprox. Finalización:</label>
                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" id="registroHoraTransmision" name="registroHoraTransmision" required data-inputmask='"mask": "99:99:99"' data-mask>
                                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary"><i class="fab fa-facebook"></i></span>
                        </div>
                        <input type="text" class="form-control seleccionarLinkFace" id="registroLinkTransmision" name="registroLinkTransmision" placeholder="Copie el link de la Transmisión" required>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarRegistroTransmision">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="registroTransmision">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================== -->
<!-- ============== Modal Editar Transmision ============== -->
<!-- ====================================================== -->

<div class="modal fade" id="editarTransmisionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_editar_transmision" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Editar Transmisión</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalEditarTransmision">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="editarIdTransmision">

                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="form-control" id="editarTitulo" name="editarTitulo"
                            placeholder="Escriba el titulo de la transmisión" required>
                    </div>

                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Hora Aprox. Finalización:</label>
                            <div class="input-group date" id="timepickerEditar" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#timepickerEditar" id="editarHoraTransmision" name="editarHoraTransmision" required data-inputmask='"mask": "99:99:99"' data-mask>
                                <div class="input-group-append" data-target="#timepickerEditar" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary"><i class="fab fa-facebook"></i></span>
                        </div>
                        <input type="text" class="form-control seleccionarLinkFace" id="editarLinkTransmision" name="editarLinkTransmision" placeholder="Copie el link de la Transmisión" required>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarEditarTransmision">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="editarTransmision">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>