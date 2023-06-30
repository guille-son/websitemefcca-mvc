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
                    <h1 id="pantalla">Videos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Videos</li>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearVideo">Agregar
                                un nuevo video</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaVideos" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Estructura</th>
                                        <th>Categoria</th>
                                        <th>Titulo</th>
                                        <th>Acciones</th>
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
<!-- ================== Modal Nuevo Video ================= -->
<!-- ====================================================== -->

<div class="modal fade" id="crearVideo">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_registro_video" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Nuevo Video</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalRegistroVideo">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Estructura</label>
                        <select class="form-control select2 select2-hidden-accessible seleccionarEstructuraVideo"
                            name="registroEstructura" style="width: 100%" aria-hidden="true">
                            <option value="default" selected="selected">Seleccione una estructura</option>
                            <?php foreach ($estructurasVideo as $key => $valueEstructura) : ?>
                            <option value="<?php echo $valueEstructura['id']; ?>">
                                <?php echo $valueEstructura['titulo']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control select2 select2-hidden-accessible seleccionarCatalogoVideo"
                            name="registroCategoria" style="width: 100%" aria-hidden="true">
                            <option value="default" selected="selected">Seleccione una categoria</option>
                            <?php foreach ($catalogoVideo as $key => $valueCatalogo) : ?>
                            <option
                                value="<?php echo $valueCatalogo['id']; ?>,<?php echo $valueCatalogo['catalogo']; ?>">
                                <?php echo $valueCatalogo['catalogo']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="form-control" id="registroTitulo" name="registroTitulo"
                            placeholder="Escriba el titulo del video">
                    </div>

                    <div class="card rounded-lg card-secondary card-outline">

                        <div class="card-header pl-2 pl-sm-3"><label>Vídeo:</label></div>

                        <div class="card-body vistaVideo"></div>

                        <div class="card-footer">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger"><i class="fab fa-youtube"></i></span>
                                </div>

                                <input type="text" class="form-control agregarVideo" name="registroCodigo" placeholder="Agregue el código del vídeo">

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarRegistroVideo">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="registroVideo">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================== -->
<!-- ================= Modal Editar Video ================= -->
<!-- ====================================================== -->

<div class="modal fade" id="editarVideoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_editar_video" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Editar Video</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalEditarVideo">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="editarIdVideo">
                    <div class="form-group">
                        <label>Estructura</label>
                        <select class="form-control select2 select2-hidden-accessible seleccionarEstructuraVideoEditar"
                            name="editarEstructura" style="width: 100%" aria-hidden="true">
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control select2 select2-hidden-accessible seleccionarCatalogoVideoEditar" 
                            name="editarCategoria" style="width: 100%" aria-hidden="true">
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="form-control" id="editarTitulo" name="editarTitulo"
                            placeholder="Escriba el titulo del video">
                    </div>

                    <div class="card rounded-lg card-secondary card-outline">

                        <div class="card-header pl-2 pl-sm-3"><label>Vídeo:</label></div>

                        <div class="card-body vistaVideo"></div>

                        <div class="card-footer">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger"><i class="fab fa-youtube"></i></span>
                                </div>

                                <input type="text" class="form-control agregarVideo" name="editarCodigo" placeholder="Agregue el código del vídeo">

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarEditarVideo">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="editarVideo">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>