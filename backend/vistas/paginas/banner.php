<?php
    if(($usuarioIngreso['rol'] != 'Administrador') && ($usuarioIngreso['rol'] != 'Super Administrador')) {
        echo "<script>
            window.location = 'inicio';
        </script>";

        return;
    }
?>

<div class="content-wrapper" style="min-height: 1148.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="pantalla">Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Banner</li>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearBanner">Crear
                                nuevo banner</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaBanner" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th style="width: 50px;">Orden</th>
                                        <th>Imagen</th>
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
<!-- ================= Modal Crear Banner ================= -->
<!-- ====================================================== -->

<div class="modal fade" id="crearBanner">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_registro_banner" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Crear Banner</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalRegistroBanner">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group my-2">

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="subirBanner" name="subirBanner" required>
                                <label class="custom-file-label" id="nombreArchivoNuevoBanner" for="subirBanner"></label>
                            </div>
                        </div>

                        <p class="help-block small">Peso Max. 15MB | Formato: JPG o PNG</p>

                        <img class="previsualizarBanner img-fluid rounded-lg">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarRegistroBanner">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="registroBanner">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================== -->
<!-- ================ Modal Editar Banner ================= -->
<!-- ====================================================== -->

<div class="modal fade" id="editarBannerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_editar_banner" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Editar Banner</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalEditarBanner">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Elije el orden de la imagen:</label>

                        <select id="select-editar-orden" class="form-control" name="editarOrden" required></select>
                    </div>

                    <div class="form-group my-2">

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="editarBanner" name="editarBanner">
                                <label class="custom-file-label" for="editarBanner"></label>
                            </div>
                        </div>

                        <input type="hidden" name="bannerActual">

                        <p class="help-block small">Peso Max. 15MB | Formato: JPG o PNG</p>

                        <img class="previsualizarBanner img-fluid rounded-lg">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarEditarBanner">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="editarBanner">
                        <input type="hidden" name="ordenActual">
                        <input type="hidden" name="idBanner">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>