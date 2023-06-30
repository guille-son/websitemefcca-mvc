<?php
    $estructurasDoc = ControladorEstructura::ctrMostrarEstructura(null, null);
    $catalogoDoc = ControladorCatalogo::ctrMostrarCatalogoPorCodigo('TDOC');
?>

<div class="content-wrapper" style="min-height: 1148.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="pantalla">Documentos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Documentos</li>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearDocumento">Agregar
                                un nuevo documento</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaDocumentos" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Estructura</th>
                                        <th>Categoria</th>
                                        <th>Titulo</th>
                                        <th style="width: 100px;">Imagen</th>
                                        <th style="width: 20px;">Tipo</th>
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
<!-- ================ Modal Nuevo Documento =============== -->
<!-- ====================================================== -->

<div class="modal fade" id="crearDocumento">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_registro_documento" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Subir Nuevo Documento</h4>
                    <button type="button" class="close" data-dismiss="modal" id="btCerrarModalRegistroDocumento">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Estructura</label>
                        <select class="form-control select2 select2-hidden-accessible seleccionarEstructuraDocumento" name="registroEstructura" style="width: 100%" aria-hidden="true">
                            <option value="default" selected="selected">Seleccione una estructura</option>
                            <?php foreach ($estructurasDoc as $key => $valueEstructura) : ?>
                                <option value="<?php echo $valueEstructura['id']; ?>,<?php echo $valueEstructura['titulo']; ?>"><?php echo $valueEstructura['titulo']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control select2 select2-hidden-accessible seleccionarCatalogoDocumento" name="registroCategoria" style="width: 100%" aria-hidden="true">
                            <option value="default" selected="selected">Seleccione una categoria</option>
                            <?php foreach ($catalogoDoc as $key => $valueCatalogo) : ?>
                                <option value="<?php echo $valueCatalogo['id']; ?>,<?php echo $valueCatalogo['catalogo']; ?>"><?php echo $valueCatalogo['catalogo']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="form-control" id="registroTitulo" name="registroTitulo" placeholder="Escriba el titulo del documento">
                    </div>

                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control" id="registroDescripcion" name="registroDescripcion" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="subirDocumento">Cargue un Documento</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="subirDocumento" name="subirDocumento">
                                <label id="nombreArchivoNuevoDocumento" class="custom-file-label" for="subirDocumento"></label>
                            </div>
                        </div>
                        <p class="help-block small">Peso Max. 35MB | Formato: PDF</p>
                    </div>

                    <div class="form-group mb-0">

                        <div class="btn btn-default btn-file">

                            <i class="fas fa-paperclip"></i> Adjunte la imagen
                            <input type="file" class="form-control-file border" name="subirImagenDocumento">
                            <input type="hidden" id="rutaImagen" name="rutaImagen"></input>

                        </div>

                        <p class="help-block small">Peso Max. 5MB | Formato: JPG o PNG</p>

                        <img class="previsualizarDocumento img-fluid rounded-lg">

                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnCancelarRegistroDocumento">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="registroDocumento">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ====================================================== -->
<!-- ================ Modal Editar Documento ============== -->
<!-- ====================================================== -->

<div class="modal fade" id="editarDocumentoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_editar_documento" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Editar Documento</h4>
                    <button type="button" class="close" data-dismiss="modal" id="btCerrarModalEditarDocumento">&times;</button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="editarIdDocumento">

                    <div class="form-group">
                        <label>Estructura</label>
                        <select class="form-control select2 select2-hidden-accessible seleccionarEditarEstructuraDocumento" name="editarEstructura" style="width: 100%" aria-hidden="true" readonly></select>
                    </div>

                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control select2 select2-hidden-accessible seleccionarEditarCatalogoDocumento" name="editarCategoria" style="width: 100%" aria-hidden="true" readonly></select>
                    </div>

                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="form-control" id="editarTitulo" name="editarTitulo" placeholder="Escriba el titulo del documento">
                    </div>

                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control" id="editarDescripcion" name="editarDescripcion" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="subirEditarDocumento">Cargue un Documento</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="subirEditarDocumento" name="subirEditarDocumento">
                                <input type="hidden" name="archivoActual" id="archivoActual"></input>
                                <label id="nombreArchivoNuevoEditarDocumento" class="custom-file-label" for="subirEditarDocumento"></label>
                            </div>
                        </div>
                        <p class="help-block small">Peso Max. 35MB | Formato: PDF</p>
                    </div>

                    <div class="form-group mb-0">

                        <div class="btn btn-default btn-file">

                            <i class="fas fa-paperclip"></i> Adjunte la imagen
                            <input type="file" class="form-control-file border" name="subirImagenEditarDocumento">
                            <input type="hidden" id="rutaImagenNueva" name="rutaImagenNueva"></input>
                            <input type="hidden" name="imagenActual" id="imagenActual"></input>
                        </div>

                        <p class="help-block small">Peso Max. 5MB | Formato: JPG o PNG</p>

                        <img class="previsualizarDocumentoEditar img-fluid rounded-lg">

                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnCancelarEditarDocumento">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="editarDocumento">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>