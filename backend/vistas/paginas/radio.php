<div class="content-wrapper" style="min-height: 1148.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="pantalla">Programas Radiales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Programas Radiales</li>
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
                                data-target="#crearRadio">Agregar un nuevo programa</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaRadio"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Tema</th>
                                        <th style="width: 120px;">Fecha</th>
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
<!-- ============ Modal Nuevo Programa de Radio =========== -->
<!-- ====================================================== -->

<div class="modal fade" id="crearRadio">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_registro_radio" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Nuevo Programa de Radio</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalRegistroRadio">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-microphone"></span>
                        </div>
                        <input type="text" class="form-control" id="registroTema" name="registroTema"
                            placeholder="Escriba el tema del programa">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-calendar-alt"></span>
                        </div>
                        <input type="text" class="form-control" id="registroFecha" name="registroFecha">
                    </div>

                    <div class="form-group">
                        <label for="subirPrograma">Cargue un Programa</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="subirPrograma" name="subirPrograma">
                                <label id="nombreArchivoNuevoPrograma" class="custom-file-label" for="subirPrograma"></label>
                            </div>
                        </div>
                        <p class="help-block small">Peso Max. 100MB | Formato: MP3</p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarRegistroRadio">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="registroRadio">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================== -->
<!-- =========== Modal Editar Programa de Radio =========== -->
<!-- ====================================================== -->

<div class="modal fade" id="editarRadioModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_editar_radio" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Editar Programa de Radio</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalEditarRadio">&times;</button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="editarIdRadio">

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-microphone"></span>
                        </div>
                        <input type="text" class="form-control" id="editarTema" name="editarTema"
                            placeholder="Escriba el tema del programa">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-calendar-alt"></span>
                        </div>
                        <input type="text" class="form-control" id="editarFecha" name="editarFecha">
                    </div>

                    <div class="form-group">
                        <label for="subirProgramaEditar">Cargue un Programa</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="programaActual" id="programaActual"></input>
                                <input type="file" class="custom-file-input" id="subirProgramaEditar" name="subirProgramaEditar">
                                <label id="nombreArchivoEditarPrograma" class="custom-file-label" for="subirProgramaEditar"></label>
                            </div>
                        </div>
                        <p class="help-block small">Peso Max. 100MB | Formato: MP3</p>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarEditarRadio">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="editarRadio">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>